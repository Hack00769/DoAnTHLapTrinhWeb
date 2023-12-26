<?php
include './header.php';
if (!empty($_SESSION['current_user'])) {
    ?>
<div class="main-content">
    <h1>Xóa thành viên</h1>
    <div id="content-box">
        <?php
            $error = false;
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                include '../connect_db.php';
                $result = mysqli_query($con, "DELETE FROM `member` WHERE `member_id` = " . $_GET['id']);
                if (!$result) {
                    $error = "Không thể xóa thành viên.";
                }
                mysqli_close($con);
                if ($error !== false) {
                    ?>
        <?php
            echo '<script language="javascript">alert("Xoá thành viên không thành công!"); window.location="member_listing.php";</script>';
        ?>
        <?php } else { ?>
        <?php
            echo '<script language="javascript">alert("Xoá thành viên thành công!"); window.location="member_listing.php";</script>';
        ?>
        <?php } ?>
        <?php } ?>
    </div>
</div>
<?php
}
?>