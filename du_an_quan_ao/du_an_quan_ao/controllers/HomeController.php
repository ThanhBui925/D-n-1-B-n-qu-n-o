<?php 

class HomeController
{
    public $modelSanPham;
    public $modelTaiKhoan;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
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





    public function formLogin(){
      require_once "./views/auth/formLogin.php";
      deleteSessionError();
    }
     public function postLogin(){
      if($_SERVER['REQUEST_METHOD'] == "POST"){
        // Lấy email và pass gửi lên từ form
        $email = $_POST['email'];
        $password = $_POST['password'];
        // var_dump($password);
    
        // Xử lí kiểm tra thông tin đăng nhập
        $user = $this->modelTaiKhoan->checkLogin($email, $password);
    
        if($user == $email){ // TH đăng nhập thành công
          // Lưu thông tin vào session
          $_SESSION["user_client"] = $user;
          header("Location: " . BASE_URL);
          exit();
        }else{
          // Lỗi thì lưu lỗi vào SESSION
          $_SESSION["error"] = $user;
          // var_dump($_SESSION['error']);die();
          $_SESSION["flash"] = true;
          header("Location: " .BASE_URL. "?act=login");
          exit();
    
        }
      }
     }
}