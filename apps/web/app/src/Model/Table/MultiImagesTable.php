<?php

namespace App\Model\Table;

use Cake\Validation\Validator;

class MultiImagesTable extends AppTable
{

    // テーブルの初期値を設定する
    public $defaultValues = [
        "id" => null,
        "position" => 0
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
        ],
        'files' => []
    ];


    // 
    public function initialize(array $config): void
    {
        $this->addBehavior('FileAttache');
        parent::initialize($config);
    }


    // Validation
    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }
}
