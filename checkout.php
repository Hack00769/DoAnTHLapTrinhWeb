<?php
include './header.php';
include './connect_db.php';
include './navbar.php';
if (!empty($_SESSION["cart"])) {
    $products = mysqli_query($con, "SELECT * FROM `product` WHERE `product_id` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
}
?>
<link rel="stylesheet" type="text/css" href="layout/styles/checkout-cart.css">

<body>
    <div class="container">
        <?php if (!empty($error)) { ?>
        <script language="javascript">
        alert("Mua hàng không thành công!");
        window.location = "cart.php";
        </script>
        <?php } elseif (!empty($success)) { ?>
        <script language="javascript">
        alert("Mua hàng thành công!");
        window.location = "index.php";
        </script>
        <?php } else {
        ?>
        <a class="home" href="index.php">
            << Quay về trang chủ</a>
                <h2 class="my_cart">Giỏ hàng của bạn</h2>
                <form id="cart-form" action="cart.php?action=submit" method="POST">
                    <table>
                        <thead>
                            <tr>
                                <th class="product-number-cart">STT</th>
                                <th class="product-name-cart">Tên sản phẩm</th>
                                <th class="product-price-cart">Đơn giá</th>
                                <th class="product-quantity-cart">Số lượng</th>
                                <th class="title-total-money">Thành tiền</th>
                            </tr>
                        </thead>
                        <?php
                    if (!empty($products)) {
                        $total = 0;
                        $num = 1;
                        while ($row = mysqli_fetch_array($products)) {
                    ?>
                        <tbody>
                            <tr>
                                <td class="product-number-cart"><?= $num++; ?></td>
                                <td class="product-name-cart"><?= $row['name'] ?></td>
                                <td class="product-price-cart"><?= number_format($row['price'], 0, ",", ".") ?>₫</td>
                                <td class="product-quantity-cart">
                                    <?= $_SESSION["cart"][$row['product_id']] ?>
                                </td>
                                <td class="total-money">
                                    <?= number_format($row['price'] * $_SESSION["cart"][$row['product_id']], 0, ",", ".") ?>₫
                                </td>
                            </tr>
                        </tbody>
                        <?php
                            $total += $row['price'] * $_SESSION["cart"][$row['product_id']];
                        }
                        ?>
                        <tfoot>
                            <tr id="row-total">
                                <td colspan="4" class="merged-column">
                                    Tổng tiền
                                </td>
                                <td class="total-money"><?= number_format($total, 0, ",", ".") ?>₫</td>
                            </tr>
                        </tfoot>
                        <?php
                    }
                    ?>
                    </table>
                    <hr>
                    <div class="center-input-box">
                        <div class="input_information">
                            <label class="form_label">Người nhận</label>
                            <input type="text" value="" name="name" class="input_infomation_buyer" />
                        </div>
                        <div class="input_information">
                            <label class="form_label">Điện thoại</label>
                            <input type="tel" value="" name="phone" class="input_infomation_buyer" />
                        </div>
                        <div class="input_information">
                            <label class="form_label">Địa chỉ</label>
                            <input type="text" value="" name="address" class="input_infomation_buyer" />
                        </div>
                        <input type="hidden" name="status" value="0">
                        <div class="submit-checkout">
                            <button type="submit" class="order">Đặt hàng</button>
                        </div>
                    </div>
                </form>
                <?php } ?>
    </div>
    <?php
    include './footer.php';
    ?>
    <script src="./jquery/jquery-3.6.0.min.js"></script>
    <!-- <script src="./alertifyjs/alertify.min.js"></script> -->
    <script src="./fancybox/jquery.fancybox.min.js"></script>
    <script src="./jquery/jquery.validate.min.js"></script>
    <script src="./javascript/checkout.js"></script>
</body>

</html>