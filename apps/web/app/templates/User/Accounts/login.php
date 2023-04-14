<?php $this->start('css') ?>
<link rel="stylesheet" href="/login/fonts/material-icon/css/material-design-iconic-font.min.css">
<link href="/login/css/style.css" rel="stylesheet">
<link href="/login/css/style.css.map" rel="stylesheet">
<?php $this->end('css') ?>
<div class="main">
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="/login/images/daily-vn_.png" alt="sing up image"></figure>
                    <a href="/accounts/register/" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">Sign up</h2>
                    <?= $this->Form->create(null, ['name' => 'form', 'id' => 'login-form', 'class' => 'register-form']); ?>

                    <div class="form-group">
                        <label for="your_name"><i class="zmdi zmdi-email"></i></label>
                        <?= $this->Form->input('email', ['type' => 'email', 'placeholder' => 'Your Email', 'maxlength' => 200, 'required', 'pattern' => '.{0}|.{10,200}', 'title' => 'Vui lòng nhập từ 10 đến 200  kí tự nhé.']); ?>
                    </div>

                    <div class="form-group">
                        <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                        <?= $this->Form->input('password', ['type' => 'password', 'placeholder' => 'Password', 'maxlength' => 100, 'required']); ?>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                        <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                    </div>
                    <p class="txtErr"><?= @$err ?></p>

                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                    </div>
                    <?php $this->Form->end() ?>

                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0&appId=848795522673086&autoLogAppEvents=1" nonce="cBQ9YJtD"></script>
                    <div class="fb-login-button" data-width="" data-size="" data-button-type="" data-layout="" data-auto-logout-link="false" data-use-continue-as="false"></div>

                    <div class="social-login">
                        <span class="social-label">Or login with</span>
                        <ul class="socials">
                            <li><a onclick="_login();" href=" #"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->start('script') ?>
<script src="/assets/js/main.js"></script>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId: '848795522673086',
            cookie: true,
            xfbml: true,
            version: 'v16.0'
        });
        FB.AppEvents.logPageView();
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v16.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function statusChangeCallback(response) {
        if (response.status === 'connected') {
            console.log('Đã xác thực thành công');
        } else if (response.status === 'not_authorized') {
            console.log('Xác thực chưa thành công');
        }
    }

    function _login() {
        FB.login(function(response) {
            // Xử lý các kết quả
            if (response.status === 'connected') {
                getFbUserData();
            }
        }, {
            scope: 'public_profile,email'
        });
    }

    function getFbUserData() {
        FB.api('/me', {
                locale: 'en_US',
                fields: 'id,first_name,last_name,email,picture'
            },
            function(response) {
                console.log(response);
                // saveUserData(response);
            });
    }

    // function saveUserData(userData) {
    //     $.post(
    //         '/accounts/loginFB', {
    //             oauth_provider: 'facebook',
    //             userData: JSON.stringify(userData)
    //         },
    //         function(data) {
    //             if (data === false) {
    //                 alert('Login failed');
    //             } else {
    //                 alert('Login success');
    //             }

    //         }
    //     );
    // }
</script>




<!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<?php $this->end('script') ?>