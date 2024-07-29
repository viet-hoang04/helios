<aside class="sidebar">
    <?php if (strpos($_SERVER['QUERY_STRING'], 'act=search') == FALSE) : ?>
        <div class="block block-layered-nav">
            <div class="block-title">
                <h3>Danh mục</h3>
            </div>
            <div class="block-content">
                <dl id="narrow-by-list">
                    <!-- <dt class="even">Category</dt> -->
                    <dd class="even">
                        <ol>
                            <li><a href="?option=page&act=product">Tất cả sản phẩm</a></li>
                            <?= $category; ?>
                        </ol>
                    </dd>
                </dl>
            </div>
        </div>
        <!-- <div class="block block-layered-nav">
        <div class="block-title">
            <h3>Thương hiệu</h3>
        </div>
        <div class="block-content">
            <dl id="narrow-by-list">
                <!-- <dt class="even">Category</dt>
                <dd class="even">
                    <ol>
                        <li><a href="?option=page&act=product">Tất cả sản phẩm</a></li>
                        <?php foreach ($list_brand as $item) : ?>
                            <li><a href="?option=page&act=brand&cat=<?= $item['slug'] ?>"><?= $item['name'] ?></a></li>
                        <?php endforeach; ?>
                    </ol>
                </dd>
            </dl>
        </div>
    </div> -->

        <div class="block product-price-range ">
            <div class="block-title">
                <h3>Lọc theo giá</h3>
            </div>
            <div class="block-content">
                <div class="slider-range">
                    <ul class="check-box-list">
                        <!-- Liên kết cho các lựa chọn lọc với thuộc tính data-* -->
                        <li><a href="?<?= http_build_query(array_merge($_GET, ['min_price' => 0, 'max_price' => 5000000, 'pages' => null])) ?>" class="price-filter">+ Dưới: 5,000,000 Vnđ</a></li>
                        <li><a href="?<?= http_build_query(array_merge($_GET, ['min_price' => 5000000, 'max_price' => 10000000, 'pages' => null])) ?>" class="price-filter">+ 5,000,000 - 10,000,000 Vnđ</a></li>
                        <li><a href="?<?= http_build_query(array_merge($_GET, ['min_price' => 10000000, 'max_price' => 20000000, 'pages' => null])) ?>" class="price-filter">+ 10,000,000 - 20,000,000 Vnđ</a></li>
                        <li><a href="?<?= http_build_query(array_merge($_GET, ['min_price' => 20000000, 'max_price' => 30000000, 'pages' => null])) ?>" class="price-filter">+ 20,000,000 - 30,000,000 Vnđ</a></li>
                        <li><a href="?<?= http_build_query(array_merge($_GET, ['min_price' => 30000000, 'max_price' => 999999999, 'pages' => null])) ?>" class="price-filter">+ Trên: 30,000,000 Vnđ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?>

</aside>
<script>
    // Lấy tất cả các phần tử có class "toggle-icon"
    var toggleIcons = document.querySelectorAll('.toggle-icon');

    // Lặp qua từng toggle-icon và thêm sự kiện click
    toggleIcons.forEach(function(icon) {
        icon.addEventListener('click', function() {
            var sublist = this.nextElementSibling; // Lấy danh sách con (ol)
            if (sublist.style.display === 'none' || sublist.style.display === '') {
                sublist.style.display = 'block'; // Hiển thị danh sách con
                this.innerText = '▲'; // Đổi icon sang mũi tên lên
            } else {
                sublist.style.display = 'none'; // Ẩn danh sách con
                this.innerText = '▼'; // Đổi icon sang mũi tên xuống
            }
        });
    });
</script>