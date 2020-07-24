<?php
//views/carts/index.php
//nhung class helper trong thu muc heloers/Helper.php de su dung phuong thuc tinh slug -> tao ra link chi tiet theo dan duong dan than thien
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
                <li>Cart</li>
            </ul>
        </div>
    </div>
</div>
<!-- //page -->
<br class="timeline-items container">
</br>
<h2>Giỏ hàng của bạn</h2>
</br>
<?php if (isset($_SESSION['cart'])): ?>
    <form action="" method="post">
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th>SL No.</th>
                <th width="40%">Product Name</th>
                <th width="12%">Quality</th>
                <th>Unit Price</th>
                <th>Amount Of Money</th>
                <th>Remove</th>
            </tr>
            <?php
            //khai bao 1 bien chua tong gia tri don hang
            $total_cart = 0;
            $count = 0;
            foreach ($_SESSION['cart'] as $product_id => $cart):
                $slug = Helper::getSlug($cart['name']);
                $url_detail = "chi-tiet-san-pham/$slug/$product_id";
                $count++;
                ?>
                <tr>
                    <td style="vertical-align: middle;text-align: center;"><?php echo $count; ?></td>
                    <td>
                        <img class="product-avatar img-responsive"
                             src="../Backend/assets/uploads/<?php echo $cart['avatar']; ?>" width="80">
                        <div class="content-product">
                            <a href="<?php echo $url_detail; ?>" class="content-product-a">
                                <?php echo $cart['name']; ?>
                            </a>
                        </div>
                    </td>
                    <td>
                        <!--cần khéo léo đặt name cho input số lượng, để khi xử lý submit form update lại giỏ hàng sẽ đơn giản hơn-->
                        <input type="number" min="0" name="<?php echo $product_id ?>"
                               class="product-amount form-control" value="<?php echo $cart['quality']; ?>">
                    </td>
                    <td>
                        <?php echo number_format($cart['price']); ?>$
                    </td>
                    <td>
                        <?php
                        //thanh tien
                        $total_item = $cart['price'] * $cart['quality'];
                        echo number_format($total_item);
                        //cong don thanh tien cho tong gia tri don hang
                        $total_cart += $total_item;
                        ?>$
                    </td>
                    <td>
                        <a class="content-product-a" href="xoa-san-pham/<?php echo $product_id ?>">
                            Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td colspan="6" style="text-align: right">
                    Total order value :
                    <span class="product-price"><?php echo number_format($total_cart); ?>$</span>
                </td>
            </tr>
            <tr>
                <td colspan="6" class="product-payment" style="text-align: right">
                    <input type="submit" name="submit" value="Update prices" class="btn btn-primary">
                    <a href="thanh-toan" class="btn btn-success">Payment</a>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
<?php else: ?>
    </br>
    <h3 style="text-align: center;color: #cf0000">Giỏ hàng của bạn trống !</h3>
    </br>
<?php endif; ?>
</div>