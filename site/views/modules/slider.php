<div class="container jtv-home-revslider">
    <div class="row">
        <div class="col-lg-9 col-sm-9 col-xs-12 jtv-main-home-slider">
            <div id='rev_slider_1_wrapper' class='rev_slider_wrapper fullwidthbanner-container'>
                <div id='rev_slider_1' class='rev_slider fullwidthabanner'>
                    <ul>
                        <?php foreach ($list_slider as $row) : ?>
                            <li data-transition='slotzoom-horizontal' data-slotamount='7' data-masterspeed='1000' data-thumb='../public/images/slider/<?= $row['img'] ?>'><img src='../public/images/slider/<?= $row['img'] ?>' alt="slider <?= $row['name'] ?>" data-bgposition='center center' data-bgfit='cover' data-bgrepeat='no-repeat' />
                                <div class="info">
                                    <?php if (isset($row['info1'])) : ?>
                                        <div class='tp-caption ExtraLargeTitle sft  tp-resizeme ' data-x='0' data-y='165' data-endspeed='500' data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2;white-space:nowrap;'><span><?= $row['info1'] ?></span></div>
                                    <?php endif; ?>
                                    <?php if (isset($row['info2'])) : ?>
                                        <div class='tp-caption LargeTitle sfl  tp-resizeme ' data-x='0' data-y='220' data-endspeed='500' data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3;white-space:nowrap;'><?= $row['info2'] ?></div>
                                    <?php endif; ?>
                                    <?php if (isset($row['info3'])) : ?>
                                        <div class='tp-caption Title sft  tp-resizeme ' data-x='0' data-y='300' data-endspeed='500' data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;white-space:nowrap;'><?= $row['info3'] ?></div>
                                    <?php endif; ?>
                                    <div class='tp-caption sfb  tp-resizeme ' data-x='0' data-y='350' data-endspeed='500' data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;white-space:nowrap;'><a href='<?= $row['link'] ?>' class="buy-btn">Truy cập ngay</a></div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <!-- <li data-transition='slotzoom-horizontal' data-slotamount='7' data-masterspeed='1000' data-thumb='../public/images/slider/slide2.jpg'><img src='../public/images/slider/slide2.jpg' alt="slider image2" data-bgposition='center center' data-bgfit='cover' data-bgrepeat='no-repeat' />
                             <div class="info">
                                  <div class='tp-caption ExtraLargeTitle sft slide2  tp-resizeme ' data-x='45' data-y='165' data-endspeed='500' data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2;white-space:nowrap;padding-right:0px'><span>Spring Fashion</span></div>
                                  <div class='tp-caption LargeTitle sfl  tp-resizeme ' data-x='45' data-y='220' data-endspeed='500' data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3;white-space:nowrap;'>Be Summer Ready</div>
                                  <div class='tp-caption Title sft  tp-resizeme ' data-x='45' data-y='300' data-endspeed='500' data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;white-space:nowrap;'>Identify your Look, Define your Style!</div>
                                  <div class='tp-caption sfb  tp-resizeme ' data-x='45' data-y='350' data-endspeed='500' data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;white-space:nowrap;'><a href='#' class="buy-btn">Join us</a></div>
                              </div> 
                        </li>
                        <li data-transition='slotzoom-horizontal' data-slotamount='7' data-masterspeed='1000' data-thumb='../public/images/slider/slide1.jpg'><img src='../public/images/slider/slide1.jpg' alt="slider image3" data-bgposition='center center' data-bgfit='cover' data-bgrepeat='no-repeat' />
                            <div class="info">
                                  <div class='tp-caption ExtraLargeTitle sft slide2  tp-resizeme ' data-x='45' data-y='165' data-endspeed='500' data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2;white-space:nowrap;padding-right:0px'><span>Big Sale</span></div>
                                  <div class='tp-caption LargeTitle sfl  tp-resizeme ' data-x='45' data-y='220' data-endspeed='500' data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3;white-space:nowrap;'>New Fashion</div>
                                  <div class='tp-caption Title sft  tp-resizeme ' data-x='45' data-y='300' data-endspeed='500' data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;white-space:nowrap;'>Look great & feel amazing in our stunning dresses.</div>
                                  <div class='tp-caption sfb  tp-resizeme ' data-x='45' data-y='350' data-endspeed='500' data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;white-space:nowrap;'><a href='#' class="buy-btn">Buy Now</a></div>
                              </div> 
                        </li>-->
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?php foreach ($list_banner_slider as $banner) : ?>
                <div class="banner-block">
                    <a href="#">
                        <img src="../public/images/banner/<?= $banner['img'] ?>" alt="" style="height:235px;width:100%">
                    </a>
                    <div class="text-des-container">
                        <div class="text-des">
                            <p><?= isset($banner['info1']) ? $banner['info1'] : '' ?></p>
                            <h2><?= isset($banner['info2']) ? $banner['info2'] : '' ?></h2>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>