<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message success" onclick="this.classList.add('hidden');">
    <div class="alert alert-success">
        <h5>
            <i class="fas fa-check"></i> <?= $message ?>
        </h5>
<!--        <div class="error">-->
<!--            <div>--><?//= $message ?><!--</div>-->
<!--        </div>-->
    </div>
</div>