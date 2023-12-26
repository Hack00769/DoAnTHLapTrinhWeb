<?php
include './connect_db.php';
session_start();
$id = (array_keys($_POST['quantity']))[0];
$quantity = $_POST['quantity'][$id];

// Lấy số lượng tồn kho khả dụng
$addProduct = mysqli_query($con, "SELECT `quantity` FROM `product` WHERE `product_id` = " . $id);
$addProduct = mysqli_fetch_assoc($addProduct);

// Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
// Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
if (isset($_SESSION["cart"][$id])) {
    $quantity += $_SESSION["cart"][$id];

    // Kiểm tra xem tổng số lượng (bao gồm số lượng trong giỏ hàng) có vượt quá tồn kho không
    if ($quantity > $addProduct['quantity']) {
        $cartQuantity = $_SESSION["cart"][$id];
        echo json_encode("Bạn đã có {$cartQuantity} sản phẩm trong giỏ hàng. Không thể thêm số lượng sản phẩm đã chọn vào giỏ hàng vì sẽ vượt quá giới hạn tồn kho.");
    } else {
        echo json_encode(true);
    }
} else {
    // Không cần kiểm tra số lượng khi sản phẩm chưa có trong giỏ hàng
    echo json_encode(true);
}
