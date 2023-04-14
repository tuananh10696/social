<?php

use App\Model\Entity\PageConfigItem;
use App\Model\Entity\AppendItem;
?>
<?php $this->start('beforeHeadClose'); ?>
<link rel="stylesheet" type="text/css" href="/user/common/js/datetimepicker-master/jquery.datetimepicker.css" />
<style>
	.start-date {
		display: flex;
		margin-bottom: 10px;
	}

	.start-date-radio-2 {
		padding-right: 20px;
	}

	#start-date,
	#end-date {
		width: 120px;
	}

	.list-button {
		background-color: #b3803a !important;
	}
</style>
<?php $this->end(); ?>

<?php $now = new \DateTime('now', new \DateTimeZone('Asia/Tokyo')); ?>
<?php $this->assign('content_title', h($page_config->page_title)); ?>

<?php $this->start('menu_list'); ?>
<?php if ($this->elementExists('InfoContents/edit-menu-list_' . $page_config->slug)) : ?>
	<?= $this->element('InfoContents/edit-menu-list_' . $page_config->slug); ?>
<?php else : ?>
	<li class="breadcrumb-item"><a href="<?= $this->Url->build(['action' => 'index', '?' => ['sch_page_id' => $page_config->id]]); ?>"><?= h($page_title) ?></a></li>
	<li class="breadcrumb-item active"><span><?= ($data['id'] > 0) ? '編集' : '新規登録'; ?></span></li>
<?php endif; ?>
<?php $this->end(); ?>

<?php if ($this->elementExists('InfoContents/content-prepend-' . $page_config->slug)) : ?>
	<?php $this->start('content_prepend'); ?>
	<?= $this->element('InfoContents/content-prepend-' . $page_config->slug); ?>
	<?php $this->end(); ?>
<?php endif; ?>

<?php $this->start('content_header'); ?>
<h2 class="card-title"><?= ($data["id"] > 0) ? '編集' : '新規登録'; ?></h2>
<?php $this->end(); ?>

<?= $this->Form->create($entity, ['type' => 'file', 'context' => ['validator' => 'default'], 'name' => 'fm', 'templates' => $form_templates]); ?>
<?= $this->Form->hidden('position'); ?>
<?= $this->Form->hidden('id'); ?>
<?= $this->Form->hidden('page_config_id'); ?>
<?= $this->Form->hidden('meta_keywords'); ?>
<?= $this->Form->hidden('postMode', ['value' => 'save', 'id' => 'idPostMode']); ?>
<?= $this->Form->hidden('mode', ['value' => ($fixed_readonly ? 'approval' : 'input')]); ?>
<input type="hidden" name="MAX_FILE_SIZE" value="<?= (1024 * 1024 * 5); ?>">
<?= $this->Form->hidden('modified', ['value' => $now->format('Y-m-d H:i')]); ?>

<?php if (!empty($item)) : ?>
	<?= $this->Form->hidden('item_id', ['value' => $item->id]); ?>
<?php endif; ?>

