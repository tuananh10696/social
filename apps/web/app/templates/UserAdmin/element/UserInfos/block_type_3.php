<div class="table__row first-dir item_block" id="block_no_<?= h($rownum); ?>" data-sub-block-move="1">
	<div class="table__column">
		<div class="block_header">
			<?= $this->Form->input("info_contents.{$rownum}.id", ['type' => 'hidden', 'value' => @$content['id'], 'id' => "idBlockId_" . h($rownum)]); ?>
			<?= $this->Form->input("info_contents.{$rownum}.position", ['type' => 'hidden', 'value' => h($content['position'])]); ?>
			<?= $this->Form->input("info_contents.{$rownum}.block_type", ['type' => 'hidden', 'value' => h($content['block_type']), 'class' => 'block_type']); ?>
			<?= $this->Form->input("info_contents.{$rownum}.section_sequence_id", ['type' => 'hidden', 'value' => h($content['section_sequence_id']), 'class' => 'section_no']); ?>
			<?= $this->Form->input("info_contents.{$rownum}._block_no", ['type' => 'hidden', 'value' => h($rownum)]); ?>
		</div>

		<div class="block_content td_parent">
			<div class="position-relative">

				<?= $this->Form->input("info_contents.{$rownum}.image", ['type' => 'file', 'id' => "__image{$rownum}", 'class' => 'attaches uploadImg', 'accept' => '.jpeg, .jpg, .png, .gif', 'onChange' => 'chooseFileUpload(this)', 'data-type' => 'image/jpeg,image/gif,image/png']); ?>

				<div class="preview_img t_align_c dpl_none" style="width: 100%;">
					<span style="max-width: 300px; margin: 10px auto" class="preview_img_btn" onclick="preview_img_action(this)">画像の削除</span>
				</div>

				<?php if (!empty($content['attaches']['image']['0'])) : ?>
					<div class="thumbImg btn w-100 thumbnail <?= $rownum ?>">
						<label type="button" class="btn-light edit__image-button " for="__image<?= $rownum ?>">
							<img src="<?= $this->Url->build($content['attaches']['image']['0']) ?>" style="max-width:500px;border:1px solid #e9e9e9">
						</label>
						<?= $this->Form->input("info_contents.{$rownum}._old_image", ['type' => 'hidden', 'value' => h($content['image']), 'class ' => 'old_img_input']); ?>
					</div>
				<?php endif; ?>

				<div class="img_text t_align_c">
					<label type="button" class="btn btn-light edit__image-button dpl_none" for="__image<?= $rownum ?>">
						<i class="fas fa-plus"></i>
						<i class="far fa-image"></i>
					</label>
					<div class="attention">※jpeg , jpg , gif , png ファイルのみ</div>
					<div class="attention">※ファイルサイズ5MB以内</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="popupOption_<?= h($rownum); ?>" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">オプション設定</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body table_area">
						<dl>
							<dt style="margin-top: 10px;">画像属性</dt>
							<dd>
								<?= $this->Form->input("info_contents.{$rownum}.img_alt", ['type' => 'text', 'class' => 'form-control', 'maxlength' => '200']); ?>
							</dd>

							<dt style="margin-top: 10px;">リンク先
								<?= $this->Form->input("info_contents.{$rownum}.option_value", [
									'type' => 'select',
									'options' => $link_target_list
								]); ?>
							</dt>
							<dd>
								<?= $this->Form->input("info_contents.{$rownum}.content", ['type' => 'text', 'class' => 'form-control', 'maxlength' => '255', 'placeholder' => 'http://']); ?>
							</dd>
						</dl>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">保存する</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="table__column table__column-sub">
		<span style="font-size:0.9rem;"><?= (h($rownum) + 1); ?>.画像</span>
		<div class="table__row-config">
			<?= $this->element('UserInfos/sort_handle2'); ?>
			<?= $this->element('UserInfos/item_block_buttons', ['rownum' => $rownum, 'disable_config' => false]); ?>
		</div>
	</div>
</div>
</td>