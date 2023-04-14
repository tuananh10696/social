<li  class="btn btn-secondary btn-sm" style="line-height: 1em;padding: 5px;font-size:1rem;">
    <span class="tag_name"><?= h($tag); ?></span>
  <?php if (!empty($input_name)): ?>
    <?= $this->Form->input($input_name, ['type' => 'hidden', 'value' => $tag]); ?>
  <?php endif; ?>
</li>
