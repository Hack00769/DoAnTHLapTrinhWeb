$(".quick-buy-form").submit(function (event) {
  event.preventDefault();
  $.ajax({
    type: "POST",
    url: "./process_cart.php?action=add",
    data: $(this).serializeArray(),
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 0) {
        //Mua không thành công
        // alert(response.message);
        alertify.error("Thêm vào giỏ hàng thất bại");
      } else {
        //Mua thành công
        // alert(response.message);
        alertify.success("Đã thêm vào giỏ hàng");
      }
      //Sau khi thêm sản phẩm sẽ popup giỏ hàng
      // $('#cart-icon a').trigger('click');
    },
  });
});
