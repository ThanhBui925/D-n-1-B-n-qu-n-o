<?php 
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

// Require toàn bộ file Models
// require_once './models/Student.php';
require_once './models/SanPham.php';
require_once './models/TaiKhoan.php';

// Route
$act = $_GET['act'] ?? '/';
// var_dump($_GET["act"]);die();

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    // route
    '/' => (new HomeController())->home(), //trường hợp đặc biệt

    // 'trangchu' => (new HomeController)->trangchu(),
    // Base URL/?act=trangchu

    // 'danh-sach-san-pham' => (new HomeController)->danhSachSanPham(),
        // Base URL/?act=danh-sach-san-pham
    'chi-tiet-san-pham' => (new HomeController())->chiTietSanPham(),

    // auth
    'login' => (new HomeController())->formLogin(),
    'check-login' => (new HomeController())->postLogin(),
};