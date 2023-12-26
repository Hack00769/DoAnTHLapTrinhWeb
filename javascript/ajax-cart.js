function updateQuantity(quantity, productID) {
  if (quantity != "") {
    if (quantity == 0) {
      var confirmDelete = confirm(
        "Số lượng sản phẩm đã giảm xuống 0. Bạn có muốn xóa sản phẩm khỏi giỏ hàng không?"
      );
      if (confirmDelete) {
        // Gọi hàm xóa sản phẩm
        deleteCart(productID);
      } else {
        quantity = 1;
        var quantityInput = document.querySelector(
          'td.product-quantity-cart input[name="quantity[' + productID + ']"]'
        );
        if (quantityInput) {
          quantityInput.value = quantity;
        }
      }
    } else {
      // Tiếp tục xử lý như bình thường nếu số lượng khác 0
      $.ajax({
        type: "POST",
        url: "./process_cart.php?action=update",
        data: $("#cart-form").serializeArray(),
        success: function (response) {
          response = JSON.parse(response);
          if (response.status == 0) {
            //Xoá không thành công
            // Muốn hiện thông báo thay đổi số lượng không thành công thì mở dòng code dưới
            // alert(response.message);
          } else {
            //Xoá thành công
            // Muốn hiện thông báo thay đổi số lượng thành công thì mở dòng code dưới
            // alert(response.message);
            $.get("ajax-cart-content.php", function (cartContentHTML) {
              $("#ajax-cart").html(cartContentHTML);
            });
          }
        },
      });
    }
  }
}

function deleteCart(productID) {
  $.ajax({
    type: "POST",
    url: "./process_cart.php?action=delete",
    data: {
      id: productID,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 0) {
        //Xoá không thành công
        // Muốn hiện thông báo xóa không thành công thì mở dòng code dưới
        alert(response.message);
      } else {
        //Xoá thành công
        // Muốn hiện thông báo xóa thành công thì mở dòng code dưới
        // alert(response.message);
        $.get("ajax-cart-content.php", function (cartContentHTML) {
          $("#ajax-cart").html(cartContentHTML);
        });
      }
    },
  });
}
