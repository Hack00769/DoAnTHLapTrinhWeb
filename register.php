<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./bootstrap-5.1.3-dist/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="./layout/styles/register_style.css">
	<title>Đăng ký thành viên</title>
</head>
<body>
	<div class="wrapper">
		<div class="container">
			<div class="row justify-content-around">
				<form action="register_process.php" method="post" class="col-md-6 bg-light p-3 my-3">
					<h1 class="text-center text-uppercase h3 py-3">Đăng ký tài khoản</h1>
					<div class="form-group">
						<label for="first_name">Họ</label>
						<input type="text" name="first_name" id="first_name" class="form-control my-2" required>
					</div>
					<div class="form-group">
						<label for="last_name">Tên</label>
						<input type="text" name="last_name" id="last_name" class="form-control my-2" required>
					</div>
					<div class="form-group">
						<label for="username">Tên đăng nhập</label>
						<input type="text" name="username" id="username" class="form-control my-2" required>
					</div>
					<div class="form-group">
						<label for="password">Mật khẩu</label>
						<input type="password" name="password" id="password" class="form-control my-2" required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" class="form-control my-2" required>
					</div>
					<div class="form-group">
						<label for="number_phone">Số điện thoại</label>
						<input type="tel" name="number_phone" id="number_phone" class="form-control my-2" required>
					</div>
					<div class="form-group">
						<label for="gender">Giới tính</label>
							<div>
								<div class="form-check form-check-inline ">
									<input type="radio" name="gender" id="male" value="Nam" class="form-check-input" checked>
									<label for="gender" class="form-check-label">Nam</label>
								</div>
								<div class="form-check form-check-inline ">
									<input type="radio" name="gender" id="female" value="Nữ" class="form-check-input">
									<label for="gender" class="form-check-label">Nữ</label>
								</div>
							</div>
					</div>
					<div class="form-group my-2">
						<label for="address">Địa chỉ</label>
						<input type="text" name="address" id="address" class="form-control my-2" required>
					</div>
					<input type="submit" value="Đăng ký" name="btn-reg" class="btn-primary btn btn-block mt-2">
				</form>
			</div>
		</div>
	</div>
</body>
</html>