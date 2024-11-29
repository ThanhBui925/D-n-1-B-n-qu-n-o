<?php
class AdminDonHangController{
  
        public $modelDonHang;
       
        public function __construct()
        {
          $this->modelDonHang = new AdminDonHang();
        } 
            
        public function danhSachDonHang(){
            
            $listDonHang = $this->modelDonHang->getAllDonHang();

            require_once './views/donhang/listDonHang.php';
        } 

        public function detailDonHang(){
            $don_hang_id = $_GET["id_don_hang"];
            // Lấy thông tin đơn hàng ở bảng đơn hàng(order)
            $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);
            // Lấy danh sách sản phẩm đã đặt của đơn hàng ở bảng chi tiết đơn hàng (order_detail)
            $sanPhamDonHang = $this->modelDonHang->getListspDonHang($don_hang_id);
            $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
            require_once './views/donhang/detailDonHang.php';
        }

    
// // Sửa sản phẩm
        public function formEditDonHang(){
          $id = $_GET["id_don_hang"];
          $donHang = $this->modelDonHang->getDetailDonHang($id);
          $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
          if($donHang){
            require_once './views/donhang/editDonHang.php';
            deleteSessionError();
          }else{
            header("Location: " .BASE_URL_ADMIN. '?act=don-hang');
            exit();
          } 
        }




      public function postEditDonHang(){
        // hàm này xử lí thêm dữ liệu
        // Kiểm tra xem dữ liệu có phải được submit lên không
        if($_SERVER['REQUEST_METHOD'] == "POST"){
          
          // Lấy ra dữ liệu
          // Lấy ra dữ liệu cũ của sản phẩm
          $don_hang_id = $_POST['don_hang_id'] ?? '';
         
          $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
          $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
          $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
          $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
          $ghi_chu = $_POST['ghi_chu'] ?? '';
          $trang_thai_id = $_POST['trang_thai_id'] ?? '';
          

        
          // Tạo 1 mảng trống chứa dữ liệu 
          $error = [];
          if(empty($ten_nguoi_nhan)){
            $error["ten_nguoi_nhan"] = "Tên người nhận không được bỏ trống !";
          }
          if(empty($sdt_nguoi_nhan)){
            $error["sdt_nguoi_nhan"] = "Số điện thoại người nhận không được bỏ trống !";
          }
          if(empty($email_nguoi_nhan)){
            $error["email_nguoi_nhan"] = "Email người nhận không được bỏ trống !";
          }
          if(empty($dia_chi_nguoi_nhan)){
            $error["dia_chi_nguoi_nhan"] = "Địa chỉ người nhận không được bỏ trống !";
          }
          if(empty($trang_thai_id)){
            $error["trang_thai_id"] = "Trạng thái đơn hàng phải chọn!";
          }
          
          // if($hinh_anh['error'] !== 0){
          //   $error["hinh_anh"] = "Phải chọn ảnh sản phẩm!";
          // }
         
          $_SESSION['error'] = $error;
          // Nếu không có lỗi thì tiến hành sửa
          // var_dump($error);die;
          if(empty($error)){
           
            // Nếu không có lỗi tiến hành thêm sản phẩm
            // var_dump("đã nhận dc dữ liệu");
            $this->modelDonHang->updateDonHang(
                                              $don_hang_id,
                                              $ten_nguoi_nhan,
                                              $sdt_nguoi_nhan, 
                                              $email_nguoi_nhan,
                                              $dia_chi_nguoi_nhan,
                                              $ghi_chu,
                                              $trang_thai_id, 
                                            );
                                            // var_dump($trang_thai_id);die;
      
            header("Location: " .BASE_URL_ADMIN. '?act=don-hang');
            exit();
          }else
            // Nếu có lỗi trả về form và lỗi
            // Đặt chỉ tị và xóa session sau khi hiển thị from
            $_SESSION['flash'] = true;
            header("Location: " .BASE_URL_ADMIN. '?act=form-sua-don-hang&id_don_hang=' . $don_hang_id);
            exit();
            // require_once './views/sanpham/addSanPham.php';
        }
      }



// // Xóa danh mục
//         public function deleteSanPham(){
//           $id = $_GET["id_san_pham"];
//           $sanPham = $this->modelSanPham->getDetailSanPham($id);

//           $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

//           if($sanPham){
//             deleteFile($sanPham['hinh_anh']);
//             $this->modelSanPham->destroySanPham($id);
//           }

//           if($listAnhSanPham){
//             foreach($listAnhSanPham as $key=>$anhSP){
//               deleteFile($anhSP['link_hinh_anh']);
//               $this->modelSanPham->destroyAnhSanPham($anhSP['id']);
//             }
//           }
//           header("Location: " .BASE_URL_ADMIN. '?act=san-pham');
//           exit();
//         }

//         public function detailSanPham(){
//           // hàm này hiện form nhập
//           // Lấy ra thông tin của sản phẩm cần sửa đã viết ở model
//           $id = $_GET["id_san_pham"];

//           $sanPham = $this->modelSanPham->getDetailSanPham($id);

//           $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
          
//           if($sanPham){
//             require_once './views/sanpham/detailSanPham.php';
      
//           }else{
//             header("Location: " .BASE_URL_ADMIN. '?act=san-pham');
//             exit();
//           } 
//       }
//         // $_SESSION['message'] = 'Xóa sản phẩm thành công'; // Thông báo xóa thành công
    }