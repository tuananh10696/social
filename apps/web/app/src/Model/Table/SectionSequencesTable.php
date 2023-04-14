<?php 
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class SectionSequencesTable extends AppTable {

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
    public function initialize(array $config) : void
    {


        $this->hasMany('UserInfoContents')
            ->setDependent(true);

        
        parent::initialize($config);
    }


    public function createNumber() {
        $entity = $this->newEntity();

        $this->save($entity);
        return $entity->id;
    }
}