<?php $this->start('css') ?>
<link rel="stylesheet" href="/assets/css/apply.css?v=037fd83d93f24a8ca08bb2b7f2dfc232">
<?php $this->end('css') ?>

<main>
  <div class="entry-wrapper confirm">
    <section class="ttl-section js-headerTrigger">
      <div class="section-wrapper"> <span class="circle gray"> <img src="/assets/images/circle-gray.svg?v=1deef8be8ac37b793816d6e57117bfe0" alt=""></span><span class="circle green"><img src="/assets/images/circle-green.svg?v=fe7aafb7c1bf7cc75a8820d93fff66ba" alt=""></span><span class="circle red"><img src="/assets/images/circle-red.svg?v=c6bd3b8d2f4340b41678f05533339265" alt=""></span><span class="circle blue"><img src="/assets/images/circle-blue.svg?v=7124f5e56da2ece3ebbbfa70a7022891" alt=""></span>
        <h2 class="ttl"> <span class="ja">入居申込み</span><span class="en">APPLY</span></h2>
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
          <?php endforeach; ?>
          <div class="form-inner">
            <div class="formBlock">
              <h3 class="formTtl">入居希望者さまについて</h3>
              <div class="block">
                <label for="service">
                  希望サービス<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= $hope_service[$form_data['hope_service']] ?></p>
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
                <label for="age">
                  年齢<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= h($form_data['age']) ?> 歳</p>
                </div>
              </div>
              <div class="block">
                <label>
                  性別<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= $gender[$form_data['gender']] ?></p>
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
                <label>
                  現在の住居形態</label>
                <div class="input-wrapper">
                  <p class="txt"><?= @$residence_status[$form_data['residence_status']] ?></p>
                </div>
              </div>
              <div class="block">
                <label for="houseName">
                  ご利用の介護施設名</label>
                <div class="input-wrapper">
                  <p class="txt"><?= h($form_data['esidence_name']) ?></p>
                </div>
              </div>
              <div class="block stretch">
                <label for="address">住所</label>
                <div class="input-wrapper">
                  <p class="txt">〒 <?= h(@$form_data['post_code']) . "　" . h(@$form_data['prefectures']) . " " . h(@$form_data['city']) . " " . h(@$form_data['building']) ?></p>
                </div>
              </div>
              <div class="block">
                <label>
                  要介護度<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= $nursing_level[$form_data['nursing_level']] ?></p>
                </div>
              </div>
              <div class="block">
                <label>
                  介護認定<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= $nursing_certification[$form_data['nursing_certification']] ?></p>
                </div>
              </div>
              <div class="block stretch block-last">
                <label for="remarks">備考欄</label>
                <div class="input-wrapper">
                  <p class="txt"><?= nl2br(h($form_data['content'])) ?></p>
                </div>
              </div>
            </div>
            <div class="formBlock">
              <h3 class="formTtl">申込代理者さまについて</h3>
              <div class="block">
                <label for="d-name">
                  お名前<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= h($form_data['agent_name']) ?></p>
                </div>
              </div>
              <div class="block">
                <label for="d-furigana">
                  フリガナ<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= h($form_data['agent_furigana']) ?></p>
                </div>
              </div>
              <div class="block">
                <label for="d-relation">
                  入居希望者さまとの続柄<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= h($form_data['relation']) ?></p>
                </div>
              </div>
              <div class="block">
                <label for="d-tel">
                  お電話番号<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= h($form_data['agent_tel']) ?></p>
                </div>
              </div>
              <div class="block">
                <label for="d-tel">
                メールアドレス<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <p class="txt"><?= h($form_data['email']) ?></p>
                </div>
              </div>
              <div class="block stretch block-last">
                <label for="d-address">住所</label>
                <div class="input-wrapper">
                  <?php if ($form_data['sameAddressCheck'] == 1) : ?>
                    <p class="txt">入居希望者さまと同じ</p>
                  <?php else : ?>
                    <p class="txt">〒 <?= h(@$form_data['agent_post_code']) . "　" . h(@$form_data['agent_prefectures']) . " " . h(@$form_data['agent_city']) . " " . h(@$form_data['agent_building']) ?></p>
                  <?php endif; ?>
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
              <div class="back-btn"> <a href="/apply">戻る</a></div>
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
      <li class="current"><a href="javascript:void(0);">入居申込み</a></li>
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