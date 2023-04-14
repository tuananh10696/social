<!--関連記事-->
<div class="table__row relation-dir" id="block_no_<?= h($rownum); ?>" data-sub-block-move="1">
  <div class="table__column">
    <tr>
      <td>
        <div class="sort_handle"></div>
        <?= $this->element('UserInfos/block_type_0', ['rownum' => $rownum, 'content' => $content]); ?>
      </td>
      <td class="head"></td>
      <td>

        <dl>
          <dt>１．タイトル</dt>
          <dd>
            <?= $this->Form->input("info_contents.{$rownum}.content", ['type' => 'textarea', 'style' => 'height:80px;width:100%;', 'maxlength' => '200']); ?>
          </dd>

          <dt>２．画像</dt>
          <dd>
            <?php $image_column = 'image'; ?>
            <?php if (!empty($content['attaches'][$image_column]['0'])) : ?>
              <div>
                <a href="<?= h($content['attaches'][$image_column]['0']); ?>" class="pop_image_single">
                  <img src="<?= $this->Url->build($content['attaches'][$image_column]['0']) ?>" style="width: 300px;">
                  <?= $this->Form->input("info_contents.{$rownum}.attaches.{$image_column}.0", ['type' => 'hidden']); ?>
                </a><br>
                <?= $this->Form->input("info_contents.{$rownum}._old_{$image_column}", array('type' => 'hidden', 'value' => h($content[$image_column]))); ?>
              </div>
            <?php endif; ?>
            <div>
              <?php if (!$fixed_readonly) : ?>
                <?= $this->Form->input("info_contents.{$rownum}.{$image_column}", array('type' => 'file')); ?>
              <?php endif; ?>
              <span class="attention">※jpeg , jpg , gif , png ファイルのみ</span>
              <div><?= $this->Form->getRecommendSize('InfoContents', 'image', ['before' => '※', 'after' => '']); ?></div>
              <br />
            </div>
          </dd>

          <dt>３．リンク先</dt>
          <dd>
            <?= $this->Form->input("info_contents.{$rownum}.option_value", ['type' => 'text', 'placeholder' => 'http://']); ?>
          </dd>
        </dl>

      </td>

    </tr>
  </div>

  <div class="table__column table__column-sub">
    <span style="font-size:0.9rem;"><?= (h($rownum) + 1); ?>.関連記事</span>
    <div class="table__row-config">
      <?= $this->element('UserInfos/sort_handle2'); ?>
      <?= $this->element('UserInfos/item_block_buttons', ['rownum' => $rownum, 'disable_config' => true]); ?>
    </div>
  </div>
</div>