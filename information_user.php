<?php
include './header.php';
include './information_user_process.php';
?>
<div class="wrapper_of_information">
    <h2 class="">Thông tin khách hàng</h2>
    <form action="" method="post">
        <div class="wrapper_row">
            <div class="row">
                <label for="first-name" class="evenly">Tên</label>
                <input type="text" name="first-name" value="" class="form_control">
                <label for="last_name" class="evenly left_alignment">Họ</label>
                <input type="text" name="last_name" value="" class="form_control">
            </div>
            <div class="row">
                <label for="email" class="evenly">Email</label>
                <input type="email" name="email" value="" class="form_control">
                <label for="phone_number" class="evenly left_alignment">SĐT</label>
                <input type="text" name="phone_number" value="" class="form_control">
            </div>
            <label for="change_pasword" class="evenly text-align-center">Thay đổi mật khẩu</label>
            <input type="text" name="change_pasword" value="" class="form_control margin-auto">
        </div>
        <button type="submit" class="update" name="update_click">Cập nhật thông tin</button>
    </form>
</div>
<?php
include './footer.php';
?>