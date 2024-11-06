<?php
class SanPham{
    public $conn; // Khai báo phương thức

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Viết hàm lấy toàn bộ danh sách sản phẩm
    public function getAllProduct(){
        try{
            $sql = "SELECT * FROM products";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        }catch(Exception $e){
            echo "Lỗi" . $e->getMessage();
    }
}

}
