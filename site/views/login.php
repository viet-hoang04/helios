<section class="main-container">
    <div class="main container">
        <div class="account-login">
            <div class="page-title">
                <h2>Đăng nhập hoặc tạo tài khoản mới</h2>
            </div>
            <fieldset class="col2-set">
                <div class="col-md-5 registered-users">
                    <div class="content text-center">
                        <strong>Bạn chưa có tài khoản</strong>
                        <ul style="font-size:medium;">
                            <li>Nhận quyền truy cập vào các giao dịch và sự kiện.</li>
                            <li>Lưu các mục yêu thích vào danh sách yêu thích của bạn.</li>
                            <li>Lưu các đơn đặt hàng và số theo dõi đơn hàng của bạn.</li>
                        </ul>
                        <div class="buttons-set">
                            <button onclick="window.location='index.php?option=user&act=register';" class="button create-account" type="button"><span>Đăng ký tài khoản ngay</span></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 registered-users"><strong class="text-center">Đăng nhập</strong>
                    <div class="content">
                        <p class="text-center">Chào mừng bạn quay trở lại với chúng tôi.</p>
                        <form action="?option=user&act=login" method="post">
                            <ul class="form-list">
                                <li>
                                    <label for="email">Email <span class="required">*</span></label>
                                    <br>
                                    <input type="text" title="Email Address" class="input-text required-entry" id="email" name="email">
                                    <span class="error-message" id="email-error"><?php echo isset($email_error) ? $email_error : ''; ?></span>
                                </li>
                                <li>
                                    <label for="password">Mật khẩu <span class="required">*</span></label>
                                    <br>
                                    <input type="password" title="password" id="password" class="input-text required-entry validate-password" name="password">
                                    <span class="error-message" id="password-error"><?php echo isset($password_error) ? $password_error : ''; ?></span>
                                </li>
                            </ul>
                            <div class="buttons-set">
                                <button id="send2" name="LOGIN" type="submit" class="button login"><span>Đăng nhập</span></button>
                                <a class="forgot-word" href="?option=user&act=forgot-password">Quên mật khẩu?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</section>