<?php
include './header.php';
include './process_order_status.php';
?>
<div class="content-right">
    <h1 class="title-editing">Chi tiết đơn hàng</h1>
    <form action="" method="post">
        <div
            style="background-color: white; text-align: center; margin: 10px auto; width: 50%; border-radius: 15px;padding: 20px;">
            <label>Người đặt hàng: </label><span> <?= $orders[0]['name'] ?></span><br />
            <label>Điện thoại: </label><span> <?= $orders[0]['phone'] ?></span><br />
            <label>Địa chỉ: </label><span> <?= $orders[0]['address'] ?></span><br />
            <label>Ngày đặt hàng: </label><span> <?= $orders[0]['create_time'] ?></span><br />
            <select name="xuly" class="approval-order">
                <option style="display:none;" <?php echo ($selectedOption == '0') ? 'selected' : ''; ?> value="0">Đang
                    chờ
                    duyệt đơn</option>
                <option value="1" <?php echo ($selectedOption == '1') ? 'selected' : ''; ?>>Đã duyệt đơn</option>
                <option value="2" <?php echo ($selectedOption == '2') ? 'selected' : ''; ?>>Đã từ chối đơn</option>
            </select>
            <button type="submit" name="capnhatdonhang" class="update-status-order">
                Cập nhật đơn hàng
            </button>
        </div>
    </form>
    <table>
        <thead>
            <tr>
                <th class="numerical_order">STT</th>
                <th class="name-product">Tên sản phẩm</th>
                <th class="price-product">Đơn giá</th>
                <th class="item-quantity">Số lượng</th>
            </tr>
        </thead>
        <?php
        $totalQuantity = 0;
        $totalMoney = 0;
        $i = 0;
        foreach ($orders as $row) {
            $i++;
        ?>
        <tbody>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $row['product_name'] ?></td>
                <td><?= number_format($row['price'], 0, ",", ",") ?>₫</td>
                <td><?= $row['quantity'] ?></td>
                <input type="hidden" name="mahang_xuly" value="<?= $row['order_id'] ?>">
            </tr>
        </tbody>
        <?php
            $totalMoney += ($row['price'] * $row['quantity']);
            $totalQuantity += $row['quantity'];
        }
        ?>
    </table>
    <div
        style="background-color:white; text-align:center; margin: 10px 0 0 28%; width: 50%; border-radius: 15px; padding:20px; color:red; font-weight:bold">
        <label>Tổng SL:</label> <?= $totalQuantity ?> - <label>Tổng tiền:</label>
        <?= number_format($totalMoney, 0, ",", ".") ?>₫
    </div>
</div>
</body>

</html>