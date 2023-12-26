$("#cart-form").validate({
  rules: {
    name: {
      required: true,
    },
    phone: {
      required: true,
      minlength: 10,
    },
    address: {
      required: true,
    },
  },
  messages: {
    name: {
      required: "Bạn phải nhập họ tên",
    },
    phone: {
      required: "Bạn phải nhập số điện thoại",
      minlength: "Số điện thoại phải có 10 số",
    },
    address: {
      required: "Bạn phải nhập địa chỉ",
    },
  },
  submitHandler: function (form) {
    $.ajax({
      type: "POST",
      url: "./process_cart.php?action=submit",
      data: $(form).serializeArray(),
      success: function (response) {
        try {
          var data = JSON.parse(response);
          if (data.status === 1) {
            window.location.href = data.redirect;
          } else {
            // Xử lý trường hợp lỗi nếu cần
            console.error(data.message);
          }
        } catch (e) {
          console.error("Invalid JSON response:", response);
        }
      },
    });
  },
});
