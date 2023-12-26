<?php
include './header.php';

function showAlert($message)
{
    echo "<script language='javascript'>alert('$message'); window.location='member_editing.php';</script>";
}

if (!empty($_SESSION['current_user'])) {
?>
    <?php
    if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {
        if (
            isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['number_phone'], $_POST['gender'], $_POST['address']) &&
            !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['number_phone']) && !empty($_POST['gender']) && !empty($_POST['address'])
        ) {
            // Use Prepared Statements to prevent SQL Injection
            $stmt = $con->prepare("SELECT * FROM `member` WHERE `username` = ? AND member_id != ?");
            $stmt->bind_param("si", $_POST['username'], $_GET['id']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows != 0) {
                showAlert("Thành viên đã tồn tại");
            } else {
                if ($_GET['action'] == 'edit' && !empty($_GET['id'])) {
                    $sql = "UPDATE `member` SET `first_name` = ?, `last_name` = ?, `username` = ?, `password` = MD5(?), `email` = ?, `number_phone` = ?, `gender` = ?, `address` = ? WHERE `member`.`member_id` = ?;";
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("ssssssssi", $_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['password'], $_POST['email'], $_POST['number_phone'], $_POST['gender'], $_POST['address'], $_GET['id']);
                } else {
                    $sql = "INSERT INTO `member` (`member_id`, `first_name`, `last_name`, `username`, `password`, `email`, `number_phone`, `gender`, `address`) VALUES (NULL, ?, ?, ?, MD5(?), ?, ?, ?, ?)";
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("ssssssss", $_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['password'], $_POST['email'], $_POST['number_phone'], $_POST['gender'], $_POST['address']);
                }

                $stmt->execute();
                $stmt->close();

                showAlert("Cập nhật thành công!");
                header("Location: member_listing.php");
                exit;
            }
        } else {
            showAlert("Bạn chưa nhập thông tin thành viên");
        }
    } else {
        if (!empty($_GET['id'])) {
            $stmt = $con->prepare("SELECT * FROM `member` WHERE `member_id` = ?");
            $stmt->bind_param("i", $_GET['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            $stmt->close();
        }
        $actionUrl = "?action=add";  // Mặc định là thêm thành viên

        if (!empty($user) && isset($_GET['id']) && !isset($_GET['task'])) {
            $actionUrl = "?action=edit&id=" . $_GET['id'];  // Nếu có ID, thì là chỉnh sửa
        }
    ?>
        <div class="content-right">
            <h1 class="title-editing">
                <?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "Copy thành viên" : "Sửa thành viên") : "Thêm thành viên" ?>
            </h1>
            <form id="product-form" method="POST" action="<?= (!empty($user) && isset($_GET['id']) && !isset($_GET['task'])) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>" enctype="multipart/form-data">
                <div class="wrap-field">
                    <label>Tên đăng nhập:</label>
                    <input type="text" name="username" value="<?= (!empty($user) ? $user['username'] : "") ?>" />
                </div>
                <div class="wrap-field">
                    <label>Mật khẩu:</label>
                    <input type="password" name="password" value="" />
                </div>
                <div class="wrap-field">
                    <label>Họ:</label>
                    <input type="text" name="first_name" value="<?= (!empty($user) ? $user['first_name'] : "") ?>" />
                </div>
                <div class="wrap-field">
                    <label>Tên:</label>
                    <input type="text" name="last_name" value="<?= (!empty($user) ? $user['last_name'] : "") ?>" />
                </div>
                <div class="wrap-field">
                    <label>Email:</label>
                    <input type="email" name="email" value="<?= (!empty($user) ? $user['email'] : "") ?>" />
                </div>
                <div class="wrap-field">
                    <label>SĐT:</label>
                    <input type="tel" name="number_phone" value="<?= (!empty($user) ? $user['number_phone'] : "") ?>" />
                </div>
                <div class="wrap-field">
                    <div class="form-check-inline">
                        <label for="gender" class="form-check-label">Nam</label>
                        <input type="radio" name="gender" id="male" value="Nam" class="form-check-input" <?= (!empty($user) && $user['gender'] == 'Nam') ? 'checked' : '' ?>>
                    </div>
                    <div class="form-check-inline">
                        <label for="gender" class="form-check-label">Nữ</label>
                        <input type="radio" name="gender" id="female" value="Nữ" class="form-check-input" <?= (!empty($user) && $user['gender'] == 'Nữ') ? 'checked' : '' ?>>
                    </div>
                </div>
                <div class="wrap-field">
                    <label>Địa chỉ:</label>
                    <input type="text" name="address" value="<?= (!empty($user) ? $user['address'] : "") ?>" />
                </div>
                <div class="button_submit">
                    <button type="submit"><i class="far fa-save fa-1x"></i> Lưu nội dung</button>
                </div>
            </form>
        </div>
    <?php
    }
    ?>
<?php
}
?>