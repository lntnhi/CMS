<?php
session_start();
/* Hai dòng dưới đây chỉ để hiển thị ra xem để test thông tin gửi lên */
//var_dump($_REQUEST); // Đây là nơi nhận các thông tin từ thẻ input,select trong form gửi lên
//var_dump($_FILES); // Đây là nơi nhận file ảnh

include_once("../model/News.php");
include_once("../model/Admin.php");
if (!isset($_SESSION["admin"])) {
    header("location:admin_login.php");
}
$admin = unserialize($_SESSION["admin"]);

$title = $_REQUEST["title"];
$subtitle = $_REQUEST["subtitle"];
$content = $_REQUEST["editor-blog-content"]; 
$image_url = "";
$categoryID = $_REQUEST["categoryID"];

if(isset($_FILES["image"])){
    if($_FILES["image"]["name"] != "") {
        $image_name = "img_" . time(); // Đặt tên cho ảnh, tự quy ước, ở đây có hàm time() là để tên ảnh ko trùng nhau khi lưu vô thư mục
        move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/images/" . $image_name . ".png"); // lưu ảnh vào thư mục
        $image_url = "uploads/images/" . $image_name . ".png"; // Url ảnh để lưu vào DB. 
    }
}

if (isset($_REQUEST["createNews"])) {
    News::add($title, $subtitle, $content, $image_url, $categoryID, $admin->username);
}
else if (isset($_REQUEST["editNews"])) {
    $ID = $_REQUEST["editNews"];
    News::edit ($ID, $title, $subtitle, $content, $image_url, $categoryID);
}
header("location:../admin_news.php");
?>