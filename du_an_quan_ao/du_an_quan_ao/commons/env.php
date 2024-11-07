<?php 

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

define('BASE_URL'       , 'http://localhost/duan1/du_an_quan_ao/du_an_quan_ao/');
// đường dẫn vào phần Admin
define('BASE_URL_ADMIN'       , 'http://localhost/duan1/du_an_quan_ao/du_an_quan_ao/admin/');

define('DB_HOST'    , 'localhost');
define('DB_PORT'    , 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME'    , 'duan1_chotl2');  // Tên database

define('PATH_ROOT'    , __DIR__ . '/../');
