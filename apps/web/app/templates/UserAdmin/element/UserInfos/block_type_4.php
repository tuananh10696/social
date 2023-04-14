<!--ファイル-->
<div class="table__row first-dir item_block" id="block_no_<?= h($rownum); ?>" data-sub-block-move="1">
  <div class="table__column">
    <div class="block_header">
      <?= $this->element('UserInfos/block_type_0', ['rownum' => $rownum, 'content' => $content]); ?>
    </div>

    <div class="block_title">

    </div>

    <div class="block_content td_parent">
      <?php $_column = 'file'; ?>
      <ul>
        <?php if (!empty($content['attaches'][$_column]['0'])) : ?>
          <li class="<?= h($content['attaches'][$_column]['extention']); ?>">
            <p><?= $this->Html->link(__('{0}.{1}', h($content['file_name']), h($content['file_extension'])), $content['attaches'][$_column]['0'], ['target' => '_blank']) ?></p>
          </li>

          <?php $old = $content['_old_' . $_column] ?? ($content[$_column] ?? ''); ?>
          <?= $this->Form->hidden("info_contents.{$rownum}._old_{$_column}", ['value' => h($old)]); ?>
          <?= $this->Form->hidden("info_contents.{$rownum}.file_size"); ?>
          <?= $this->Form->hidden("info_contents.{$rownum}.file_name"); ?>
          <?= $this->Form->hidden("info_contents.{$rownum}.file_extension"); ?>
        <?php endif; ?>
        <li>
          <?php if (!$fixed_readonly) : ?>
            <?= $this->Form->input("info_contents.{$rownum}.file", ['type' => 'file', 'accept' => '.doc, .docx, .xls, .xlsx, .pdf, .ppt, .pptx', 'class' => 'attaches', 'onChange' => 'chooseFileUpload(this)', 'data-type' => 'application/vnd.ms-powerpoint,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,application/msword,application/vnd.openxmlformats-officedocument.presentationml.presentation']); ?>
          <?php endif; ?>
          <div><span class="attention">※PDF、Office(.doc, .docx, .xls, .xlsx, ppt, pptx)ファイルのみ</span></div>
          <div><span class="attention">※ファイルサイズ5MB以内</span></div>

        </li>
      </ul>
    </div>
  </div>

  <div class="table__column table__column-sub">
    <span style="font-size:0.9rem;"><?= (h($rownum) + 1); ?>.ファイル添付</span>
    <div class="table__row-config">
      <?= $this->element('UserInfos/sort_handle2'); ?>
      <?= $this->element('UserInfos/item_block_buttons', ['rownum' => $rownum, 'disable_config' => true]); ?>
    </div>
  </div>
</div>