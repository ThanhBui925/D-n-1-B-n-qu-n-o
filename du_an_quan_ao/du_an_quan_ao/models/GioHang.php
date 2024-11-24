<?php
class GioHang{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    

    public function getGioHangFromUser($id){
        try{
            $sql = "SELECT * FROM carts WHERE user_id = :user_id";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':user_id'=>$id]);

            return $stmt->fetch();
        }catch(Exception $e){
            echo "Lỗi" .$e->getMessage();

        }

    }

    
    public function getDetailGioHang($id){
        try{
            $sql = "SELECT cart_details.*,  products.ten_san_pham, products.hinh_anh, products.gia_san_pham, products.gia_khuyen_mai
            FROM cart_details
            INNER JOIN products ON cart_details.product_id = products.id
            WHERE cart_details.cart_id = :cart_id";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':cart_id'=>$id]);
            
            return $stmt->fetchAll();
        }catch(Exception $e){
            echo "Lỗi" .$e->getMessage();

        }

    }
    public function addGioHang($id){
        try{
            $sql = "INSERT INTO carts(user_id) VALUES (:id)";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id'=>$id]);

            return $this->conn->lastInsertId();
        }catch(Exception $e){
            echo "Lỗi" .$e->getMessage();

        }
    }
    public function updateSoLuong($cart_id, $product_id, $so_luong){
        try{
            $sql = "UPDATE cart_details 
            SET so_luong = :so_luong
            WHERE cart_id = :cart_id AND product_id = :product_id
            ";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':cart_id'=>$cart_id, ':product_id'=>$product_id, ':so_luong'=>$so_luong]);

            return true;
        }catch(Exception $e){
            echo "Lỗi" .$e->getMessage();

        }
    }
    public function addDetailGioHang($cart_id, $product_id, $so_luong){
        try{
            $sql = "INSERT INTO cart_details(cart_id, product_id, so_luong) 
            VALUES (:cart_id, :product_id, :so_luong) ";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':cart_id'=>$cart_id, ':product_id'=>$product_id, ':so_luong'=>$so_luong]);

            return true;
        }catch(Exception $e){
            echo "Lỗi" .$e->getMessage();

        }
    }

}
?>