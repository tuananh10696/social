<?php

namespace App\Controller\Component;

use App\Consts\UseradminConsts;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

/**
 * OutputHtml component
 */
class AdminMenuComponent extends Component
{
    public $menu_list = [];


    public function initialize(array $config): void
    {
        $this->Controller = $this->_registry->getController();
        $this->Session = $this->Controller->getRequest()->getSession();
    }


    public function getMenuList($type = 'main')
    {
        $menu_list = null;
        if ($this->Session->check('admin_menu.menu_list')) {
            $menu_list = $this->Session->read('admin_menu.menu_list');
            $menu_list = $menu_list[$type];
        }
        return $menu_list;
    }


    public function getRoleUrls()
    {
        $role_list = array_merge(
            $this->_getRoleUrls(),
            $this->_appendRoleUrl()
        );

        return $role_list;
    }


    /**
     * @return array[]
     * URLごとのアクセス権限の設定
     * ※ $this->>_getRoleUrls()では対応できないものをここに書く
     */
    private function _appendRoleUrl()
    {
        $role_list = [];

        $role_list = [
            '/user_admin/page-config-items?(.*)' => [
                'role' => 'develop',
                'role_only' => false
            ],
            '/user_admin/page-config-extensions?(.*)' => [
                'role' => 'develop',
                'role_only' => false
            ],
            '/user_admin/append-items?(.*)' => [
                'role' => 'develop',
                'role_only' => false
            ],
        ];

        return $role_list;
    }


    /**
     * @return array
     * $this->>meny_list から自動生成
     */
    private function _getRoleUrls()
    {
        $role_list = [];

        $menu_list = $this->getMenuList();
        if (empty($menu_list)) {
            return $role_list;
        }
        foreach ($menu_list as $menu) {
            $default_role = UseradminConsts::ROLE_ALL;
            $default_only = false;
            if (isset($menu['role']) && !empty($menu['role']['role_type'])) {
                $default_role = $menu['role']['role_type'];
                if (isset($menu['role']['role_only'])) {
                    $default_only = $menu['role']['role_only'];
                }
            }
            foreach ($menu['buttons'] as $btn) {
                $role = $default_role;
                $role_only = $default_only;
                if (isset($btn['role']) && !empty($btn['role']['role_type'])) {
                    $role = $btn['role']['role_type'];
                    if (isset($btn['role']['role_only'])) {
                        $role_only = $btn['role']['role_only'];
                    }
                }
                $role_list[$btn['link']] = [
                    'role' => $role,
                    'role_only' => $role_only
                ];
            }
        }

        return $role_list;
    }


    public function init()
    {
        if (!$this->Session->check('admin_menu.menu_list')) {
            $this->menu_list = [
                'main' => [
                    [
                        'title' => 'コンテンツ',
                        'role' => ['role_type' => 'editor'],
                        'buttons' => $this->setContent('main'),
                    ],
                    [
                        'title' => 'マスタ管理',
                        'role' => ['role_type' => 'admin'],
                        'buttons' => [
                            ['name' => 'ユーザー管理', 'link' => '/user_admin/useradmins/']
                        ]
                    ],
                    [
                        'title' => __('各種設定'),
                        'role' => ['role_type' => 'admin'],
                        'buttons' => [
                            ['name' => __('コンテンツ設定'), 'link' => '/user_admin/page-configs/', 'role' => ['role_type' => 'develop']],
                            ['name' => __('定数管理'), 'link' => '/user_admin/mst-lists/', 'role' => ['role_type' => 'admin']],
                            ['name' => __('カレンダー'), 'link' => '/user_admin/schedules/', 'role' => ['role_type' => 'admin']],
                        ]
                    ]
                ],
                'side' => [
                    [
                        'title' => 'コンテンツ',
                        'role' => ['role_type' => 'editor'],
                        'buttons' => $this->setContent('main')
                    ],
                    [
                        'title' => 'マスタ管理',
                        'role' => ['role_type' => 'admin'],
                        'buttons' => [
                            ['name' => 'ユーザー管理', 'link' => '/user_admin/useradmins/']
                        ]
                    ],
                    [
                        'title' => __('各種設定'),
                        'role' => ['role_type' => 'develop'],
                        'buttons' => [
                            ['name' => __('コンテンツ設定'), 'link' => '/user_admin/page-configs/', 'role' => ['role_type' => 'develop']],
                            ['name' => __('定数管理'), 'link' => '/user_admin/mst-lists/', 'role' => ['role_type' => 'develop']],
                            ['name' => __('カレンダー'), 'link' => '/user_admin/schedules/', 'role' => ['role_type' => 'admin']],
                            ['name' => 'メニューリロード', 'link' => '/user_admin/menu-reload', 'position' => 'right', 'icon' => 'fas fa-sync-alt']
                        ]
                    ]
                ]

            ];

            $this->Session->write('admin_menu.menu_list', $this->menu_list);
        }
        $this->menu_list = $this->Session->read('admin_menu.menu_list');
    }


    public function reload()
    {
        $this->Session->delete('admin_menu.menu_list');
        $this->init();
    }


    public function setContent($type = 'main', $append_menus = [])
    {
        $this->PageConfigs = $this->Controller->loadModel('PageConfigs');

        $content_buttons = [];

        $page_configs = $this->PageConfigs->find()
            ->where(['is_auto_menu' => 1])
            ->order(['PageConfigs.position' => 'ASC'])
            ->toArray();

        if (!empty($page_configs)) {

            if ($type == 'main') {

                foreach ($page_configs as $config) {
                    $menu = [
                        'name' => $config->page_title,
                        'link' => '/user_admin/infos/?sch_page_id=' . $config->id,
                        'role' => ['role_type' => UseradminConsts::$role_key_list[$config->admin_menu_role]]
                    ];
                    $content_buttons[] = $menu;
                }
            } elseif ($type == 'side') {
                foreach ($page_configs as $config) {
                    $menu = [
                        'name' => $config->page_title,
                        'subMenu' => [
                            ['name' => __('新規登録'), 'link' => '/infos/edit/0?sch_page_id=' . $config->id],
                            ['name' => __('一覧'), 'link' => '/infos/?sch_page_id=' . $config->id],
                        ]
                    ];
                    $content_buttons[] = $menu;
                }
            }
        }

        foreach ($append_menus as $menu)
            $content_buttons[] = $menu;

        return $content_buttons;
    }
}
