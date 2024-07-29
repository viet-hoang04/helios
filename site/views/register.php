<?php
// Kiểm tra xem có thông báo không
if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    // Lấy thông báo và loại thông báo
    $flash_message = $_SESSION['message'];
    $type = $flash_message['type'];
    $msg = $flash_message['msg'];

    // Xóa session để tránh hiển thị thông báo lần tiếp theo
    unset($_SESSION['message']);
?>
    <script>
        // Hiển thị modal Bootstrap thay thế cho alert
        $(document).ready(function() {
            $('#myModal').modal('show');
        });
    </script>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">
                        <?php echo $type === "success" ? "Đăng ký thành viên thành công" : "Đăng ký thành viên thất bại"; ?>
                        <button type="button" class="close" style="padding-top:15px" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h2>
                </div>
                <div class="modal-body">
                    <h3><?php echo $msg; ?></h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="window.location.href = '?option=user&act=login';">Đăng nhập ngay</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<section class="main-container">
    <div class="main container">
        <div class="account-login">
            <div class="page-title" style="text-align: center">
                <h2>Thông tin đăng ký tài khoản</h2>
            </div>
            <fieldset class="col2-set">
                <form action="?option=user&act=register" method="post" enctype="multipart/form-data" class="col-md-7 form-horizontal">
                    <div class="col-2 registered-users">
                        <strong class="text-center">Thông tin đăng ký tài khoản: </strong>
                        <div class="form-group">
                            <label for="email" class="control-label col-sm-3" style="font-size:14px;padding:13px 0px;text-align:left">Email <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" title="Email Address" class="form-control" id="email" name="email" placeholder="Ví dụ: example@gmail.com">
                                <span class="error-message" id="email-error"><?php echo isset($email_error) ? $email_error : ''; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fullname" class="control-label col-sm-3" style="font-size:14px;padding:13px 0px;text-align:left">Họ tên <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" title="fullname" class="form-control" id="fullname" name="fullname">
                                <span class="error-message" id="fullname-error"><?php echo isset($fullname_error) ? $fullname_error : ''; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="control-label col-sm-3" style="font-size:14px;padding:13px 0px;text-align:left">Số điện thoại <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" title="phone" class="form-control" id="phone" name="phone">
                                <span class="error-message" id="phone-error"><?php echo isset($phone_error) ? $phone_error : ''; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender-radio" class="control-label col-sm-3" style="font-size:14px;padding:13px 0px;text-align:left">Giới tính <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <label class="radio-inline"><input type="radio" name="gender" value="1" checked> Nam</label>
                                <label class="radio-inline"><input type="radio" name="gender" value="0"> Nữ</label>
                                <span class="error-message" id="gender-error"><?php echo isset($gender_error) ? $gender_error : ''; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label col-sm-3" style="font-size:14px;padding:13px 0px;text-align:left">Địa chỉ</label>
                            <div class="col-sm-9">
                                <input type="text" title="address" class="form-control" id="address" name="address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Password" class="control-label col-sm-3" style="font-size:14px;padding:13px 0px;text-align:left">Mật khẩu <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="password" title="Password" id="Password" class="form-control" name="password">
                                <h4><span>Mật khẩu phải dài ít nhất 8 ký tự và có ít nhất 1 chữ hoa, 1 ký tự đặc biệt và 1 ký tự số </span></h4>
                                <span class="error-message" id="password-error"><?php echo isset($password_error) ? $password_error : ''; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="repass" class="control-label col-sm-3" style="font-size:14px;padding:13px 0px;text-align:left">Xác nhận mật khẩu <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="password" title="rePassword" id="rePassword" class="form-control" name="repassword">
                                <span class="error-message" id="repassword-error"><?php echo isset($repassword_error) ? $repassword_error : ''; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="checkbox">
                                    <label style="font-size:14px;"><input type="checkbox" required> Tôi đã đọc và đồng ý với điều khoản sử dụng của Helios</label>
                                    <span class="error-message" id="checkbox-error"><?php echo isset($checkbox_error) ? $checkbox_error : ''; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="buttons-set col-sm-offset-3 col-sm-9">
                                <button id="login-button" name="BTN_REGISTER" type="submit" class="button login" style="width:100%">
                                    <span>Đăng ký</span>
                                </button>
                                <h4><span>Bạn đã có tài khoản? <a href="?option=user&act=login">Đăng nhập ngay</a></span></h4>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-md-5 registered-users text-center">
                    <strong>Các đặc quyền khi đăng ký tài khoản: </strong>
                    <ul style="font-size:medium;">
                        <li>Nhận quyền truy cập vào các giao dịch và sự kiện.</li>
                        <li>Lưu các mục yêu thích vào danh sách yêu thích của bạn.</li>
                        <li>Lưu các đơn đặt hàng và số theo dõi đơn hàng của bạn.</li>
                        <br>
                        <br>
                        <li>Dịch vụ khách hàng</li>
                        <li>Bạn cần giúp đỡ? Xin hãy gọi điện đến Hotline: 093.934.8888</li>
                    </ul>
                </div>
            </fieldset>
        </div>
    </div>
</section>