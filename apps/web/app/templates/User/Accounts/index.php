<?php $this->end() ?>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	<div class="container-fluid pdng0">
		<div class="row merged">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="land-featurearea">
					<div class="land-meta">
						<h1>Winku</h1>
						<p>
							Winku is free to use for as long as you want with two active projects.
						</p>
						<div class="friend-logo">
							<span><img src="images/wink.png" alt=""></span>
						</div>
						<a href="#" title="" class="folow-me">Follow Us on</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="login-reg-bg">
					<div class="log-reg-area sign">
						<h2 class="log-title">Login</h2>
						<p>
							Don’t use Winku Yet? <a href="#" title="">Take the tour</a> or <a href="#" title="">Join now</a>
						</p>
						<p style="color: #e43737;font-size: 16px;">
							<?php if ((isset($err['login_id']['_empty']) && $err['login_id']['_empty']) != '' || (isset($err['login_id']['_empty']) && @$err['password']['_empty'] != '')){
								echo @$err['login_id']['_empty'] != '' ? $err['login_id']['_empty'] : @$err['password']['_empty'];
							} else echo $err;
							?>

						</p>
						<?= $this->Form->create(null, ['name' => 'form']); ?>
						<?= $this->Form->input('form_type', ['type' => 'hidden', 'value' => 'login']); ?>
						<div class="form-group">
							<?= $this->Form->input('login_id', ['type' => 'text', 'maxlength' => 100, 'required']); ?>
							<label class="control-label" for="input">Username</label><i class="mtrl-select"></i>
						</div>
						<div class="form-group">
							<?= $this->Form->input('password', ['type' => 'password', 'maxlength' => 100, 'required']); ?>
							<label class="control-label" for="input">Password</label><i class="mtrl-select"></i>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" checked="checked" /><i class="check-box"></i>Always Remember Me.
							</label>
						</div>
						<a href="#" title="" class="forgot-pwd">Forgot Password?</a>
						<div class="submit-btns">
							<button class="mtr-btn signin" type="button" onclick="document.form.submit();"><span>Login</span></button>
							<button class="mtr-btn signup" type="button"><span>Register</span></button>
						</div>
						<?php $this->Form->end() ?>

					</div>
					<div class="log-reg-area reg">
						<h2 class="log-title">Register</h2>
						<p>
							Don’t use Winku Yet? <a href="#" title="">Take the tour</a> or <a href="#" title="">Join now</a>
						</p>
						<?= $this->Form->create(null, ['name' => 'form']); ?>
						<div class="form-group">
							<input type="text" required="required" />
							<label class="control-label" for="input">First & Last Name</label><i class="mtrl-select"></i>
						</div>
						<div class="form-group">
							<input type="text" required="required" />
							<label class="control-label" for="input">User Name</label><i class="mtrl-select"></i>
						</div>
						<div class="form-group">
							<input type="password" required="required" />
							<label class="control-label" for="input">Password</label><i class="mtrl-select"></i>
						</div>
						<div class="form-radio">
							<div class="radio">
								<label>
									<input type="radio" name="radio" checked="checked" /><i class="check-box"></i>Male
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="radio" /><i class="check-box"></i>Female
								</label>
							</div>
						</div>
						<div class="form-group">
							<input type="text" required="required" />
							<label class="control-label" for="input"><a href="https://wpkixx.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="6c29010d05002c">[email&#160;protected]</a></label><i class="mtrl-select"></i>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" checked="checked" /><i class="check-box"></i>Accept Terms & Conditions ?
							</label>
						</div>
						<a href="#" title="" class="already-have">Already have an account</a>
						<div class="submit-btns">
							<button class="mtr-btn signup" type="button"><span>Register</span></button>
						</div>
						<?php $this->Form->end() ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>