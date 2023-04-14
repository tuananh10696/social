<?php $this->start('css') ?>
<link rel="stylesheet" href="/login/fonts/material-icon/css/material-design-iconic-font.min.css">
<link href="/login/css/style.css" rel="stylesheet">
<link href="/login/css/style.css.map" rel="stylesheet">
<?php $this->end('css') ?>

<div class="main">
	<!-- Sign up form -->
	<section class="sign-up" style="padding: 0;">
		<div class="container">
			<div class="signup-content">
				<div class="signup-form">
					<h2 class="form-title">Sign up</h2>
					<?= $this->Form->create(null, ['name' => 'form', 'id' => 'register-form', 'class' => 'register-form']); ?>

					<div class="form-group">
						<label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
						<?= $this->Form->input('username', ['type' => 'text', 'placeholder' => 'Your Name', 'maxlength' => 100, 'required', 'pattern' => '.{0}|.{5,32}', 'title' => 'Vui lòng nhập từ 5 đến 32  kí tự nhé.']); ?>
					</div>

					<div class="form-group">
						<label for="email"><i class="zmdi zmdi-email"></i></label>
						<?= $this->Form->input('email', ['type' => 'email', 'placeholder' => 'Your Email', 'maxlength' => 200, 'required']); ?>

					</div>
					<div class="form-group">
						<label for="pass"><i class="zmdi zmdi-lock"></i></label>
						<?= $this->Form->input('password', ['type' => 'password', 'placeholder' => 'Password', 'maxlength' => 100, 'required', 'id' => 'password', 'pattern' => '.{0}|.{8,10}', 'title' => 'Vui lòng nhập từ 8 đến 32  kí tự nhé.']); ?>
					</div>
					<div class="form-group">
						<label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
						<?= $this->Form->input('confirm_password', ['type' => 'password', 'placeholder' => 'Repeat your password', 'maxlength' => 100, 'required', 'id' => 'confirm_password', 'pattern' => '.{0}|.{8,10}', 'title' => 'Vui lòng nhập từ 8 đến 32  kí tự nhé.']); ?>
						<span id='message'></span>
					</div>

					<!-- <input type="password" placeholder="Password" id="password" required>
					<input type="password" placeholder="Confirm Password" id="confirm_password" required> -->
					<!-- <div class="form-group">
						<input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
						<label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all
							statements in <a href="#" class="term-service">Terms of service</a></label>
					</div> -->
					<?php if (@$err != '')
						foreach ($err as $render_error) : ?>
						<p class="txtErr"><?= @$render_error['chkUserName'] != '' ? $render_error['chkUserName'] : $render_error['custom'] ?></p>
					<?php endforeach; ?>

					<div class="form-group form-button">
						<input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
					</div>
					<?php $this->Form->end() ?>
				</div>
				<div class="signup-image">
					<figure><img src="/login/images/daily-vn_.png" alt="sing up image"></figure>
					<a href="/accounts/" class="signup-image-link">I am already member</a>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->start('script') ?>
<script src="/user/plugins/jquery/jquery.min.js"></script>
<script src="/login/js/main.js"></script>
<script>
	var password = document.getElementById("password"),
		confirm_password = document.getElementById("confirm_password");

	function validatePassword() {
		if (password.value != confirm_password.value) {
			confirm_password.setCustomValidity("Mật khẩu không khớp.");
		} else {
			confirm_password.setCustomValidity('');
		}
	}

	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;
</script>
<?php $this->end('script') ?>