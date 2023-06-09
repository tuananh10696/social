<?php use Cake\Utility\Inflector; ?>
<?php $this->assign('content_title', "ユーザー管理"); ?>
<?php $this->start('menu_list'); ?>
<li class="breadcrumb-item"><a href="<?= $this->Url->build(['action' => 'index']); ?>">ユーザー管理</a></li>
<li class="breadcrumb-item active"><span><?= ($data['id'] > 0) ? '編集' : '新規登録'; ?></span></li>
<?php $this->end(); ?>

<?php $this->start('content_header'); ?>
<h2 class="card-title"><?= ($data["id"] > 0) ? '編集' : '新規登録'; ?></h2>
<?php $this->end(); ?>

<?= $this->Form->create($entity, array('type' => 'file', 'context' => ['validator' => 'default'], 'name' => 'fm', 'templates' => $form_templates));?>
<?= $this->Form->input('id', array('type' => 'hidden', 'value' => $entity->id)); ?>
<?= $this->Form->input('position', array('type' => 'hidden')); ?>
<div class="table_edit_area">


  <?= $this->element('edit_form/item-start', ['title' => '名前', 'required' => true]); ?>
    <?= $this->Form->input('name', array('type' => 'text', 'maxlength' => 60, 'class' => 'form-control')); ?>
    <br><span>※60文字以内で入力してください</span>
  <?= $this->element('edit_form/item-end'); ?>

  <?= $this->element('edit_form/item-start', ['title' => 'メールアドレス']); ?>
  <?= $this->Form->input('email', ['type' => 'text', 'class' => 'form-control']); ?>
  <?= $this->element('edit_form/item-end'); ?>

  <div class="form-group row">
    <div class="w-100 btn-light text-center">
      <h5>▼▼▼ アカウント情報 ▼▼▼</h5>
    </div>
  </div>

  <?= $this->element('edit_form/item-start', ['title' => 'アカウント名', 'required' => true]); ?>
  <?= $this->Form->input('username', ['type' => 'text', 'class' => 'form-control']); ?>
  <?= $this->element('edit_form/item-end'); ?>

  <?= $this->element('edit_form/item-start', ['title' => 'パスワード', 'required ' => true]); ?>
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">パスワード入力</div>
      </div>
      <div class="input-group-append">
       <?= $this->Form->input('_password', ['type' => 'password', 'class' => 'form-control', 'error' => false]); ?>
      </div>
    </div>
    <?= $this->Form->error('password'); ?>
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">パスワード確認</div>
      </div>
      <div class="input-group-append">
       <?= $this->Form->input('password_confirm', ['type' => 'password', 'class' => 'form-control', 'error' => false]); ?>
      </div>
    </div>
    <?= $this->Form->error('password_confirm'); ?>
  <?= $this->element('edit_form/item-end'); ?>

  <?= $this->element('edit_form/item-start', ['title' => '権限']); ?>
  <?= $this->Form->input('role', ['type' => 'select', 'options' => $user_role_list, 'class' => 'form-control']); ?>
  <?= $this->element('edit_form/item-end'); ?>

  <?= $this->element('edit_form/item-start', ['title' => '有効/無効']); ?>
  <?= $this->element('edit_form/item-status'); ?>
  <?= $this->element('edit_form/item-end'); ?>


</div>
<?= $this->Form->end(); ?>

<div class="btn_area center">
<?php if (!empty($data['id']) && $data['id'] > 0){ ?>
    <a href="#" onclick="document.fm.submit();" class="btn btn-danger btn_post submitButton">変更する</a>
  <?php if ($this->Common->isUserRole('admin')): ?>
    <a href="javascript:kakunin('データを完全に削除します。よろしいですか？','<?= $this->Url->build(array('action' => 'delete', $data['id'], 'content'))?>')" class="btn btn_post btn_delete"><i class="far fa-trash-alt"></i> 削除する</a>
  <?php endif; ?>
<?php }else{ ?>
    <a href="#" onclick="document.fm.submit();" class="btn btn-danger btn_post submitButton">登録する</a>
<?php } ?>
</div>

<div id="deleteArea" style="display: hide;"></div>




<?php $this->start('beforeBodyClose'); ?>
<link rel="stylesheet" href="/user/common/css/cms.css">
<script src="/user/common/js/jquery.ui.datepicker-ja.js"></script>
<script src="/user/common/js/cms.js"></script>

<?php $this->end(); ?>
