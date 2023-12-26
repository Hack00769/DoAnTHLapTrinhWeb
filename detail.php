<?php
include './header.php';
include './navbar.php';
$result = mysqli_query($con, "SELECT * FROM `product` WHERE `product_id` = " . $_GET['id']);
$product = mysqli_fetch_assoc($result);
?>
<link rel="stylesheet" type="text/css" href="layout/styles/detail_style.css">

<body>
    <div class="wrapper_detail">
        <div class="container-detail">
            <a class="home" href="index.php">
                << Quay về trang chủ</a>
                    <h2 class="item-detail">Chi tiết sản phẩm</h2>
                    <div id="product-detail">
                        <div id="product-img">
                            <img src="./<?= $product['image'] ?>">
                        </div>
                        <div id="product-info">
                            <h1 class="name_item_detail"><?= $product['name'] ?></h1>
                            <span class="price">Giá:</span>
                            <span class="product-price"><?= number_format($product['price'], 0, ",", ".") ?>₫</span><br />
                            <?php if ($product['quantity'] > 0) { ?>
                                <div class="product-quantity">
                                    <span class="inventory">Tồn kho: <strong><?= $product['quantity'] ?></strong></span>
                                </div>
                                <form id="add-to-cart-form" action="cart.php?action=add" method="POST">
                                    <div class="quantity-container">
                                        <span class="quatity">Số lượng:</span>
                                        <div class="quantity-input">
                                            <button type="button" class="quantity-btn" onclick="decreaseQuantity()">-</button>
                                            <input type="text" class="input_quantity" value="1" name="quantity[<?= $product['product_id'] ?>]" size="2" oninput="updateQuantityInput()" onfocus="clearDefaultQuantity()" onblur="setDefaultQuantity()" />
                                            <button type="button" class="quantity-btn" id="increase-btn" onclick="increaseQuantity()">+</button>
                                        </div>
                                    </div>
                                    <div id="error-message"></div>
                                    <button type="submit" class="btn-order">Thêm sản phẩm</button>
                                </form>
                            <?php } else { ?>
                                <span class="out-of-stock">Hết hàng</span>
                            <?php } ?>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci labore sint quas sed
                                hic iusto perferendis natus, autem veritatis sunt quaerat esse reprehenderit architecto,
                                dolore minima eveniet animi exercitationem vel!
                            </p>
                        </div>
                    </div>
        </div>
    </div>
    <?php
    include './footer.php';
    ?>
    <script src="./jquery/jquery-3.6.0.min.js"></script>
    <script src="./alertifyjs/alertify.min.js"></script>
    <script src="./fancybox/jquery.fancybox.min.js"></script>
    <script src="./jquery/jquery.validate.min.js"></script>

    <script>
        $("#add-to-cart-form").validate({
            rules: {
                "quantity[<?= isset($product['product_id']) ? $product['product_id'] : 0 ?>]": {
                    required: false,
                    remote: {
                        url: "check-quantity.php",
                        type: "post"
                    }
                }
            },
            errorPlacement: function(error, element) {
                error.appendTo("#error-message");
            },
            submitHandler: function(form) {
                $.ajax({
                    type: "POST",
                    url: "./process_cart.php?action=add",
                    data: $(form).serializeArray(),
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.status == 0) { // Mua không thành công
                            displayErrorMessage(response.message);
                        } else { // Mua thành công
                            alertify.success('Đã thêm vào giỏ hàng');
                        }
                    }
                });
            }
        });

        function clearDefaultQuantity() {
            var inputQuantity = document.querySelector('.input_quantity');
            if (inputQuantity.value !== '') {
                inputQuantity.value = '';
            }
        }

        function setDefaultQuantity() {
            var inputQuantity = document.querySelector('.input_quantity');
            if (inputQuantity.value === '') {
                inputQuantity.value = '1';
            }
        }


        function updateQuantityInput() {
            var inputQuantity = document.querySelector('.input_quantity');
            var maxQuantity = <?= $product['quantity'] ?>;

            // Đảm bảo giá trị nhập vào là một số
            var enteredValue = parseInt(inputQuantity.value);

            // Nếu giá trị không phải là một số hoặc là một số âm, đặt giá trị mặc định là rỗng
            if (isNaN(enteredValue) || enteredValue < 1) {
                enteredValue = '';
            }

            // Giữ giá trị nhập vào không vượt quá số lượng tồn kho
            enteredValue = enteredValue === '' ? '' : Math.min(enteredValue, maxQuantity);

            // Cập nhật giá trị trường nhập
            inputQuantity.value = enteredValue;
        }

        function decreaseQuantity() {
            var inputQuantity = document.querySelector('.input_quantity');
            if (inputQuantity.value === '' || inputQuantity.value > 1) {
                inputQuantity.value = inputQuantity.value === '' ? '' : parseInt(inputQuantity.value) - 1;
                updateQuantityInput();
            }
        }

        function increaseQuantity() {
            var inputQuantity = document.querySelector('.input_quantity');
            inputQuantity.value = inputQuantity.value === '' ? 1 : parseInt(inputQuantity.value) + 1;
            updateQuantityInput();
        }
    </script>
</body>

</html>