<?= $this->Form->input("info_contents.{$rownum}.id", ['type' => 'hidden', 'value' => h($content['id']), 'id' => "idBlockId_" . h($rownum)]); ?>
<?= $this->Form->input("info_contents.{$rownum}.position", ['type' => 'hidden', 'value' => h($content['position'])]); ?>
<?= $this->Form->input("info_contents.{$rownum}.block_type", ['type' => 'hidden', 'value' => h($content['block_type']), 'class' => 'block_type']); ?>
<?= $this->Form->input("info_contents.{$rownum}.title", ['type' => 'hidden', 'value' => '']); ?>
<?= $this->Form->input("info_contents.{$rownum}.content", ['type' => 'hidden', 'value' => '', 'id' => 'block_hidden__content_' . $rownum]); ?>
<?= $this->Form->input("info_contents.{$rownum}.image", ['type' => 'hidden', 'value' => '']); ?>
<?= $this->Form->input("info_contents.{$rownum}.image_pos", ['type' => 'hidden', 'value' => '']); ?>
<?= $this->Form->input("info_contents.{$rownum}.file", ['type' => 'hidden', 'value' => '']); ?>
<?= $this->Form->input("info_contents.{$rownum}.file_size", ['type' => 'hidden', 'value' => '0']); ?>
<?= $this->Form->input("info_contents.{$rownum}.file_name", ['type' => 'hidden', 'value' => '']); ?>
<?= $this->Form->input("info_contents.{$rownum}.section_sequence_id", ['type' => 'hidden', 'value' => h($content['section_sequence_id']), 'class' => 'section_no']); ?>
<?= $this->Form->input("info_contents.{$rownum}._block_no", ['type' => 'hidden', 'value' => h($rownum)]); ?>
<?= $this->Form->input("info_contents.{$rownum}.option_value", ['type' => 'hidden', 'value' => h($rownum)]); ?>
<?= $this->Form->input("info_contents.{$rownum}.option_value2", ['type' => 'hidden', 'value' => '']); ?>
<?= $this->Form->input("info_contents.{$rownum}.option_value3", ['type' => 'hidden', 'value' => '']); ?>
