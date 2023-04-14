<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SiteConfigsTable extends AppTable
{
    // テーブルの初期値を設定する
    public $defaultValues = [
        "id" => null
    ];

    public $attaches = array('images' =>
                            array(),
                            'files' => array(),
                            );
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);


        $this->hasMany('PageConfigs')->setDependent(true);

        $this->hasMany('UserSites')->setDependent(true);

        $this->addBehavior('Position', [
                'order' => 'DESC'
            ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) : Validator
    {
        $validator->setProvider('SiteConfig', 'App\Validator\SiteConfigValidation');

        $validator
            ->notEmpty('site_name', '入力してください')
            ->add('site_name', 'maxLength', [
                'rule' => ['maxLength', 40],
                'message' => '40文字以内で入力してください'])

            ->notEmpty('slug', '入力してください')
            ->add('slug', 'chkName', ['rule' => ['checkName'],'provider' => 'SiteConfig','message' => '数字から始まっているか使えない文字が含まれています'])
            ->add('slug', 'Length', ['rule' => ['lengthBetween', 2, 30],'message' => '2文字以上30文字以内で入力してください'])
            ->add('slug', 'unique', ['rule' => ['isUnique'],'provider' => 'SiteConfig','message' => 'ご希望のディレクトリ名は既に使われております'])
            ->add('slug', 'ng_word', ['rule' => ['ngSlugName'],'provider' => 'SiteConfig','message' => 'このディレクトリ名は使えません'])
            ;


        return $validator;
    }

    public function validationIsRoot(Validator $validator)
    {
        $validator->setProvider('SiteConfig', 'App\Validator\SiteConfigValidation');

        $validator
            ->notEmpty('site_name', '入力してください')
            ->add('site_name', 'maxLength', [
                'rule' => ['maxLength', 40],
                'message' => '40文字以内で入力してください'])
            ;

        return $validator;
    }

    public function getList($cond=[])
    {
        $query = $this->find()->where($cond);
        $list = [];

        if ($query->isEmpty()) {
            return $list;
        }

        $datas = $query->toArray();
        foreach ($datas as $val) {
            $list[$val['id']] = $val['site_name'];
        }

        return $list;

    }

}
