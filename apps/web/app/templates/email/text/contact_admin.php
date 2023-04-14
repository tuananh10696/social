*************************************************
　お問い合わせ内容
*************************************************

【お客さま区分】
<?= $list['customer_type'][$form['customer_type']]; ?>　
<?php if ($form['customer_type'] == 2 && $form['company_name'] != '') : ?>
<?= $form['company_name']; ?>　
<?php endif; ?>
<?php if ($form['customer_type'] == 2 && $form['department'] != '') : ?>
<?= $form['department']; ?>　
<?php endif; ?>

【お問い合わせ項目】
<?= $list['contact_type'][$form['contact_type']]; ?>　

【お名前】
<?= $form['name']; ?>　

【フリガナ】
<?= $form['furigana']; ?>　

【お電話番号】
<?= $form['tel']; ?>　

【メールアドレス】
<?= $form['email']; ?>　
<?php if ($form['post_code'] != '' || $form['prefectures'] != '' || $form['city'] != '' || $form['building'] != '') : ?>

【住所】
〒 <?= h($form['post_code']) . "　" . h($form['prefectures']) . " " . h($form['city']) . " " . h($form['building']) ?>　
<?php endif; ?>
<?php if ($form['content'] != '') : ?>

【自由記入欄】
<?= $form['content']; ?>　
<?php endif; ?>
