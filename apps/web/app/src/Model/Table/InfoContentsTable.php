<?php

namespace App\Model\Table;

use Cake\Validation\Validator;

class InfoContentsTable extends AppTable
{

    // テーブルの初期値を設定する
    public $defaultValues = [
        "id" => null,
        "position" => 0,
    ];

    public $attaches = [
        'images' => [

            'image' => [
                'extensions' => ['jpg', 'jpeg', 'gif', 'png'],
                'width' => 1200,
                'height' => 1200,
                'file_name' => 'img_%d_%s',
                'thumbnails' => [
                    's' => [
                        'prefix' => 's_',
                        'width' => 320,
                        'height' => 320
                    ],
                    'm' => [
                        'prefix' => 'm_',
                        'width' => 800,
                        'height' => 800
                    ]
                ],
            ]
            //image_1
        ],
        'files' => [
            'file' => [
                'extensions' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'],
                'file_name' => 'e_f_%d_%s'
            ]
            // file_1
        ],
    ];


    // 推奨サイズ
    public $recommend_size_display = [
        // 'image' => true, //　編集画面に推奨サイズを常時する場合の指定
        // 'image' => ['width' => 700, 'height' => 300] // attaachesに書かれているサイズ以外の場合の指定
        // 'image' => false
        'image' => '横幅700以上を推奨。1200x1200以内に縮小されます。'
    ];


    // 
    public function initialize(array $config): void
    {

        // // 並び順
        // $this->addBehavior('Position', [
        //     'group' => ['user_info_id'],
        //     'groupMove' => false,
        //     'order' => 'DESC'
        // ]);
        // 添付ファイル
        $this->addBehavior('FileAttache');

        $this->belongsTo('SectionSequences');
        $this->belongsTo('Infos');

        $this->hasMany('MultiImages')
            ->setForeignKey('info_content_id')
            ->setBindingKey('id')
            ->setDependent(true);

        parent::initialize($config);
    }


    // Validation
    public function validationDefault(Validator $validator): Validator
    {

        $validator->setProvider('Info', 'App\Validator\InfoValidation');

        $validator
            ->allowEmpty('title', true);

        return $validator;
    }
}
