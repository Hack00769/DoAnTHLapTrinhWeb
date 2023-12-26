<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../layout/styles/bill_style.css">
    <title>Chi tiết đơn hàng</title>
</head>

<body>
    <?php 
    session_start();
    if(!empty($_SESSION['current_user'])){
    include '../connect_db.php'; 
    $sql = "SELECT orders.name, orders.address, orders.phone, order_detail.*, product.name as product_name
    FROM orders
    INNER JOIN order_detail on orders.order_id = order_detail.order_id
    INNER JOIN product ON product.product_id = order_detail.product_id
    WHERE orders.order_id = " . $_GET['id'];
    $orders = mysqli_query($con, $sql);
    $orders = mysqli_fetch_all($orders, MYSQLI_ASSOC);
    // echo '<pre>';var_dump($orders);exit;
    }   
    ?>
    <div id="order-detail-wrapper">
        <div id="order-detail">
            <h1>Chi tiết đơn hàng</h1>
            <label>Người nhận: </label><span> <?= $orders[0]['name'] ?></span><br />
            <label>Điện thoại: </label><span> <?= $orders[0]['phone'] ?></span><br />
            <label>Địa chỉ: </label><span> <?= $orders[0]['address'] ?></span><br />
            <label>Ngày đặt hàng: </label><span> <?= $orders[0]['create_time'] ?></span><br />
            <hr />
            <h3 style="margin:0 0 5px 0;">Danh sách sản phẩm</h3>
            <ul>
                <?php
                    $totalQuantity = 0;
                    $totalMoney = 0;
                    foreach ($orders as $row) {
                        ?>
                <li>
                    <span class="item-name"><?= $row['product_name'] ?></span>
                    <span class="item-quantity"> - SL: <?= $row['quantity'] ?> sản phẩm</span>
                </li>
                <?php
                        $totalMoney += ($row['price'] * $row['quantity']);
                        $totalQuantity += $row['quantity'];
                    }
                    ?>
            </ul>
            <hr />
            <label>Tổng SL:</label> <?= $totalQuantity ?> - <label>Tổng tiền:</label>
            <?= number_format($totalMoney, 0, ",", ".") ?> đ
        </div>
    </div>
</body>

</html>