<?php
namespace App\Consts;

class UseradminConsts
{
    const ROLE_DEVELOP = 0;
    const ROLE_ADMIN = 1;
    const ROLE_AUTHORIZER = 10;
    const ROLE_EDITOR = 20;
    const ROLE_DEMO = 90;
    const ROLE_ALL = 99;

    static $role_list = [
        self::ROLE_DEVELOP => '開発者',
        self::ROLE_ADMIN => '管理者',
        self::ROLE_AUTHORIZER => '承認者',
        self::ROLE_EDITOR => '編集者',
        self::ROLE_ALL => '権限なし',
    ];

    static $role_key_list = [
        self::ROLE_DEVELOP => 'develop',
        self::ROLE_ADMIN => 'admin',
        self::ROLE_AUTHORIZER => 'authorizer',
        self::ROLE_EDITOR => 'editor',
        self::ROLE_ALL => 'all',
    ];

    static $role_key_values = [
        'develop' => self::ROLE_DEVELOP,
        'admin' => self::ROLE_ADMIN,
        'authorizer' => self::ROLE_AUTHORIZER,
        'editor' => self::ROLE_EDITOR,
        'all' => self::ROLE_ALL,
    ];
}