<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Datasource\ModelAwareTrait;
use Cake\Utility\Inflector;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

use App\Model\Entity\Info;
use App\Model\Entity\AppendItem;

/**
 * OutputHtml component
 */
class CmsComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $itemCount = 0;

    use ModelAwareTrait;

    public function initialize(array $config): void
    {

        $this->Controller = $this->_registry->getController();
        $this->Session = $this->Controller->getRequest()->getSession();

        $this->loadModel('Infos');
        $this->loadModel('PageConfigs');
        $this->loadModel('InfoTops');
        $this->loadModel('Categories');
        $this->loadModel('Infos');
        $this->loadModel('AppendItems');
        $this->loadModel('InfoAppendItems');
        $this->loadModel('InfoStockTables');
    }

    public function getInfoIdsFromAppendItem($slug, $key, $conditions = [])
    {
        $info_ids = [0];

        $cond = [
            'PageConfigs.slug' => $slug,
            'AppendItems.slug' => $key,
        ];
        $contain = [
            'PageConfigs',
            'InfoAppendItems' => function ($q) use ($conditions) {
                return $q->where($conditions);
            }
        ];
        $append_items = $this->AppendItems->find()->where($cond)->contain($contain)->all();
        if (!empty($append_items)) {
            $info_ids = $append_items->extract('info_id');
        }

        return $info_ids;
    }

    public function findAll($slug, $options = [], $paginate = [])
    {
        // page_config
        $page_config = $this->PageConfigs->find()->where(['PageConfigs.slug' => $slug])->first();
        if (empty($page_config)) {
            return null;
        }

        // デフォルトオプション
        $default_cond = ['Infos.status' => 'publish'];
        $now = new \DateTime();
        $default_cond[] = [
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
        $default_contain = [
            'PageConfigs'
        ];
        if ($page_config->is_category == 'Y') {
            if ($page_config->is_category_multiple == 1) { } else {
                $default_contain = [
                    'PageConfigs',
                    'Categories'
                ];
                $default_cond['Categories.status'] = 'publish';
            }
        }
        // 掲載予約機能（タイマー掲載）
        $this->getConditionPublicStart($page_config, $default_cond);

        $order = ['Infos.position' => 'ASC'];

        // オプション
        $options = array_merge([
            'limit' => null,
            'paginate' => false,
            'conditions' => $default_cond,
            'append_cond' => [],
            'contain' => $default_contain,
            'order' => $order,
            'isItemCount' => false
        ], $options);

        // ページネーションオプション
        if ($options['paginate']) {
            $this->Controller->paginate = array_merge([
                'order' => $options['order'],
                'limit' => $options['limit'],
                'contain' => $options['contain'],
                'paramType' => 'querystring',
                'url' => [
                    'sort' => null,
                    'direction' => null
                ]
            ], $paginate);
        }

        // find設定
        $cond = ['PageConfigs.slug' => $slug];
        if (!empty($options['conditions'])) {
            $cond += $options['conditions'];
        }
        if (!empty($options['append_cond'])) {
            $cond += $options['append_cond'];
        }

        $query = $this->Infos->find()->where($cond)->contain($options['contain']);
        if ($options['isItemCount']) {
            $this->itemCount = $query->count();
        }

        if ($options['paginate']) {
            return $this->Controller->paginate($this->Infos->find()->where($cond));
        }

        if ($options['limit']) {
            $query->limit($options['limit']);
        }
        if ($options['order']) {
            $query->order($options['order']);
        }


        return $query->all();
    }

    public function findTop($slug, $options = [])
    {

        $options = array_merge([
            'limit' => null,
            'order' => ['InfoTops.position' => 'ASC']
        ], $options);

        $contain = [
            'Infos',
            'PageConfigs'
        ];

        $cond = [
            'Infos.status' => 'publish',
            'PageConfigs.slug' => $slug
        ];

        $query = $this->InfoTops->find()
            ->where($cond)
            ->contain($contain)
            ->order($options['order']);
        if ($options['limit']) {
            $query->limit($options['limit']);
        }

        $data = $query->all();
        if ($data->isEmpty()) {
            return [];
        }
        return $data;
    }

    public function getCategoryList($slug, $options = [])
    {
        $options = array_merge([
            'cond' => [
                'Categories.status' => 'publish',
                'PageConfigs.slug' => $slug
            ],
            'append_cond' => [],
            'order' => ['Categories.position' => 'ASC']
        ], $options);

        $contain = [
            'PageConfigs'
        ];

        if (!empty($options['append_cond'])) {
            $options['cond'] += $options['append_cond'];
        }

        $categories = $this->Categories->find('list')->where($options['cond'])->contain($contain)->order($options['order'])->all();
        $category_list = [];
        if (!$categories->isEmpty()) {
            $category_list = $categories->toArray();
        }

        return $category_list;
    }

    public function findFirst($slug, $info_id, $options = [])
    {

        if ($this->Controller->getRequest()->getQuery('preview') == 'on') {
            $options['isPreview'] = true;
        }

        $entity = $this->_detail($slug, $info_id, $options);
        if (empty($entity)) {
            return null;
            // throw new NotFoundException('ページが見つかりません');
        }

        $option['section_block_ids'] = array_keys(Info::BLOCK_TYPE_WAKU_LIST);
        $data = $this->toHierarchization($info_id, $entity, $option);

        return [
            'contents' => $data['contents']['contents'],
            'content_count' => $data['content_count'],
            'info' => $entity
        ];
    }

    public function findStocks($slug, $options = [], $paginate = [])
    {
        $options = array_merge(
            [
                'model_name' => '',
                'model_id' => 0,
                'method' => 'all'
            ],
            $options
        );

        $cond = [
            'InfoStockTables.page_slug' => $slug,
            'InfoStockTables.model_name' => $options['model_name'],
            'InfoStockTables.model_id' => $options['model_id']
        ];
        $stocks = $this->InfoStockTables->find()->where($cond)->all();
        $stock_ids = [0];
        if (!$stocks->isEmpty()) {
            $stock_ids = $stocks->extract('info_id')->toArray();
        }

        if ($options['method'] == 'first') {
            return $this->findFirst($slug, $stock_ids[0]);
        } elseif ($options['method'] == 'all') {
            $_cond = [
                'Infos.id in' => $stock_ids
            ];
            unset($options['model_name']);
            unset($options['model_id']);
            unset($options['method']);
            $options = array_merge([
                'append_cond' => $_cond
            ], $options);
            return $this->findAll($slug, $options, $paginate);
        }
    }

    private function _detail($slug, $info_id, $options = [])
    {
        // page_config
        $page_config = $this->PageConfigs->find()->where(['PageConfigs.slug' => $slug])->first();
        if (empty($page_config)) return null;

        // デフォルトオプション
        $now = new \DateTime();
        $default_cond = [
            'Infos.id' => $info_id,
            'Infos.status' => 'publish',
            'Infos.start_at <=' => $now->format('Y-m-d')
        ];

        $default_contain = [
            'PageConfigs',
            'InfoAppendItems' => function ($q) {
                return $q->contain(['AppendItems'])->order(['AppendItems.position' => 'ASC']);
            },
            'InfoContents' => function ($q) {
                return $q->order(['InfoContents.position' => 'ASC'])->contain(['SectionSequences', 'MultiImages']);
            }
        ];

        if ($page_config->is_category == 'Y') {
            if ($page_config->is_category_multiple != 1) {
                $default_contain[] = 'Categories';
                $default_cond['Categories.status'] = 'publish';
            }
        }

        // タイマー掲載
        $this->getConditionPublicStart($page_config, $default_cond);

        $options = array_merge([
            'conditions' => $default_cond,
            'contain' => $default_contain,
            'append_cond' => [],
            'isPreview' => false
        ], $options);

        $cond = $options['conditions'];

        if ($options['isPreview'] && $this->Controller->isUserLogin()) {
            unset($cond['Infos.status']);
            unset($cond['Categories.status']);
            unset($cond['Infos.start_at <=']);
            unset($cond['Infos.end_at >=']);
        }

        if (!empty($options['append_cond']))
            $cond += $options['append_cond'];

        return $this->Infos
            ->find()
            ->where($cond)
            ->contain($options['contain'])
            ->first();
    }


    public function toHierarchization($id, $entity, $options = [])
    {
        $content_count = 0;
        $contents = [
            'contents' => [],
        ];

        if (is_null($entity->info_contents)) return ['contents' => [], 'content_count' => 0];

        $content_count = count($entity->info_contents);

        foreach ($entity->info_contents as $k => $v) {

            // 枠ブロックの中にあるブロック以外　（枠ブロックも対象）
            if (!$v->section_sequence_id || in_array($v->block_type, $options['section_block_ids'])) {
                $contents["contents"][$k] = $v;
                $contents["contents"][$k]['_block_no'] = $k;
            } else {
                // 枠ブロックの中身
                if (is_null($v->section_sequence)) continue;

                $sequence_id = $v->section_sequence_id;

                $waku_number = false;

                foreach ($contents['contents'] as $_k => $_v) {
                    if (in_array($_v->block_type, $options['section_block_ids']) && $sequence_id == $_v->section_sequence_id) {
                        $waku_number = $_k;
                        break;
                    }
                }
                if ($waku_number === false) continue;

                if (is_null($contents["contents"][$waku_number]->sub_contents))
                    $contents["contents"][$waku_number]->sub_contents = [];

                $contents["contents"][$waku_number]->sub_contents[$k] = $v;
                $contents["contents"][$waku_number]->sub_contents[$k]['_block_no'] = $k;
            }
        }

        return [
            'contents' => $contents,
            'content_count' => $content_count
        ];
    }


    public function saveAppend($info_id, $slug, $values = [])
    {
        $info = $this->Infos->find()->where(['Infos.id' => $info_id])->first();
        if (empty($info)) {
            return false;
        }

        $append_item = $this->AppendItems->find()->where(['AppendItems.page_config_id' => $info->page_config_id, 'AppendItems.slug' => $slug])->first();
        if (empty($append_item)) {
            return false;
        }

        $info_append = $this->InfoAppendItems->find()->where(['InfoAppendItems.info_id' => $info_id, 'InfoAppendItems.append_item_id' => $append_item->id])->first();
        if (empty($info_append)) {
            $info_append = $this->InfoAppendItems->newEntity([]);
        }
        $save = $values;
        $save['info_id'] = $info_id;
        $save['append_item_id'] = $append_item->id;

        $entity = $this->InfoAppendItems->patchEntity($info_append, $save);
        return $this->InfoAppendItems->save($entity);
    }


    public function getAppend($page_slug, $slug, $info_id, $options = [])
    {
        $options = array_merge([
            'success' => null,
            'error' => null
        ], $options);

        $page_config = $this->PageConfigs->find()->where(['PageConfigs.slug' => $page_slug])->first();
        if (empty($page_config)) {
            return null;
        }

        $cond = [
            'InfoAppendItems.info_id' => $info_id,
            'AppendItems.page_config_id' => $page_config->id,
            'AppendItems.slug' => $slug
        ];
        $contain = [
            'AppendItems'
        ];

        $data = $this->InfoAppendItems->find()->where($cond)->contain($contain)->first();
        if (empty($data)) {
            if (!empty($options['error'])) {
                return $options['error']();
            }
            return null;
        }

        return $options['success']($data);
    }


    public function isPublicStart($slug, $id)
    { }


    public function getConditionPublicStart($page_config, &$cond)
    {
        $now = new \DateTime();

        if ($page_config->public_timer_mode == 1) {
            $cond['Infos.start_at <='] = $now->format('Y-m-d H:i:s');
        } elseif ($page_config->public_timer_mode == 2) {
            $cond['Infos.start_at <='] = $now->format('Y-m-d H:i:s');
            $cond['Infos.end_at >='] = $now->format('Y-m-d H:i:s');
        }
    }
}
