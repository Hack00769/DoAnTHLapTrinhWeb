<?php
include './header.php';
$config_name = "member";
$config_title = "thành viên";
if (!empty($_SESSION['current_user'])) {
    if (!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)) {
        $_SESSION[$config_name . '_filter'] = $_POST;
        header('Location: ' . $config_name . '_listing.php');
        exit;
    }
    $where = "member_id != " . $_SESSION['current_user']['member_id'];
    // var_dump($where);exit;
    if (!empty($_SESSION[$config_name . 'filter'])) {
        foreach ($_SESSION[$config_name . 'filter'] as $field => $value) {
            if (!empty($value)) {
                switch ($field) {
                    case 'name':
                        $where .= (!empty($where)) ? " AND " . "`" . $field . "` LIKE '%" . $value . "%'" : "`" . $field . "` LIKE '%" . $value . "%'";
                        break;
                    default:
                        $where .= (!empty($where)) ? " AND " . "`" . $field . "` = " . $value . "" : "`" . $field . "` = " . $value . "";
                        break;
                }
            }
        }
        extract($_SESSION[$config_name . 'filter']);
    }
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if (!empty($where)) {
        $totalRecords = mysqli_query($con, "SELECT * FROM `member` where (" . $where . ")");
    } else {
        $totalRecords = mysqli_query($con, "SELECT * FROM `member`");
    }
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if (!empty($where)) {
        $members = mysqli_query($con, "SELECT * FROM `member` where (" . $where . ") ORDER BY `member_id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    } else {
        $members = mysqli_query($con, "SELECT * FROM `member` ORDER BY `member_id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($con);
?>
    <div id="member-listing" class="main-content">
        <h1>Danh sách <?= $config_title ?></h1>
        <div class="listing-items">
            <div class="total-items">
                <span class="note">Có tất cả <strong><?= $totalRecords ?></strong> <?= $config_title ?> trên
                    <strong><?= $totalPages ?></strong> trang</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Tên đăng nhập</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Giới tính</th>
                        <th>Địa chỉ</th>
                        <?php if (checkPrivilege($config_name . '_editing.php?id=0')) { ?>
                            <th>Phân quyền</th>
                        <?php } ?>
                        <?php if (checkPrivilege($config_name . '_editing.php?id=0')) { ?>
                            <th colspan="2">Hành động</th>
                        <?php } ?>
                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_array($members)) {
                ?>
                    <tbody>
                        <tr>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['number_phone'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <?php if (checkPrivilege($config_name . '_editing.php?id=' . $row['member_id'])) { ?>
                                <td>
                                    <a href="./<?= $config_name ?>_privilege.php?id=<?= $row['member_id'] ?>">
                                        <i class="fa-solid fa-user fa-2x"></i>
                                    </a>
                                </td>
                            <?php } ?>
                            <?php if (checkPrivilege($config_name . '_editing.php?id=' . $row['member_id'])) { ?>
                                <td>
                                    <a href="./<?= $config_name ?>_editing.php?id=<?= $row['member_id'] ?>">
                                        <i class="far fa-edit fa-2x" title="Sửa nội dung"></i>
                                    </a>
                                </td>
                            <?php } ?>
                            <?php if (checkPrivilege($config_name . '_editing.php?id=' . $row['member_id'])) { ?>
                                <td>
                                    <a href="./<?= $config_name ?>_delete.php?id=<?= $row['member_id'] ?>">
                                        <i class="fas fa-trash-alt fa-2x" title="Xoá nội dung"></i>
                                    </a>
                                </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                <?php } ?>
                <?php
                //include './pagination.php';
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
    echo '<script language="javascript">
        alert("Đã hết phiên đăng nhập. Vui lòng đăng nhập lại!");
        window.location = "index.php";
    </script>';
<?php } ?>
</body>

</html>