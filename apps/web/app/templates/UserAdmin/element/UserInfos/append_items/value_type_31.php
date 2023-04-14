<!--ファイル型-->
<?= $this->element('edit_form/append_item-start', [
  'title' => $append['name'],
  'slug' => $append['slug'],
  'required' => ($append['is_required'] ? true : false),
  'num' => $num,
  'data' => $data,
  'append' => $append
]); ?>


<?php $_column = 'file'; ?>
<div class="manu td_parent">
  <ul>

    <?php if (!empty($data['info_append_items'][$num]['attaches'][$_column]['0'])) : ?>
      <?php
        $file_data = $data['info_append_items'][$num]['attaches'][$_column];
        ?>
      <li class="<?= h($file_data['extention']); ?>">
        <?= $this->Form->input("info_append_items.{$num}.file_name", ['type' => 'hidden']); ?>
        <?= h($data['info_append_items'][$num]['file_name']); ?>
        .<?= h($data['info_append_items'][$num]['file_extension']); ?>
        <?= $this->Form->input("info_append_items.{$num}.file_size", ['type' => 'hidden', 'value' => h($data['info_append_items'][$num]['file_size'])]); ?>
        <div><?= $this->Html->link('ダウンロード', $file_data['0'], array('target' => '_blank')) ?></div>
      </li>
      <?= $this->Form->input("info_append_items.{$num}._old_{$_column}", array('type' => 'hidden', 'value' => h($data['info_append_items'][$num][$_column]))); ?>
      <?= $this->Form->input("info_append_items.{$num}.file_extension", ['type' => 'hidden']); ?>
    <?php endif; ?>

    <li>
      <?= $this->Form->input("info_append_items.{$num}.file", array('type' => 'file', 'accept' => '.doc, .docx, .xls, .xlsx, .pdf', 'class' => 'attaches', 'onChange' => 'chooseFileUpload(this)', 'data-type' => 'application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,application/msword')); ?>
      <div><span class="attention">※PDF、Office(.doc, .docx, .xls, .xlsx)ファイルのみ</span></div>
      <div><span class="attention">※ファイルサイズ5MB以内</span></div>

      <?= $this->Html->view($append['attention'], ['before' => '<br><span>', 'after' => '</span>']); ?>
    </li>


  </ul>
  <?= $this->Form->error("{$slug}.{$append['slug']}") ?>
</div>

<?= $this->element('edit_form/append_item-end'); ?>