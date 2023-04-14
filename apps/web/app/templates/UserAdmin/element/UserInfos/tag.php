<li id="tag_id_<?= $num; ?>" class="btn btn-secondary btn-sm" style="line-height: 1em;padding: 5px;font-size:1rem;">
    <span class="tag_name"><?= $tag; ?></span>
    <span><a href="javascript:void(0);" class="delete_tag" data-id="<?= $num; ?>" style="color:#FFF;font-size:1.3em;">×</a></span>
    <?= $this->Form->input("tags.{$num}.tag", ['type' => 'hidden', 'value' => $tag]); ?>
</li>
