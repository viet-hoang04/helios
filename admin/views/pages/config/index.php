<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cấu hình website</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang quản lý</a></li>
                        <li class="breadcrumb-item active">Thông tin cấu hình</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="index.php?option=config&act=update" method="post" enctype="multipart/form-data">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2">Chỉnh sửa cấu hình website</h3>
                        <div class="card-tools">
                            <button type="submit" name="CAPNHAT" class="btn btn-success">
                                <i class="fa fa-save"></i> Lưu[CẬP NHẬT]
                            </button>
                            <a class="btn btn-secondary" href="index.php?option=dashboard">
                                <i class="fa fa-arrow-left"></i> Thoát
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="title">Tên Website (*)</label>
                                <input type="text" id="title" name="title" class="form-control" value="<?= $row['title'] ?>" required>
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logo-current">Logo hiện tại:</label>
                                        <img src="../public/images/<?= $row['logo'] ?>" class="form-control img img-responsive img-thumbnail" style="height:100px;width:250px">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon-current">Icon hiện tại:</label>
                                        <img src="../public/images/<?= $row['icon'] ?>" class="form-control img img-responsive img-thumbnail" style="height:100px;width:150px">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-7">
                                    <label for="email">Email: </label>
                                    <input type="text" id="email" name="email" class="form-control" value="<?= $row['email'] ?>" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="phone">Hotline: </label>
                                    <input type="text" id="phone" name="phone" class="form-control" value="<?= $row['phone'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ công ty: </label>
                                <input type="text" id="address" name="address" class="form-control" value="<?= $row['address'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="url">Địa chỉ trang web (url):</label>
                                <input type="text" id="url" name="url" class="form-control" value="<?= $row['url'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="map">Đường dẫn iframe map:</label>
                                <input type="text" id="map" name="map" class="form-control" value="<?= $row['map'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group align-items-center">
                                <label for="logo">Logo website (*):</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="logo" name="logo" onchange="updateFileNames();">
                                    <label class="custom-file-label" for="logo">Chọn hình</label>
                                </div>
                            </div>
                            <div class="form-group align-items-center">
                                <label for="icon">Icon website (*):</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="icon" name="icon" onchange="updateFileNames();">
                                    <label class="custom-file-label" for="icon">Chọn hình</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="icon">Bản đồ (*):</label>
                                <iframe src="<?= $row['map'] ?>" class="form-control" style="border:0;height:250px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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