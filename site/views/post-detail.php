<section class="blog_post">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-9">
                <div class="entry-detail">
                    <div class="entry-photo">
                        <figure><img src="../public/images/post/<?= $row['img'] ?>" alt="<?= $row['title'] ?>"></figure>
                    </div>
                    <div class="entry-meta-data">

                        <div class="blog-top-desc">
                            <h1><?= $row['title'] ?></h1>
                        </div>

                    </div>
                    <div class="content-text clearfix">
                        <?php echo $row['detail'] ?>
                    </div>
                </div>

                <!-- Comment -->
                <div class="single-box">
                    <div class="best-title text-left">
                        <h2>Bình luận</h2>
                    </div>
                    <div class="comment-list">
                        <ul>
                            <?php foreach ($list_comment as $item) : ?>
                                <li>
                                    <div class="avartar">
                                        <img src="../public/images/user/<?= $user['img'] ?>" alt="<?= $user['fullname'] ?>">
                                    </div>
                                    <div class="comment-body">
                                        <div class="comment-meta">
                                            <span class="author">
                                                <a href="index.php?option=user&act=account"><?= $user['fullname'] ?></a>
                                            </span><span class="date"><?= $item['created_at'] ?></span>
                                        </div>
                                        <div class="comment"><?= $item['detail'] ?></div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <form action="index.php?option=page&act=post-comment" method="post" enctype="multipart/form-data">
                    <div class="single-box comment-box">
                        <div class="best-title text-left">
                            <h2>Để lại bình luận của bạn</h2>
                        </div>
                        <div class="coment-form">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="fullname">Họ tên:</label>
                                    <input id="fullname" name="fullname" type="text" value="<?= $_SESSION['user']['fullname'] ?>" class="form-control">
                                    <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id'] ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="email">Email:</label>
                                    <input id="email" name="email" type="text" class="form-control" value="<?= $_SESSION['user']['email'] ?>">
                                </div>
                                <div class="col-sm-12">
                                    <label for="detail">Nội dung:</label>
                                    <textarea name="detail" id="detail" rows="8" class="form-control"></textarea>
                                </div>
                            </div>
                            <button class="button" type="submit"><span>Gửi bình luận</span></button>
                        </div>
                    </div>
                </form>
                <!-- ./Comment -->
            </div>
            <!-- right colunm -->
            <?php require_once 'modules/blog_sidebar.php' ?>
            <!-- ./right colunm -->
        </div>
    </div>
</section>
<?php
$message = get_flash('message');
if ($message && isset($message['type'])) {
    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function() {';
    echo '    $("#successModal").modal("show");'; // Chỉ định ID của modal của bạn
    echo '});';
    echo '</script>';
}
?>
<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel"> <?= $message['title'] ?>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h5>
            </div>
            <div class="modal-body">
                <?= $message['msg'] ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>