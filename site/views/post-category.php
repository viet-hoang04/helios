<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul>
                    <li><a href="index.php" title="Quay lại trang chủ">Trang chủ</a><span>/</span></li>
                    <li><a href="index.php?option=page&act=post-category&cat=<?=$topic['slug']?>" title="<?=$topic['name']?>"><?=$topic['name']?></a><span>/</span></li>
                    <li><strong>Tất cả bài viết</strong></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="blog_post">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-9" id="center_column">
                <div class="center_column">
                    <div class="page-title">
                        <h2>Bài viết</h2>
                    </div>
                    <ul class="blog-posts">
                        <?php foreach ($post_all as $row) : ?>
                            <li class="post-item">
                                <article class="entry">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="entry-thumb">
                                                <a href="index.php?option=page&act=post-detail&slug=<?= $row['slug'] ?>">
                                                    <figure>
                                                        <img src="../public/images/post/<?= $row['img'] ?>" alt="<?= $row['title'] ?>" style="width:100%">
                                                    </figure>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <h3 class="entry-title">
                                                <a href="index.php?option=page&act=post-detail&slug=<?= $row['slug'] ?>">
                                                    <?= $row['title'] ?>
                                                </a>
                                            </h3>
                                            <div class="entry-meta-data">
                                                <span class="cat">
                                                    <i class="fa fa-folder"></i>&nbsp;
                                                    <a href="index.php?option=page&act=post-category&cat=<?= $topic['slug'] ?>"><?= $topic['name'] ?></a>
                                                </span>
                                            </div>

                                            <div class="entry-excerpt"> <?= string_limit($row['detail'], 250); ?></div>
                                            <a href="index.php?option=page&act=post-detail&slug=<?= $row['slug'] ?>" class="read-more">Đọc thêm&nbsp;
                                                <i class="fa fa-angle-double-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="sortPagiBar">
                        <div class="pagination-area">
                            <?php if (isset($totalPages) > 0) : ?>
                                <?php
                                $current = isset($_GET['pages']) ? intval($_GET['pages']) : 1;

                                echo '<ul class="pagination">';

                                if ($current > 1) {
                                    $baseLink = '?option=page&act=post-category&cat="' . $row['slug'] . '"&pages=1';
                                    echo "<li><a href='$baseLink'>&lt;&lt;</a></li>";
                                    echo "<li><a href='?option=page&act=post-category&cat=" . $row['slug'] . "&pages=" . ($current - 1) . "'>&lt;</a></li>";
                                } else {
                                    echo "<li class='disabled'><span>&lt;&lt;</span></li>";
                                    echo "<li class='disabled'><span>&lt;</span></li>";
                                }

                                for ($i = 1; $i <= $totalPages; $i++) {
                                    $baseLink = '?option=page&act=post-category&cat="' . $row['slug'] . '"&pages=' . $i;
                                    if ($i == $current) {
                                        echo "<li class='active'><span>$i</span></li>";
                                    } else {
                                        echo "<li><a href='$baseLink'>$i</a></li>";
                                    }
                                }

                                if ($current < $totalPages) {
                                    $baseLink = '?option=page&act=post-category&cat="' . $row['slug'] . '"&pages=' . ($current + 1);
                                    echo "<li><a href='$baseLink'>&gt;</a></li>";
                                    $baseLink = '?option=page&act=post-category&cat="' . $row['slug'] . '"&pages=' . $totalPages;
                                    echo "<li><a href='$baseLink'>&gt;&gt;</a></li>";
                                } else {
                                    echo "<li class='disabled'><span>&gt;</span></li>";
                                    echo "<li class='disabled'><span>&gt;&gt;</span></li>";
                                }
                                echo '</ul>';
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right colunm -->
            <?php require_once 'modules/blog_sidebar.php' ?>
            <!-- ./right colunm -->
        </div>
        <!-- ./row-->
    </div>
</section>
<!-- Footer -->