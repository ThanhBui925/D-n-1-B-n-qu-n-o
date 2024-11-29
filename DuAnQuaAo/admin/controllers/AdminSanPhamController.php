<?php
class AdminSanPhamController{
  
    public $modelSanPham;
    public $modelDanhMuc;
    public function __construct()
    {
      $this->modelSanPham = new AdminSanPham();
      $this->modelDanhMuc = new AdminDanhMuc();
    } 
        
    public function danhSachSanPham(){
        
        $listSanPham = $this->modelSanPham->getAllSanPham();

        require_once './views/sanpham/listSanPham.php';
    }
    public function formAddSanPham(){
  
      $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();

      // echo "Thêm";
      //Thêm dữ liệu
      // var_dump($_POST);
      // Kiểm tra dữ liệu có phải được gửi từ form hay k
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Lấy dữ liệu
        $ten_san_pham = $_POST['ten_san_pham'] ?? '';
        $gia_san_pham = $_POST['gia_san_pham'] ?? '';
        $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
        $so_luong = $_POST['so_luong'] ?? '';
        $ngay_nhap = $_POST['ngay_nhap'] ?? '';
        $category_id = $_POST['category_id'] ?? '';
        $trang_thai = $_POST['trang_thai'] ?? '';
        $mo_ta = $_POST['mo_ta'] ?? '';
        $hinh_anh = $_FILES['hinh_anh'] ?? null;

        //Lưu hình ảnh vào
        $file_thumb = uploadFile($hinh_anh, './uploads/');
        //Mảng hình ảnh
        $img_array = $_FILES['img_array'];
        
        $moTa = $_POST['mo_ta'];
        // tạo 1 mảng rỗng chứa dữ liệu
        $errors = [];
        if(empty($ten_san_pham)){
          $errors['ten_san_pham'] = 'Tên sản phẩm không được bỏ trống';
          // return;
        }
        if(empty($gia_san_pham)){
          $errors['gia_san_pham'] = 'Giá sản phẩm không được bỏ trống';
        }
        if(empty($gia_khuyen_mai)){
          $errors['gia_khuyen_mai'] = 'Giá khuyến mãi không được bỏ trống';
        }
        if(empty($so_luong)){
          $errors['so_luong'] = 'Số lượng không được bỏ trống';
        }
        if(empty($ngay_nhap)){
          $errors['ngay_nhap'] = 'Ngày nhập không được bỏ trống';
        }
        if(empty($category_id)){
          $errors['category_id'] = 'Danh mục sản phẩm phải được chọn';
        }
        if(empty($trang_thai)){
          $errors['trang_thai'] = 'Trạng thái phải được chọn';
        }
        if($hinh_anh['error'] !== 0){
          $errors['hinh_anh'] = 'Phải chọn ảnh sản phẩm';
        }
        $_SESSION['error'] = $errors;

        //Nếu k có lỗi thì tiến hành thêm sản phẩm
        if(empty($errors)){
          $product_id = $this->modelSanPham->insertSanPham($ten_san_pham, $gia_san_pham, 
                                              $gia_khuyen_mai, $so_luong,
                                              $ngay_nhap, $category_id,
                                              $trang_thai, $mo_ta,
                                              $file_thumb);

            //Xử lý thêm album ảnh sản phẩm
            if(!empty($img_array['name'])){
              foreach($img_array['name'] as $key=>$value){
                $file = [
                  'name' => $img_array['name'][$key],
                  'type' => $img_array['type'][$key],
                  'tmp_name' => $img_array['tmp_name'][$key],
                  'error' => $img_array['error'][$key],
                  'size' => $img_array['size'][$key],
                ];
                $link_hinh_anh = uploadFile($file, '../');
                $this->modelSanPham->insertAlbumAnhSanPham($product_id, $link_hinh_anh);
              }
            }
            
            echo "<script>
            alert('Thêm sản phẩm thành công thành công');
            window.location.href = '" . BASE_URL_ADMIN . "?act=san-pham';
            </script>";
            exit();
          // header("location: " . BASE_URL_ADMIN . '?act=san-pham');
          // exit();
        }else{
          require_once './views/sanpham/addSanPham.php';
          //trả lỗi về form
        }

      } else {
      require_once './views/sanpham/addSanPham.php';
      }

    }
    public function formEditSanPham(){
      $id = $_GET['id_san_pham'];
      $sanPham = $this->modelSanPham->getDetailSanPham($id);
      $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
    // var_dump($listAnhSanPham);die();
      $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Lấy dữ liệu
        //Lấy dữ liệu cũ của sản phẩm
        $product_id = $_POST['product_id'] ?? '';
        //truy vấn
        $sanPhamOld = $this->modelSanPham->getDetailSanPham($product_id);
        $old_file = $sanPhamOld['hinh_anh']; //Lấy ảnh cũ để phục vụ cho sửa ảnh

        $ten_san_pham = $_POST['ten_san_pham'] ?? '';
        $gia_san_pham = $_POST['gia_san_pham'] ?? '';
        $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
        $so_luong = $_POST['so_luong'] ?? '';
        $ngay_nhap = $_POST['ngay_nhap'] ?? '';
        $category_id = $_POST['category_id'] ?? '';
        $trang_thai = $_POST['trang_thai'] ?? '';
        $mo_ta = $_POST['mo_ta'] ?? '';
        $hinh_anh = $_FILES['hinh_anh'] ?? null;

        $img_array = $_FILES['img_array'];
        
        $moTa = $_POST['mo_ta'];
        // tạo 1 mảng rỗng chứa dữ liệu
        $errors = [];
        if(empty($ten_san_pham)){
          $errors['ten_san_pham'] = 'Tên sản phẩm không được bỏ trống';
          // return;
        }
        if(empty($gia_san_pham)){
          $errors['gia_san_pham'] = 'Giá sản phẩm không được bỏ trống';
        }
        if(empty($gia_khuyen_mai)){
          $errors['gia_khuyen_mai'] = 'Giá khuyến mãi không được bỏ trống';
        }
        if(empty($so_luong)){
          $errors['so_luong'] = 'Số lượng không được bỏ trống';
        }
        if(empty($ngay_nhap)){
          $errors['ngay_nhap'] = 'Ngày nhập không được bỏ trống';
        }
        if(empty($category_id)){
          $errors['category_id'] = 'Danh mục sản phẩm phải được chọn';
        }
        if(empty($trang_thai)){
          $errors['trang_thai'] = 'Trạng thái phải được chọn';
        }
        
        $_SESSION['error'] = $errors;
        //logic sửa ảnh
        if(isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK){
          //Upload ảnh mới
          $new_file = uploadFile($hinh_anh, './uploads/');

          if(!empty($old_file)){ //Nếu có ảnh cũ thì xóa đi
            deleteFile($old_file);
          }
        }else{
          $new_file = $old_file;
        }

        //Nếu k có lỗi thì tiến hành thêm sản phẩm
        // var_dump($_POST);die();
        if(empty($errors)){
           $result = $this->modelSanPham->updateSanPham($product_id,$ten_san_pham, $gia_san_pham, 
                                              $gia_khuyen_mai, $so_luong,
                                              $ngay_nhap, $category_id,
                                              $trang_thai, $mo_ta,
                                              $new_file);

            // var_dump($result);die();
            echo "<script>
            alert('Sửa sản phẩm thành công thành công');
            window.location.href = '" . BASE_URL_ADMIN . "?act=san-pham';
            </script>";
            exit();
        }else{
          require_once './views/sanpham/editSanPham.php';
          //trả lỗi về form
        }
      } else {
          require_once './views/sanpham/editSanPham.php';
      }

    }
    public function editAnhSanPham(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $product_id = $_POST['product_id'] ?? '';
          //Lấy danh sách ảnh sản phẩm hiện tại
          $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($product_id);
          
          //Xử lý các ảnh được gửi từ form
          $img_array = $_FILES['img_array'];
          $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
          $current_img_ids = $_POST['current_img_ids'] ?? [];
          
          //Khai báo mảng để lưu ảnh thêm mới hoăc thay thế
          $upload_file = [];
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
          //Lưu ảnh mới vào db và xóa ảnh cũ
          // var_dump($upload_file);die();
          foreach($upload_file as $file_info){
            if($file_info['id']){
              $old_file = $this->modelSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];
              //Cập nhật ảnh cũ
              $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);
              //Xóa ảnh cũ
              deleteFile($old_file);
            }else{
              //thêm ảnh mới
              $this->modelSanPham->insertAlbumAnhSanPham($product_id, $file_info['file']);
            }
          }
          //xử lý xóa ảnh
          foreach($listAnhSanPhamCurrent as $anhSanPham){
            $anh_id = $anhSanPham['id'];
            if(in_array($anh_id, $img_delete)){
              //Xóa ảnh
              $this->modelSanPham->destroyAnhSanPham($anh_id);
              //xóa file
              deleteFile($anhSanPham['link_hinh_anh']);
            }
          }
          echo "<script>
            alert('Sửa album ảnh thành công');
            window.location.href = '" . BASE_URL_ADMIN . "?act=edit-san-pham&id_san_pham=". $product_id ."';
            </script>";
            exit();
      }
  }
  public function deleteSanPham(){
    $id = $_GET['id_san_pham'];
    $sanPham = $this->modelSanPham->getDetailSanPham($id);
    $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
    
    if ($sanPham) {
        // Kiểm tra và xóa ảnh sản phẩm trong bảng product_images trước
        if ($listAnhSanPham) {
            foreach ($listAnhSanPham as $key => $anhSP) {
                deleteFile($anhSP['link_hinh_anh']); // Xóa file ảnh vật lý (nếu cần)
                $this->modelSanPham->destroyAnhSanPham($anhSP['id']); // Xóa ảnh trong db
            }
        }

        // Sau khi xóa ảnh xong, xóa sản phẩm
        deleteFile($sanPham['hinh_anh']); // Xóa file ảnh chính của sản phẩm (nếu cần)
        $this->modelSanPham->destroySanPham($id);

        // Xác nhận xóa thành công
        echo "<script>
                alert('Xóa thành công sản phẩm');
                window.location.href = '" . BASE_URL_ADMIN . "?act=san-pham';
              </script>";
        exit();
    }
}
public function detailSanPham(){
  $id = $_GET['id_san_pham'];
  $sanPham = $this->modelSanPham->getDetailSanPham($id);
  $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
  $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);
