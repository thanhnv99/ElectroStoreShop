<?php
//nhúng class Helper để gọi phương thức lấy slug của chi tiết sp
require_once 'helpers/Helper.php';
?>

<!-- banner-2 -->
<div class="page-head_agile_info_w3l">

</div>
<!-- //banner-2 -->
<!-- page -->
<div class="services-breadcrumb">
    <div class="agile_inner_breadcrumb">
        <div class="container">
            <ul class="w3_short">
                <li>
                    <a href="index.html">Home</a>
                    <i>|</i>
                </li>
                <li>Laptops</li>
            </ul>
        </div>
    </div>
</div>
<!-- //page -->

<!-- top Products -->
<div class="ads-grid py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            <span>S</span>how
            <span>A</span>ll
            <span>L</span>aptops</h3>
        <!-- //tittle heading -->
        <div class="row">
            <!-- product left -->
            <div class="agileinfo-ads-display col-lg-9">
                <div class="wrapper">
                    <!-- fourth section -->
                    <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mt-4">
                        <h3 class="heading-tittle text-center font-italic">Laptops</h3>
                        <div class="row">
                            <?php if (!empty($products_laptop)): ?>
                                <?php foreach ($products_laptop as $product):
                                    $product_title = $product['title'];
                                    $product_slug = Helper::getSlug($product_title);
                                    $product_id = $product['id'];
                                    $product_link = "chi-tiet-san-pham/$product_slug/$product_id";
                                    ?>
                                    <div class="col-md-4 product-men mt-5">
                                        <div class="men-pro-item simpleCart_shelfItem">
                                            <div class="men-thumb-item text-center">
                                                <img src="../Backend/assets/uploads/<?php echo $product['avatar']; ?>"
                                                     alt="" width="150" height="200">
                                                <div class="men-cart-pro">
                                                    <div class="inner-men-cart-pro">
                                                        <a href="<?php echo $product_link; ?>"
                                                           class="link-product-add-cart">Quick View</a>
                                                    </div>
                                                </div>
                                                <span class="product-new-top">New</span>

                                            </div>
                                            <div class="item-info-product text-center border-top mt-4">
                                                <h4 class="pt-1">
                                                    <a href="<?php echo $product_link; ?>"><?php echo $product['title']; ?></a>
                                                </h4>
                                                <div class="info-product-price my-2">
                                                    <span class="item_price"><?php echo number_format($product['price']); ?>$</span>
                                                    <del><?php echo number_format($product['price'] * 1.2); ?></del>$
                                                </div>
                                                <div class="home-page timeline-post-content">
                                                    <div class="timeline-post-info">
                                                        <a href="them-vao-gio-hang/<?php echo $product['id']; ?>"
                                                           class="btn btn-primary">
                                                            ADD TO CART
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <h2>Không có sản phẩm nào</h2>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- //fourth section -->
                </div>
            </div>
            <!-- //product left -->

            <!-- product right -->
            <div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
                <div class="side-bar p-sm-4 p-3">
                    <div class="search-hotel border-bottom py-2">
                        <h3 class="agileits-sear-head mb-3">Search Here..</h3>
                        <form action="#" method="post">
                            <input type="search" placeholder="Product name..." name="search" required="">
                            <input type="submit" value=" ">
                        </form>
                    </div>
                    <!-- price -->
                    <div class="range border-bottom py-2">
                        <h3 class="agileits-sear-head mb-3">Price</h3>
                        <form action="" method="post">
                            <div class="form-group">
                                <?php
                                //xu ly do lai du lieu cho cac checkbox lien quan den khoang gia
                                //do day la du lieu tinh,nen viec check do lai du lieu se theo huong: co bao nhieu input checkbok thi se tao ra bay nhieu bien checked tuong ung
                                $checked_price1 = '';
                                $checked_price2 = '';
                                $checked_price3 = '';
                                $checked_price4 = '';
                                //neu user submit form Filter, thi xu ly de do lai du lieu
                                if (isset($_POST['price'])) {
                                    if (in_array(1, $_POST['price'])) {
                                        $checked_price1 = 'checked';
                                    }
                                    if (in_array(2, $_POST['price'])) {
                                        $checked_price2 = 'checked';
                                    }
                                    if (in_array(3, $_POST['price'])) {
                                        $checked_price3 = 'checked';
                                    }
                                    if (in_array(4, $_POST['price'])) {
                                        $checked_price4 = 'checked';
                                    }
                                }
                                ?>
                                <input type="checkbox" name="price[]" value="1" <?php echo $checked_price1; ?> >
                                Under $200
                                <br>
                                <input type="checkbox" name="price[]" value="2" <?php echo $checked_price2; ?> >
                                From $200 - $600
                                <br>
                                <input type="checkbox" name="price[]" value="3" <?php echo $checked_price3; ?> >
                                From $600 - $1000
                                <br>
                                <input type="checkbox" name="price[]" value="4" <?php echo $checked_price4; ?> >
                                Over $ 1000
                                <br>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="filter" value="Filter" class="btn btn-primary">
                                <a href="danh-sach-san-pham/Laptops" class="btn btn-default">Xóa filter</a>
                            </div>
                        </form>
                    </div>

                    <!-- //price -->

                    <!-- best seller -->
                    <div class="f-grid py-2">
                        <h3 class="agileits-sear-head mb-3">Best Seller</h3>
                        <div class="box-scroll">
                            <div class="scroll">
                                <div class="row">
                                    <div class="col-lg-3 col-sm-2 col-3 left-mar">
                                        <img src="assets/images/k1.jpg" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-lg-9 col-sm-10 col-9 w3_mvd">
                                        <a href="">Samsung Galaxy On7 Prime (Gold, 4GB RAM + 64GB Memory)</a>
                                        <a href="" class="price-mar mt-2">$12,990.00</a>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-lg-3 col-sm-2 col-3 left-mar">
                                        <img src="assets/images/k2.jpg" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-lg-9 col-sm-10 col-9 w3_mvd">
                                        <a href="">Haier 195 L 4 Star Direct-Cool Single Door Refrigerator</a>
                                        <a href="" class="price-mar mt-2">$12,499.00</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-sm-2 col-3 left-mar">
                                        <img src="assets/images/k3.jpg" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-lg-9 col-sm-10 col-9 w3_mvd">
                                        <a href="">Ambrane 13000 mAh Power Bank (P-1310 Premium)</a>
                                        <a href="" class="price-mar mt-2">$1,199.00 </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //best seller -->
                </div>
                <!-- //product right -->
            </div>
        </div>
    </div>
</div>
<!-- //top products -->