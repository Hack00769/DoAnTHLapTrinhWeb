<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<link rel="stylesheet" href="./layout/styles/checkout-cart.css">
<div id="ajax-cart">
    <?php
    include './ajax-cart-content.php';
    ?>
</div>
<script src="./jquery/jquery-3.6.0.min.js"></script>
<script src="./alertifyjs/alertify.min.js"></script>
<script src="./fancybox/jquery.fancybox.min.js"></script>
<script src="./jquery/jquery.validate.min.js"></script>
<script src="./javascript/ajax-cart.js"></script>