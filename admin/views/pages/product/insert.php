<?php
$materials = ALL_MATERIAL;
$sizes = ALL_SIZES;
$html_catid = '';
$html_brandid = '';
$html_sizeid = '';
$html_materalid = '';
foreach ($list_category as $item) {
    $html_catid .= '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
}
foreach ($list_brand as $item) {
    $html_brandid .= '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
}
foreach ($list_size as $item) {
    $html_sizeid .= '<option value="' . $item['id'] . '">' . $item['name_size'] . '</option>';
}
foreach ($list_material as $item) {
    $html_materalid .= '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
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
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="index.php?option=product&act=insert" method="post" enctype="multipart/form-data">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2">Thêm sản phẩm</h3>
                        <div class="card-tools">
                            <button type="submit" name="THEM" class="btn btn-success"><i class="fa fa-save"></i> Lưu[Thêm]</button>
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
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="material_id">Chất liệu:</label>
                                    <select class="select2 form-control" id="material_id" name="material_id" data-placeholder="Chọn chất liệu" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        <?= $html_materalid; ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="size">Kích cỡ:</label>
                                    <select class="select2 form-control" id="size" name="size[]" multiple="multiple" data-placeholder="Chọn size" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        <?= $html_sizeid ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="smdetail">Mô tả sản phẩm</label>
                                <textarea id="smdetail" name="smdetail" class="form-control summernote" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="detail">Chi tiết sản phẩm</label>
                                <textarea id="detail" name="detail" class="form-control summernote" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="category_id">Loại sản phẩm (*):</label>
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
                                <input type="number" id="price" name="price" min="500000" value="0" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="promotion">Phần trăm khuyến mãi:</label>
                                <input type="number" id="promotion" name="promotion" min="0" value="0" max="90" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Số lượng kho: </label>
                                <input type="number" id="quantity" name="quantity" min="1" value="1" class="form-control">
                            </div>
                            <div class="form-group align-items-center">
                                <label for="img">Hình ảnh sản phẩm (*):</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="img" name="img[]" multiple onchange="updateFileNames()">
                                    <label class="custom-file-label" for="img">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status">Trạng thái (*): </label>
                                <select id="status" name="status" class="form-control custom-select">
                                    <option selected>[--- Trạng thái sản phẩm ---]</option>
                                    <option value="1">Mở bán</option>
                                    <option value="2">Không mở bán</option>
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