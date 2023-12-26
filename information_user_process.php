<?php
    include './connect_db.php';
    if (!empty($_GET['member_id'])) {
        // var_dump($_GET['member_id']);
        // exit;
        $sql = "select * from member";
        print_r($sql);
        die;
        $result = mysqli_query($con, $sql);
        
        $member = $result->fetch_assoc();
    }

?>