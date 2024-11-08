<?php
session_start();
class AdminSanPhamController{
  
        public $modelSanPham;
        public $modelDanhmuc;
        public function __construct()
        {
          $this->modelSanPham = new AdminSanPham();
          $this->modelDanhmuc = new AdminDanhmuc();
        } 
            
        public function danhSachSanPham(){
            
            $listSanPham = $this->modelSanPham->getAllSanPham();

            require_once './views/sanpham/listSanPham.php';
        } 
// Thêm sản phẩm
        public function formAddSanPham(){
          // hàm này hiện form nhập
          $listDanhMuc = $this->modelDanhmuc->getAllDanhMuc();
          require_once './views/sanpham/addSanPham.php';
        } 

//         public function postAddDanhMuc(){
//           // hàm này xử lí thêm dữ liệu
//           // Kiểm tra xem dữ liệu có phải được submit lên không
//           if($_SERVER['REQUEST_METHOD'] == "POST"){
//             // Lấy ra dữ liệu
//             $ten_danh_muc = $_POST['ten_danh_muc'];
//             $mo_ta = $_POST['mo_ta'];

//             // Tạo 1 mảng trống chứa dữ liệu 
//             $error = [];
//             if(empty($ten_danh_muc)){
//               $error["ten_danh_muc"] = "Tên danh mục không được bỏ trống !";
//             }

//             // Nếu không có lỗi thì tiến hành thêm danh mục
//             if(empty($error)){
//               // Nếu không có lỗi tiến hành thêm danh mục
//               // var_dump("đã nhận dc dữ liệu");
//               $this->modelDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta);
//               header("Location: " .BASE_URL_ADMIN. '?act=danh-muc');
//               exit();
//             }else
//               // Nếu có lỗi trả về form và lỗi
//               require_once './views/danhmuc/addDanhMuc.php';
//           }
//         } 
// // End Thêm danh mục



// // Sửa danh mục
//         public function formEditDanhMuc(){
//           // hàm này hiện form nhập
//           // Lấy ra thông tin của danh mục cần sửa đã viết ở model
//           $id = $_GET["id_danh_muc"];
//           $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
//           // var_dump($danhMuc);
//           // die();
//           if($danhMuc){
//             require_once './views/danhmuc/editDanhMuc.php';
//           }else{
//             header("Location: " .BASE_URL_ADMIN. '?act=danh-muc');
//             exit();
//           } 
//       }

//         public function postEditDanhMuc(){
//           // hàm này xử lí thêm dữ liệu
//           // Kiểm tra xem dữ liệu có phải được submit lên không
//           if($_SERVER['REQUEST_METHOD'] == "POST"){
//             // Lấy ra dữ liệu
//             $id = $_POST['id'];
//             $ten_danh_muc = $_POST['ten_danh_muc'];
//             $mo_ta = $_POST['mo_ta'];
          

//             // Tạo 1 mảng trống chứa dữ liệu 
//             $error = [];
//             if(empty($ten_danh_muc)){
//               $error["ten_danh_muc"] = "Tên danh mục không được bỏ trống !";
//             }

//             // Nếu không có lỗi thì tiến hành sửa danh mục
//             if(empty($error)){
//               // Nếu không có lỗi tiến hành sửa danh mục
//               // var_dump("đã nhận dc dữ liệu");
//               $this->modelDanhMuc->updateDanhMuc($id, $ten_danh_muc, $mo_ta);
//               header("Location: " .BASE_URL_ADMIN. '?act=danh-muc');
//               exit();
//             }else
//               // Nếu có lỗi trả về form và lỗi
//               $danhMuc = ['id' => $id, 'ten_danh_muc' => $ten_danh_muc, 'mo_ta' => $mo_ta];
//               require_once './views/danhmuc/editDanhMuc.php';
//           }
//         } 
// // End sửa danh mục


// // Xóa danh mục
//         public function deleteDanhMuc(){
//           $id = $_GET["id_danh_muc"];
//           $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
//           if($danhMuc){
//             $this->modelDanhMuc->destroyDanhMuc($id);
//             $_SESSION['message'] = 'Xóa sản phẩm thành công'; // Thông báo xóa thành công
//             header("Location: " .BASE_URL_ADMIN. '?act=danh-muc');
//             exit();
//           }else{
//             header("Location: " .BASE_URL_ADMIN. '?act=danh-muc');
//             exit();
//           }
//         }


}