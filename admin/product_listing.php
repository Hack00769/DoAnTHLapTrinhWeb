<?php
include './header.php';

if (empty($_SESSION['current_user'])) {
?>
<script type="text/javascript">
alert("Đã hết phiên đăng nhập. Vui lòng đăng nhập lại!");
window.location = "index.php";
</script>
<?php
} else {
    displayProductListing();
}

function displayProductListing()
{
    global $con;

    $itemPerPage = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $currentPage = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($currentPage - 1) * $itemPerPage;

    $totalRecordsQuery = mysqli_query($con, "SELECT * FROM `product`");
    $totalRecords = $totalRecordsQuery->num_rows;
    $totalPages = ceil($totalRecords / $itemPerPage);

    $productsQuery = mysqli_query($con, "SELECT * FROM `product` ORDER BY `product_id` DESC LIMIT $offset, $itemPerPage");
    mysqli_close($con);
?>
<div class="main-content">
    <h1>Danh sách sản phẩm</h1>

    <?php if (checkPrivilege('product_editing.php')) { ?>
    <div class="buttons">
        <a href="./product_editing.php" class="add-product">Thêm sản phẩm</a>
    </div>
    <?php } ?>

    <div class="total-items">
        <span class="note">Có tất cả <strong><?= $totalRecords ?></strong> sản phẩm trên
            <strong><?= $totalPages ?></strong> trang</span>
    </div>

    <table>
        <thead>
            <tr>
                <th class="image">Ảnh</th>
                <th class="name-product">Tên sản phẩm</th>
                <th class="price">Giá sản phẩm</th>
                <th class="quantity">Tồn kho</th>
                <th class="last-updated">Ngày cập nhật</th>
                <?php if (checkPrivilege('product_editing.php?id=0')) { ?>
                <th class="edit">Sửa</th>
                <?php } ?>
                <?php if (checkPrivilege('product_delete.php?id=0')) { ?>
                <th class="delete">Xoá</th>
                <?php } ?>
            </tr>
        </thead>

        <?php while ($row = mysqli_fetch_array($productsQuery)) { ?>
        <tbody>
            <tr>
                <td><img src="../<?= $row['image'] ?>" /></td>
                <td><?= $row['name'] ?></td>
                <td><?= number_format($row['price'], 0, ",", ",") ?>₫</td>
                <td><?= $row['quantity'] ?></td>
                <td><?= $row['last_update'] ?></td>
                <?php if (checkPrivilege('product_editing.php?id=' . $row['product_id'])) { ?>
                <td><a href="./product_editing.php?id=<?= $row['product_id'] ?>"><i class="far fa-edit fa-2x"
                            title="Sửa nội dung"></i></a></td>
                <?php } ?>
                <?php if (checkPrivilege('product_delete.php?id=' . $row['product_id'])) { ?>
                <td><a href="./product_delete.php?id=<?= $row['product_id'] ?>"><i class="fas fa-trash-alt fa-2x"
                            title="Xoá nội dung"></i></a></td>
                <?php } ?>
            </tr>
        </tbody>
        <?php } ?>
    </table>
</div>
<?php
}
?>
<?php if (!empty($_SESSION['current_user'])) { ?>
</div>
<?php } else { ?>
<script type="text/javascript">
alert("Đã hết phiên đăng nhập. Vui lòng đăng nhập lại!");
window.location = "index.php";
</script>
<?php } ?>
</body>

</html>