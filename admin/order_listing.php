<?php
include './header.php';
$config_name = "product";
$config_title = "hoá đơn";
if (!empty($_SESSION['current_user'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    $totalRecords = mysqli_query($con, "SELECT * FROM `orders`");
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    $orders = mysqli_query($con, "SELECT * FROM `orders` ORDER BY `order_id` DESC");
    mysqli_close($con);
?>
<div class="main-content">
    <h1>Danh sách hoá đơn</h1>
    <div class="product-items">
        <div class="listing-search">
            <form id="<?= $config_name ?>-search-form" action="<?= $config_name ?>_listing.php?action=search"
                method="POST">
                <!-- <fieldset>
                        <legend>Tìm kiếm <?= $config_title ?>:</legend>
                        ID: <input type="text" name="id" value="<?= !empty($id) ? $id : "" ?>" />
                        Tên <?= $config_title ?>: <input type="text" name="name" value="<?= !empty($name) ? $name : "" ?>" />
                        <input type="submit" value="Tìm" />
                    </fieldset> -->
            </form>
        </div>
        <div class="total-items">
            <span class="note">Có tất cả <strong><?= $totalRecords ?></strong> <?= $config_title ?> trên
                <strong><?= $totalPages ?></strong> trang</span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="name-receiver">Tên người nhận</th>
                    <th class="phone-receiver">Số điện thoại</th>
                    <th class="address-receiver">Địa chỉ</th>
                    <th class="time-order">Ngày đặt hàng</th>
                    <th class="status-order">Tình trạng đơn hàng</th>
                    <?php if (checkPrivilege($config_name . '_editing.php?id=0')) { ?>
                    <th>Xem chi tiết</th>
                    <th>In hóa đơn</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($orders)) { ?>
                <tr>
                    <td><?= $row['order_id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?php echo $row['create_time'] ?></td>
                    <td>
                        <?php
                                if ($row['status'] == 0) {
                                    echo 'Đang chờ xử lý';
                                } elseif ($row['status'] == 1) {
                                    echo 'Đã duyệt đơn hàng';
                                } else {
                                    echo 'Từ chối đơn hàng';
                                }
                                ?>
                    </td>
                    <?php if (checkPrivilege($config_name . '_editing.php?id=' . $row['order_id'])) { ?>
                    <td>
                        <a href="./order_detail.php?id=<?= $row['order_id'] ?>"><i
                                class="fa-solid fa-eye fa-2x"></i></a>
                    </td>

                    <td>
                        <?php if ($row['status'] == 0 || $row['status'] == 2) { ?>
                        <i class="fa-solid fa-ban fa-2x" style="color: red;"></i>
                        <?php } else { ?>
                        <a href="./order_printing.php?id=<?= $row['order_id'] ?>">
                            <i class="fa-solid fa-print fa-2x"></i>
                        </a>
                        <?php } ?>
                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
            ?>
    </div>
</div>
<?php
}
?>
<?php if (!empty($_SESSION['current_user'])) { ?>
</div>
</div>
<?php } else { ?>
<script language="javascript">
alert("Đã hết phiên đăng nhập. Vui lòng đăng nhập lại!");
window.location = "index.php";
</script>;
<?php } ?>
</body>

</html>