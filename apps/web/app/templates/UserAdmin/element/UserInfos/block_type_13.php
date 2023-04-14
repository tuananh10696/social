<!--関連記事 枠-->
<div class="table__row first-dir" id="block_no_<?= h($rownum); ?>" data-sub-block-move="0">
  <div class="table__column">
<tr>
  <td>
    <div class="sort_handle"></div>
    <?= $this->element('UserInfos/block_type_0', ['rownum' => $rownum, 'content' => $content]); ?>
  </td>

  <td colspan="2">
    <div class="sub-unit__wrap">
      <h4></h4>
      <table style="margin: 0; width: 100%;table-layout: fixed;" data-section-no="<?= h($content['section_sequence_id']);?>" data-block-type="<?= h($content['block_type']); ?>">
        <colgroup>
          <col style="width: 70px;">
          <col style="width: 150px;">
          <col>
          <col style="width: 90px;">
        </colgroup>
        <thead>
        </thead>
        <tbody class="list_table_relation" data-waku-block-type="<?= $content['block_type'];?>">
          <tr>
            <td colspan="1" style="display: none;"></td>
            <td colspan="4" class="td__movable">
              <div class="btn_area" style="text-align: right;float: right;">
                <a href="#" class="btn_confirm btn_orange small_menu_btn" onClick="addBlockRelation(<?= $rownum; ?>, <?= h($content['section_sequence_id']); ?>); return false;">関連記事追加</a>
              </div>
              ここへ関連記事ブロックを追加できます
            </td>
          </tr>
        <?php if (array_key_exists('sub_contents', $content) ): ?>
        <?php foreach ($content['sub_contents'] as $sub_key => $sub_val): ?>
          <?php $block_type = h($sub_val['block_type']); ?>
          <?= $this->element("UserInfos/block_type_{$block_type}", ['rownum' => h($sub_val['_block_no']), 'content' => h($sub_val)]); ?>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </td>

</tr>
  </div>

  <div class="table__column table__column-sub">
    <span style="font-size:0.9rem;"><?= (h($rownum) + 1); ?>.枠（関連記事）</span>
    <div class="table__row-config">
      <?= $this->element('UserInfos/sort_handle2'); ?>
      <?= $this->element('UserInfos/item_block_buttons', ['rownum' => $rownum, 'disable_config' => true]); ?>
    </div>
  </div>
</div>