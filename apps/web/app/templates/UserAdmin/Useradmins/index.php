<?php $this->assign('content_title', "ユーザー管理"); ?>
<?php $this->start('menu_list'); ?>
<li class="breadcrumb-item active"><span>ユーザー管理</span></li>
<?php $this->end(); ?>

<?php
$this->assign('data_count', $this->Paginator->counter("{{count}}")); // データ件数
$this->assign('create_url', $this->Url->build(array('action' => 'edit', '?' => $query))); // 新規登録URL
?>

<?= $this->element('pagination'); ?>

<div class="table_list_area">
  <table class="table table-sm table-hover table-bordered dataTable dtr-inline" style="table-layout: fixed;">
    <colgroup class="show_pc">
      <col style="width: 70px;">
      <col style="width: 150px;">
      <col>
      <col style="width: 170px;">
    </colgroup>

    <thead class="bg-gray">
    <tr>
      <th>掲載</th>
      <th>アカウント名</th>
      <th style="text-align:left;">名前</th>
      <th>権限</th>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach ($data_query->toArray() as $key => $data):
      $no = sprintf("%02d", $data->id);
      $id = $data->id;
      $status = ($data->status === 'publish' ? true : false);

      ?>
      <tr class="<?= $status ? "visible" : "unvisible" ?>" id="content-<?= $data->id ?>">
        <td>
          <a name="m_<?= $id ?>"></a>
          <?= $this->element('status_button', ['id' => $id, 'status' => $status]); ?>
        </td>

        <td title="" data-label="アカウント名">
          <?= $data->username ?>
        </td>

        <td>
          <?= $this->Html->link($data->name, ['action' => 'edit', $data->id, '?' => $query], ['class' => 'btn btn-light w-100 text-left']) ?>
        </td>

        <td>
          <?= $role_list[$data->role]; ?>
        </td>


      </tr>

    <?php endforeach; ?>
    </tbody>

  </table>

</div>
<?= $this->element('pagination'); ?>

<?php $this->start('beforeBodyClose'); ?>
<link rel="stylesheet" href="/admin/common/css/cms.css">
<script>
  function change_category() {
    $("#fm_search").submit();

  }

  $(function () {


  })
</script>
<?php $this->end(); ?>
