<!DOCTYPE html>
<html>

<head>
    <title>Trang quản trị Website</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../layout/styles/admin_style.css">
</head>

<body>
    <?php
        session_start();
        include '../connect_db.php';
        $error = false;
        if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {  
			$sql = "Select `member_id`, `username` from `member` WHERE (`username` ='" . $_POST['username'] . "' AND `password` = md5('" . $_POST['password'] . "'))";  
            $result = mysqli_query($con,$sql);
            // var_dump($sql);exit;
            if (!$result) {
                $error = mysqli_error($con);
            } else {
                $user = mysqli_fetch_assoc($result);
                // var_dump($user);exit;
                $sql = "SELECT * FROM 
                `user_privilege` 
                INNER JOIN `privilege`
                ON `user_privilege`.`privilege_id`= `privilege`.`privilege_id`
                WHERE `user_privilege`.`member_id`= ".$user['member_id'];  
                $userPrivileges = mysqli_query($con,$sql);
                $userPrivileges = mysqli_fetch_all($userPrivileges, MYSQLI_ASSOC);
                // var_dump($userPrivileges);exit;
                if (!empty($userPrivileges)) {
                    $user['privileges'] = array();
                    foreach($userPrivileges as $privilege){
                        $user['privileges'][] = $privilege['url_match'];
                    }
                }
                $_SESSION['current_user'] = $user;
                // echo '<pre>';var_dump($_SESSION['current_user']);exit;
                // header('Location: dashboard.php');
            }
            mysqli_close($con);
            if ($error !== false || $result->num_rows == 0) {
                ?>
                <script language="javascript">alert("Thông tin đăng nhập không chính xác"); window.location="./index.php";</script>
                <?php
                exit;
            }
            ?>
            <?php } ?>
    <?php if (empty($_SESSION['current_user'])) { ?>
    <div id="wrapper">
        <form action="./index.php" id="form-login" method="Post" autocomplete="off">
            <h1 class="form-heading">Đăng nhập Admin</h1>
            <div class="form-group">
                <input type="text" class="form-input" name="username" required>
                <label for="name" class="form-label">Tên đăng nhập</label>
            </div>
            <div class="form-group">
                <input type="password" class="form-input" name="password" required>
                <label for="password" class="form-label">Mật khẩu</label>
            </div>
            <button type="submit" class="form-submit">Đăng nhập</button>
        </form>
    </div>
    <?php
        } else {
            $currentUser = $_SESSION['current_user'];
            header('Location: dashboard.php');
            ?>
    <?php } ?>
</body>

</html>