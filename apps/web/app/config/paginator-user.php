<?php
/**
 * ページネーションのレイアウトを変更したい場合はここを編集
 */
return [
    'nextActive' => '<a href="{{url}}" class="btn btn-secondary text-light">{{text}}</a>',
    'nextDisabled' => '<li class="next disabled"><a href="" onclick="return false;">{{text}}</a></li>',
    'prevActive' => '<a href="{{url}}" class="btn btn-secondary text-light">{{text}}</a>',
    'prevDisabled' => '<li class="prev disabled"><a href="" onclick="return false;">{{text}}</a></li>',
    'counterRange' => '{{start}} - {{end}} of {{count}}',
    'counterPages' => '{{page}} of {{pages}}',
    'first' => '<li><a href="{{url}}" class="btn btn-secondary text-light">{{text}}</a></li>',
    'last' => '<li><a href="{{url}}" class="btn btn-secondary text-light">{{text}}</a></li>',
    'number' => '<li><a href="{{url}}" class="btn btn-secondary text-light">{{text}}</a></li>',
    'current' => '<li><a href="" class="btn btn-warning text-dark">{{text}}</a></li>',
    'ellipsis' => '<li class="ellipsis">&hellip;</li>',
    'sort' => '<a href="{{url}}">{{text}}</a>',
    'sortAsc' => '<a class="asc" href="{{url}}">{{text}}</a>',
    'sortDesc' => '<a class="desc" href="{{url}}">{{text}}</a>',
    'sortAscLocked' => '<a class="asc locked" href="{{url}}">{{text}}</a>',
    'sortDescLocked' => '<a class="desc locked" href="{{url}}">{{text}}</a>',
];