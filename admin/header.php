<!DOCTYPE html>
<html>

<head>
    <title>Trang quản trị Website</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../layout/styles/admin_style.css">
    <script src="resources/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="../fontawesome-free-6.1.1-web/css/all.css">
</head>

<body>
    <?php
    session_start();
    include '../connect_db.php';
    include './function.php';
    $regexResult = checkPrivilege();
    if (!$regexResult) {
        echo '<script language="javascript">alert("Bạn không có quyền truy cập chức năng này!"); window.location="dashboard.php";</script>';
        exit;
    }
    if (!empty($_SESSION['current_user'])) { //Kiểm tra xem đã đăng nhập chưa?
    ?>
        <div id="admin-heading-panel">
            <div class="container">
                <div class="left-panel">
                    Xin chào <span>Admin</span>
                </div>
                <div class="right-panel">
                    <i class="fa-solid fa-house"></i>
                    <a href="../index.php">Trang chủ</a>
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <a href="logout.php">Đăng xuất</a>
                </div>
            </div>
        </div>
        <div id="content-wrapper">
            <div class="container">
                <div class="left-menu">
                    <div class="menu-heading">Admin Menu</div>
                    <div class="menu-items">
                        <ul>
                            <?php if (checkPrivilege('./dashboard.php')) { ?>
                                <li><a href="./dashboard.php">Thông tin hệ thống</a></li>
                            <?php } ?>
                            <?php if (checkPrivilege('./product_listing.php')) { ?>
                                <li><a href="./product_listing.php">Quản lí sản phẩm</a></li>
                            <?php } ?>
                            <?php if (checkPrivilege('./member_listing.php')) { ?>
                                <li><a href="./member_listing.php">Quản lí thành viên</a></li>
                            <?php } ?>
                            <?php if (checkPrivilege('./order_listing.php')) { ?>
                                <li><a href="./order_listing.php">Quản lí đơn hàng</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>