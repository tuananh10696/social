<?php $class = ['pdf'] ?>
  <?php $class = in_array($c->file_extension, ['doc', 'docx'], true) ? ['word'] : $class ?>
  <?php $class = in_array($c->file_extension, ['xls', 'xlsx'], true) ? ['xcel'] : $class ?>
  <?php $class = in_array($c->file_extension, ['ppt', 'pptx'], true) ? ['pptx'] : $class ?>

  <div class="link <?= $class[0] ?>">
    <a href="<?= $c->attaches['file'][0]; ?>"> <i class="icon icon-<?= $class[0] ?>"></i><span><?= h($c->file_name); ?>(<?= human_filesize($c->file_size) ?>)</span></a>
  </div>