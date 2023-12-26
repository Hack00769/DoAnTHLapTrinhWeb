<?php
    session_start();
    ob_start();
    unset($_SESSION['current_user']);
    // echo '<pre>';
	// var_dump($con);
	// exit;
    header('location: index.php');
?>