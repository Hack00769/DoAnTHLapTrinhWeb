<?php
session_start();
include './connect_db.php';
$GLOBALS['connection'] = $con;
switch ($_GET['action']) {
    case "add":
        $result = update_cart(true);
        echo json_encode($result);
        break;
    case "update":
        $result = update_cart();
        echo json_encode($result);
        break;
    case "delete":
        if (isset($_POST['id'])) {
            unset($_SESSION["cart"][$_POST['id']]);
        }
        echo json_encode(array(
            'status' => 1,
            'message' => 'Xoá sản phẩm thành công'
        ));
        break;
    case "submit":
        if (empty($_SESSION["cart"])) {
            echo json_encode(array(
                'status' => 0,
                'message' => "Giỏ hàng rỗng. Bạn vui lòng lựa chọn sản phẩm vào giỏ hàng"
            ));
            exit;
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $products = mysqli_query($con, "SELECT * FROM `product` WHERE `product_id` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
        $total = 0;
        $orderProducts = array();
        $updateString = "";
        $changeQuantity = false;
        // var_dump($GLOBALS['changed_cart']);
        while ($row = mysqli_fetch_array($products)) {
            $orderProducts[] = $row;
            if ($_SESSION["cart"][$row['product_id']] > $row['quantity']) { //Thay đổi số lượng sản phẩm trong giỏ hàng
                $_SESSION["cart"][$row['product_id']] = $row['quantity'];
                $changeQuantity = true;
            } else {
                $total += $row['price'] * $_SESSION["cart"][$row['product_id']];
                $updateString .= " WHEN `product_id` = " . $row['product_id'] . " THEN quantity - " . $_SESSION["cart"][$row['product_id']]; //Trừ đi sản phẩm tồn kho
            }
        }
        // var_dump($updateString);exit;
        if ($changeQuantity == false) {
            $sql = "UPDATE `product` SET `quantity` = CASE " . $updateString . " END WHERE `product_id` in (" . implode(",", array_keys($_SESSION["cart"])) . ")";
            $updateQuantity = mysqli_query($con, $sql);
            // Chỗ này không có dòng note
            $insertOrder = mysqli_query($con, "INSERT INTO `orders` ( `name`, `phone`, `address`, `total`, `create_time`, `status`) VALUES ( '" . $_POST['name'] . "', '" . $_POST['phone'] . "', '" . $_POST['address'] . "', '" . $total . "', '" . date("Y-m-d H:i:s") . "', '" . $_POST['status'] . "')");
            $orderID = $con->insert_id;
            $insertString = "";
            foreach ($orderProducts as $key => $product) {
                $insertString .= "(NULL, '" . $orderID . "', '" . $product['product_id'] . "', '" . $_SESSION["cart"][$product['product_id']] . "', '" . $product['price'] . "', '" . date("Y-m-d H:i:s") . "')";
                if ($key != count($orderProducts) - 1) {
                    $insertString .= ",";
                }
            }
            $insertOrder = mysqli_query($con, "INSERT INTO `order_detail` (`detail_id`, `order_id`, `product_id`, `quantity`, `price`, `create_time`) VALUES " . $insertString);
            unset($_SESSION['cart']);
            echo json_encode(array(
                'status' => 1,
                'redirect' => './order_success.php'
            ));
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => "Đặt hàng không thành công do lượng tồn kho không đủ. Vui lòng kiểm tra lại giỏ hàng"
            ));
        }
        break;
    default:
        break;
}
function update_cart($add = false)
{
    $changeQuantity = false;
    foreach ($_POST['quantity'] as $id => $quantity) {
        if ($quantity == 0) {
            unset($_SESSION["cart"][$id]);
        } else {
            if (!isset($_SESSION["cart"][$id])) {
                $_SESSION["cart"][$id] = 0;
            }
            if ($add) {
                $_SESSION["cart"][$id] += $quantity;
            } else {
                $_SESSION["cart"][$id] = $quantity;
            }
        }
        // Kiểm tra số lượng sản phẩm tồn kho
        $addProduct = mysqli_query($GLOBALS['connection'], "SELECT `quantity` FROM `product` WHERE `product_id` = " . $id);
        $addProduct = mysqli_fetch_assoc($addProduct);
        if ($_SESSION["cart"][$id] > $addProduct['quantity']) {
            $_SESSION["cart"][$id] = $addProduct['quantity'];
            if ($add) {
                return array(
                    'status' => 0,
                    'message' => "Số lượng sản phẩm tồn kho chỉ còn " . $addProduct['quantity'] . " sản phẩm. Bạn vui lòng kiểm tra lại giỏ hàng."
                );
            } else {
                $changeQuantity = true;
            }
        }
        if ($add) {
            return array(
                'status' => 1,
                'message' => "Thêm vào giỏ hàng thành công"
            );
        }
    }
    if ($changeQuantity) {
        return array(
            'status' => 1,
            'message' => "Số lượng sản phẩm trong giỏ hàng đã thay đổi do số lượng tồn kho không đủ. Bạn vui lòng kiểm tra lại giỏ hàng"
        );
    } else {
        return array(
            'status' => 1,
            'message' => "Cập nhật giỏ hàng thành công"
        );
    }
}
