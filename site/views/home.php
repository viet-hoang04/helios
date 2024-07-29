  <!-- Revslider -->
  <?php require_once 'modules/slider.php' ?>
  <!-- Support Policy Box -->
  <div class="container">
      <div class="support-policy-box">
          <div class="row">
              <div class="col-md-3 col-sm-4 col-xs-12">
                  <div class="support-policy"> <i class="fa fa-money"></i>
                      <div class="content">Tiết kiệm chi tiêu</div>
                  </div>
              </div>
              <div class="col-md-3 col-sm-4 col-xs-12">
                  <div class="support-policy"> <i class="fa fa-truck"></i>
                      <div class="content">Miễn phí vận chuyển</div>
                  </div>
              </div>
              <div class="col-md-3 col-sm-4 col-xs-12">
                  <div class="support-policy"> <i class="fa fa-phone"></i>
                      <div class="content">Hotline 24/7</div>
                  </div>
              </div>
              <div class="col-md-3 col-sm-4 col-xs-12">
                  <div class="support-policy"> <i class="fa fa-refresh"></i>
                      <div class="content">Hoàn trả sau 30 ngày</div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Main Container -->
  <section class="main-container">
      <div class="container">
          <div class="row">
              <div class="col-sm-12 col-xs-12">
                  <div class="col-main">
                      <div class="jtv-featured-products">
                          <div class="slider-items-products">
                              <div class="jtv-new-title">
                                  <h2>Sản phẩm mới</h2>
                              </div>
                              <div id="featured-slider" class="product-flexslider hidden-buttons">
                                  <div class="slider-items slider-width-col4 products-grid">
                                      <?php foreach ($product_list_newest as $item_newest) : ?>
                                          <div class="item">
                                              <div class="item-inner">
                                                  <div class="item-img">
                                                      <div class="item-img-info">
                                                          <a class="product-image" title="<?= $item_newest['slug'] ?>" href="?option=page&act=product-detail&slug=<?= $item_newest['slug'] ?>">
                                                              <img alt="<?= $item_newest['slug'] ?>" src="../public/images/product/<?= $item_newest['img'] ?>" height="250px">
                                                          </a>
                                                          <div class="new-label new-top-left">new</div>
                                                          <!-- <a class="quickview-btn" href="quick-view.html">
                                                              <span>Quick View</span>
                                                          </a> -->
                                                          <a href="index.php?option=page&act=add-wishlist&pid=<?= $item_newest['id'] ?>" data-toggle="tooltip" title="Yêu thích">
                                                              <div class="mask-left-shop">
                                                                  <i class="fa fa-heart"></i>
                                                              </div>
                                                          </a>
                                                          <a href="index.php?option=cart&act=add-cart&pid=<?= $item_newest['id'] ?>" data-toggle="tooltip" title="Thêm giỏ hàng">
                                                              <div class="mask-right-shop">
                                                                  <i class="fa fa-shopping-cart"></i>
                                                              </div>
                                                          </a>
                                                      </div>
                                                  </div>
                                                  <div class="item-info">
                                                      <div class="info-inner">
                                                          <div class="item-title">
                                                              <a title="<?= $item_newest['slug'] ?>" href="?option=page&act=product-detail&slug=<?= $item_newest['slug'] ?>">
                                                                  <?= $item_newest['name'] ?>
                                                              </a>
                                                          </div>
                                                          <div class="item-content">
                                                              <div class="item-price">
                                                                  <div class="price-box">
                                                                      <?php if ($item_newest['promotion'] > 0) : ?>
                                                                          <span class="regular-price" id="displayedPrice">
                                                                              <span class="price">
                                                                                  <?= number_format($item_newest['promotion_price']) ?> Vnđ
                                                                              </span>
                                                                          </span>
                                                                          <p class="old-price">
                                                                              <span class="price-label">Giá gốc:</span>
                                                                              <span class="price"><?= number_format($item_newest['old_price']) ?> Vnđ </span>
                                                                          </p>
                                                                      <?php else : ?>
                                                                          <span class="regular-price">
                                                                              <span class="price">
                                                                                  <?= number_format($item_newest['old_price']) ?> Vnđ
                                                                              </span>
                                                                          </span>
                                                                      <?php endif; ?>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      <?php endforeach; ?>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- Trending Products Slider -->
                  <div class="jtv-featured-products">
                      <div class="slider-items-products">
                          <div class="jtv-new-title">
                              <h2>Sản phẩm thịnh hành</h2>
                          </div>
                          <div id="featured-slider" class="product-flexslider hidden-buttons">
                              <div class="slider-items slider-width-col4 products-grid">
                                  <?php foreach ($product_list_topview as $item_topview) : ?>
                                      <div class="item">
                                          <div class="item-inner">
                                              <div class="item-img">
                                                  <div class="item-img-info">
                                                      <a class="product-image" title="<?= $item_topview['slug'] ?>" href="?option=page&act=product-detail&slug=<?= $item_topview['slug'] ?>">
                                                          <img alt="<?= $item_topview['slug'] ?>" src="../public/images/product/<?= $item_topview['img'] ?>" height="250px">
                                                      </a>
                                                      <?php if ($item_topview['promotion'] > 0) : ?>
                                                          <div class="sale-label sale-top-right">Sale</div>
                                                      <?php endif; ?>
                                                      <!-- <a class="quickview-btn" href="quick-view.html">
                                                              <span>Quick View</span>
                                                          </a> -->
                                                      <a href="index.php?option=page&act=add-wishlist&pid=<?= $item_topview['id'] ?>" data-toggle="tooltip" title="Yêu thích">
                                                          <div class="mask-left-shop">
                                                              <i class="fa fa-heart"></i>
                                                          </div>
                                                      </a>
                                                      <a href="index.php?option=cart&act=add-cart&pid=<?= $item_topview['id'] ?>" data-toggle="tooltip" title="Thêm giỏ hàng">
                                                          <div class="mask-right-shop">
                                                              <i class="fa fa-shopping-cart"></i>
                                                          </div>
                                                      </a>
                                                  </div>
                                              </div>
                                              <div class="item-info">
                                                  <div class="info-inner">
                                                      <div class="item-title">
                                                          <a title="<?= $item_topview['slug'] ?>" href="?option=page&act=product-detail&slug=<?= $item_topview['slug'] ?>">
                                                              <?= $item_topview['name'] ?>
                                                          </a>
                                                      </div>
                                                      <div class="item-content">
                                                          <div class="item-price">
                                                              <div class="price-box">
                                                                  <?php if ($item_topview['promotion'] > 0) : ?>
                                                                      <span class="regular-price" id="displayedPrice">
                                                                          <span class="price">
                                                                              <?= number_format($item_topview['promotion_price']) ?> Vnđ
                                                                          </span>
                                                                      </span>
                                                                      <p class="old-price">
                                                                          <span class="price-label">Giá gốc:</span>
                                                                          <span class="price"><?= number_format($item_topview['old_price']) ?> Vnđ </span>
                                                                      </p>
                                                                  <?php else : ?>
                                                                      <span class="regular-price">
                                                                          <span class="price">
                                                                              <?= number_format($item_topview['old_price']) ?> Vnđ
                                                                          </span>
                                                                      </span>
                                                                  <?php endif; ?>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  <?php endforeach; ?>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- End Trending Products Slider -->
                  <?php require_once 'modules/collection_area.php' ?>
                  <!-- Latest Blog -->
                  <?php require_once 'modules/lasted_blog.php' ?>
                  <!-- End Latest Blog -->
              </div>
          </div>
      </div>
  </section>

  <!-- Brand Logo -->
  <?php require_once 'modules/brand_logo.php' ?>
  <!-- Collection Banner -->
  <!-- collection area end -->
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