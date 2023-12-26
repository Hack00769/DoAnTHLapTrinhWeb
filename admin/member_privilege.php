<?php
include './header.php';

if (!empty($_SESSION['current_user'])) {
    // $user_id = !empty($_GET['id']) ? $_GET['id'] : null;
    // print_r($_GET['id']);
    if (!empty($_GET['action']) && $_GET['action'] == "save") {
        $data = $_POST;
        $deleteOldPrivileges = mysqli_query($con, "DELETE FROM `user_privilege` WHERE `member_id` = " . $data['user_id']);

        $insertValues = [];
        foreach ($data['privileges'] as $insertPrivilege) {
            if (is_array($insertPrivilege)) {
                foreach ($insertPrivilege as $value) {
                    $insertValues[] = "(NULL, " . $data['user_id'] . ", " . $value . ", '1596502615', '1596502615')";
                }
            } else {
                $insertValues[] = "(NULL, " . $data['user_id'] . ", " . $insertPrivilege . ", '1596502615', '1596502615')";
            }
        }

        if (!empty($insertValues)) {
            $sql = "INSERT INTO `user_privilege` (`user_privilege_id`, `member_id`, `privilege_id`, `created_time`, `last_updated`) VALUES " . implode(',', $insertValues);
            $insertPrivilege = mysqli_query($con, $sql);
            if (!$insertPrivilege) {
                $error = "Phân quyền không thành công. Xin thử lại";
            } else {
                $successMessage = "Phân quyền thành công. <a href='./member_listing.php'>Quay lại danh sách thành viên</a>";
            }
        }
    }

    $privileges = mysqli_query($con, "SELECT * FROM `privilege`");
    $privileges = mysqli_fetch_all($privileges, MYSQLI_ASSOC);

    $privilegeGroup = mysqli_query($con, "SELECT * FROM `privilege_group` ORDER BY `privilege_group`.`position` ASC");
    $privilegeGroup = mysqli_fetch_all($privilegeGroup, MYSQLI_ASSOC);

    $currentPrivileges = mysqli_query($con, "SELECT * FROM `user_privilege` WHERE `member_id` = " . $_GET['id']);
    $currentPrivileges = mysqli_fetch_all($currentPrivileges, MYSQLI_ASSOC);
    $currentPrivilegeList = !empty($currentPrivileges) ? array_column($currentPrivileges, 'privilege_id') : [];
    // print_r($currentPrivilegeList);
?>
<div class="main-content">
    <h1>Phân quyền thành viên</h1>
    <div id="content-box">
        <form id="editing-form" method="POST" action="?action=save" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?= $_GET['id'] ?? '' ?>">
            <?php foreach ($privilegeGroup as $group) { ?>
            <div class="privilege-group" data-group-id="<?= $group['group_id'] ?>">
                <h3 class="group-name"><?= $group['privilege_name'] ?></h3>
                <input type="checkbox" class="select-all-checkbox" id="select_all_<?= $group['group_id'] ?>" />
                <label for="select_all_<?= $group['group_id'] ?>">Chọn tất cả</label>
                <ul>
                    <?php foreach ($privileges as $privilege) { ?>
                    <?php if ($privilege['group_id'] == $group['group_id']) { ?>
                    <li class="group-items">
                        <input type="checkbox"
                            <?= in_array($privilege['privilege_id'], $currentPrivilegeList) ? 'checked' : '' ?>
                            value="<?= $privilege['privilege_id'] ?>" id="privilege_<?= $privilege['privilege_id'] ?>"
                            name="privileges[<?= $group['group_id'] ?>][]" />
                        <label for="privilege_<?= $privilege['privilege_id'] ?>"><?= $privilege['name'] ?></label>
                    </li>
                    <?php } ?>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>

            <div class="button_submit">
                <button type="submit" title="Lưu phân quyền" value="">
                    <i class="far fa-save fa-1x"></i>
                    Lưu nội dung
                </button>
            </div>
        </form>

        <?php if (!empty($error)) { ?>
        <?= $error ?>
        <?php } elseif (!empty($successMessage)) { ?>
        <?= $successMessage ?>
        <?php } ?>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php foreach ($privilegeGroup as $group) { ?>
    var selectAllCheckbox<?= $group['group_id'] ?> = document.getElementById(
        'select_all_<?= $group['group_id'] ?>');
    var privilegeCheckboxes<?= $group['group_id'] ?> = document.querySelectorAll(
        '.privilege-group[data-group-id="<?= $group['group_id'] ?>"] input[type="checkbox"]');

    selectAllCheckbox<?= $group['group_id'] ?>.addEventListener('change', function() {
        privilegeCheckboxes<?= $group['group_id'] ?>.forEach(function(checkbox) {
            checkbox.checked = selectAllCheckbox<?= $group['group_id'] ?>.checked;
        });
    });

    privilegeCheckboxes<?= $group['group_id'] ?>.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            selectAllCheckbox<?= $group['group_id'] ?>.checked = Array.from(
                privilegeCheckboxes<?= $group['group_id'] ?>).every(function(
                currentCheckbox) {
                return currentCheckbox.checked;
            });
        });

    });

    // Cập nhật để chọn tất cả các checkbox con khi chọn "Chọn tất cả"
    selectAllCheckbox<?= $group['group_id'] ?>.addEventListener('change', function() {
        if (selectAllCheckbox<?= $group['group_id'] ?>.checked) {
            privilegeCheckboxes<?= $group['group_id'] ?>.forEach(function(checkbox) {
                checkbox.checked = true;
            });
        }
    });
    <?php } ?>
});
</script>
<?php
}
?>