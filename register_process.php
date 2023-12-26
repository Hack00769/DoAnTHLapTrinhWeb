<?php
header('Content-Type: text/html; charset=utf-8');
require './connect_db.php';

// Dùng isset để kiểm tra Form
if (isset($_POST['btn-reg'])) {
	// var_dump($_POST);exit;
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$number_phone = $_POST['number_phone'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	if (!empty($first_name)&&!empty($last_name)&&!empty($username)&&!empty($password)&&!empty($email)&&!empty($number_phone)&&!empty($gender)&&!empty($address)) {
		// Kiểm tra username hoặc email có bị trùng hay không
		$sql = "SELECT * FROM member WHERE username = '$username'";

		// Thực thi câu truy vấn
		$result = mysqli_query($con, $sql);

		// Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
		if (mysqli_num_rows($result) > 0) {

		// Sử dụng javascript để thông báo
		echo '<script language="javascript">alert("Bị trùng tên hoặc chưa nhập tên!"); window.location="register.php";</script>';
		
		// Dừng chương trình
		die();
		} else {
			$sql = "INSERT INTO `member` (`first_name`, `last_name`, `username`, `password`, `email`, `number_phone`, `gender`, `address`) VALUES ('$first_name','$last_name','$username',md5('$password'),'$email','$number_phone','$gender','$address')";
			$con->query($sql);
			echo '<script language="javascript">alert("Đăng kí thành công"); window.location="login.php";</script>';
		}
	}else{
		echo '<script language="javascript">alert("Bị trùng tên hoặc chưa nhập tên!"); window.location="register.php";</script>';
	}
}
?>