<div class="table_edit_area">

	<!--記事番号-->
	<?= $this->element('edit_form/item-start', ['title' => '記事番号', 'required' => false]); ?>
	<?= ($data["id"]) ? sprintf('No. %04d', h($data["id"])) : "新規" ?>
	<?= $this->element('edit_form/item-end'); ?>
	<?= $this->element('UserInfos/append_items/append_item_block', ['pos' => 2]); ?>

	<!--親ページ設定-->
	<?php if ($page_config->parent_config_id) : ?>
		<?= $this->element('edit_form/item-start', ['title' => $parent_config->page_title, 'required' => false]); ?>
		<?= h($parent_info->title); ?>
		<?= $this->Form->input('parent_info_id', ['type' => 'hidden', 'value' => $parent_info->id]); ?>
		<?= $this->element('edit_form/item-end'); ?>
	<?php endif; ?>

	<!--掲載期間-->
	<!-- start - end -->
	<?= $this->element('edit_form/item-start', ['title' => '掲載期間', 'required' => true]); ?>
	<?= $this->Form->radio('start_now', ['即日'], ['hiddenField' => false]); ?>
	<div class="start-date">
		<?= $this->Form->radio('start_now', [1 => '期間指定'], ['hiddenField' => false]); ?>
		<?= $this->Form->input('start_at', ['type' => 'text', 'class' => 'datetimepicker', 'value' => $entity->start_at ? $entity->start_at->format('Y/m/d') : $now->format('Y/m/d'), 'style' => @$data['start_now'] == 0 ? 'pointer-events:none;' : '', 'readonly']); ?>　_　
		<?= $this->Form->input('end_at', ['type' => 'text', 'class' => 'datetimepicker', 'value' => $entity->end_at && $entity->start_now == 1 ? $entity->end_at->format('Y/m/d') : '', 'style' => @$data['start_now'] == 0 ? 'pointer-events:none;' : '', 'readonly', 'error' => false]); ?>
	</div>
	<?= $this->Form->error("end_at") ?>
	<div class="attention"><span>※開始日のみ必須。終了日を省略した場合は下書きにするまで掲載されます。</span></div>
	<?= $this->element('edit_form/item-end'); ?>

	<?php if ($page_config->is_approval == 1) : ?>
		<?php if ($this->Common->isUserRole('admin')) : ?>
			<?= $this->element('edit_form/item-start', ['title' => '状態']); ?>
			<?= $this->Form->input('status', ['type' => 'select', 'options' => \App\Consts\InfoConsts::$status_list, 'class' => 'form-control']); ?>
			<?= $this->element('edit_form/item-end'); ?>
		<?php else : ?>
			<?= $this->element('edit_form/item-start', ['title' => '状態']); ?>
			<?= \App\Consts\InfoConsts::$status_list[$data['status']]; ?>
			<?= $this->Form->input('status', ['type' => 'hidden']); ?>
			<?= $this->element('edit_form/item-end'); ?>
			<?= $this->element('UserInfos/approval', ['data' => $data]); ?>
		<?php endif; ?>

	<?php else : ?>
		<?= $this->element('edit_form/item-start', ['title' => '記事表示']); ?>
		<?= $this->element('edit_form/item-status', ['enable_text' => '掲載する', 'disable_text' => '下書き']); ?>
		<?= $this->element('edit_form/item-end'); ?>
	<?php endif; ?>

	<!--タイトル-->
	<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'title')) : ?>
		<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'title', 'title', 'タイトル'); ?>
		<?php $_sub_tilte = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'title', 'sub_title', ''); ?>
		<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => $_sub_tilte, 'required' => true]); ?>
		<?= $this->Form->input('title', array('type' => 'text', 'maxlength' => 100, 'class' => $fixed_class, 'readonly' => $fixed_readonly)); ?>
		<?php if (!$fixed_readonly) : ?>
			<div class="attention"><span>※100文字以内で入力してください</span></div>
		<?php endif; ?>
		<?= $this->element('edit_form/item-end'); ?>
	<?php endif; ?>
	<?= $this->element('UserInfos/append_items/append_item_block', ['pos' => 5]); ?>

	<!--カテゴリ-->
	<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'category')) : ?>
		<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'category', 'title', 'カテゴリ'); ?>
		<?php $_sub_tilte = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'categry', 'sub_title', ''); ?>
		<?php if ($this->Common->isCategoryEnabled($page_config) && !$this->Common->isCategoryEnabled($page_config, 'category_multiple')) : ?>
			<!-- 単カテゴリ -->
			<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => $_sub_tilte, 'required' => true]); ?>
			<?php if ($fixed_readonly) : ?>
				<?= $this->Form->input('category_id', ['type' => 'hidden']); ?>
				<?= $this->Form->input('_category_name', ['type' => 'text', 'value' => $category_list[$data['category_id']], 'class' => $fixed_class, 'readonly' => $fixed_readonly]); ?>
			<?php else : ?>
				<?= $this->Form->radio('category_id', $category_list, ['class' => 'form-control', 'default' => array_keys($category_list)[0]]); ?>
			<?php endif; ?>
			<?= $this->element('edit_form/item-end'); ?>
		<?php elseif ($this->Common->isCategoryEnabled($page_config) && $this->Common->isCategoryEnabled($page_config, 'category_multiple')) : ?>
			<!-- 複数カテゴリ -->
			<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => $_sub_tilte, 'required' => true]); ?>
			<?php if ($fixed_readonly) : ?>
				<ul>
					<?php foreach ($category_list as $cat_id => $cat_name) : ?>
						<?= $this->element('UserInfos/tag_fixed', ['input_name' => '', 'tag' => $cat_name]); ?>
					<?php endforeach; ?>
				</ul>
			<?php else : ?>
				<div class="list-group" style="height: 200px; overflow:auto;">
					<?php foreach ($category_list as $cat_id => $cat_name) : ?>
						<label class="list-group-item">
							<?= $this->Form->input(
												"info_categories.{$cat_id}",
												[
													'type' => 'checkbox',
													'value' => $cat_id,
													'checked' => in_array((int) $cat_id, $info_category_ids, false),
													'class' => 'form-check-input me-1',
													'hiddenField' => false
												]
											); ?>
							<?= $cat_name; ?>
						</label>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			<?= $this->element('edit_form/item-end'); ?>
		<?php endif; ?>
	<?php endif; ?>
	<?= $this->element('UserInfos/append_items/append_item_block', ['pos' => 4]); ?>

	<!--概要-->
	<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'notes')) : ?>
		<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'notes', 'title', '概要'); ?>
		<?php $_sub_tilte = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'notes', 'sub_title', '<div>(一覧と詳細に表示)</div>'); ?>
		<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => $_sub_tilte]); ?>
		<?= $this->Form->input('notes', ['type' => 'textarea', 'maxlength' => '1000', 'class' => $fixed_class, 'readonly' => $fixed_readonly]); ?>

		<div class="attention"> <span>※1000文字以内で入力してください</span></div>
		<?= $this->element('edit_form/item-end'); ?>
	<?php endif; ?>
	<?= $this->element('UserInfos/append_items/append_item_block', ['pos' => 6]); ?>

	<!-- image -->
	<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'image')) : ?>
		<?php $image_column = 'image'; ?>
		<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'image', 'title', 'メイン画像'); ?>
		<?php $_sub_tilte = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'image', 'sub_title', '<div>(一覧と詳細に表示)</div>'); ?>
		<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => $_sub_tilte]); ?>
		<div class="edit_image_area td_parent">
			<ul>
				<li>
					<?= $this->Form->input($image_column, ['type' => 'file', 'accept' => '.jpeg, .jpg, .gif, .png', 'onChange' => 'chooseFileUpload(this)', 'data-type' => 'image/jpeg,image/gif,image/png', 'class' => 'attaches']); ?>
					<?php if (!empty($data['attaches'][$image_column]['0'])) : ?>
						<div class="thumbImg">
							<a href="<?= $data['attaches'][$image_column]['0']; ?>" class="pop_image_single">
								<img src="<?= $this->Url->build($data['attaches'][$image_column]['0']) ?>" style="max-width: 300px;">
								<?= $this->Form->input("attaches.{$image_column}.0", ['type' => 'hidden']); ?>
							</a>
							<?= $this->Form->input("_old_{$image_column}", ['type' => 'hidden', 'default' => h($data[$image_column]), 'class' => 'old_img_input']); ?>
						</div>
					<?php endif; ?>

					<div class="preview_img dpl_none">
						<span class="preview_img_btn" onclick="preview_img_action(this)">画像の削除</span>
					</div>
					<div class="attention">※jpeg , jpg , gif , png ファイルのみ</div>
					<div class="attention">※ファイルサイズ5MB以内</div>
					<?= $this->Form->error("_image2") ?>
				</li>
			</ul>
			<?= $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'image', 'memo', ''); ?>
		</div>
		<?= $this->element('edit_form/item-end'); ?>
	<?php endif; ?>
	<?= $this->element('UserInfos/append_items/append_item_block', ['pos' => 7]); ?>

	<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'title', 'title', '掲載タイプ'); ?>
	<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => '', 'required' => false]); ?>
	<?php
	$temp = [
		'nestingLabel' => '{{input}}<label{{attrs}}>{{text}}</label>',
		'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
		'radioWrapper' => '<div class="radio icheck-midnightblue mr-2">{{label}}</div>'
	] ?>
	<?= $this->Form->setTemplates($temp)->radio('link_type', [1 => '詳細記事を作成する', 2 => 'URLにリンクする（別タブ）', 3 => 'URLにリンクする（同タブ）', 4 => '添付ファイルにリンクする',], ['class' => 'form-control', 'hiddenField' => false, 'onchange' => 'changeType(this)']); ?>
	<?= $this->element('edit_form/item-end'); ?>

	<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'title', 'title', 'リンク先(別タブ)'); ?>
	<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => '', 'required' => false, 'elementClass' => __('link_type link_type_2 {0}', $entity->link_type == 2 ? '' : 'dpl_none')]); ?>
	<?= $this->Form->input('link', ['type' => 'text', 'maxlength' => 255, 'class' => 'form-control']); ?>
	<?= $this->element('edit_form/item-end'); ?>

	<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'title', 'title', 'リンク先(同タブ)'); ?>
	<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => '', 'required' => false, 'elementClass' => __('link_type link_type_3 {0}', $entity->link_type == 3 ? '' : 'dpl_none')]); ?>
	<?= $this->Form->input('link_blank', ['type' => 'text', 'maxlength' => 255, 'class' => 'form-control']); ?>
	<?= $this->element('edit_form/item-end'); ?>

	<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'title', 'title', '添付ファイルにリンク'); ?>
	<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => '', 'required' => false, 'bodyClass' => 'td_parent', 'elementClass' => __('link_type link_type_4 {0}', $entity->link_type == 4 ? '' : 'dpl_none')]); ?>

	<?php if (!empty($entity->attaches['file']['0'])) : ?>
		<p><?= $this->Html->link(__('{0}.{1}', $entity->file_name, $entity->file_extension), $entity->attaches['file']['0'], ['target' => '_blank']) ?></p>
		<?= $this->Form->hidden("file_name"); ?>
		<?= $this->Form->hidden("_old_file", ['value' => $entity->file]); ?>
	<?php endif; ?>

	<?= $this->Form->input('file', ['type' => 'file', 'accept' => '.doc, .docx, .xls, .xlsx, .pdf', 'onChange' => 'chooseFileUpload(this)', 'data-type' => 'application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,application/msword', 'class' => 'attaches']); ?>
	<div class="attention">※PDF、Office（.doc、.docx、.xls、.xlsx）ファイルのみ</div>
	<?= $this->element('edit_form/item-end'); ?>

	<!--画像の注釈-->
	<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'image_title')) : ?>
		<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'image_title', 'title', '画像の注釈'); ?>
		<?php $_sub_tilte = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'image_title', 'sub_title', ''); ?>
		<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => $_sub_tilte]); ?>
		<?= $this->Form->input('image_title', ['type' => 'textarea', 'maxlength' => '200', 'class' => $fixed_class, 'readonly' => $fixed_readonly]); ?>
		<div class="attention">※200文字以内で入力してください</div>
		<div class="attention">※改行は反映されません</div>
		<?= $this->element('edit_form/item-end'); ?>
	<?php endif; ?>
	<?= $this->element('UserInfos/append_items/append_item_block', ['pos' => 8]); ?>

	<!--TOP表示-->
	<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'index_type')) : ?>
		<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'index_type', 'title', 'TOP表示'); ?>
		<?php $_sub_tilte = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'index_type', 'sub_title', ''); ?>
		<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => $_sub_tilte]); ?>

		<?= $this->Form->radioEx('index_type', ['0' => '設定しない', '1' => '設定する'], ['readonly' => $fixed_readonly]); ?>

		<?= $this->element('edit_form/item-end'); ?>
	<?php endif; ?>
	<?= $this->element('UserInfos/append_items/append_item_block', ['pos' => 9]); ?>

	<!-- ハッシュタグ -->
	<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'hash_tag')) : ?>
		<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'hash_tag', 'title', 'ハッシュタグ'); ?>
		<?php $_sub_tilte = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'hash_tag', 'sub_title', ''); ?>
		<?php $info_tag_count = 0; ?>
		<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => $_sub_tilte]); ?>
		<?php if (!$fixed_readonly) : ?>
			<div class="input-group">
				<span class="input-group-prepend">
					<?= $this->Form->input('add_tag', [
								'type' => 'text',
								'style' => 'width: 200px;',
								'maxlength' => '40',
								'id' => 'idAddTag',
								'placeholder' => 'タグを入力',
								'class' => 'form-control'
							]); ?>
				</span>

				<span class="input-group-append">
					<a href="#" class="btn btn-warning btn-flat" id="btnAddTag">追加</a>
					<a href="#" class="btn btn-info btn-flat" id="btnListTag">タグリスト</a>
				</span>
			</div>
		<?php endif; ?>
		<?php if ($fixed_readonly) : ?>
			<ul>
				<?php foreach ($entity->info_tags as $k => $tag) : ?>
					<?= $this->element('UserInfos/tag_fixed', ['input_name' => "tags.{$k}.tag", 'tag' => $tag->tag->tag]); ?>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<div>
				<ul id="tagArea">
					<?php if (!empty($entity->info_tags)) : ?>
						<?php $info_tag_count = count($entity->info_tags); ?>
						<?php foreach ($entity->info_tags as $k => $tag) : ?>
							<?= $this->element('UserInfos/tag', ['num' => $k, 'tag' => $tag->tag->tag]); ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
		<?php endif; ?>
		<?= $this->element('edit_form/item-end'); ?>
	<?php else : ?>
		<?php $info_tag_count = 0; ?>
	<?php endif; ?>

	<!--追加項目-->
	<?= $this->element('UserInfos/append_items/append_item_block', ['pos' => 0]); ?>

	<!--metaタグ-->
	<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'meta')) : ?>
		<div class="form-group row">
			<div class="w-100 btn-light text-center">
				<button class="btn w-100 btn-light" type="button" data-toggle="collapse" data-target="#optionMetaItem" aria-expanded="false">
					<span>metaタグ</span> <i class="fas fa-angle-down"></i>
				</button>
			</div>
		</div>
	<?php endif; ?>

	<div id="optionMetaItem" class="collapse">

		<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'meta')) : ?>
			<?= $this->element('edit_form/item-start', ['title' => 'meta', 'subTitle' => '（ページ説明文）']); ?>
			<?= $this->Form->input('meta_description', ['type' => 'textarea', 'maxlength' => '200', 'class' => $fixed_class, 'readonly' => $fixed_readonly]); ?>
			<span class="attention">※200文字まで</span>
			<?= $this->element('edit_form/item-end'); ?>
		<?php endif; ?>

		<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'meta')) : ?>
			<?= $this->element('edit_form/item-start', ['title' => 'meta', 'subTitle' => '（キーワード）']); ?>
			<?php for ($i = 0; $i < 5; $i++) : ?>
				<div><?= ($i + 1); ?>.<?= $this->Form->input("keywords.{$i}", ['type' => 'text', 'maxlength' => '20', 'class' => $fixed_class, 'readonly' => $fixed_readonly]); ?></div>
			<?php endfor; ?>
			<span class="attention">※各20文字まで</span>
			<?= $this->element('edit_form/item-end'); ?>
		<?php endif; ?>

	</div>

