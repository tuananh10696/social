  <?php if ($is_save_btn && $data['status'] == App\Consts\InfoConsts::STATUS_DRAFT): ?>
    <?= $this->element('edit_form/item-start', ['title' => '承認']); ?>
    <div class="checkbox icheck-success">
      <?= $this->Form->input('_chk_ready', ['type' => 'checkbox', 'class' => '', 'value' => '1', 'label' => '承認申請する']); ?>
    </div>
    <?= $this->element('edit_form/item-end'); ?>
  <?php elseif ($is_save_btn && $this->Common->isUserRole('authorizer') && $data['status'] == \App\Consts\InfoConsts::STATUS_READY): ?>
    <?= $this->element('edit_form/item-start', ['title' => '承認']); ?>
    <div class="input-group">
      <div class="checkbox icheck-success">
        <?= $this->Form->input('_chk_publish', ['type' => 'checkbox', 'class' => '', 'value' => '1', 'label' => '承認する']); ?>
      </div>
      <div class="input-group-append ml-3">
        <button class="btn btn-warning btn-sm" type="button" onclick="changeDraft();">下書きに戻す</button>
      </div>
    </div>
    <?= $this->element('edit_form/item-end'); ?>
  <?php elseif ($is_save_btn && $this->Common->isUserRole('admin') && $data['status'] == \App\Consts\InfoConsts::STATUS_PUBLISH): ?>
    <?= $this->element('edit_form/item-start', ['title' => '']); ?>
    <div class="input-group">
      <div class="input-group-append ml-3">
        <button class="btn btn-warning btn-sm" type="button" onclick="changeDraft();">下書きに戻す</button>
      </div>
    </div>
    <?= $this->element('edit_form/item-end'); ?>
  <?php endif; ?>