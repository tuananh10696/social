<figure>
<?php if ($c['attaches']['image']['0']): ?>
  <?php $image = $c['attaches']['image']['0']; ?>
<?php if (!empty($c['content'])): ?>
  <a href="<?= $c['content']; ?>" target="<?= $c['option_value'];?>" class="true">
      <img src="<?= h($image); ?>" alt="" loading="lazy">
  </a>
<?php else: ?>
  <img src="<?= h($image); ?>" alt="" loading="lazy">
<?php endif; ?>
<?php endif; ?>
</figure>