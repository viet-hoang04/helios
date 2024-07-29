<!-- main-container -->
<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-sm-9 col-xs-12">
                <form action="index.php?option=user&act=account-detail" method="post" enctype="multipart/form-data">
                    <div class="col-main">
                        <div class="my-account">
                            <div class="page-title">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2>Cập nhật thông tin tài khoản</h2>
                                    </div>
                                    <div class="col-sm-6">
                                        <?php if (has_flash('message')) : ?>
                                            <?php $error = get_flash('message'); ?>
                                            <div id="myAlert" style="margin: auto;" class="alert alert-<?= $error['type'] ?> " role="alert">
                                                <i class="fa fa-check"></i>
                                                <?= $error['msg']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5 col-xs-12">
                                    <img name="current_img" class="img img-fluid img-circle" style="margin-top: 20px;margin-left:40px" height="250px" width="250px" src="../public/images/user/<?= $_SESSION["user"]["img"] ?>">
                                    <input type="file" name="img" class="form-control" style="width:250px; margin-top: 15px;margin-left:35px">
                                </div>
                                <div class="col-sm-12 col-md-7 col-xs-12">
                                    <div class="title-box">
                                        <h3>Thông tin tài khoản</h3>
                                        <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="fullname">Họ tên <span class="required">*</span></label>
                                        <input type="text" name="fullname" id="fullname" class="form-control" value="<?= isset($_SESSION['user']['fullname']) ? $_SESSION['user']['fullname'] : '' ?>" required>
                                        <span class="error-message" id="fullname-error"><?php echo isset($fullname_error) ? $fullname_error : ''; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Địa chỉ email <span class="required">*</span></label>
                                        <input type="email" name="email" id="emailAddress" class="form-control" value="<?= isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : '' ?>" readonly>
                                        <span class="error-message" id="email-error"><?php echo isset($email_error) ? $email_error : ''; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Địa chỉ: <span class="required">*</span></label>
                                        <input type="text" name="address" id="address" class="form-control" value="<?= isset($_SESSION['user']['address']) ? $_SESSION['user']['address'] : '' ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Số điện thoại: <span class="required">*</span></label>
                                        <input type="phone" name="phone" id="phone" class="form-control" value="<?= isset($_SESSION['user']['phone']) ? $_SESSION['user']['phone'] : '' ?>" required>
                                        <span class="error-message" id="phone-error"><?php echo isset($phone_error) ? $phone_error : ''; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="gender" class="control-label col-sm-2" style="font-size:14px;padding:11px 0px;text-align:left">Giới tính <span class="required">*</span></label>
                                        <div class="col-sm-10 radio">
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" value="1" <?php if($_SESSION['user']['gender'] == '1') echo 'checked' ?>>
                                                Nam
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" value="0" <?php if($_SESSION['user']['gender'] == '0') echo 'checked' ?>>
                                                Nữ
                                            </label>
                                            <span class="error-message" id="gender-error"><?php echo isset($gender_error) ? $gender_error : ''; ?></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-xs-12">
                                    <div class="ship-toggle">
                                        <input type="checkbox" id="ship-toggle" name="change_password">
                                        <label for="ship-toggle">Thay đổi mật khẩu?</label>
                                    </div>
                                    <div class="ship-acc-body">
                                        <ul class="list-unstyled">
                                            <li>
                                                <div class="form-group">
                                                    <label for="cpassword">Mật khẩu hiện tại <span class="required">*</span></label>
                                                    <input type="password" name="cpassword" id="cpassword" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="npassword">Mật khẩu mới <span class="required">*</span></label>
                                                    <input type="password" name="npassword" id="npassword" class="form-control">
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group">
                                                    <label for="cnewpassword">Xác nhận mật khẩu mới <span class="required">*</span></label>
                                                    <input type="password" name="cnewpassword" id="cnewpassword" class="form-control">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-set">
                                <button id="send2" name="BTN_UPDATE" type="submit" class="button submit"><span>Cập nhật</span></button>
                                <span class="required pull-right"><b>*</b> Thông tin bắt buộc</span>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <aside class="col-right sidebar col-sm-3 col-xs-12">
                <div class="block block-account">
                    <div class="block-title">Quản lý tài khoản</div>
                    <div class="block-content">
                        <ul>
                            <li><a href="?option=user&act=account"><i class="fa fa-angle-right"></i> Tài khoản</a></li>
                            <li class="current"><a href="?option=user&act=account-detail"><i class="fa fa-angle-right"></i> Thông tin tài khoản</a></li>
                            <li><a href="?option=user&act=history-orders"><i class="fa fa-angle-right"></i> Lịch sử đơn hàng</a></li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
<!--End main-container -->