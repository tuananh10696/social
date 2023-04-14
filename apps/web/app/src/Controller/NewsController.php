<?php

namespace App\Controller;

class NewsController extends AppController
{


    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Cms');
        // $this->setHeadTitle('お知らせ');
        // $this->set('__description__', '塩谷町に関する、イベント情報や役にたつ情報を発信します');
    }


    public function index()
    {
        $this->setLists();
        $category_id = $this->request->getQuery('category_id') ?? 0;

        $opts = [
            'limit' => 10,
            'paginate' => true
        ];

        if ($category_id)
            $opts['append_cond'] = ['category_id' => $category_id];

        $infos = $this->Cms->findAll('news', $opts);
        $all_infos = $this->Cms->findAll('news', ['limit' => false]);
        $this->set(compact('infos', 'all_infos'));
    }


    public function detail($id = null)
    {
        $this->setLists();
        $info_array = $this->Cms->findFirst('news', $id);
        if (is_null($info_array)) return $this->redirect(['action' => 'index']);
        $info = $info_array['info'] ?? [];
        extract($info_array);

        $this->set('listId', $this->getNextBack($id));
        $this->set(compact('contents', 'info'));
    }


    public function setLists()
    {
        $category = $this->fetchTable('Categories')
        ->find()
        ->where([
            'PageConfigs.slug' => 'news',
            'Categories.status' => 'publish'
        ])
        ->contain(['PageConfigs', 'Infos' => function ($q) {
        $now = (new \DateTime('now'))->format('Y-m-d H:i:s');
            return $q->where([
                'Infos.status' => 'publish',
                [
                    'OR' => [
                        'Infos.start_at is' => null,
                        'Infos.start_at <=' => $now
                    ]
                ],
                [
                    'OR' => [
                        'Infos.end_at is' => null,
                        'Infos.end_at >=' => $now
                    ]
                ]]);
        }])
        ->toArray();

    $all = $this->fetchTable('Categories')
        ->newEmptyEntity();
    $all->id = 0;
    $all->name = 'すべて';
    $all->infos = $this->Cms->findAll('news')->toArray();

    $list['category'] = [$all, ...$category];

    if (!empty($list)) $this->set(array_keys($list), $list);
    return $list;
    }

    public function getNextBack($id = null)
    {
        $now = (new \DateTime('now'))->format('Y-m-d H:i:s');
        $cond = [
            'Categories.status' => 'publish',
            'Infos.status' => 'publish',
            'Infos.start_at <=' => $now,
            'PageConfigs.slug' => 'news',
                [
                    'OR' => [
                        'Infos.start_at is' => null,
                        'Infos.start_at <=' => $now
                    ]
                ],
                [
                    'OR' => [
                        'Infos.end_at is' => null,
                        'Infos.end_at >=' => $now
                    ]
                ]
        ];

        $this->loadModel('Infos');
        $query = $this->Infos->find('list', [
            'keyField' => 'id',
            'valueField' => 'id'
        ])
            ->where($cond)->order([
                'Infos.position' => 'ASC',
            ])
            ->contain(['PageConfigs', 'Categories']);
        $data = $query->toArray();
        $_listId = array_keys($data);

        $prev_id = $id;
			$next_id = $id;
			for ($i = 0; $i < count($_listId); $i++) {
				if ($_listId[$i] == $id) {
					$prev = $i - 1;
					$prev_id = isset($_listId[$prev]) ? $_listId[$prev] : '';
					$next = $i + 1;
					$next_id = isset($_listId[$next]) ? $_listId[$next] : '';
					break;
				}
			} 

            $prev_id = $this->Cms->findFirst('news', $prev_id);
            $next_id = $this->Cms->findFirst('news', $next_id);

            $listId = [$prev_id, $next_id];
        return $listId;
    }
}
