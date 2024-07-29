<div class="mega-container visible-lg visible-md visible-sm">
    <div class="navleft-container">
        <div class="mega-menu-title">
            <h3><i class="fa fa-navicon" style="color: #33465c;"></i>Danh mục</h3>
        </div>
        <div class="mega-menu-category">
            <ul class="nav">
                <?php foreach ($parent_menu as $parent) : ?>
                    <?php if (count($parent['submenu']) != 0) : ?>
                        <li>
                            <a href="<?= $parent['link'] ?>"><?= $parent['name'] ?></a>
                            <div class="wrap-popup">
                                <div class="popup">
                                    <div class="row">
                                        <?php foreach ($parent['submenu'] as $menu1) : ?>
                                            <div class="col-md-4 col-sm-6">
                                                <h3><a href="<?= $menu1['link'] ?>"><?= $menu1['name'] ?></a></h3>
                                                <ul class="nav">
                                                    <?php foreach ($menu1['submenu'] as $menu2) : ?>
                                                        <li><a href="<?= $menu2['link'] ?>"><span><?= $menu2['name'] ?></span></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php else : ?>
                        <li class="nosub"><a href="<?= $parent['link'] ?>"><?= $parent['name'] ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
                <!-- <li>
                    <a href="#">Page</a>
                    <div class="wrap-popup">
                        <div class="popup">
                            <div class="row">
                                <div class="col-sm-4">
                                    <ul class="nav">
                                        <li><a href="shop-grid.html"><span>Shop Grid</span></a></li>
                                        <li><a href="shop-grid-sidebar.html"><span>Shop Grid Sidebar</span></a></li>
                                        <li><a href="shop-list.html"><span>Shop List</span></a></li>
                                        <li><a href="shop-list-sidebar.html"><span>Shop List Sidebar</span></a></li>
                                        <li><a href="product-detail.html"><span>Product Detail</span></a></li>
                                        <li><a href="product-detail-sidebar.html"><span>Product Detail Sidebar</span></a></li>
                                        <li><a href="shopping-cart.html"><span>Shopping Cart</span></a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="nav">
                                        <li><a href="checkout.html"><span>Checkout</span></a></li>
                                        <li><a href="wishlist.html"><span>Wishlist</span></a></li>
                                        <li><a href="dashboard.html"><span>Dashboard</span></a></li>
                                        <li><a href="compare.html"><span>Compare</span></a></li>
                                        <li><a href="quick-view.html"><span>Quick View</span></a></li>
                                        <li><a href="complete-order.html">Complete Order</a></li>
                                        <li><a href="my-account-information.html">Account Information</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="nav">
                                        <li><a href="faq.html"><span>FAQ</span></a></li>
                                        <li><a href="sitemap.html"><span>Sitemap</span></a></li>
                                        <li><a href="track-order.html"><span>Track Order</span></a></li>
                                        <li><a href="register-ac.html"><span>Register Account</span></a></li>
                                        <li><a href="forgot-password.html"><span>Forgot Password</span></a></li>
                                        <li><a href="team.html"><span>Team</span></a></li>
                                        <li><a href="404error.html"><span>404 Error Page</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nosub"><a href="contact.html">Contact Us</a></li> -->
                <!-- <li>
                    <a href="#">Home</a>
                    <div class="wrap-popup column1">
                        <div class="popup">
                            <ul class="nav">
                                <li><a href="index.html">Home Shop 1</a></li>
                                <li><a href="version2/index.html">Home Shop 2</a></li>
                                <li><a href="version3/index.html">Home Shop 3</a></li>
                                <li><a href="version4/index.html">Home Shop 4</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li><a href="#">Page</a>
                    <div class="wrap-popup">
                        <div class="popup">
                            <div class="row">
                                <div class="col-sm-4">
                                    <ul class="nav">
                                        <li><a href="shop-grid.html"><span>Shop Grid</span></a></li>
                                        <li><a href="shop-grid-sidebar.html"><span>Shop Grid Sidebar</span></a></li>
                                        <li><a href="shop-list.html"><span>Shop List</span></a></li>
                                        <li><a href="shop-list-sidebar.html"><span>Shop List Sidebar</span></a></li>
                                        <li><a href="product-detail.html"><span>Product Detail</span></a></li>
                                        <li><a href="product-detail-sidebar.html"><span>Product Detail Sidebar</span></a></li>
                                        <li><a href="shopping-cart.html"><span>Shopping Cart</span></a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="nav">
                                        <li><a href="checkout.html"><span>Checkout</span></a></li>
                                        <li><a href="wishlist.html"><span>Wishlist</span></a></li>
                                        <li><a href="dashboard.html"><span>Dashboard</span></a></li>
                                        <li><a href="compare.html"><span>Compare</span></a></li>
                                        <li><a href="quick-view.html"><span>Quick View</span></a></li>
                                        <li><a href="complete-order.html">Complete Order</a></li>
                                        <li><a href="my-account-information.html">Account Information</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="nav">
                                        <li><a href="faq.html"><span>FAQ</span></a></li>
                                        <li><a href="sitemap.html"><span>Sitemap</span></a></li>
                                        <li><a href="track-order.html"><span>Track Order</span></a></li>
                                        <li><a href="register-ac.html"><span>Register Account</span></a></li>
                                        <li><a href="forgot-password.html"><span>Forgot Password</span></a></li>
                                        <li><a href="team.html"><span>Team</span></a></li>
                                        <li><a href="404error.html"><span>404 Error Page</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li><a href="#">Men's</a>
                    <div class="wrap-popup">
                        <div class="popup">
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <h3><a href="shop-grid-sidebar.html">Clothing</a></h3>
                                    <ul class="nav">
                                        <li><a href="shop-grid-sidebar.html">T-Shirts</a></li>
                                        <li><a href="shop-grid-sidebar.html">Shirts</a></li>
                                        <li><a href="shop-grid-sidebar.html">Trousers</a></li>
                                        <li><a href="shop-grid-sidebar.html">Sleep Wear</a></li>
                                    </ul>
                                    <br>
                                    <h3><a href="shop-grid-sidebar.html">Shoes</a></h3>
                                    <ul class="nav">
                                        <li><a href="shop-grid-sidebar.html">Flat Shoes</a></li>
                                        <li><a href="shop-grid-sidebar.html">Flat Sandals</a></li>
                                        <li><a href="shop-grid-sidebar.html">Boots</a></li>
                                        <li><a href="shop-grid-sidebar.html">Heels</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-4 col-sm-6 has-sep">
                                    <h3><a href="shop-grid-sidebar.html">Jwellery</a></h3>
                                    <ul class="nav">
                                        <li><a href="shop-grid-sidebar.html">Bracelets</a></li>
                                        <li><a href="shop-grid-sidebar.html">Necklaces &amp; Pendent</a></li>
                                        <li><a href="shop-grid-sidebar.html">Pendants</a></li>
                                        <li><a href="shop-grid-sidebar.html">Pins &amp; Brooches</a></li>
                                    </ul>
                                    <br>
                                    <h3><a href="shop-grid-sidebar.html">Watches</a></h3>
                                    <ul class="nav">
                                        <li><a href="shop-grid-sidebar.html">Fastrack</a></li>
                                        <li><a href="shop-grid-sidebar.html">Casio</a></li>
                                        <li><a href="shop-grid-sidebar.html">Sonata</a></li>
                                        <li><a href="shop-grid-sidebar.html">Maxima</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-4 has-sep hidden-sm">
                                    <div class="custom-menu-right">
                                        <div class="box-banner media">
                                            <div class="add-right"><a href="#"><img src="../public/images/jtv-menu-banner1.jpg" class="img-responsive" alt="New Arrive"></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <a href="#" class="ads"><img src="../public/images/jtv-menu-banner4.jpg" alt="Mega Sale" class="img-responsive"></a>
                        </div>
                    </div>
                </li>
                <li><a href="#">Women's</a>
                    <div class="wrap-popup">
                        <div class="popup">
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <h3><a href="shop-grid-sidebar.html">Clothing</a></h3>
                                    <ul class="nav">
                                        <li><a href="shop-grid-sidebar.html">Dress sale</a></li>
                                        <li><a href="shop-grid-sidebar.html">Sarees</a></li>
                                        <li><a href="shop-grid-sidebar.html">Kurta & kurti</a></li>
                                        <li><a href="shop-grid-sidebar.html">Dress materials</a></li>
                                        <li><a href="shop-grid-sidebar.html">Salwar kameez sets</a></li>
                                    </ul>
                                    <br>
                                    <h3><a href="shop-grid-sidebar.html">Jewellery</a></h3>
                                    <ul class="nav">
                                        <li><a href="shop-grid-sidebar.html">Rings</a></li>
                                        <li><a href="shop-grid-sidebar.html">Earrings</a></li>
                                        <li><a href="shop-grid-sidebar.html">Jewellery sets</a></li>
                                        <li><a href="shop-grid-sidebar.html">Pendants & lockets</a></li>
                                        <li><a href="shop-grid-sidebar.html">Plastic jewellery</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-4 col-sm-6 has-sep">
                                    <h3><a href="shop-grid-sidebar.html">Beauty</a></h3>
                                    <ul class="nav">
                                        <li><a href="shop-grid-sidebar.html">Make up</a></li>
                                        <li><a href="shop-grid-sidebar.html">Hair care</a></li>
                                        <li><a href="shop-grid-sidebar.html">Deodorants</a></li>
                                        <li><a href="shop-grid-sidebar.html">Bath & body</a></li>
                                        <li><a href="shop-grid-sidebar.html">Skin care</a></li>
                                    </ul>
                                    <br>
                                    <h3><a href="shop-grid-sidebar.html">Footwear</a></h3>
                                    <ul class="nav">
                                        <li><a href="shop-grid-sidebar.html">Flats</a></li>
                                        <li><a href="shop-grid-sidebar.html">Heels</a></li>
                                        <li><a href="shop-grid-sidebar.html">Boots</a></li>
                                        <li><a href="shop-grid-sidebar.html">Slippers</a></li>
                                        <li><a href="shop-grid-sidebar.html">Shoes</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-4 has-sep hidden-sm">
                                    <div class="custom-menu-right">
                                        <div class="box-banner media">
                                            <div class="add-desc">
                                                <h3>Top<br>
                                                    Glass </h3>
                                                <div class="price-sale">2018</div>
                                                <a href="#">Shop Now</a>
                                            </div>
                                            <div class="add-right"><img src="../public/images/jtv-menu-banner2.jpg" alt="Top Glass" class="img-responsive"></div>
                                        </div>
                                        <div class="box-banner media">
                                            <div class="add-desc">
                                                <h3>Save</h3>
                                                <div class="price-sale">35%</div>
                                                <a href="#">Buy Now</a>
                                            </div>
                                            <div class="add-right"><img src="../public/images/jtv-menu-banner3.jpg" alt="Save 35%" class="img-responsive"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nosub"><a href="shop-grid-sidebar.html">Kids</a></li>
                <li class="nosub"><a href="shop-grid-sidebar.html">Accessories</a></li>
                <li><a href="blog.html">Blog</a>
                    <div class="wrap-popup column1">
                        <div class="popup">
                            <ul class="nav">
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="blog-archive.html">Blog Archive</a></li>
                                <li><a href="blog_single_post.html">Blog Single</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nosub"><a href="contact.html">Contact Us</a></li> -->
            </ul>
            <!-- <div class="side-banner"><img src="../public/images/top-banner.jpg" alt="Flash Sale" class="img-responsive"></div> -->
        </div>
    </div>
</div>