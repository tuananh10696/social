<?php
namespace App\Model\Table;

use App\Consts\DataSet;
use App\Consts\InfoConsts;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class UseradminLogsTable extends AppTable {

    // テーブルの初期値を設定する
    public $defaultValues = [
        "id" => null,
    ];

    public $attaches = array('images' =>
                            array(),
                            'files' => array( ),
                            );

                            //
    public function initialize(array $config) : void
    {


        parent::initialize($config);

    }

    // Validation
    public function validationDefault(Validator $validator) : Validator
    {
        $validator->setProvider('User', 'App\Validator\UserValidation');

        $validator

            ;

        return $validator;
    }

}