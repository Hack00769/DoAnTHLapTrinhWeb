<?php session_start();?>
<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
	//ket noi csdl
	include './connect_db.php';

	//lay du lieu tu form goi len
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	// echo '<pre>';
	// var_dump($con);
	// exit;

	//truy van du lieu - tim username va passwprd nhan duoc co trong csdl k?
	$sql = "select * from member where username='$username' and password='$password'";

	//thuc thi truy van
	$result = mysqli_query($con, $sql);
	
	if ($row = mysqli_num_rows($result) > 0) {
		header("location:index.php");
		$row = mysqli_fetch_assoc($result);
	
		$_SESSION["username"] = $row["username"];
		$_SESSION['isLoggin'] = true;
	} else {
		echo '<script language="javascript">alert("Tài khoản chưa được đăng kí hoặc sai thông tin!"); window.location="login.php";</script>';
	}
}
?>