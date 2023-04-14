<?php

/**
 * ページネーションのレイアウトを変更したい場合はここを編集
 */
return [
    'nextActive' => '<a href="{{url}}" class="next" ><span class="nextArr"></span></a>',
    'nextDisabled' => '<a href="#" class="next noActive" ><span class="nextArr"></span></a>',
    'prevActive' => '<a href="{{url}}" class="prev" ><span class="prevArr"></span></a>',
    'prevDisabled' => '<a href="#" class="prev noActive" ><span class="prevArr"></span></a>',
    'number' => '<a href="{{url}}" class="num">{{text}}</a>',
    'current' => '<a class="num active" href="#">{{text}}</a>',
    'ellipsis' => '<span class="num dots">...</span>',
];
