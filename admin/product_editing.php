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
	if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {
		handleProductFormSubmission();
	} else {
		displayProductForm();
	}
}
?>
</body>

</html>

<?php
function handleProductFormSubmission()
{
	global $con;
	if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price'])) {
		$galleryImages = array();
		if (empty($_POST['name'])) {
			$error = "Bạn phải nhập tên sản phẩm";
		} elseif (empty($_POST['price'])) {
			$error = "Bạn phải nhập giá sản phẩm";
		} elseif (!empty($_POST['price']) && is_numeric(str_replace('.', '', $_POST['price'])) == false) {
			$error = "Giá nhập không hợp lệ";
		}
		if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
			$uploadedFiles = $_FILES['image'];
			$result = uploadFiles($uploadedFiles);
			if (!empty($result['errors'])) {
				$error = $result['errors'];
			} else {
				$image = $result['path'];
			}
		}
		if (!isset($image) && !empty($_POST['image'])) {
			$image = $_POST['image'];
		}
		if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) {
			$uploadedFiles = $_FILES['gallery'];
			$result = uploadFiles($uploadedFiles);
			if (!empty($result['errors'])) {
				$error = $result['errors'];
			} else {
				$galleryImages = $result['uploaded_files'];
			}
		}
		if (!isset($error)) {
			date_default_timezone_set('Asia/Ho_Chi_Minh');
			if ($_GET['action'] == 'edit' && !empty($_GET['id'])) {
				//Cập nhật lại sản phẩm
				$sql = "UPDATE `product` SET `name` = '" . $_POST['name'] . "', `quantity` = '" . $_POST['quantity'] . "',`image` =  '" . $image . "', `price` = " . str_replace('.', '', $_POST['price']) . ", `content` = '" . $_POST['content'] . "', `last_update` =' " . date("Y-m-d H:i:s") . "' WHERE `product`.`product_id` = " . $_GET['id'];
				$result = mysqli_query($con, $sql);
			} else {
				//Thêm sản phẩm
				$result = mysqli_query($con, "INSERT INTO `product` (`product_id`, `name`, `quantity`, `image`, `price`, `content`, `created`, `last_update`) VALUES (NULL, '" . $_POST['name'] . "', '" . $_POST['quantity'] . "','" . $image . "', " . str_replace('.', '', $_POST['price']) . ", '" . $_POST['content'] . "', '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d H:i:s") . "')");
			}
			if ($result) {
?>
				<script type="text/javascript">
					alert("Cập nhật thành công!");
					window.location = "product_listing.php";
				</script>
			<?php
			} else {
				$error = "Có lỗi xảy ra trong quá trình thực hiện.";
			}
		} else {
			echo '<script type="text/javascript">alert("' . $error . '"); window.location="product_editing.php";</script>';
		}
		$successMessage = "Cập nhật thành công!";
		if (!empty($successMessage)) {
			?>
			<script type="text/javascript">
				alert("<?= $successMessage ?>");
				window.location = "product_listing.php";
			</script>
	<?php
		}
	}
	?>
<?php
}

function displayProductForm()
{
	global $con;

	$product = null;

	if (!empty($_GET['id'])) {
		$result = mysqli_query($con, "SELECT * FROM `product` WHERE `product_id` = " . $_GET['id']);
		$product = $result->fetch_assoc();
	}
?>
	<div class="content-right">
		<h1 class="title-editing">
			<?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "Copy thành viên" : "Sửa sản phẩm") : "Thêm sản phẩm" ?>
		</h1>
		<form id="product-form" method="POST" action="<?= (!empty($product) && !isset($_GET['task'])) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>" enctype="multipart/form-data">
			<div class="wrap-field">
				<label>Tên sản phẩm: </label>
				<input type="text" name="name" value="<?= (!empty($product) ? $product['name'] : "") ?>" />
			</div>
			<div class="wrap-field">
				<label>Giá sản phẩm: </label>
				<input type="text" name="price" value="<?= (!empty($product) ? number_format($product['price'], 0, ",", ".") : "") ?>" />
			</div>
			<div class="wrap-field">
				<label>Tồn kho: </label>
				<input type="text" name="quantity" value="<?= (!empty($product) ? $product['quantity'] : "") ?>" />
			</div>
			<div class="wrap-field">
				<label>Ảnh đại diện: </label>
				<div class="right-wrap-field">
					<?php if (!empty($product['image'])) { ?>
						<img src="../<?= $product['image'] ?>" /><br />
						<input type="hidden" name="image" value="<?= $product['image'] ?>" />
					<?php } ?>
					<input type="file" name="image" />
				</div>
			</div>
			<div class="wrap-field">
				<label>Nội dung: </label>
				<textarea name="content" id="product-content"><?= (!empty($product) ? $product['content'] : "") ?>
            </textarea>
			</div>
			<div class="button_submit">
				<button type="submit"><i class="far fa-save fa-1x"></i> Lưu nội dung</button>
			</div>
		</form>
	</div>
	<script>
		CKEDITOR.replace('product-content');
	</script>
<?php
}
?>