<figure class="float-<?= h($c['image_pos']); ?>">
  <?php if (!empty($c['option_value'])) : ?>
    <a href="<?= h($c['option_value']); ?>" target="_blank">
    <?php endif; ?>
    <img src="<?= $c['attaches']['image']['0']; ?>" alt="" width="866" height="556" loading="lazy" decoding="async">
    <?php if (!empty($c['option_value'])) : ?>
    </a>
  <?php endif; ?>
</figure>
<p><?= $c['content']; ?></p>