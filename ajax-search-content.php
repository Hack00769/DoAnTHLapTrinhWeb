<?php
include './connect_db.php';
$a = $_POST['data'];
$sql = "select * from product where name like '%$a%'";
$query = mysqli_query($con, $sql);
$num = mysqli_num_rows($query);
if ($num > 0) {
    while ($row = mysqli_fetch_array($query)) {
?>
        <li class="one_third" style="margin-top: 30px;">
            <a href="detail.php?id=<?= $row['product_id'] ?>">
                <img class="image_item" src="./<?php echo $row['image']; ?>" alt="" />
                <div class="center-information-product">
                    <span class="name_item"><?= $row['name'] ?></span>
                    <span class="price_item"><?= number_format($row['price'], 0, ",", ",") ?>₫</span>
                </div>
            </a>
            <?php if ($row['quantity'] > 0) { ?>
                <form class="quick-buy-form" action="cart.php?action=add" method="POST" style="margin:0">
                    <input type="hidden" value="1" name="quantity[<?= $row['product_id'] ?>]">
                    <button type="submit" class="btn-order-index">Thêm vào giỏ</button>
                </form>
            <?php } else { ?>
                <span class="out-of-stock">Hết hàng</span>
            <?php } ?>
        </li>
<?php
    }
} else {
    // Không có sản phẩm được tìm thấy
    echo '<p class="not-found-message">Không tìm thấy sản phẩm nào với từ khóa "' . htmlspecialchars($a) . '"</p>';
}
?>
<script>
    $(".quick-buy-form").submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "./process_cart.php?action=add",
            data: $(this).serializeArray(),
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 0) { //Mua không thành công
                    // alert(response.message);
                    alertify.error('Thêm vào giỏ hàng thất bại');
                } else { //Mua thành công
                    // alert(response.message);
                    alertify.success('Đã thêm vào giỏ hàng');
                }
                //Sau khi thêm sản phẩm sẽ popup giỏ hàng
                // $('#cart-icon a').trigger('click');
            }
        });
    })
</script>