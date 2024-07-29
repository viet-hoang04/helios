<?php
$html_orders = '';
foreach ($list_banner as $item) {
    if ($item['orders'] == $row['orders'])
        $html_orders .= '<option value="' . $item['orders'] . '">Sau ' . $item['name'] . '</option>';
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý banner sản phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?option=banner">Danh sách banner</a></li>
                        <li class="breadcrumb-item active">Cập nhật</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="index.php?option=banner&act=update" method="post" enctype="multipart/form-data">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2">Cập nhật thông tin banner</h3>
                        <div class="card-tools">
                            <button type="submit" name="CAPNHAT" class="btn btn-success"><i class="fa fa-save"></i> Lưu[CẬP NHẬT]</button>
                            <a class="btn btn-secondary" href="index.php?option=banner">
                                <i class="fa fa-arrow-left"></i> Thoát
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="name">Tên banner (*)</label>
                                <input type="text" id="name" name="name" value="<?= $row['name'] ?>" class="form-control" required>
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="link">Đường dẫn (*)</label>
                                <input type="text" id="link" name="link" value="<?= $row['link'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="info1">Thông tin 1: </label>
                                <input type="text" id="info1" name="info1" value="<?= $row['info1'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="info2">Thông tin 2: </label>
                                <input type="text" id="info2" name="info2" value="<?= $row['info2'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="info3">Thông tin 3: </label>
                                <input type="text" id="info3" name="info3" value="<?= $row['info3'] ?>" class="form-control">
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
                                    <option>[--- Chọn vị trí trang chủ ---]</option>
                                    <option value="slider" <?php if ($row['position'] == 'slider') {
                                                                echo "selected";
                                                            } ?>>Slider</option>
                                    <option value="collection banner" <?php if ($row['position'] == 'collection banner') {
                                                                            echo "selected";
                                                                        } ?>>Collection banner</option>
                                    <option value="collection area" <?php if ($row['position'] == 'collection area') {
                                                                        echo "selected";
                                                                    } ?>>Collection Area</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="img">Hình ảnh hiện tại:</label>
                                <img src="../public/images/banner/<?= $row['img'] ?>" class="img-responsive img-thumbnail w-100">
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
                                    <option selected>[--Trạng thái bài viết--]</option>
                                    <option value="1" <?php if ($row['status'] == 1) {
                                                            echo "selected";
                                                        } ?>>Xuất bản</option>
                                    <option value="2" <?php if ($row['status'] == 2) {
                                                            echo "selected";
                                                        } ?>>Không xuất bản</option>
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
                            <a class="btn btn-secondary" href="index.php?option=banner">
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
<script>
    $(function() {
        //Initialize Elements
        $('.select2').select2()
    });
    $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
</script>