<!--回り込み画像枠-->
<div class="table__row first-dir item_block" id="block_no_<?= h($rownum); ?>" data-sub-block-move="0">
	<div class="table__column">
		<tr>
			<td>
				<div class="sort_handle"></div>
				<?= $this->Form->hidden("info_contents.{$rownum}.id", ['value' => @$content['id'], 'id' => 'idBlockId_' . h($rownum)]); ?>
				<?= $this->Form->hidden("info_contents.{$rownum}.position", ['value' => h($content['position'])]); ?>
				<?= $this->Form->hidden("info_contents.{$rownum}.block_type", ['value' => h($content['block_type']), 'class' => 'block_type']); ?>
			</td>

			<td colspan="2">
				<div class="sub-unit__wrap">
					<h4></h4>

					<?php $image_column = 'image'; ?>
					<dl style="border:1px solid #cbcbcb; padding: 10px;">
						<?php
						$temp = [
							'nestingLabel' => '{{input}}<label{{attrs}} class="custom-control-label">{{text}}</label>',
							'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
							'radioWrapper' => '<div class="custom-control custom-radio">{{label}}</div>'
						] ?>
						<dt>１．回り込み位置</dt>
						<dd>
							<?= $this->Form->setTemplates($temp)->radio(
								"info_contents.{$rownum}.image_pos",
								[
									'left' => '<img src="/user/common/images/cms/align_left.gif">',
									'right' => '<img src="/user/common/images/cms/align_right.gif">'
								],
								[
									'class' => 'custom-control-input',
									'separator' => '　',
									'escape' => false,
									'value' => @$content['image_pos'] != '' ? $content['image_pos'] : 'left'
								]
							); ?>
						</dd>

						<dt>２．画像</dt>
						<dd>
							<div class="td_parent">
								<?= $this->Form->input("info_contents.{$rownum}.{$image_column}", ['type' => 'file', 'class' => 'attaches attachesWith', 'accept' => '.jpeg, .jpg, .gif, .png', 'onChange' => 'chooseFileUpload(this)', 'data-type' => 'image/jpeg,image/gif,image/png']); ?>

								<?php if (!empty($content['attaches'][$image_column]['0'])) : ?>
									<div class="thumbImg">

										<a href="<?= h($content['attaches'][$image_column]['0']); ?>" class="pop_image_single">
											<img src="<?= $this->Url->build($content['attaches'][$image_column]['0']) ?>" style="width: 300px; float: left;">
											<?= $this->Form->input("info_contents.{$rownum}.attaches.{$image_column}.0", ['type' => 'hidden']); ?>
										</a>

										<?php $old = $content['_old_' . $image_column] ?? ($content[$image_column] ?? ''); ?>
										<?= $this->Form->input("info_contents.{$rownum}._old_{$image_column}", array('type' => 'hidden', 'value' => h($old), 'class' => 'old_img_input')); ?>
										<?= $this->Form->input("info_contents.{$rownum}.file_size", ['type' => 'hidden']); ?>
										<?= $this->Form->input("info_contents.{$rownum}.file_name", ['type' => 'hidden']); ?>
										<?= $this->Form->input("info_contents.{$rownum}.file_extension", ['type' => 'hidden']); ?>

									</div>
									<div style="clear: both;"></div>
								<?php endif; ?>

								<div class="preview_img dpl_none">
									<span class="preview_img_btn" onclick="preview_img_action(this)">画像の削除</span>
								</div>

								<div class="attention">※jpeg , jpg , gif , png ファイルのみ</div>
								<div class="attention">※ファイルサイズ5MB以内</div>

							</div>
						</dd>

						<dt style="margin-top: 10px;">３．画像リンク</dt>
						<dd>
							<?= $this->Form->input("info_contents.{$rownum}.option_value", [
								'type' => 'text',
								'placeholder' => 'http://',
								'maxlength' => 255,
								'class' => $fixed_class,
								'readonly' => $fixed_readonly
							]); ?>

						</dd>

						<dt style="margin-top: 10px;">４．内容</dt>
						<dd>
							<?= $this->Form->input("info_contents.{$rownum}.content", ['type' => 'textarea', 'class' => 'editor', 'readonly' => $fixed_readonly]); ?>
						</dd>
					</dl>
				</div>
			</td>
		</tr>
	</div>

	<div class="table__column table__column-sub">
		<span style="font-size:0.9rem;"><?= (h($rownum) + 1); ?>.画像回り込み用</span>
		<div class="table__row-config">
			<?= $this->element('UserInfos/sort_handle2'); ?>
			<?= $this->element('UserInfos/item_block_buttons', ['rownum' => $rownum, 'disable_config' => true]); ?>
		</div>
	</div>
</div>