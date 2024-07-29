<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý khách hàng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?option=customer">Quản lý khách hàng</a></li>
                        <li class="breadcrumb-item active">Cập nhật thông tin khách hàng</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="index.php?option=customer&act=update&id=<?= $row['id']; ?>" method="post" enctype="multipart/form-data">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2">Cập nhật thông tin khách hàng</h3>
                        <div class="card-tools">
                            <button type="submit" name="CAPNHAT" class="btn btn-success">
                                <i class="fa fa-save"></i> Lưu[CẬP NHẬT]
                            </button>
                            <a class="btn btn-secondary" href="index.php?option=customer">
                                <i class="fa fa-arrow-left"></i> Thoát
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control" placeholder="Nhập email" value="<?= $row['email'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" id="address" name="address" class="form-control" value="<?= $row['address'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu" value="<?= $row['password'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="repassword">Nhập lại mật khẩu</label>
                                <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Xác nhận mật khẩu" value="<?= $row['password'] ?>" required>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullname">Họ tên</label>
                                <input type="text" id="fullname" name="fullname" class="form-control" value="<?= $row['fullname'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Điện thoại</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="<?= $row['phone'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Giới tính (*):</label>
                                <select id="gender" name="gender" class="form-control custom-select">
                                    <option value="">[--- Chọn giới tính ---]</option>
                                    <option value="1" <?php if ($row['gender'] == 1) echo 'selected'; ?>>Nam</option>
                                    <option value="0" <?php if ($row['gender'] == 0) echo 'selected'; ?>>Nữ</option>
                                </select>
                            </div>
                            <div class="form-group align-items-center">
                                <label for="img">Hình ảnh Khách hàng (*):</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="img" name="img">
                                    <label class="custom-file-label" for="img">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status">Trạng thái (*): </label>
                                <select id="status" name="status" class="form-control custom-select">
                                    <option value="">[--- Trạng thái Khách hàng ---]</option>
                                    <option value="1" <?php if ($row['status'] == 1) {
                                                            echo 'selected';
                                                        } ?>>Kích hoạt</option>
                                    <option value="2" <?php if ($row['status'] == 2) {
                                                            echo 'selected';
                                                        } ?>>Không kích hoạt</option>
                                    <option value="0" <?php if ($row['status'] == 0) {
                                                            echo 'selected';
                                                        } ?>>Lưu trữ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2"></h3>
                        <div class="card-tools">
                            <button type="submit" name="CAPNHAT" class="btn btn-success"><i class="fa fa-save"></i> Lưu[CẬP NHẬT]</button>
                            <a class="btn btn-secondary" href="index.php?option=customer">
                                <i class="fa fa-arrow-left"></i> Thoát
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </form>
    </section>
    <!-- /.content -->
</div>