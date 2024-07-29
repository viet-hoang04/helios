<?php if (has_flash('message')) : ?>
    <?php $error = get_flash('message'); ?>
    <!-- <div class="alert alert-<?= $error['type'] ?> alert-dismissible" data-auto-dismiss="3000">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Thông báo!</h5>
        <?= $error['msg']; ?>
    </div> -->
    <script>
        $(document).ready(function() {
            var errorType = <?= json_encode($error['type']) ?>;
            var errorMsg = <?= json_encode($error['msg']) ?>;

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                icon: errorType,
                title: errorMsg
            });
        });
    </script>
<?php endif; ?>