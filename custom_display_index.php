<?php
$param = "";
$sortParam = "";
$orderConditon = "";
//Tìm kiếm
$search = isset($_GET['name']) ? $_GET['name'] : "";
if ($search) {
	$where = "WHERE `name` LIKE '%" . $search . "%'";
	$param .= "name=" . $search . "&";
	$sortParam = "name=" . $search . "&";
}
//Sắp xếp
$orderField = isset($_GET['field']) ? $_GET['field'] : "";
$orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";
if (!empty($orderField) && !empty($orderSort)) {
	$orderConditon = "ORDER BY `product`.`" . $orderField . "` " . $orderSort;
	$param .= "field=" . $orderField . "&sort=" . $orderSort . "&";
}

include './connect_db.php';
$item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 6;
$current_page = !empty($_GET['page']) ? $_GET['page'] : 1; //Trang hiện tại
$offset = ($current_page - 1) * $item_per_page;
if ($search) {
	$products = mysqli_query($con, "SELECT * FROM `product` WHERE `name` LIKE '%" . $search . "%' " . $orderConditon . "  LIMIT " . $item_per_page . " OFFSET " . $offset);
	$totalRecords = mysqli_query($con, "SELECT * FROM `product` WHERE `name` LIKE '%" . $search . "%'");
} else {
	$products = mysqli_query($con, "SELECT * FROM `product` " . $orderConditon . "  LIMIT " . $item_per_page . " OFFSET " . $offset);
	$totalRecords = mysqli_query($con, "SELECT * FROM `product`");
}

$totalRecords = $totalRecords->num_rows;
$totalPages = ceil($totalRecords / $item_per_page);

if (isset($_SESSION['username']) && isset($_GET['logout'])) {
	unset($_SESSION['username']); // xóa session login
}
