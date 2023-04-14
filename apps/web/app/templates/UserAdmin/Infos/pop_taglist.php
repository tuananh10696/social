<?php $this->assign('content_title', 'タグ登録リスト'); ?>

<?php $this->assign('search_box_open', false); ?>

<?php
$this->assign('data_count', $this->Paginator->counter("{{count}}")); // データ件数
$this->assign('create_url', false); // 新規登録URL
?>

<div class="table_list_area">
  <?= $this->element('pagination'); ?>

  <table class="table table-sm table-hover table-bordered dataTable dtr-inline" style="table-layout: fixed;">
    <colgroup>
      <col style="width: 90px;">
      <col style="width: 100px;">
      <col>
<!--      <col style="width: 100px;">-->

    </colgroup>

    <thead class="bg-gray">
      <tr>
        <th >選択</th>
        <th >表示番号</th>
        <th style="text-align:left;">タグ</th>
<!--        <th>使用数</th>-->
      </tr>
    </thead>

    <tbody>
      <?php
      foreach ($data_query->toArray() as $key => $data):
      $no = sprintf("%02d", $data->id);
      $id = $data->id;
      $status = ($data->status === 'publish' ? true : false);

      ?>

      <tr class="visible" id="content-<?= $data->id ?>">

        <td>
          <a name="m_<?= $id ?>"></a>
          <div class="btn_area center">
            <a href="#" class="btn btn-danger btn-sm" onClick="parent.pop_box.select('<?= $data->tag;?>');">選択</a>
          </div>
        </td>

        <td>
          <?= $data->position; ?>
        </td>

        <td>
          <?= $data->tag; ?>
        </td>

<!--        <td>-->
<!--          --><?php //= $data->cnt; ?><!--件-->
<!--        </td>-->

      </tr>

<?php endforeach; ?>
    </tbody>
  </table>
  <?= $this->element('pagination'); ?>

</div>


<?php $this->start('beforeBodyClose');?>
<link rel="stylesheet" href="/admin/common/css/cms.css">
<script>
function change_category() {
  $("#fm_search").submit();
    
}
$(function () {



})
</script>
<?php $this->end();?>
