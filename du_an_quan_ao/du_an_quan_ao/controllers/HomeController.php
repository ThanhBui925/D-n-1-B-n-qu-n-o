<?php 

class HomeController
{
    public $modelSanPham;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
    }

    public function home(){
        $listSanPham = $this->modelSanPham->getAllSanPham();
       require_once './views/home.php';
    }
    
   
    public function chiTietSanPham(){
        // hàm này hiện form nhập
        // Lấy ra thông tin của sản phẩm cần sửa đã viết ở model
        $id = $_GET["id"];
        // var_dump($id);die;

        $sanPham = $this->modelSanPham->getDetailSanPham($id);

        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['category_id']);
        if($sanPham){
          require_once './views/detailSanPham.php';
       
    
        }else{
            // var_dump("123");die();
          header("Location: " . BASE_URL);
          exit();
        } 
    }
}