// var_dump($listAnhSanPham);die();
  $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
  if($sanPham){
    require_once './views/sanpham/detailSanPham.php';
  }else{
    echo "<script>
    window.location.href = '" . BASE_URL_ADMIN . "?act=san-pham';
    </script>";
    exit();
  }

}
public function updateTrangThaiBinhLuan(){
  $id_binh_luan = $_POST["id_binh_luan"];
  $name_view = $_POST["name_view"];
  // $id_khach_hang = $_POST["id_khach_hang"];
  $binhLuan = $this->modelSanPham->getDetailBinhLuan($id_binh_luan);
  
  if($binhLuan){
    $trang_thai_update = "";
    if($binhLuan["trang_thai"] == 1){
      $trang_thai_update = 2;
    }else{
      $trang_thai_update = 1;
    }
    $status = $this->modelSanPham->updateTrangThaiBinhLuan($id_binh_luan, $trang_thai_update);
    if($status){
      if($name_view == 'detail_khach'){
        header("Location: ".BASE_URL_ADMIN. '?act=chi-tiet-khach-hang&id_khach_hang=' .$binhLuan['user_id']);
      }else{
        header("Location: ".BASE_URL_ADMIN. '?act=chi-tiet-san-pham&id_san_pham=' .$binhLuan['product_id']);
      }
    }
    
  }
  }
    
    
}