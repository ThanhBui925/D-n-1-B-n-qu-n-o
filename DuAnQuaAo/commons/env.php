<?php 

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

define('BASE_URL'       , 'http://localhost/Duan1/DuAnQuaAo/');
// đường dẫn vào phần Admin
define('BASE_URL_ADMIN'       , 'http://localhost/Duan1/DuAnQuaAo/admin/');

define('DB_HOST'    , 'localhost');
define('DB_PORT'    , 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME'    , 'cong-so');  // Tên database

define('PATH_ROOT'    , __DIR__ . '/../');
