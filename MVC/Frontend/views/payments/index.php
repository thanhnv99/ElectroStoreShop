<?php
require_once 'helpers/Helper.php';
?>
<div class="container">
    <h1>Thanh toán</h1>
    <br>
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h3 class="center-align">Thông tin khách hàng</h3>
                <br>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="fullname" value="" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="number" min="0" name="mobile" value="" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" min="0" name="email" value="" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Note</label>
                    <textarea name="note" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Select a payment method</label> <br/>
                    <input type="radio" name="method" value="0"/> Online Payment <br/>
                    <input type="radio" name="method" checked value="1"/> COD (Cash On Delivery) <br/>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <h3 class="center-align">Your Order Information</h3>
                <br>
                <?php
                //biến lưu tổng giá trị đơn hàng
                $total = 0;
                $count = 0;
                if (isset($_SESSION['cart'])):
                    ?>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>SL No.</th>
                            <th width="40%">Product Name</th>
                            <th width="12%">Quality</th>
                            <th>Unit Price</th>
                            <th>Amount Of Money</th>
                        </tr>
                        <?php foreach ($_SESSION['cart'] as $product_id => $cart):
                            $product_link = 'chi-tiet-san-pham/' . Helper::getSlug($cart['name']) . "/$product_id";
                            $count++;
                            ?>
                            <tr>
                                <td style="vertical-align: middle;text-align: center;"><?php echo $count; ?></td>
                                <td>
                                    <?php if (!empty($cart['avatar'])): ?>
                                        <img class="product-avatar img-responsive"
                                             src="../Backend/assets/uploads/<?php echo $cart['avatar']; ?>" width="60"/>
                                    <?php endif; ?>
                                    <div class="content-product">
                                        <a href="<?php echo $product_link; ?>" class="content-product-a">
                                            <?php echo $cart['name']; ?>
                                        </a>
                                    </div>
                                </td>
                                <td>
                              <span class="product-amount">
                                  <?php echo $cart['quality']; ?>
                              </span>
                                </td>
                                <td>
                              <span class="product-price-payment">
                                 <?php echo number_format($cart['price'], 0, '.', '.') ?>$
                              </span>
                                </td>
                                <td>
                              <span class="product-price-payment">
                                  <?php
                                  $price_total = $cart['price'] * $cart['quality'];
                                  $total += $price_total;
                                  ?>
                                  <?php echo number_format($price_total, 0, '.', '.') ?>$
                              </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="5" class="product-total">
                                Total order value :
                                <span class="product-price">
                                <?php echo number_format($total, 0, '.', '.') ?>$
                            </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
        <input type="submit" name="submit" value="Thanh toán" class="btn btn-primary">
        <a href="gio-hang-cua-ban" class="btn btn-secondary">Về trang giỏ hàng</a>
    </form>
    <br>
</div>