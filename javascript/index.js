$(".quick-buy-form").submit(function (event) {
  event.preventDefault();
  $.ajax({
    type: "POST",
    url: "./process_cart.php?action=add",
    data: $(this).serializeArray(),
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 0) {
        alertify.error("Thêm vào giỏ hàng thất bại");
      } else {
        alertify.success("Đã thêm vào giỏ hàng");
      }
    },
  });
});

$(".input-name-product").keyup(function () {
  var txt = $(".input-name-product").val();
  $.post(
    "./ajax-search-content.php",
    {
      data: txt,
    },
    function (data) {
      $(".danhsach").html(data);
    }
  );
});

$(document).ready(function () {
  $(".input-name-product").on("input", function () {
    var searchValue = $(this).val().trim();

    if (searchValue !== "") {
      $.ajax({
        url: "ajax-search-content.php",
        type: "POST",
        data: {
          data: searchValue,
        },
        success: function (response) {
          $(".danhsach").html(response);

          // Kiểm tra xem có sản phẩm được tìm thấy hay không
          if (response.indexOf("Không tìm thấy sản phẩm") !== -1) {
            // Ẩn các phần sắp xếp và phân trang
            $("#filter-box").hide();
            $("#pagination").hide();
          } else {
            // Ẩn các phần sắp xếp và phân trang
            $("#filter-box").hide();
            $("#pagination").hide();
          }
        },
      });
    } else {
      window.location.href = window.location.pathname;
    }
  });
});
