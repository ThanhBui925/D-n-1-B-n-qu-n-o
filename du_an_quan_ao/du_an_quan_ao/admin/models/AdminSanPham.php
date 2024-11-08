<?php 
class AdminSanPham{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllSanPham(){
        try{
            // $sql = "SELECT * FROM products";
            $sql = "SELECT products.*, categories.ten_danh_muc
            FROM products
            INNER JOIN categories ON products.category_id = categories.id
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }


    public function insertSanPham($ten_san_pham, 
    $gia_san_pham,
    $gia_khuyen_mai,
    $so_luong, 
    $ngay_nhap,
    $mo_ta,
    $category_id,
    $trang_thai, $hinh_anh){
        try{
            $sql = "INSERT INTO products (ten_san_pham, gia_san_pham, gia_khuyen_mai, so_luong, ngay_nhap, mo_ta, category_id, trang_thai, hinh_anh) 
            VALUES (:ten_san_pham, :gia_san_pham, :gia_khuyen_mai, :so_luong, :ngay_nhap, :mo_ta, :category_id, :trang_thai, :hinh_anh)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham'=> $gia_san_pham,
                ':gia_khuyen_mai'=> $gia_khuyen_mai,
                ':mo_ta' => $mo_ta,
                ':so_luong'=> $so_luong,
                ':ngay_nhap'=> $ngay_nhap,
                ':category_id'=> $category_id,
                ':ngay_nhap'=> $ngay_nhap,
                ':hinh_anh'=> $hinh_anh,
                ':trang_thai'=> $trang_thai
            ]);

            return true;
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
}
}
  

?>