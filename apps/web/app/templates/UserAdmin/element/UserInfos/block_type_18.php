<div class="table__row first-dir item_block" id="block_no_<?= h($rownum); ?>" data-sub-block-move="1">
	<div class="table__column">
		<div class="block_header">
			<?= $this->Form->hidden("info_contents.{$rownum}.id", ['value' => @$content['id'], 'id' => "idBlockId_" . h($rownum)]); ?>
			<?= $this->Form->hidden("info_contents.{$rownum}.position", ['value' => h($content['position'])]); ?>
			<?= $this->Form->hidden("info_contents.{$rownum}.block_type", ['value' => h($content['block_type']), 'class' => 'block_type']); ?>
			<?= $this->Form->hidden("info_contents.{$rownum}.section_sequence_id", ['value' => h($content['section_sequence_id']), 'class' => 'section_no']); ?>
			<?= $this->Form->hidden("info_contents.{$rownum}._block_no", ['value' => h($rownum)]); ?>
		</div>
		<!-- dispaly saved img -->
		<?php $key = 0; ?>
		<?php if (@$entity->delete_ids_multi_image) : ?>
			<?php foreach ($entity->delete_ids_multi_image as $delId) : ?>
				<input name="delete_ids_multi_image[]" type="checkbox" class="d-none" value="<?= $delId ?>" checked />
			<?php endforeach; ?>
		<?php endif; ?>

		<div class="block_content td_parent">

			<div class="multiple-uploader" data-numrow="<?= $rownum ?>" onclick="triggerInput(this, event)">
				<?php if (isset($content['multi_images'])) foreach ($content['multi_images'] as $img) : ?>

					<?php if (@$img['attaches']['image'][0] != '') : ?>

						<input name="delete_ids_multi_image[]" type="checkbox" id="deleteImg_<?= $img['id'] ?>" class="d-none" value="<?= $img['id'] ?>" />

						<div class="image-container" data-pos="<?= $key ?>">
							<label for="deleteImg_<?= $img['id'] ?>" onclick="deleteImgLabel(this)">x</label>

							<?php $old = @$img['_old_image'] ?? ($img['image'] ?? ''); ?>

							<?= $this->Form->hidden("info_contents.{$rownum}.multi_images.{$key}._old_image", ['value' => $old, 'class' => 'old_img']); ?>
							<?= $this->Form->hidden("info_contents.{$rownum}.multi_images.{$key}.id", ['value' => $img['id'], 'class' => 'old_img_id']); ?>

							<div class="thumbImg">
								<a href="<?= $img['attaches']['image'][0] ?>" class="pop_image_single">
									<img src="<?= $img['attaches']['image'][0] ?>" class="image-preview">
								</a>
							</div>

						</div>
						<?php $key++ ?>
					<?php endif; ?>

				<?php endforeach; ?>

				<!-- render input img -->
				<div class="mup-msg <?= $key != 0 ? "d-none" : '' ?>">
					<span class="mup-main-msg">画像アップロードする。</span>
					<span class="mup-msg" id="max-upload-number">※ファイルサイズ5MB以内</span>
					<span class="mup-msg">※jpeg , jpg , gif , png ファイルのみ</span>
				</div>

				<?= $this->Form->input("_image_[]", ['multiple' => true, 'type' => 'file', 'class' => 'd-none attaches _image_', 'accept' => '.jpeg, .jpg, .gif, .png', 'onChange' => 'chooseFileUpload(this); previewImage(this); ', 'data-type' => 'image/jpeg,image/gif,image/png']); ?>
				<?= $this->Form->input(__("__image__[{0}][]", $rownum), ['multiple' => true, 'type' => 'file', 'class' => 'd-none __image__', 'accept' => '.jpeg, .jpg, .gif, .png']); ?>

			</div>

		</div>
	</div>

	<div class="table__column table__column-sub">
		<span style="font-size:0.9rem;"><?= (h($rownum) + 1); ?>.<?= \App\Model\Entity\Info::BLOCK_TYPE_LIST[$content['block_type']]; ?></span>
		<div class="table__row-config">
			<?= $this->element('UserInfos/sort_handle2'); ?>
			<?= $this->element('UserInfos/item_block_buttons', ['rownum' => $rownum, 'disable_config' => true]); ?>
		</div>
	</div>
</div>