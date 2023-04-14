<div class="table__row first-dir item_block <?= @$class_delete ?>" id="block_no_<?= h($rownum); ?>" data-sub-block-move="1">
  <div class="table__column">
    <div class="block_header">
      <?= $this->Form->hidden("info_contents.{$rownum}.id", ['value' => @$content['id'], 'id' => "idBlockId_" . h($rownum)]); ?>
      <?= $this->Form->hidden("info_contents.{$rownum}.position", ['value' => h($content['position'])]); ?>
      <?= $this->Form->hidden("info_contents.{$rownum}.block_type", ['value' => h($content['block_type']), 'class' => 'block_type']); ?>
      <?= $this->Form->hidden("info_contents.{$rownum}.section_sequence_id", ['value' => h($content['section_sequence_id']), 'class' => 'section_no']); ?>
      <?= $this->Form->hidden("info_contents.{$rownum}._block_no", ['value' => h($rownum)]); ?>
    </div>

    <div class="modal-body table_area block_content" style="border: 1px solid #ced4da;">
      <dl>
        <dt>１．ボタン名</dt>
        <dd>
          <?= $this->Form->input("info_contents.{$rownum}.title", [
            'type' => 'text',
            'class' => 'form-control',
            'style' => 'width: 100%;',
            'maxlength' => 12,
            'data-row' => h($rownum)
          ]); ?>
          <div class="attention">※12文字以内</div>
        </dd>

        <dt style="margin-top: 10px;">２．リンク先
          <?= $this->Form->input("info_contents.{$rownum}.option_value2", [
            'type' => 'select',
            'options' => \App\Model\Entity\Info::$link_target_list
          ]); ?>

        </dt>
        <dd>
          <?= $this->Form->input("info_contents.{$rownum}.content", ['type' => 'text', 'class' => 'form-control', 'style' => 'width: 100%;', 'maxlength' => 255, 'placeholder' => 'http://']); ?>
        </dd>

      </dl>
    </div>
  </div>

  <div class="table__column table__column-sub">
    <span style="font-size:0.9rem;"><?= (h($rownum) + 1); ?>.リンクボタン</span>
    <div class="table__row-config">
      <?= $this->element('UserInfos/sort_handle2'); ?>
      <?= $this->element('UserInfos/item_block_buttons', ['rownum' => $rownum, 'disable_config' => false]); ?>
    </div>
  </div>
</div>