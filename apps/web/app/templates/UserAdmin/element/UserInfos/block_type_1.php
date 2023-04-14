<!--中タイトル-->
<div class="table__row first-dir item_block" id="block_no_<?= h($rownum); ?>" data-sub-block-move="1">
  <div class="table__column">
    <div class="block_header">
      <?= $this->element('UserInfos/block_type_0', ['rownum' => $rownum, 'content' => $content]); ?>
    </div>

    <div class="block_title">

    </div>

    <div class="block_content">
      <?= $this->Form->input("info_contents.{$rownum}.title", [
        'type' => 'text',
        'style' => 'width: 100%;',
        'class' => 'form-control font_target h2_title',
        'maxlength' => 100,
        'readonly' => $fixed_readonly,
        'placeholder' => \App\Model\Entity\Info::BLOCK_TYPE_LIST[\App\Model\Entity\Info::BLOCK_TYPE_TITLE] . 'を入力してください'
      ]); ?>
    </div>

  </div>

  <div class="table__column table__column-sub">
    <div class="table__row">
      <span style="font-size:0.9rem;"><?= (h($rownum) + 1); ?>.<?= \App\Model\Entity\Info::BLOCK_TYPE_LIST[\App\Model\Entity\Info::BLOCK_TYPE_TITLE]; ?></span>
    </div>
    <div class="table__row-config">
      <?= $this->element('UserInfos/sort_handle2'); ?>
      <?= $this->element('UserInfos/item_block_buttons', ['rownum' => $rownum, 'disable_config' => true]); ?>
    </div>
  </div>
</div>