<ul class="links pull-left">
    <?php foreach ($header_menu as $menu) : ?>
        <li><a title="<?= $menu['name'] ?>" href="<?= $menu['link'] ?>"><?= $menu['name'] ?></a></li>
    <?php endforeach; ?>
    <!-- <li><a title="Sản phẩm" href="index.php?option=page&act=product">Sản phẩm</a></li>
    <li><a title="Về chúng tôi" href="index.php?option=page&act=about">Về chúng tôi</a></li>
    <li><a title="Liên hệ" href="index.php?option=page&act=contact">Liên hệ</a></li>
    <li><a title="Tin tức" href="index.php?option=page&act=post">Tin tức</a></li>
    <li><a title="faq" href="index.php?option=page&act=faq">Faq</a></li> -->
</ul>
<ul class="links pull-right">
    <?php if (isset($_SESSION['user'])) : ?>
        <li><a title="Tài khoản" href="index.php?option=user&act=account">Xin chào, <?= $_SESSION['user']['fullname']; ?></a></li>
        <li><a title="Đăng xuất" href="index.php?option=user&act=logout">Đăng xuất</a></li>
    <?php else : ?>
        <li><a title="Đăng nhập" href="index.php?option=user&act=login">Đăng nhập</a></li>
        <li><a title="Đăng ký" href="index.php?option=user&act=register">Đăng ký</a></li>
    <?php endif; ?>
</ul>