<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./bootstrap-5.1.3-dist/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="layout/styles/login_style.css">
	<title>Đăng nhập</title>
</head>

<body>
	<div class="wrapper">
		<div class="container">
			<div class="row justify-content-around">
				<form action="login_process.php" method="post" class="col-md-6 bg-light p-3 my-3">
					<h1 class="text-center text-uppercase h3 py-3">Đăng nhập tài khoản</h1>
					<div class="form-group">
						<label for="username">Tên đăng nhập</label>
						<input type="text" name="username" id="username" class="form-control my-2" required>
					</div>
					<div class="form-group">
						<label for="password">Mật khẩu</label>
						<input type="password" name="password" id="password" class="form-control my-2" required>
					</div>
					<input type="submit" value="Đăng nhập" name="btn-reg" class="btn-primary btn btn-block mt-2">
				</form>
			</div>
		</div>
	</div>
	<!-- <script src="//code.jquery.com/jquery.js"></script> -->
</body>
</html>
