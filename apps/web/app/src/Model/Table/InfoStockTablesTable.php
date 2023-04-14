<?php 
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class InfoStockTablesTable extends AppTable {

    // テーブルの初期値を設定する
    public $defaultValues = [
        "id" => null
    ];

    public $attaches = array('images' =>
                            array(),
                            'files' => array(),
                            );

    // 推奨サイズ
    // public $recommend_size_display = [
    //     'image' => true, //　編集画面に推奨サイズを常時する場合の指定
    //     // 'image' => ['width' => 300, 'height' => 300] // attaachesに書かれているサイズ以外の場合の指定
    //     // 'image' => false
    // ];
                            // 
    public function initialize(array $config): void
    {

        $this->belongsTo('Items');

        
        parent::initialize($config);
    }

    // Validation
    public function validationDefault(Validator $validator): Validator
    {

        $validator

            ;

        return $validator;
    }
}