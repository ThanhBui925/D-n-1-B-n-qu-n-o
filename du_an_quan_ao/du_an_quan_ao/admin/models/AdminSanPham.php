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


}
  

?>