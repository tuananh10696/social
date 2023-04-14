<?php

namespace App\Model\Table;

use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class InfosTable extends AppTable
{

    // テーブルの初期値を設定する
    public $InfoCategories;
    public $defaultValues = [
        "id" => null,
        "position" => 0,
        'status' => 'draft',
        'index_type' => 0
    ];


    // 新CMSの枠ブロックを使う場合の設定
    public $useHierarchization = [
        'contents_table' => 'info_contents',
        'contents_id_name' => 'info_content_id',
        'sequence_model' => 'SectionSequences',
        'sequence_table' => 'section_sequence',
        'sequence_id_name' => 'section_sequence_id'
    ];


    public $attaches = array(
        'images' =>
        array(
            'image' => array(
                'extensions' => array('jpg', 'jpeg', 'gif', 'png'),
                'width' => 1200,
                'height' => 1200,
                'file_name' => 'img_%d_%s',
                'thumbnails' => array(
                    'r' => array(
                        'prefix' => 'r_',
                        'width' => 183,
                        'height' => 117
                    ),
                    's' => array(
                        'prefix' => 's_',
                        'width' => 240,
                        'height' => 151
                    ),
                    'l' => array(
                        'prefix' => 'l_',
                        'width' => 515,
                        'height' => 323
                    ),
                ),
            )
            //image_1
        ),
        'files' => [
            'file' => [
                'extensions' => ['pdf', 'xlsx', 'docx', 'csv', 'ppt', 'pptx'],
                'file_name' => 'file_%d_%s',
            ]
        ]
    );


    // 推奨サイズ
    public $recommend_size_display = [
        // 'image' => true, //　編集画面に推奨サイズを常時する場合の指定
        // 'image' => ['width' => 300, 'height' => 300] // attaachesに書かれているサイズ以外の場合の指定
        // 'image' => false
        'image' => '横幅700以上を推奨。1200x1200以内に縮小されます。'
    ];


    // 
    public function initialize(array $config): void
    {

        // 並び順
        if (CATEGORY_SORT) {
            $this->addBehavior('Position', [
                'group' => ['page_config_id', 'category_id', 'parent_info_id'],
                'groupMove' => true,
                'contain' => ['PageConfigs']
            ]);
        } else {
            $this->addBehavior('Position', [
                'group' => ['page_config_id', 'parent_info_id'],
                'groupMove' => true
            ]);
        }
        // 添付ファイル
        $this->addBehavior('FileAttache');

        $this->hasMany('InfoContents')->setForeignKey('info_id')->setDependent(true);
        $this->hasMany('InfoTags')->setForeignKey('info_id')->setDependent(true);
        $this->hasMany('InfoAppendItems')->setDependent(true);

        $this->hasMany('InfoCategories');
        $this->hasMany('InfoStockTables')->setDependent(true);

        $this->belongsTo('PageConfigs');
        $this->belongsTo('Categories');

        $this->hasOne('InfoTops')->setDependent(true);

        $this->hasMany('ChildInfos', [
            'className' => 'Infos',
            'foreignKey' => 'parent_info_id',
            'dependent' => true
        ]);


        parent::initialize($config);
    }


    // Validation
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('title', '入力してください')
            ->maxLength('title', 100, '100字以内で入力してください')

            ->notEmpty('category_id', '選択してください')
            ->add('category_id', 'check', ['rule' => ['comparison', '>', 0], 'message' => '選択してください'])

            ->allowEmptyString('link', '入力してください')
            ->maxLength('link', 255, '255字以内で入力してください')

            ->allowEmptyString('link_blank', '入力してください')
            ->maxLength('link_blank', 255, '255字以内で入力してください')

            ->allowEmptyString('end_at')
            ->add(
                'end_at',
                [
                    'custom' => [
                        'rule' => function ($value, $context) {
                            if (($context['data']['start_at'])->format('Ymd') > ($value->format('Ymd'))) {
                                return '掲載期間は正しく選択してください';
                            }
                            return true;
                        },
                    ],
                ],
            )

            ->notEmpty('start_at', '入力してください');

        return $validator;
    }


    public function validationCreate(Validator $validator)
    {
        $validator = $this->validationDefault($validator);
        // $validator->allowEmpty('_image')
        //     ->add('_image', 'custom', [
        //         'rule' => function ($value, $context) {
        //             $error = !is_string($value) ? $value->getError() : 1;
        //             if ($error != 0) return 'アップロードできません';
        //             if (!in_array($value->getClientMediaType(), ['image/jpeg', 'image/gif', 'image/png'])) return 'アップロードできません';
        //             return true;
        //         },
        //     ]);

        $validator->allowEmpty('_file')
            ->add('_file', 'custom', [
                'rule' => function ($value, $context) {
                    $error = !is_string($value) ? $value->getError() : 1;
                    if ($error != 0) return 'アップロードできません';
                    if (!in_array($value->getClientMediaType(), ['application/pdf'])) return 'アップロードできません';
                    return true;
                },
            ]);
        return $validator;
    }


    public function validationIsCategory(Validator $validator): Validator
    {
        $validator = $this->validationDefault($validator);

        $validator
            ->setStopOnFailure()
            ->notEmpty('category_id', '選択してください')
            ->add('category_id', 'check', ['rule' => ['comparison', '>', 0], 'message' => '選択してください'])
            ->notEmpty('start_at', '入力してください');

        return $validator;
    }


    public function getRecommendImageSize($column)
    { }


    // 複数カテゴリの場合のカテゴリ取得
    public function getCategories($info_id, $result_type = 'entity', $options = [])
    {
        $options = array_merge([
            'status' => null,
            'where' => null,
            'separator' => '、',
            'empty_result' => '未設定'
        ], $options);

        $this->InfoCategories = TableRegistry::getTableLocator()->get('InfoCategories');

        $contain = [
            'Categories'
        ];
        if ($options['status'] === 'publish' || $options['status'] === 'draft') {
            $contain = [
                'Categories' => function ($q) use ($options) {
                    return $q->where(['Categories.status' => $options['status']])->order(['Categories.position' => 'ASC']);
                }
            ];
        }

        $query = $this->InfoCategories->find()->contain($contain);
        if ($options['where']) {
            $query->where($options['where']);
        }

        $categories = $query->all();

        if ($result_type == 'entity') {
            return $categories;
        } elseif ($result_type == 'names') {
            $names = [];
            foreach ($categories as $c) {
                if (empty($c->category->name)) {
                    continue;
                }
                $names[] = $c->category->name;
            }
            if (empty($names)) {
                return $options['empty_result'];
            }
            return implode($options['separator'], $names);
        }

        return '';
    }

    // public function beforeMarshal(EventInterface $event, \ArrayObject $data, $options)
    // {
    //     $this->_checkDateTime($data, 'start_at');
    //     $this->_checkDateTime($data, 'end_at', DATETIME_ZERO);
    // }
}
