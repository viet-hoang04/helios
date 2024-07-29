<?php
$html_orders = '';
$html_category = '';
foreach ($slider_list as $item) {
    $html_orders .= '<option value="' . $item['orders'] . '">Sau ' . $item['name'] . '</option>';
}
foreach ($category_list as $item_cate) {
    $html_category .= '<option value="' . $item_cate['slug'] . '">Trang: ' . $item_cate['name'] . '</option>';
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý slideshow</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang quản lý</a></li>
                        <li class="breadcrumb-item"><a href="index.php?option=slider">Danh sách slideshow</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="index.php?option=slider&act=insert" method="post" enctype="multipart/form-data">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2">Tạo ảnh slideshow</h3>
                        <div class="card-tools">
                            <button type="submit" name="THEM" class="btn btn-success"><i class="fa fa-save"></i> Lưu[Thêm]</button>
                            <a class="btn btn-secondary" href="index.php?option=slider">
                                <i class="fa fa-arrow-left"></i> Thoát
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="name">Tên slider (*)</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="link">Đường dẫn (*)</label>
                                <input type="text" id="link" name="link" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="info1">Thông tin 1: </label>
                                <input type="text" id="info1" name="info1" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="info2">Thông tin 2: </label>
                                <input type="text" id="info2" name="info2" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="info3">Thông tin 3: </label>
                                <input type="text" id="info3" name="info3" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="orders">Sắp xếp (*):</label>
                                <select id="orders" name="orders" class="form-control custom-select">
                                    <option value="0">[--- Mặc định ---]</option>
                                    <?= $html_orders; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="position">Vị trí (*):</label>
                                <select id="position" name="position" class="form-control custom-select">
                                    <option>[--- Chọn vị trí ---]</option>
                                    <option value="home">+ Trang chủ</option>
                                    <?= $html_category ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="img">Hình ảnh đại diện (*):</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="img" name="img" onchange="updateFileNames()">
                                    <label class="custom-file-label" for="img">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status">Trạng thái (*): </label>
                                <select id="status" name="status" class="form-control custom-select">
                                    <option selected>[--- Trạng thái ---]</option>
                                    <option value="1">Xuất bản</option>
                                    <option value="2">Không xuất bản</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2"></h3>
                        <div class="card-tools">
                            <button type="submit" name="THEM" class="btn btn-success"><i class="fa fa-save"></i> Lưu[Thêm]</button>
                            <a class="btn btn-secondary" href="index.php?option=slider">
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