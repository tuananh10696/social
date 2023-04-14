<!--画像型-->
<?= $this->element('edit_form/append_item-start', [
  'title' => $append['name'],
  'slug' => $append['slug'],
  'required' => ($append['is_required'] ? true : false),
  'num' => $num,
  'data' => $data,
  'append' => $append
]); ?>

<?php $image_column = 'image'; ?>

<dl>
  <dd>
    <?php if (!empty($data['info_append_items'][$num]['attaches'][$image_column]['0'])) : ?>
      <div>
        <a href="<?= h($data['info_append_items'][$num]['attaches'][$image_column]['0']); ?>" class="pop_image_single">
          <img src="<?= $this->Url->build($data['info_append_items'][$num]['attaches'][$image_column]['0']) ?>" style="width: 300px; float: left;">
          <?= $this->Form->input("info_append_items.{$num}.attaches.{$image_column}.0", ['type' => 'hidden']); ?>
        </a><br>
        <?= $this->Form->input("info_append_items.{$num}._old_{$image_column}", array('type' => 'hidden', 'value' => h($data['info_append_items'][$num][$image_column]))); ?>
      </div>
    <?php endif; ?>
    <div class="td_parent">
      <?= $this->Form->input("info_append_items.{$num}.{$image_column}", ['type' => 'file', 'accept' => '.jpeg, .jpg, .gif, .png', 'onChange' => 'chooseFileUpload(this)', 'data-type' => 'image/jpeg,image/gif,image/png', 'class' => 'attaches']); ?>
      <div><span class="attention">※jpeg , jpg , gif , png ファイルのみ</span></div>
      <div><span class="attention">※ファイルサイズ5MB以内</span></div>
    </div>
  </dd>
  <?php if (false) : ?>
    <dt style="margin-top: 10px;">２．リンク先
      <?= $this->Form->input("info_append_items.{$num}.value_int", [
          'type' => 'select',
          'options' => $list,
          'value' => $data['info_append_items'][$num]['value_int']
        ]); ?>
    </dt>
    <dd>
      <?= $this->Form->input("info_append_items.{$num}.value_textarea", ['type' => 'text', 'maxlength' => '255', 'placeholder' => 'http://']); ?>
    </dd>
  <?php else : ?>
    <?= $this->Form->input("info_append_items.{$num}.value_int", ['type' => 'hidden', 'value' => '0']) ?>
    <?= $this->Form->input("info_append_items.{$num}.value_textarea", ['type' => 'hidden', 'value' => '']) ?>
  <?php endif; ?>
</dl>

<?= $this->element('edit_form/append_item-end'); ?>