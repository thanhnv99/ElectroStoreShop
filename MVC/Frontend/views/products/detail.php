<?php
//views/products/detail
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
                <li>Detail Product</li>
            </ul>
        </div>
    </div>
</div>
<!-- //page -->

<!-- Single Page -->
<div class="banner-bootom-w3-agileits py-5">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            <span><?php echo $product['title'] ?></span>
        </h3>
        <!-- //tittle heading -->
        <div class="row">
            <div class="col-lg-5 col-md-8 single-right-left ">
                <div class="grid images_3_of_2">
                    <div class="flexslider"">
                        <ul class="slides">
                            <li data-thumb="../Backend/assets/uploads/<?php echo $product['avatar']; ?>">
                                <div class="thumb-image">
                                    <img src="../Backend/assets/uploads/<?php echo $product['avatar']; ?>" data-imagezoom="true" class="img-fluid" alt=""> </div>
                            </li>
                            <li data-thumb="../Backend/assets/uploads/<?php echo $product['avatar']; ?>">
                                <div class="thumb-image">
                                    <img src="../Backend/assets/uploads/<?php echo $product['avatar']; ?>" data-imagezoom="true" class="img-fluid" alt=""> </div>
                            </li>
                            <li data-thumb="../Backend/assets/uploads/<?php echo $product['avatar']; ?>">
                                <div class="thumb-image">
                                    <img src="../Backend/assets/uploads/<?php echo $product['avatar']; ?>" data-imagezoom="true" class="img-fluid" alt=""> </div>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 single-right-left simpleCart_shelfItem">
                <h3 class="mb-3"><?php echo $product['summary']; ?></h3>
                <p class="mb-3">
                    <span class="item_price"><?php echo $product['price']; ?></span>$
                    <del class="mx-2 font-weight-light"><?php echo $product['price']*1.2; ?></del>$
                    <label>Free delivery</label>
                </p>
                <div class="single-infoagile">
                    <?php echo $product['content']; ?>
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
</div>
<!-- //Single Page -->