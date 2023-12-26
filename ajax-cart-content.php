<div class="container-ajax-cart">
    <?php
    session_start();
    include './connect_db.php';
    // Kiểm tra giỏ hàng trống
    $isCartEmpty = empty($_SESSION["cart"]);
    $cartStatusMessage = $isCartEmpty ? 'Giỏ hàng của bạn đang trống' : 'Giỏ hàng của bạn';

    if (!$isCartEmpty) {
        $products = mysqli_query($con, "SELECT * FROM `product` WHERE `product_id` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
    }
    ?>
    <h2 class="my_cart"><?= $cartStatusMessage ?></h2>
    <?php if (!$isCartEmpty) : ?>
        <form id="cart-form" action="cart.php?action=submit" method="POST">
            <table>
                <thead>
                    <tr>
                        <th class="product-number-cart">STT</th>
                        <th class="product-name-cart">Tên sản phẩm</th>
                        <th class="product-price-cart">Đơn giá</th>
                        <th class="product-quantity-cart">Số lượng</th>
                        <th class="title-total-money">Thành tiền</th>
                        <th class="total-money">&nbsp;</th>
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
                                <td class="product-price-cart"><?= number_format($row['price'], 0, ",", ".") ?></td>
                                <td class="product-quantity-cart">
                                    <input oninput="javascript:updateQuantity(this.value, <?= $row['product_id'] ?>)" value="<?= $_SESSION["cart"][$row['product_id']] ?>" name="quantity[<?= $row['product_id'] ?>]" type="number" />
                                </td>
                                <td class="total-money">
                                    <?= number_format($row['price'] * $_SESSION["cart"][$row['product_id']], 0, ",", ".") ?>₫</td>
                                <td class="product-delete">
                                    <a href="javascript:deleteCart(<?= $row['product_id'] ?>)">
                                        <i class="fas fa-trash-alt fa-2x" title="Xoá nội dung"></i>
                                    </a>
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
                            <td>&nbsp;</td>
                        </tr>
                    </tfoot>
                <?php
                }
                ?>
            </table>
            <div id="order-cart-button">
                <a href="./checkout.php" class="btn-order-cart">Thanh toán</a>
            </div>
        </form>
    <?php else : ?>
        <!-- Hiển thị hình ảnh empty cart khi giỏ hàng trống -->
        <div style="text-align: center;">
            <img src="./images/empty-cart.png" alt="Empty Cart Image">
        </div>
    <?php endif; ?>
</div>