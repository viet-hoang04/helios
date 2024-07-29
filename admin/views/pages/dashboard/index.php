<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thống kê</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Thống kê</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $count_product ?></h3>

                            <p>Sản phẩm</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-box"></i>
                        </div>
                        <a href="index.php?option=product" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $count_post ?></h3>

                            <p>Bài viết</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-book"></i>
                        </div>
                        <a href="index.php?option=post" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $count_user ?></h3>
                            <p>Số lượng người dùng</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="index.php?option=customer" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $count_order ?></h3>

                            <p>Đơn hàng</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="index.php?option=order" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- Info boxes -->
            <!-- /.row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Thống kê sản phẩm</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="statistic_product_by_category" style="width:100%; max-width:600px; height:500px;"></div>
                                    <!-- /.chart-responsive -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Thống kê đơn hàng</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="statistic_order_by_stage" style="width:100%; max-width:100%; height:500px;"></div>
                                    <!-- /.chart-responsive -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    // Load google charts
    google.charts.load('current', {
        'packages': ['piechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Tên', 'Số lượng sản phẩm'],
            <?php
            foreach ($product_by_category as $row) {
                extract($row);
                echo "['$name', $so_luong_san_pham],";
            }
            ?>
        ]);

        // Optional; add a title and set the width and height of the chart
        var options = {
            'title': 'Thống kê sản phẩm theo danh mục',
        };

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('statistic_product_by_category'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    // Load google charts
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Trạng thái', 'Danh mục'],
            <?php
            foreach ($category_status as $cat_stat) {
                extract($cat_stat);
                if ($status == 1) {
                    $status = "Đang hoạt động";
                } else {
                    $status = "Đang chờ hoạt động";
                }
                echo "['$status', $so_luong_danh_muc],";
            }
            ?>
        ]);

        // Optional; add a title and set the width and height of the chart
        var options = {
            'title': 'Thống kê danh mục hoạt động',
        };

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.ColumnChart(document.getElementById('statistic_category'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    // Load google charts
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Trạng thái', 'Đơn hàng'],
            <?php
            foreach ($order_statitic as $item) {
                extract($item);
                if ($trang_thai_don_hang == 1) {
                    $trang_thai_don_hang = "Chờ duyệt";
                } elseif ($trang_thai_don_hang == 2) {
                    $trang_thai_don_hang = "Đang xử lý";
                } elseif ($trang_thai_don_hang == 3) {
                    $trang_thai_don_hang = "Huỷ đơn";
                } elseif ($trang_thai_don_hang == 4) {
                    $trang_thai_don_hang = "Đang giao";
                } elseif ($trang_thai_don_hang == 5) {
                    $trang_thai_don_hang = "Giao thành công";
                } elseif ($trang_thai_don_hang == 6) {
                    $trang_thai_don_hang = "Trả hàng/Đổi hàng";
                } elseif ($trang_thai_don_hang == 7) {
                    $trang_thai_don_hang = "Hoàn thành";
                }
                echo "['$trang_thai_don_hang', $so_luong],";
            }
            ?>
        ]);

        // Optional; add a title and set the width and height of the chart
        var options = {
            'title': 'Thống kê đơn hàng',
            is3D: true

        };

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.ColumnChart(document.getElementById('statistic_order_by_stage'));
        chart.draw(data, options);
    }
</script>