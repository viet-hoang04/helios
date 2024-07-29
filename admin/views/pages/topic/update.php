<?php
$html_parentid = '';
$html_orders = '';
foreach ($list_topic as $item) {
    if ($item['id'] == $row['parent_id']) {
        $html_parentid .= '<option selected value="' . $item['id'] . '">' . $item['name'] . '</option>';
    } else {
        $html_parentid .= '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
    }
    if ($item['orders'] == ($row['orders'] - 1)) {
        $html_orders .= '<option selected value="' . $item['orders'] . '">Sau ' . $item['name'] . '</option>';
    } else {
        $html_orders .= '<option value="' . $item['orders'] . '">Sau ' . $item['name'] . '</option>';
    }
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý chủ đề bài viết</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang quản lý</a></li>
                        <li class="breadcrumb-item"><a href="index.php?option=topic">Chủ đề bài viết</a></li>
                        <li class="breadcrumb-item active">Cập nhật thông tin</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="index.php?option=topic&act=update" method="post" enctype="multipart/form-data">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2">Cập nhật thông tin chủ đề</h3>
                        <div class="card-tools">
                            <button type="submit" name="CAPNHAT" class="btn btn-success"><i class="fa fa-save"></i> Lưu[Cập nhật]</button>
                            <a class="btn btn-secondary" href="index.php?option=topic">
                                <i class="fa fa-arrow-left"></i> Thoát
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Tên Chủ đề (*)</label>
                        <input type="text" id="name" name="name" value="<?= $row['name'] ?>" class="form-control" required>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Cấp cha (*):</label>
                        <select id="parent_id" name="parent_id" class="form-control custom-select">
                            <option value="0">[--- Cấp cha ---]</option>
                            <?= $html_parentid ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="orders">Sắp xếp (*):</label>
                        <select id="orders" name="orders" class="form-control custom-select">
                            <option value="0">[--- Mặc định ---]</option>
                            <?= $html_orders ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Trạng thái (*): </label>
                        <select id="status" name="status" class="form-control custom-select">
                            <option selected>[--Trạng thái sản phẩm--]</option>
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
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2"></h3>
                        <div class="card-tools">
                            <button type="submit" name="CAPNHAT" class="btn btn-success"><i class="fa fa-save"></i> Lưu[Cập nhật]</button>
                            <a class="btn btn-secondary" href="index.php?option=topic">
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