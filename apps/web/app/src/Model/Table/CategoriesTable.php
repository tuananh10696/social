<?php

namespace App\Model\Table;

use Cake\Validation\Validator;

class CategoriesTable extends AppTable
{


    // テーブルの初期値を設定する
    public $defaultValues = [
        "id" => null,
        "position" => 0
    ];

    public $attaches = array(
        'images' =>
        array(),
        'files' => array(),
    );


    // 
    public function initialize(array $config): void
    {
        // 添付ファイル
        $this->addBehavior('Position', [
            'group' => ['page_config_id', 'parent_category_id'],
            'order' => 'DESC'
        ]);

        // アソシエーション
        $this->hasMany('Infos');
        $this->belongsTo('PageConfigs');

        parent::initialize($config);
    }


    // Validation
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('name', '入力してください')
            ->maxLength('name',  40, __('40字以内で入力してください'))
            ->add(
                'name',
                [
                    'custom' => [
                        'rule' => function ($value, $context) {
                            if (mb_ereg_match("^(\s|　)+$", $value)) {
                                return '入力してください';
                            }
                            return true;
                        },
                    ],
                ],
            );

        return $validator;
    }
}
