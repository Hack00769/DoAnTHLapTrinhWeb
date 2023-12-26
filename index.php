<?php
include './header.php';
include './custom_display_index.php';
include './navbar.php';
?>
<link rel="stylesheet" href="./layout/styles/index.css">
<link rel="stylesheet" href="./layout/styles/pagination.css">
<div class="wrapper row2">
    <section class="hoc container-index clear">
        <div class="center-h1-searchbox">
            <h1 class="list_items">Danh sách sản phẩm</h1>
            <form id="product-search" method="GET">
                <input type="text" class="input-name-product" value="<?= isset($_GET['name']) ? $_GET['name'] : "" ?>"
                    name="name" placeholder="Tìm kiếm sản phẩm" />
            </form>
        </div>
        <div id="filter-box">
            <div class="filter-box-child">
                <select id="sort-box"
                    onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                    <option style="display:none;" value="">Sắp xếp theo</option>
                    <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "desc") { ?> selected <?php } ?>
                        value="?<?= $sortParam ?>field=price&sort=desc">Giá cao đến thấp</option>
                    <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "asc") { ?> selected <?php } ?>
                        value="?<?= $sortParam ?>field=price&sort=asc">Giá thấp đến cao</option>
                </select>
            </div>
        </div>
        <ul class="nospace group intro danhsach">
            <?php
            while ($row = mysqli_fetch_array($products)) {
            ?>
            <li class="one_third">
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
            ?>
        </ul>
    </section>
    <?php
    include "./pagination.php";
    ?>
</div>
<?php
include './footer.php';
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="./alertifyjs/alertify.min.js"></script>
<script src="./fancybox/jquery.fancybox.min.js"></script>
<script src="./javascript/index.js"></script>
</body>

</html>