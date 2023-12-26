<?php
$config_name = "product";

$order_info = []; // Khởi tạo một mảng trống để tránh lỗi khi chưa có dữ liệu.

if (!empty($_SESSION['current_user'])) {
    $sql = "SELECT orders.name, orders.address, orders.phone, order_detail.*, product.name as product_name
    FROM orders
    INNER JOIN order_detail on orders.order_id = order_detail.order_id
    INNER JOIN product ON product.product_id = order_detail.product_id
    WHERE orders.order_id = " . $_GET['id'];

    $orders = mysqli_query($con, $sql);
    $orders = mysqli_fetch_all($orders, MYSQLI_ASSOC);

    // Lấy thông tin đơn hàng (nếu có)
    $sql_get_order_info = "SELECT * FROM orders WHERE order_id = " . $_GET['id'];
    $result_get_order_info = mysqli_query($con, $sql_get_order_info);
    $order_info = mysqli_fetch_assoc($result_get_order_info);
}

if (isset($_POST['capnhatdonhang'])) {
    $order_id = $_GET['id'];
    $current_status = $order_info['status'] ?? '0';
    $new_status = $_POST['xuly'];

    // Lấy danh sách sản phẩm trong đơn hàng
    $sql_get_order_products = "SELECT * FROM order_detail WHERE order_id = $order_id";
    $result_get_order_products = mysqli_query($con, $sql_get_order_products);
    $order_products = mysqli_fetch_all($result_get_order_products, MYSQLI_ASSOC);

    // Kiểm tra nếu trạng thái mới là "Đã từ chối đơn" và trạng thái hiện tại không phải là "Đã từ chối đơn"
    if ($new_status == 2 && $current_status != 2) {
        // Trả số lượng sản phẩm về như trước khi đặt mua
        foreach ($order_products as $product) {
            $product_id = $product['product_id'];
            $quantity = $product['quantity'];

            // Cập nhật số lượng sản phẩm trong kho
            $sql_update_product_quantity = "UPDATE `product` SET `quantity` = `quantity` + $quantity WHERE `product_id` = $product_id";
            $result_update_product_quantity = mysqli_query($con, $sql_update_product_quantity);
        }
    } elseif ($new_status == 1 && $current_status != 1) {
        // Giảm số lượng sản phẩm trong kho khi đơn hàng được duyệt
        foreach ($order_products as $product) {
            $product_id = $product['product_id'];
            $quantity = $product['quantity'];

            // Cập nhật số lượng sản phẩm trong kho
            $sql_update_product_quantity = "UPDATE `product` SET `quantity` = `quantity` - $quantity WHERE `product_id` = $product_id";
            $result_update_product_quantity = mysqli_query($con, $sql_update_product_quantity);
        }
    }

    // Cập nhật trạng thái đơn hàng
    $sql_update_order_status = "UPDATE `orders` SET `status`= '$new_status' WHERE `order_id` = $order_id";
    $result_update_order_status = mysqli_query($con, $sql_update_order_status);

    // Kiểm tra và thông báo cập nhật trạng thái đơn hàng
    if ($result_update_order_status) {
        echo '<script language="javascript">alert("Đã cập nhật trạng thái đơn hàng"); window.location="./order_listing.php";</script>';
    } else {
        echo '<script language="javascript">alert("Có lỗi xảy ra khi cập nhật trạng thái đơn hàng");</script>';
    }
}

// Xác định giá trị mặc định cho option
$selectedOption = $order_info['status'] ?? '0';
