<?php $this->start('css') ?>
<link rel="stylesheet" href="/assets/css/contact.css?v=c78163d7ff45c37c8bf87b1354dd4f4a">
<?php $this->end('css') ?>

<main>
  <div class="contact-wrapper confirm">
    <section class="ttl-section js-headerTrigger">
      <div class="section-wrapper"> <span class="circle gray"> <img src="/assets/images/circle-gray.svg?v=1deef8be8ac37b793816d6e57117bfe0" alt=""></span><span class="circle green"><img src="/assets/images/circle-green.svg?v=fe7aafb7c1bf7cc75a8820d93fff66ba" alt=""></span><span class="circle red"><img src="/assets/images/circle-red.svg?v=c6bd3b8d2f4340b41678f05533339265" alt=""></span><span class="circle blue"><img src="/assets/images/circle-blue.svg?v=7124f5e56da2ece3ebbbfa70a7022891" alt=""></span>
        <h2 class="ttl"> <span class="ja">お問い合わせ</span><span class="en">CONTACT</span></h2>
      </div>
    </section>
    <section class="contents-section">
      <div class="bg-top"> </div>
      <div class="bg-content">
        <div class="section-wrapper">
          <div class="pagination">
            <div class="pagination-inner">
              <div class="pagination-item">入力</div>
              <div class="pagination-item active">確認</div>
              <div class="pagination-item">送信</div>
            </div>
          </div>
          <?= $this->Form->create($contact_form, ['templates' => $form_templates, 'class' => 'form']); ?>
          <?php foreach ($form_data as $id => $vl) : ?>
            <?= $this->Form->input($id, ['type' => 'hidden']); ?>
          <?php endforeach; ?><div class="form-inner">
            <div class="formBlock">
              <div class="block">
                <label for="division">
                  お客さま区分<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= $customer_type[$form_data['customer_type']] ?></p>
                  <?php if ($form_data['customer_type'] == 2 && $form_data['company_name'] != '') : ?>
                    <p class="txt"><?= h($form_data['company_name']) ?></p>
                  <?php endif; ?>
                  <?php if ($form_data['customer_type'] == 2 && $form_data['department'] != '') : ?>
                    <p class="txt"><?= h($form_data['department']) ?></p>
                  <?php endif; ?>
                </div>
              </div>
              <div class="block">
                <label>
                  お問い合わせ項目</label>
                <div class="input-wrapper">
                  <p class="txt"><?= $contact_type[$form_data['contact_type']] ?></p>
                </div>
              </div>
              <div class="block">
                <label for="name">
                  お名前<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= h($form_data['name']) ?></p>
                </div>
              </div>
              <div class="block">
                <label for="furigana">
                  フリガナ<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= h($form_data['furigana']) ?></p>
                </div>
              </div>
              <div class="block">
                <label for="tel">
                  お電話番号<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= h($form_data['tel']) ?></p>
                </div>
              </div>
              <div class="block">
                <label for="email">
                  メールアドレス<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= h($form_data['email']) ?></p>
                </div>
              </div>
              <div class="block">
                <label for="email-confirm">
                  メールアドレス(確認)<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= h($form_data['check_email']) ?></p>
                </div>
              </div>
              <div class="block stretch">
                <label for="address">
                  住所</label>
                <div class="input-wrapper">
                  <p class="txt">〒 <?= h($form_data['post_code']) . "　" . h($form_data['prefectures']) . " " . h($form_data['city']) . " " . h($form_data['building']) ?></p>
                </div>
              </div>
              <div class="block stretch block-last">
                <label for="remarks">自由記入欄</label>
                <div class="input-wrapper">
                  <p class="txt"><?= nl2br(h($form_data['content'])) ?></p>
                </div>
              </div>
              <div class="block stretch block-last">
                <label for="d-address">
                  プライバシーポリシー<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt">同意する</p>
                </div>
              </div>
            </div>
            <div class="btn">
              <div class="back-btn"> <a href="/contact">戻る</a></div>
              <div class="btn-wrapper">
                <input type="submit" class="send" value="送信する">
              </div>
            </div>
          </div>
          <?= $this->Form->end() ?>
        </div>
      </div>
    </section>
  </div>
  <div class="bredcrumb">
    <ul>
      <li> <a href="/">TOP</a></li>
      <li class="current"><a href="javascript:void(0);">お問い合わせ</a></li>
    </ul>
  </div>
</main>

<?php $this->start('script') ?>
<script src="/user/common/js/jquery.js"></script>
<script type="text/javascript">
  $(function() {
    //送信ボタンを押した際に送信ボタンを無効化する（連打による多数送信回避）
    var is_click = true;
    $('.send').click(function() {
      if (!is_click) return false;
      $(this).parents('form').submit();
      is_click = false;
    });
  });
</script>
<?php $this->end('script') ?>