<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý người dùng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?option=user">Danh sách quản trị viên</a></li>
                        <li class="breadcrumb-item active">Cập nhật</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="index.php?option=user&act=update&id=<?= $row['id'] ?>" method="post" enctype="multipart/form-data">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2">Cập nhật thông tin</h3>
                        <div class="card-tools">
                            <button type="submit" name="CAPNHAT" class="btn btn-success"><i class="fa fa-save"></i> Lưu[CẬP NHẬT]</button>
                            <a class="btn btn-secondary" href="index.php?option=user">
                                <i class="fa fa-arrow-left"></i> Thoát
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="fullname">Họ tên (*)</label>
                                <input type="text" id="fullname" name="fullname" class="form-control" value="<?= $row['fullname'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email (*)</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?= $row['email'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" id="address" name="address" value="<?= $row['address'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone (*)</label>
                                <input type="text" id="phone" name="phone" value="<?= $row['phone'] ?>" class="form-control">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password">Mật khẩu (*)</label>
                                    <input type="password" id="password" name="password" value="<?= $row['password'] ?>" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="repassword">Xác nhận Mật khẩu (*)</label>
                                    <input type="password" id="repassword" name="repassword" value="<?= $row['password'] ?>" class="form-control" required>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="role">Phân quyền:</label>
                                <select id="role" name="role" class="form-control custom-select">
                                    <option value="super_admin" <?php if ($row['role'] == 'super_admin') echo 'selected'; ?>>Super admin</option>
                                    <option value="admin" <?php if ($row['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                    <option value="seo_manager" <?php if ($row['role'] == 'seo_manager') echo 'selected'; ?>>SEO Manager</option>
                                    <option value="content" <?php if ($row['role'] == 'content') echo 'selected'; ?>>content</option>
                                    <option value="writer" <?php if ($row['role'] == 'writer') echo 'selected'; ?>>Writer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="current-img">Hình ảnh hiện tại:</label>
                                <img src="../public/images/user/<?= $row['img'] ?>" class="img-responsive img-thumbnail w-100">
                            </div>
                            <div class="form-group align-items-center">
                                <label for="img">Hình ảnh đại diện (*):</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="img" name="img" onchange="updateFileNames()">
                                    <label class="custom-file-label" for="img">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gender">Giới tính:</label>
                                <select id="gender" name="gender" class="form-control custom-select">
                                    <option value="1" <?php if ($row['gender'] == 1) {
                                                            echo "selected";
                                                        } ?>>Nam</option>
                                    <option value="2" <?php if ($row['gender'] == 2) {
                                                            echo "selected";
                                                        } ?>>Nữ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Trạng thái (*): </label>
                                <select id="status" name="status" class="form-control custom-select">
                                    <option selected>[--Trạng thái sản phẩm--]</option>
                                    <option value="1" <?php if ($row['status'] == 1) {
                                                            echo "selected";
                                                        } ?>>Kích hoạt</option>
                                    <option value="2" <?php if ($row['status'] == 2) {
                                                            echo "selected";
                                                        } ?>>Ngưng kích hoạt</option>
                                    <option value="0" <?php if ($row['status'] == 0) {
                                                            echo "selected";
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
                            <a class="btn btn-secondary" href="index.php?option=user">
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