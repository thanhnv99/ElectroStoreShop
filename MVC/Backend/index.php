<?php
//Backend/index.php
session_start();

//set mui gio VN
date_default_timezone_set('Asia/Ho_Chi_Minh');
//phan tich url
//voi mo hinh mvc hien tai url luon co dang index.php?controller=?&action=?
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'product';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
//chuyen doi bien controller thanh ten class controller tuong tung
//Muc dich de chuyen thanh ten class: CategoryController
$controller = ucfirst($controller);
$controller .="Controller"; //CategoryController
//tao 1 bien chua duong dan den file controller
//controllers/CategoryController.php
$path_controller = "controllers/$controller.php";
//truoc khi nhung duong dan can kiem tra xem co ton tai hay khong
if(!file_exists($path_controller)){
    die("Trang bạn tìm không tồn tại!");
}
//nhung file controller vao
require_once "$path_controller";
//sau khi nhung class, thi khoi tao doi tuong class do
$object = new $controller();
//goi phuong thuc cua doi tuog dua vao bien action bat duoc
//can check neu khong ton tai phuong thuc thi vao loi
if(!method_exists($object,$action)){
    die("Không tồn tại phương thức $action trong class $controller");
}
//goi phuong thuc tu doi tuong
$object->$action();