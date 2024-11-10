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
          deleteSessionError();
        } 

        public function postAddSanPham(){
          // hàm này xử lí thêm dữ liệu
          // Kiểm tra xem dữ liệu có phải được submit lên không
          if($_SERVER['REQUEST_METHOD'] == "POST"){
            // Lấy ra dữ liệu
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';
            $category_id = $_POST['category_id'] ?? '';
            // var_dump($category_id);
            $trang_thai = $_POST['trang_thai'] ?? '';
            // var_dump($trang_thai);

            $hinh_anh = $_FILES["hinh_anh"] ?? null;
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
            if($hinh_anh['error'] !== 0){
              $error["hinh_anh"] = "Phải chọn ảnh sản phẩm!";
            }

            $_SESSION['error'] = $error;
            // Nếu không có lỗi thì tiến hành thêm sản phẩm
            if(empty($error)){
              // Nếu không có lỗi tiến hành thêm sản phẩm
              // var_dump("đã nhận dc dữ liệu");
              $product_id = $this->modelSanPham->insertSanPham($ten_san_pham, 
                                                $gia_san_pham,
                                                $gia_khuyen_mai,
                                                $so_luong, 
                                                $ngay_nhap,
                                                $mo_ta,
                                                $category_id,
                                                $trang_thai,
                                                $file_thumb
                                              );
                                              // var_dump($san_pham_id);die;
              // Xử lí thêm album ảnh sản phẩm img_array
              if(!empty($img_array['name'])){
                foreach ($img_array['name'] as $key=>$value){
                  $file = [
                    'name' => $img_array['name'][$key],
                    'type' => $img_array['type'][$key],
                    'tmp_name' => $img_array['tmp_name'][$key],
                    'error' => $img_array['error'][$key],
                    'size' => $img_array['size'][$key],
                  ];
                  $link_hinh_anh = uploadFile($file, './uploads/');
                  $this->modelSanPham->insertAlbumAnhSanPham($product_id, $link_hinh_anh);
                }
              }
              
              header("Location: " .BASE_URL_ADMIN. '?act=san-pham');
              exit();
            }else
              // Nếu có lỗi trả về form và lỗi
              // Đặt chỉ tị và xóa session sau khi hiển thị from
              $_SESSION['flash'] = true;
              header("Location: " .BASE_URL_ADMIN. '?act=form-them-san-pham');
              exit();
              // require_once './views/sanpham/addSanPham.php';
          }
        } 
// // End Thêm danh mục



