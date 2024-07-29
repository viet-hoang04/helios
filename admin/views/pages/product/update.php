<?php
$html_catid = '';
$html_brandid = '';
$html_material = '';
$html_size = '';
foreach ($list_category as $item) {
    if ($item['id'] == $row['category_id']) {
        $html_catid .= '<option selected value="' . $item['id'] . '">' . $item['name'] . '</option>';
    } else {
        $html_catid .= '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
    }
}
foreach ($list_brand as $item) {
    if ($item['id'] == $row['brand_id']) {
        $html_brandid .= '<option selected value="' . $item['id'] . '">' . $item['name'] . '</option>';
    } else {
        $html_brandid .= '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
    }
}
foreach ($list_material as $item) {
    if ($item['id'] == $row['material_id']) {
        $html_material .= '<option selected value="' . $item['id'] . '">' . $item['name'] . '</option>';
    } else {
        $html_material .= '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
    }
}
foreach ($list_all_sizes as $size) {
    $selected = in_array($size['id'], array_column($list_product_sizes, 'size_id')) ? 'selected' : '';
    $html_size .= '<option ' . $selected . ' value="' . $size['id'] . '">' . $size['name_size'] . '</option>';
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý sản phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?option=product">Danh sách sản phẩm</a></li>
                        <li class="breadcrumb-item active">Cập nhật</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="index.php?option=product&act=update" method="post" enctype="multipart/form-data">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2">Cập nhật thông tin sản phẩm</h3>
                        <div class="card-tools">
                            <button type="submit" name="CAPNHAT" class="btn btn-success"><i class="fa fa-save"></i> Lưu[CẬP NHẬT]</button>
                            <a class="btn btn-secondary" href="index.php?option=product">
                                <i class="fa fa-arrow-left"></i> Thoát
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm (*)</label>
                                <input type="text" id="name" name="name" value="<?= $row['name'] ?>" class="form-control" required>
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="material_id">Chất liệu:</label>
                                    <select class="select2 form-control" id="material_id" name="material_id" data-placeholder="Chọn chất liệu" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        <?= $html_material ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="size">Kích cỡ:</label>
                                    <select class="select2 form-control" id="size" name="size[]" multiple="multiple" data-placeholder="Chọn size" style="width: 100%;">
                                        <?= $html_size ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="smdetail">Mô tả sản phẩm</label>
                                <textarea id="smdetail" name="smdetail" class="form-control summernote" rows="3"><?= $row['smdetail'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="detail">Chi tiết sản phẩm</label>
                                <textarea id="detail" name="detail" class="form-control summernote" rows="3"><?= $row['detail'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="category_id">Loại sản phẩm (All):</label>
                                <select id="category_id" name="category_id" class="form-control custom-select">
                                    <option value="">[--- Chọn loại sản phẩm ---]</option>
                                    <?= $html_catid ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand_id">Thương hiệu (*):</label>
                                <select id="brand_id" name="brand_id" class="form-control custom-select">
                                    <option value="">[--- Chọn thương hiệu ---]</option>
                                    <?= $html_brandid ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Giá sản phẩm:</label>
                                <input type="number" id="price" name="price" min="0" value="<?= $row['price'] ?>" step="1000000" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="promotion">Phần trăm khuyến mãi:</label>
                                <input type="number" id="promotion" name="promotion" min="0" value="<?= $row['promotion'] ?>" max="90" step="5" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Số lượng kho: </label>
                                <input type="number" id="quantity" name="quantity" min="1" value="<?= $row['quantity'] ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="current_img">Hình ảnh hiện tại (<?= count($list_img) ?>):</label>
                                <div id="imageSlider<?= $row['id']; ?>" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php foreach ($list_img as $key => $img) : ?>
                                            <input type="hidden" name="current_images" id="current_images" value="<?= $img['image'] ?>">
                                            <div class="carousel-item <?= ($key === 0) ? 'active' : ''; ?>">
                                                <img src="../public/images/product/<?= $img['image']; ?>" class="img img-thumbnail" style="width:100%" alt="Image">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <a class="carousel-control-prev" href="#imageSlider<?= $row['id']; ?>" data-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#imageSlider<?= $row['id']; ?>" data-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group align-items-center">
                                <label for="img">Hình ảnh sản phẩm (Tất cả):</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="img" name="img[]" multiple onchange="updateFileNames()">
                                    <label class="custom-file-label" for="img">Choose file</label>
                                </div>
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
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2"></h3>
                        <div class="card-tools">
                            <button type="submit" name="CAPNHAT" class="btn btn-success"><i class="fa fa-save"></i> Lưu[CẬP NHẬT]</button>
                            <a class="btn btn-secondary" href="index.php?option=product">
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