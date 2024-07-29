<!-- Main Footer -->
<footer class="main-footer footer-sm">
    <strong>Copyright &copy; 2023 <a href="https://www.facebook.com/traicay.thach.9/">Thế Đăng Thạch</a>.</strong>
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- PAGE PLUGINS -->
<!-- DataTables -->
<script src="../public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../public/plugins/jszip/jszip.min.js"></script>
<script src="../public/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../public/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- jQuery Mapael -->
<script src="../public/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../public/plugins/raphael/raphael.min.js"></script>
<script src="../public/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../public/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../public/plugins/chart.js/Chart.min.js"></script>

<!-- SweetAlert2 -->
<script src="../public/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../public/plugins/toastr/toastr.min.js"></script>
<!-- Select2 -->
<script src="../public/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../public/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- Summernote -->
<script src="../public/plugins/summernote/summernote-bs4.min.js"></script>

<!-- AdminLTE App -->
<script src="../public/js/adminlte.js"></script>
<script src="../public/js/control-sidebar.js"></script>
<script src="../public/js/dashboard2.js"></script>

<script>
    $(function() {
        $('.datatable').DataTable({
            order: [[0, 'desc']],
            "paging": true,
            pagingType: 'full_numbers',
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
        $('.select2').select2();
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script>
    function updateFileNames() {
        const input = document.getElementById('img');
        const label = document.querySelector('.custom-file-label');

        if (input.files && input.files.length > 0) {
            if (input.files.length === 1) {
                // Nếu chỉ có một file được chọn, lấy tên của file đầu tiên
                const fileName = input.files[0].name;

                // Cập nhật label để hiển thị tên của file đã chọn
                label.textContent = fileName;
            } else {
                // Nếu có nhiều hình được chọn, hiển thị số lượng file đã chọn
                label.textContent = input.files.length + ' files selected';
            }
        } else {
            // Nếu không có file nào được chọn, hiển thị lại "Choose file"
            label.textContent = "Choose file";
        }
    }
</script>
</body>

</html>