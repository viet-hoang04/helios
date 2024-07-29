<div class="jtv-latest-blog">
    <div class="jtv-new-title">
        <h2>Tin tức mới nhất</h2>
    </div>
    <div class="row">
        <div class="blog-outer-container">
            <div class="blog-inner">
                <?php foreach ($list_blog as $row) : ?>
                    <div class="col-xs-12 col-sm-4 blog-preview_item">
                        <div class="entry-thumb jtv-blog-img-hover">
                            <a href="index.php?option=page&act=post&slug=<?= $row['slug'] ?>">
                                <img alt="Blog" src="../public/images/post/<?= $row['img'] ?>" style="width:100%;height:200px">
                            </a>
                        </div>
                        <h4 class="blog-preview_title">
                            <a href="index.php?option=page&act=post&slug=<?= $row['slug'] ?>">
                            <?= string_limit($row['title'], 50); ?>
                            </a>
                        </h4>
                        <div class="blog-preview_info">
                            <div class="blog-preview_desc">
                                <?= string_limit($row['detail'], 150); ?>
                                <a class="read_btn" href="index.php?option=page&act=post&slug=<?= $row['slug'] ?>">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>