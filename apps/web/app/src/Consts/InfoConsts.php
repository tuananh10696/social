<?php
namespace App\Consts;

class InfoConsts
{
    const STATUS_DRAFT = 'draft';
    const STATUS_READY = 'ready';
    const STATUS_PUBLISH = 'publish';

    static $status_list = [
        self::STATUS_DRAFT => '下書き',
        self::STATUS_READY => '承認待ち',
        self::STATUS_PUBLISH => '公開中'
    ];

    static $status_index_list = [
        self::STATUS_DRAFT => [
            'status' => false,
            'class' => 'secondary',
            'text' => '下書き'
        ],
        self::STATUS_READY => [
            'status' => false,
            'class' => 'warning',
            'text' => '承認待ち',
        ],
        self::STATUS_PUBLISH => [
            'status' => true,
            'class' => 'success',
            'text' => '公開'
        ]
    ];
}