</div>

<!--コンテンツブロック-->

<div class="editor__table mb-5 <?= isset($data['link_type']) && $data['link_type'] != 1 ? 'hidden' : '' ?>">
	<div id="blockArea" class="table__body list_table">
		<?php if (!empty($contents) && array_key_exists('contents', $contents)) : ?>
			<?php foreach ($contents['contents'] as $k => $v) : ?>
				<?php if ($v['block_type'] != 13) : ?>
					<?= $this->element("UserInfos/block_type_{$v['block_type']}", ['rownum' => h($v['_block_no']), 'content' => h($v)]); ?>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>

	<?= $this->element('UserInfos/dlg_select_block'); ?>
</div>

<div id="blockWork"></div>

<div id="deleteArea" style="display: hide;"></div>
<?= $this->Form->end(); ?>

<?php if ($this->Common->isUserRole('admin') || $is_save_btn) : ?>
	<div class="btn_area center">
		<?php if (!empty($data['id']) && $data['id'] > 0) { ?>
			<a href="javascript:void(0);" onclick="document.fm.submit();" class="btn btn-danger btn_post submitButton">変更する</a>
			<a href="<?= $this->Url->build(['action' => 'index', '?' => ['sch_page_id' => $page_config->id]]) ?>" class="btn btn_post list-button">一覧に戻る</a>
			<a href="javascript:kakunin('データを完全に削除します。よろしいですか？','<?= $this->Url->build(array('action' => 'delete', $data['id'], 'content', '?' => $query)) ?>')" class="btn btn_post btn_delete"><i class="far fa-trash-alt"></i> 削除する</a>
		<?php } else { ?>
			<a href="javascript:void(0);" onclick="document.fm.submit();" class="btn btn-danger btn_post submitButton">登録する</a>
			<a href="<?= $this->Url->build(['action' => 'index', '?' => ['sch_page_id' => $page_config->id]]) ?>" class="btn btn_post list-button">一覧に戻る</a>
		<?php } ?>
	</div>
