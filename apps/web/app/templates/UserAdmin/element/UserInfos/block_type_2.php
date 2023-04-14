<!--本文-->
<div class="table__row first-dir item_block" id="block_no_<?= h($rownum); ?>" data-sub-block-move="1" >
  <div class="table__column">
    <div class="block_header">
      <?= $this->element('UserInfos/block_type_0', ['rownum' => $rownum, 'content' => $content]); ?>
    </div>

    <div class="block_title">
      
    </div>

    <div class="block_content">
      <div class="<?= h($content['option_value']); ?> font_target <?= h($content['option_value2']); ?>">
      <?= $this->Form->input("info_contents.{$rownum}.content", ['type' => 'textarea',
                                                                'class' => 'editor','readonly' => $fixed_readonly
                                                              ]); ?>
      </div>
    </div>

  </div>

  <div class="table__column table__column-sub">
    <span style="font-size:0.9rem;"><?= (h($rownum) + 1); ?>.本文</span>
    <div class="table__row-config">
      <?= $this->element('UserInfos/sort_handle2'); ?>
      <?= $this->element('UserInfos/item_block_buttons', ['rownum' => $rownum, 'disable_config' => true, 'fixed_readonly' => $fixed_readonly]); ?>
    </div>
  </div>
</div>