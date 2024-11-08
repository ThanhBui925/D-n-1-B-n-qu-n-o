<?php
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

        public function postAddSanPham(){
          // hàm này xử lí thêm dữ liệu
          // Kiểm tra xem dữ liệu có phải được submit lên không
          if($_SERVER['REQUEST_METHOD'] == "POST"){
            // Lấy ra dữ liệu
            $ten_san_pham = $_POST['ten_san_pham'];
            $gia_san_pham = $_POST['gia_san_pham'];
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'];
            $so_luong = $_POST['so_luong'];
            $ngay_nhap = $_POST['ngay_nhap'];
            $mo_ta = $_POST['mo_ta'];
            $category_id = $_POST['category_id'];
            var_dump($category_id);
            $trang_thai = $_POST['trang_thai'];
            var_dump($trang_thai);

            $hinh_anh = $_FILES["hinh_anh"];
            // Lưu hình ảnh vào 
            $file_thumb = uploadFile($hinh_anh, './uploads/');

            // mảng hình ảnh [album]
            $img_array = $_FILES["img_array"];

            // Tạo 1 mảng trống chứa dữ liệu 
            $error = [];
            if(empty($ten_san_pham)){
              $error["ten_san_pham"] = "Tên sản phẩm không được bỏ trống !";
            }
            if(empty($so_luong)){
              $error["so_luong"] = "Số lượng sản phẩm không được bỏ trống !";
            }
            if(empty($gia_san_pham)){
              $error["gia_san_pham"] = "Giá sản phẩm không được bỏ trống !";
            }
            if(empty($gia_khuyen_mai)){
              $error["gia_khuyen_mai"] = "Giá khuyến mãi sản phẩm không được bỏ trống !";
            }
            if(empty($ngay_nhap)){
              $error["ngay_nhap"] = "Ngày nhập sản phẩm không được bỏ trống !";
            }
            if(empty($trang_thai)){
              $error["trang_thai"] = "Trạng thái sản phẩm phải chọn!";
            }
            if(empty($category_id)){
              $error["category_id"] = "Danh mục sản phẩm phải chọn!";
            }

            // Nếu không có lỗi thì tiến hành thêm sản phẩm
            if(empty($error)){
              // Nếu không có lỗi tiến hành thêm sản phẩm
              // var_dump("đã nhận dc dữ liệu");
              $this->modelSanPham->insertSanPham($ten_san_pham, 
                                                $gia_san_pham,
                                                $gia_khuyen_mai,
                                                $so_luong, 
                                                $ngay_nhap,
                                                $mo_ta,
                                                $category_id,
                                                $trang_thai,
                                                $file_thumb
                                              );
              header("Location: " .BASE_URL_ADMIN. '?act=san-pham');
              exit();
            }else
              // Nếu có lỗi trả về form và lỗi
              require_once './views/sanpham/addSanPham.php';
          }
        } 
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