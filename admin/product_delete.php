<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    ?>
<div class="main-content">
    <h1>Xóa sản phẩm</h1>
    <div id="content-box">
        <?php
            $error = false;
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                include '../connect_db.php';
                $result = mysqli_query($con, "DELETE FROM `product` WHERE `product_id` = " . $_GET['id']);
                if (!$result) {
                    $error = "Không thể xóa sản phẩm.";
                }
                mysqli_close($con);
                if ($error !== false) {
                    ?>
        <?php
            echo '<script language="javascript">alert("Xoá sản phẩm không thành công!"); window.location="product_listing.php";</script>';
        ?>
        <?php } else { ?>
        <?php
            echo '<script language="javascript">alert("Xoá sản phẩm thành công!"); window.location="product_listing.php";</script>';
        ?>
        <?php } ?>
        <?php } ?>
    </div>
</div>
<?php
}
?>