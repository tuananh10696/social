<?php

use App\Model\Entity\PageConfigItem;
?>

<?php $this->assign('content_title', "「{$page_config->page_title}」のカテゴリ"); ?>

<?php $this->start('menu_list'); ?>
<li class="breadcrumb-item">
	<a href="<?= '/user_admin/infos/?sch_page_id=' . $page_config->id; ?>"><?= $page_config->page_title; ?></a>
</li>
<li class="breadcrumb-item">
	<a href="<?= '/user_admin/categories/?sch_page_id=' . $page_config->id; ?>">カテゴリ</a>
</li>
<li class="breadcrumb-item active">
	<span><?= ($data['id'] > 0) ? '編集' : '新規登録'; ?></span>
</li>
<?php $this->end(); ?>

<?php $this->start('content_header'); ?>
<h2 class="card-title"><?= ($data["id"] > 0) ? '編集' : '新規登録'; ?></h2>
<?php $this->end(); ?>

<?= $this->Form->create($entity, ['type' => 'file', 'context' => ['validator' => 'default'], 'name' => 'fm', 'templates' => $form_templates]); ?>

<?= $this->Form->hidden('id'); ?>
<?= $this->Form->hidden('position'); ?>
<?= $this->Form->hidden('page_config_id', ['value' => $query['sch_page_id']]); ?>

<div class="table_edit_area">

	<?php if ($page_config->is_category_multilevel == 1) : ?>
		<?= $this->element('edit_form/item-start', ['title' => '上層カテゴリ']); ?>
		<?php if (empty($parent_category)) : ?>
			（なし）
			<?= $this->Form->input('parent_category_id', ['type' => 'hidden', 'value' => 0]); ?>
		<?php else : ?>
			<?= $parent_category->name; ?>
			<?= $this->Form->input('parent_category_id', ['type' => 'hidden', 'value' => $query['parent_id']]); ?>
		<?php endif; ?>
		<?= $this->element('edit_form/item-end'); ?>
	<?php endif; ?>

	<?= $this->element('edit_form/item-start', ['title' => 'カテゴリ名', 'required' => true]); ?>
	<?= $this->Form->input('name', array('type' => 'text', 'maxlength' => 40, 'class' => 'form-control')); ?>
	<div class="attention">※40文字以内で入力してください</div>
	<?= $this->element('edit_form/item-end'); ?>

	<?= $this->element('edit_form/item-start', ['title' => '有効/無効']); ?>
	<?= $this->element('edit_form/item-status'); ?>
	<?= $this->element('edit_form/item-end'); ?>

</div>
<?= $this->Form->end(); ?>

<div class="btn_area center">
	<?php if (!empty($data['id']) && $data['id'] > 0) { ?>
		<a href="#" onclick="document.fm.submit();" class="btn btn-danger btn_post submitButton">変更する</a>
		<?php if ($this->Common->isUserRole('admin')) : ?>
			<a href="javascript:kakunin('データを完全に削除します。よろしいですか？','<?= $this->Url->build(array('action' => 'delete', $data['id'], 'content')) ?>')" class="btn btn_post btn_delete"><i class="far fa-trash-alt"></i> 削除する</a>
		<?php endif; ?>
	<?php } else { ?>
		<a href="#" onclick="document.fm.submit();" class="btn btn-danger btn_post submitButton">登録する</a>
	<?php } ?>
</div>

<div id="deleteArea" style="display: hide;"></div>




<?php $this->start('beforeBodyClose'); ?>
<link rel="stylesheet" href="/user/common/css/cms.css">
<script src="/user/common/js/jquery.ui.datepicker-ja.js"></script>
<script src="/user/common/js/cms.js"></script>

<?php $this->end(); ?>