// // Sửa sản phẩm
        public function formEditSanPham(){
          // hàm này hiện form nhập
          // Lấy ra thông tin của sản phẩm cần sửa đã viết ở model
          $id = $_GET["id_san_pham"];
          $sanPham = $this->modelSanPham->getDetailSanPham($id);
          $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
          $listDanhMuc = $this->modelDanhmuc->getAllDanhMuc();
          if($sanPham){
            require_once './views/sanpham/editSanPham.php';
            deleteSessionError();
          }else{
            header("Location: " .BASE_URL_ADMIN. '?act=san-pham');
            exit();
          } 
      }




      public function postEditSanPham(){
        // hàm này xử lí thêm dữ liệu
        // Kiểm tra xem dữ liệu có phải được submit lên không
        if($_SERVER['REQUEST_METHOD'] == "POST"){
          
          // Lấy ra dữ liệu
          // Lấy ra dữ liệu cũ của sản phẩm
          $san_pham_id = $_POST['san_pham_id'] ?? '';
          
          $sanPhamOld = $this->modelSanPham->getDetailSanPham($san_pham_id);
          $old_file = $sanPhamOld['hinh_anh']; //Lấy ra ảnh cũ để sửa ảnh
// var_dump($old_file);die;
          $ten_san_pham = $_POST['ten_san_pham'] ?? '';
          $gia_san_pham = $_POST['gia_san_pham'] ?? '';
          $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
          $so_luong = $_POST['so_luong'] ?? '';
          $ngay_nhap = $_POST['ngay_nhap'] ?? '';
          $mo_ta = $_POST['mo_ta'] ?? '';
          $category_id = $_POST['category_id'] ?? '';
          // var_dump($category_id);
          $trang_thai = $_POST['trang_thai'] ?? '';
          // var_dump($trang_thai);

          $hinh_anh = $_FILES["hinh_anh"] ?? null;
         

        
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
          // if($hinh_anh['error'] !== 0){
          //   $error["hinh_anh"] = "Phải chọn ảnh sản phẩm!";
          // }
         
          $_SESSION['error'] = $error;

          // Logic sửa ảnh
         
          if(isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK){  
                // upload file ảnh mới lên  
                $new_file = uploadFile($hinh_anh, './uploads/');  
                if(!empty($old_file)){ //Nếu có ảnh cũ thì xóa đi  
                    deleteFile($old_file);  
                }  
            } else {  
                // Nếu không có ảnh mới, giữ lại ảnh cũ  
                $new_file = $old_file;  
            }  

          // Nếu không có lỗi thì tiến hành thêm sản phẩm
          if(empty($error)){
           
            // Nếu không có lỗi tiến hành thêm sản phẩm
            // var_dump("đã nhận dc dữ liệu");
           $this->modelSanPham->updateSanPham(
                                              $san_pham_id,
                                              $ten_san_pham, 
                                              $gia_san_pham,
                                              $gia_khuyen_mai,
                                              $so_luong, 
                                              $ngay_nhap,
                                              $mo_ta,
                                              $category_id,
                                              $trang_thai,
                                              $new_file
                                            );
                                            // var_dump($san_pham_id);die;
      
            
            header("Location: " .BASE_URL_ADMIN. '?act=san-pham');
            exit();
          }else
            // Nếu có lỗi trả về form và lỗi
            // Đặt chỉ tị và xóa session sau khi hiển thị from
            $_SESSION['flash'] = true;
            header("Location: " .BASE_URL_ADMIN. '?act=form-sua-san-pham&id_san_pham=' .$san_pham_id);
            exit();
            // require_once './views/sanpham/addSanPham.php';
        }
      } 

      // Sửa album ảnh
      // - sửa ảnh cũ
      //   + thêm ảnh mới 
      //   + ko thêm ảnh mới
      // - ko sửa ảnh cũ
      //   + thêm ảnh mới 
      //   + ko thêm ảnh mới
      // - xóa ảnh cũ
      //   + thêm ảnh mới 
      //   + ko thêm ảnh mới
      public function postEditAnhSanPham(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $san_pham_id = $_POST["san_pham_id"] ?? '';

          // Lấy danh sách ảnh hiện tại của sản phẩm
          $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);

          // Xử lí các ảnh gửi từ form
          $img_array = $_FILES['img_array'];
          $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
          $current_img_ids = $_POST['current_img_ids'] ?? [];
          // Khai báo mảng để lưu ảnh mới thay thế ảnh cũ
          $upload_file = [];
          // upload ảnh mới hoặc thay thế ảnh cũ
          foreach($img_array['name'] as $key=>$value){
            if($img_array['error'][$key] == UPLOAD_ERR_OK){
              $new_file = uploadFileAlbum($img_array, './uploads/', $key);
              if($new_file){
                $upload_file[] = [
                  'id' => $current_img_ids[$key] ?? null,
                  'file' => $new_file
                ];
              }
            }
          }
          // Lưu ảnh mới vào db và xóa ảnh cũ nếu có
          foreach ($upload_file as $file_info){
            if($file_info['id']){
              $old_file = $this->modelSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];

              // cập nhật ảnh cũ
              $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);

              // Xóa ảnh cũ
              deleteFile($old_file);
            }else{
              // Thêm ảnh mới 
              $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
            }
          }
          // Xử lí xóa ảnh
          foreach ($listAnhSanPhamCurrent as $anhSP){
            $anh_id = $anhSP['id'];
            if(in_array($anh_id, $img_delete)){
              // xóa ảnh trong db
              $this->modelSanPham->destroyAnhSanPham($anh_id);
              // Xóa file
              deleteFile($anhSP['link_hinh_anh']);

            }
          }
          header("Location: " .BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham='.$san_pham_id);
          exit();
        }
      }
        
// // End sửa sản phẩm



// Xóa danh mục
        public function deleteSanPham(){
          $id = $_GET["id_san_pham"];
          $sanPham = $this->modelSanPham->getDetailSanPham($id);

          $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

          if($sanPham){
            deleteFile($sanPham['hinh_anh']);
            $this->modelSanPham->destroySanPham($id);
          }

          if($listAnhSanPham){
            foreach($listAnhSanPham as $key=>$anhSP){
              deleteFile($anhSP['link_hinh_anh']);
              $this->modelSanPham->destroyAnhSanPham($anhSP['id']);
            }
          }
          header("Location: " .BASE_URL_ADMIN. '?act=san-pham');
          exit();
        }

        // $_SESSION['message'] = 'Xóa sản phẩm thành công'; // Thông báo xóa thành công
}