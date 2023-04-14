<?php
namespace App\Consts;

class PageConfigConsts
{
    const LIST_STYLE_THUMBNAIL = 1;
    const LIST_STYLE_ONE_COLUMN = 2;

    static $list_styles = [
        self::LIST_STYLE_THUMBNAIL => 'サムネイル',
        self::LIST_STYLE_ONE_COLUMN => '１カラム'
    ];

    // タイマー機能
    const TIMER_MODE_NONE = 0;
    const TIMER_MODE_START_ONLY = 1;
    const TIMER_MODE_BETWEEN = 2;

    static $timer_mode_list = [
        self::TIMER_MODE_NONE => 'タイマー機能なし',
        self::TIMER_MODE_START_ONLY => '掲載開始のみ',
        self::TIMER_MODE_BETWEEN => '掲載期間',
    ];

    // 承認機能
    const APPROVAL_OFF = '0';
    const APPROVAL_ON = '1';

    static $approval_list = [
        self::APPROVAL_OFF => '無効',
        self::APPROVAL_ON => '有効'
    ];
}