<?php endif; ?>

<?php if ($page_config->is_approval == 1 && !empty($data['id']) && $data['status'] != \App\Consts\InfoConsts::STATUS_DRAFT) : ?>
	<?= $this->Form->create(null, ['type' => 'post', 'name' => 'fm_draft', 'url' => ['action' => 'changeDraft']]); ?>
	<?= $this->Form->input('id', ['type' => 'hidden', 'value' => $data['id']]); ?>
	<?= $this->Form->input('sch_page_id', ['type' => 'hidden', 'value' => $page_config->id]); ?>
	<?= $this->Form->input('sch_category_id', ['type' => 'hidden', 'value' => $query['sch_category_id']]); ?>
	<?= $this->Form->end(); ?>
<?php endif; ?>


<?php $this->start('beforeBodyClose'); ?>
<script src="/user/common/js/cms.js"></script>
<script src="/user/common/js/ckeditor/ckeditor.js"></script>
<script src="/user/common/js/ckeditor/translations/ja.js"></script>
<?= $this->Html->script('/user/common/js/system/pop_box'); ?>

<script src="/user/common/js/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
<script>
	var rownum = 0;
	var tag_num = <?= $info_tag_count; ?>;
	var max_row = 100;
	var pop_box = new PopBox();
	var out_waku_list = <?= json_encode($out_waku_list); ?>;
	var block_type_waku_list = <?= json_encode($block_type_waku_list); ?>;
	var block_type_relation = 14;
	var block_type_relation_count = 0;
	var max_file_size = <?= (1024 * 1024 * 5); ?>;
	var total_max_size = <?= (1024 * 1024 * 30); ?>;
	var form_file_size = 0;
	var page_config_id = <?= $page_config->id; ?>;
	var is_old_editor = <?= ($editor_old == 1 ? 1 : 0); ?>;
	var page_config_slug = '<?= $page_config->slug; ?>';

	jQuery.datetimepicker.setLocale('ja');
	jQuery('.datetimepicker').datetimepicker({
		format: 'Y/m/d',
		timepicker: false,
		lang: 'ja',
		scrollMonth: false,
		scrollInput: false
	});

	function changeType(e) {
		const _t = $(e);
		$('.link_type').addClass('dpl_none');
		$(`.link_type_${$(e).val()}`).removeClass('dpl_none');
		if (_t.val() != 1) {
			$('.editor__table').addClass('hidden')
		} else {
			$('.editor__table').removeClass('hidden')
		}
	}
</script>
<?= $this->Html->script('/user/common/js/info/base'); ?>
<?= $this->Html->script('/user/common/js/info/edit'); ?>
<?= $this->Html->script('/user/common/js/info/multiple-uploader'); ?>
<script>
	$(function() {
		//check start time
		/** 日付を文字列にフォーマットする */
		var d = new Date();
		var formatted = `${d.getFullYear()}-${(d.getMonth()+1).toString().padStart(2, '0')}-${d.getDate().toString().padStart(2, '0')}`.replace(/\n|\r/g, '');

		$('input[name=start_now]').change(function() {
			var id = $(this).val();
			if (id == 0) {
				$('#start-at').css('pointer-events', 'none')
				$('#end-at').css('pointer-events', 'none')
				$('input[name=start_at]').val(formatted)
				$('#end-at').val('')
			} else {
				$('#start-at').css('pointer-events', '')
				$('#end-at').css('pointer-events', '')
			}
		});
	});
</script>
<?php $this->end(); ?>