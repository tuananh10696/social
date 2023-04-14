<?php 
namespace App\Model\Table;

use App\Consts\UseradminConsts;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PageConfigsTable extends AppTable {

    // テーブルの初期値を設定する
    public $defaultValues = [
        "id" => null,
        'is_auto_menu' => 1,
        'admin_menu_role' => UseradminConsts::ROLE_ALL
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

        // 添付ファイル
        $this->addBehavior('FileAttache');
        $this->addBehavior('Position', [
                'group' => ['site_config_id'],
                'order' => 'DESC'
            ]);

        $this->belongsTo('SiteConfigs');
        $this->hasMany('PageConfigExtensions');
        
        parent::initialize($config);
    }

    // Validation
    public function validationDefault(Validator $validator) : Validator
    {

        $validator->setProvider('PageConfig', 'App\Validator\PageConfigValidation');

        $validator
            ->allowEmpty('slug', true)
            
            ->notEmpty('page_title', __('入力してください'))
            ->add('page_title', 'maxLength', ['rule' => ['maxLength', 40], 'message' => __('40字以内で入力してください')])
            ;

        $validator
            ->add('root_dir_type', 'isUniqueTop', ['rule' => ['isUniqueTop'], 'provider' => 'PageConfig', 'message' => 'トップページに出来るのは１サイトに１つです。'])
            ->add('slug', 'isUnique', ['rule' => ['isUnique'], 'provider' => 'PageConfig', 'message' => 'この表示場所は既にあります'])
            ->add('slug', 'checkName', ['rule' => ['checkName'], 'provider' => 'PageConfig', 'message' => 'この表示場所は使えません'])
            ->add('slug', 'ng_word', ['rule' => ['ngSlugName'], 'provider' => 'PageConfig', 'message' => 'この表示場所は使えません'])
            ;
        
        return $validator;
    }
}