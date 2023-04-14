*************************************************
　お問い合わせ内容
*************************************************

＊入居希望者さまについて

【希望サービス】
<?= $list['hope_service'][$form['hope_service']]; ?>　

【お名前】
<?= $form['name']; ?>　

【フリガナ】
<?= $form['furigana']; ?>　

【年齢】
<?= $form['age']; ?>　

【性別】
<?= $list['gender'][$form['gender']]; ?>　

【お電話番号】
<?= $form['tel']; ?>　
<?php if ($form['residence_status'] != '') : ?>

【現在の住居形態】
<?= $list['residence_status'][$form['residence_status']]; ?>　
<?php endif; ?>
<?php if ($form['esidence_name'] != '') : ?>

【介護施設名】
<?= $form['esidence_name']; ?>　
<?php endif; ?>
<?php if ($form['post_code'] != '' || $form['prefectures'] != '' || $form['city'] != '' || $form['building'] != '') : ?>

【住所】
〒 <?= h($form['post_code']) . "　" . h($form['prefectures']) . " " . h($form['city']) . " " . h($form['building']) ?>　
<?php endif; ?>

【要介護度】
<?= $list['nursing_level'][$form['nursing_level']]; ?>　

【ご利用の介護施設名】
<?= $list['nursing_certification'][$form['nursing_certification']]; ?>　
<?php if ($form['content'] != '') : ?>

【備考欄】
<?= $form['content']; ?>　
<?php endif; ?>

＊申込代理者さまについて

【お名前】
<?= $form['agent_name']; ?>　

【フリガナ】
<?= $form['agent_furigana']; ?>　

【入居希望者さまとの続柄】
<?= $form['relation']; ?>　

【お電話番号】
<?= $form['agent_tel']; ?>　

【メールアドレス】
<?= $form['email']; ?>　

<?php if ($form['sameAddressCheck'] == 1) : ?>

【住所】
入居希望者さまと同じ　
<?php elseif ($form['sameAddressCheck'] != 1 && ($form['agent_post_code'] != '' || $form['agent_prefectures'] != '' || $form['agent_city'] != '' || $form['agent_building'] != '')) : ?>
  
【住所】
〒 <?= h($form['agent_post_code']) . "　" . h($form['agent_prefectures']) . " " . h($form['agent_city']) . " " . h($form['agent_building']) ?>　
<?php endif; ?>
