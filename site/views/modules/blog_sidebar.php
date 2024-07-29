<aside class="sidebar col-xs-12 col-sm-3">
    <!-- Blog category -->
    <div class="block blog-module">
        <div class="block-title">
            <h3>Chủ đề</h3>
        </div>
        <div class="block_content">
            <div class="layered layered-category">
                <div class="layered-content">
                    <ul class="tree-menu">
                        <?php foreach ($list_topic as $item) : ?>
                            <li>
                                <a href="index.php?option=page&act=post-category&cat=<?= $item['slug'] ?>">
                                    <i class="fa fa-angle-right"></i>&nbsp; <?= $item['name'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <!-- <li><i class="fa fa-angle-right"></i>&nbsp; <a href="#">Audio</a></li>
                        <li><i class="fa fa-angle-right"></i>&nbsp; <a href="#">Photos</a></li>
                        <li><i class="fa fa-angle-right"></i>&nbsp; <a href="#">Diet &amp; Fitness</a></li>
                        <li><i class="fa fa-angle-right"></i>&nbsp; <a href="#">Slider</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Posts -->
    <!-- <div class="block blog-module">
        <div class="block-title">
            <h3>Bài viết nổi bật</h3>
        </div>
        <div class="block_content">
            <div class="layered">
                <div class="layered-content">
                    <ul class="blog-list-sidebar">
                        <li>
                            <div class="post-thumb"> <a href="#"><img src="../public/images/blog-img1.jpg" alt="Blog"></a> </div>
                            <div class="post-info">
                                <h5 class="entry_title"><a href="#">Lorem ipsum dolor</a></h5>
                                <div class="post-meta"> <span class="date"><i class="fa fa-calendar"></i> 2014-08-05</span> <span class="comment-count"> <i class="fa fa-comment-o"></i> 3 </span> </div>
                            </div>
                        </li>
                        <li>
                            <div class="post-thumb"> <a href="#"><img src="../public/images/blog-img1.jpg" alt="Blog"></a> </div>
                            <div class="post-info">
                                <h5 class="entry_title"><a href="#">Lorem ipsum dolor</a></h5>
                                <div class="post-meta"> <span class="date"><i class="fa fa-calendar"></i> 2014-08-05</span> <span class="comment-count"> <i class="fa fa-comment-o"></i> 3 </span> </div>
                            </div>
                        </li>
                        <li>
                            <div class="post-thumb"> <a href="#"><img src="../public/images/blog-img1.jpg" alt="Blog"></a> </div>
                            <div class="post-info">
                                <h5 class="entry_title"><a href="#">Lorem ipsum dolor</a></h5>
                                <div class="post-meta"> <span class="date"><i class="fa fa-calendar"></i> 2014-08-05</span> <span class="comment-count"> <i class="fa fa-comment-o"></i> 3 </span> </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Recent Comments -->
    <!-- <div class="block blog-module">
        <div class="block-title">
            <h3>Bình luận mới nhất</h3>
        </div>
        <div class="block_content">
            <div class="layered">
                <div class="layered-content">
                    <ul class="recent-comment-list">
                        <li>
                            <h5><a href="#">Lorem ipsum dolor sit amet</a></h5>
                            <div class="comment"> "Consectetuer adipis. Mauris accumsan nulla vel diam. Sed in..." </div>
                            <div class="author">Posted by <a href="#">Admin</a></div>
                        </li>
                        <li>
                            <h5><a href="#">Lorem ipsum dolor sit amet</a></h5>
                            <div class="comment"> "Consectetuer adipis. Mauris accumsan nulla vel diam. Sed in..." </div>
                            <div class="author">Posted by <a href="#">Admin</a></div>
                        </li>
                        <li>
                            <h5><a href="#">Lorem ipsum dolor sit amet</a></h5>
                            <div class="comment"> "Consectetuer adipis. Mauris accumsan nulla vel diam. Sed in..." </div>
                            <div class="author">Posted by <a href="#">Admin</a></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
</aside>