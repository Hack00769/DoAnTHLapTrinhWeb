<?php
include './header.php';
if (!empty($_SESSION['current_user'])) {
?>
    <div class="main-content">
        <h1>Thông tin hệ thống</h1>
        <div class="listing-items">
            <!-- <img style="max-width: 100%;" src="../images/chart.png" />
            <div class="clear-both"></div> -->
            <h2 class="welcome">Chào mừng admin quay trở lại</h2>
        </div>
    </div>
<?php
}
?>