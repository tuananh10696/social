<?php $this->start('css') ?>
<link rel="stylesheet" href="/assets/css/apply.css?v=037fd83d93f24a8ca08bb2b7f2dfc232">
<?php $this->end('css') ?>

<main>
  <div class="entry-wrapper <?= !empty($contact_form->getErrors()) ? 'error' : '' ?>">
    <section class="ttl-section js-headerTrigger">
      <div class="section-wrapper"> <span class="circle gray"> <img src="/assets/images/circle-gray.svg?v=1deef8be8ac37b793816d6e57117bfe0" alt=""></span><span class="circle green"><img src="/assets/images/circle-green.svg?v=fe7aafb7c1bf7cc75a8820d93fff66ba" alt=""></span><span class="circle red"><img src="/assets/images/circle-red.svg?v=c6bd3b8d2f4340b41678f05533339265" alt=""></span><span class="circle blue"><img src="/assets/images/circle-blue.svg?v=7124f5e56da2ece3ebbbfa70a7022891" alt=""></span>
        <h2 class="ttl"> <span class="ja">入居申込み</span><span class="en">APPLY</span></h2>
      </div>
    </section>
    <section class="contents-section">
      <div class="bg-top"> </div>
      <div class="bg-content">
        <div class="section-wrapper">
          <div class="tel-box">
            <div class="flex">
              <div class="flex-item left">
                <p>電話でのお問い合わせはこちら</p>
              </div>
              <div class="flex-item right"> <a href="tel:0285-38-8489"> <span class="tel">0285-38-8489</span></a>
                <p>
                  受付時間｜10:00〜16:00<span>(土日祝日を除く)</span></p>
              </div>
            </div>
          </div>
          <div class="pagination">
            <div class="pagination-inner">
              <div class="pagination-item active">入力</div>
              <div class="pagination-item">確認</div>
              <div class="pagination-item">送信</div>
            </div>
          </div>
          <div class="text-area">
            <p>
              下記フォームをご入力のうえ、<br class="only-sp">「入力内容を確認する」ボタンを押してください。</p>
            <p> <span class="red">※</span>は必須項目です。</p>
          </div>
          <?= $this->Form->create($contact_form, ['name' => 'form', 'type' => 'post', 'class' => 'form h-adr', 'templates' => $form_templates]); ?>
          <div class="form-inner">
            <div class="formBlock">
              <h3 class="formTtl">入居希望者さまについて</h3>
              <div class="block">
                <label for="service">
                  希望サービス<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <?= $this->Form->input('hope_service', ['type' => 'radio', 'options' => $hope_service]); ?>
                </div>
              </div>
              <div class="block">
                <label for="name">
                  お名前<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <?= $this->Form->input('name', ['type' => 'text', 'placeholder' => '大沼 里子', 'maxlength' => 50, 'required' => false]); ?>
                </div>
              </div>
              <div class="block">
                <label for="furigana">
                  フリガナ<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <?= $this->Form->input('furigana', ['type' => 'text', 'placeholder' => 'オオヌマ サトコ', 'maxlength' => 50, 'required' => false]); ?>
                </div>
              </div>
              <div class="block">
                <label for="age">
                  年齢<span class="asta">※</span></label>
                <div class="input-wrapper age">
                  <?= $this->Form->input('age', ['type' => 'text', 'maxlength' => 3, 'error' => false, 'required' => false]); ?><span>歳</span>
                  <?= $this->Form->error('age'); ?>
                </div>
              </div>
              <div class="block">
                <label>
                  性別<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <?= $this->Form->input('gender', ['type' => 'radio', 'options' => $gender]); ?>
                </div>
              </div>
              <div class="block">
                <label for="tel">
                  お電話番号<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <?= $this->Form->input('tel', ['type' => 'text', 'placeholder' => '0000-00-0000', 'maxlength' => 13, 'required' => false]); ?>
                </div>
              </div>
              <div class="block">
                <label>
                  現在の住居形態</label>
                <div class="input-wrapper">
                  <?= $this->Form->input('residence_status', ['type' => 'radio', 'options' => $residence_status]); ?>
                </div>
              </div>
              <div class="block esidence_name">
                <label for="houseName">
                  ご利用の介護施設名
                </label>
                <div class="input-wrapper">
                  <?= $this->Form->input('esidence_name', ['type' => 'text', 'maxlength' => 100, 'required' => false]); ?>
                </div>
              </div>
              <div class="block stretch">
                <label for="address">住所</label>
                <div class="address-wrapper h-adr"><span class="p-country-name" style="display:none">Japan</span>
                  <div class="input-form postal">
                    <p>〒</p>
                    <?= $this->Form->input('post_code', ['class' => 'p-postal-code', 'type' => 'text', 'placeholder' => '000-0000', 'maxlength' => 8, 'error' => false, 'required' => false]); ?>
                    <p class="caption">※ 入力後、住所に自動反映されます。</p>
                  </div>
                  <?= $this->Form->error('post_code'); ?>
                  <div class="input-form">
                    <p>都道府県</p>
                    <?= $this->Form->input('prefectures', ['class' => 'p-region', 'type' => 'text', 'placeholder' => '栃木県', 'maxlength' => 50, 'required' => false]); ?>
                  </div>
                  <div class="input-form">
                    <p>市区町村</p>
                    <?= $this->Form->input('city', ['class' => 'p-locality', 'type' => 'text', 'placeholder' => '小山市大学荒井', 'maxlength' => 50, 'required' => false]); ?>
                  </div>
                  <div class="input-form">
                    <p>番地・建物名</p>
                    <?= $this->Form->input('building', ['class' => 'p-street-address p-extended-address', 'type' => 'text', 'placeholder' => '6-2', 'maxlength' => 50, 'required' => false]); ?>
                  </div>
                </div>
              </div>
              <div class="block">
                <label>
                  要介護度<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <?= $this->Form->input('nursing_level', ['type' => 'radio', 'options' => $nursing_level]); ?>
                </div>
              </div>
              <div class="block">
                <label>
                  介護認定<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <?= $this->Form->input('nursing_certification', ['type' => 'radio', 'options' => $nursing_certification]); ?>
                </div>
              </div>
              <div class="block stretch block-last">
                <label for="remarks">備考欄</label>
                <div class="input-wrapper">
                  <?= $this->Form->input('content', ['type' => 'textarea', 'cols' => 30, 'rows' => 10, 'placeholder' => '入居希望者さまについて、そのほかに伝えておきたいことがございましたら、こちらにご記入ください。', 'maxlength' => 500, 'required' => false]); ?>
                </div>
              </div>
            </div>
            <div class="formBlock">
              <h3 class="formTtl">申込代理者さまについて</h3>
              <div class="block">
                <label for="d-name">
                  お名前<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <?= $this->Form->input('agent_name', ['type' => 'text', 'placeholder' => '大沼 里子', 'maxlength' => 50, 'required' => false]); ?>
                </div>
              </div>
              <div class="block">
                <label for="d-furigana">
                  フリガナ<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <?= $this->Form->input('agent_furigana', ['type' => 'text', 'placeholder' => 'オオヌマ サトコ', 'maxlength' => 50, 'required' => false]); ?>
                </div>
              </div>
              <div class="block">
                <label for="d-relation">
                  入居希望者さまとの続柄<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <?= $this->Form->input('relation', ['type' => 'text', 'maxlength' => 50, 'required' => false]); ?>
                </div>
              </div>
              <div class="block">
                <label for="d-tel">
                  お電話番号<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <?= $this->Form->input('agent_tel', ['type' => 'text', 'placeholder' => '0000-00-0000', 'maxlength' => 13, 'required' => false]); ?>
                </div>
              </div>
              <div class="block">
                <label for="email">
                  メールアドレス<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <?= $this->Form->input('email', ['type' => 'text', 'placeholder' => 'sample@reiwakai.or.jp', 'maxlength' => 100, 'required' => false]); ?>
                </div>
              </div>
              <div class="block">
                <label for="email-confirm">
                  メールアドレス(確認)<span class="asta">※</span></label>
                <div class="input-wrapper">
                  <?= $this->Form->input('check_email', ['type' => 'text', 'placeholder' => 'sample@reiwakai.or.jp', 'maxlength' => 100, 'required' => false]); ?>
                </div>
              </div>
              <div class="block stretch block-last">
                <label for="d-address">住所</label>
                <div class="address-wrapper h-adr"><span class="p-country-name" style="display:none">Japan</span>
                  <?= $this->Form->input('sameAddressCheck', ['type' => 'checkbox', 'value' => 1, 'hiddenFiend' => false, 'id' => 'sameAddressCheck', 'error' => false]); ?>
                  <label for="sameAddressCheck">入居希望者さまと同じ住所の場合は、入力せずにチェックをつけてください。</label>
                  <div class="input-form postal">
                    <p>〒</p>
                    <?= $this->Form->input('agent_post_code', ['class' => 'p-postal-code', 'type' => 'text', 'placeholder' => '000-0000', 'maxlength' => 8, 'error' => false, 'required' => false]); ?>
                    <p class="caption">※ 入力後、住所に自動反映されます。</p>
                  </div>
                  <?= $this->Form->error('agent_post_code'); ?>
                  <div class="input-form">
                    <p>都道府県</p>
                    <?= $this->Form->input('agent_prefectures', ['class' => 'p-region', 'type' => 'text', 'placeholder' => '栃木県', 'maxlength' => 50, 'required' => false]); ?>
                  </div>
                  <div class="input-form">
                    <p>市区町村</p>
                    <?= $this->Form->input('agent_city', ['class' => 'p-locality', 'type' => 'text', 'placeholder' => '小山市大学荒井', 'maxlength' => 50, 'required' => false]); ?>
                  </div>
                  <div class="input-form">
                    <p>番地・建物名</p>
                    <?= $this->Form->input('agent_building', ['class' => 'p-street-address p-extended-address', 'type' => 'text', 'placeholder' => '6-2', 'maxlength' => 50, 'required' => false]); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="privacy-check">
              <?= $this->Form->input('chk_privacy', ['type' => 'checkbox', 'value' => 1, 'hiddenFiend' => false, 'id' => 'privacy', 'error' => false]); ?>
              <label for="privacy"> <span> <a target="_blank" href="/privacy/">プライバシーポリシー</a>に同意する </span></label>
              <?= $this->Form->error('chk_privacy'); ?>
            </div>
            <div class="btn">
              <div class="btn-wrapper">
                <input type="submit" onclick="document.form.submit();" value="入力内容を確認する">
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
<script src="/user/common/js/yubinbango.js"></script>
<!-- <script>
  $(function() {
    $('input[name=residence_status]').change(function() {
      if ($(this).val() != 1) {
        $('.esidence_name').css('display', 'none')
      } else {
        $('.esidence_name').css('display', '')
      }
    })
  })
</script> -->
<?php $this->end('script') ?>