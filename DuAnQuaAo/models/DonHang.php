<?php
class DonHang{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function addDonHang($user_id, $ten_nguoi_nhan, $sdt_nguoi_nhan, $email_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $tong_tien, $payment_method_id, $ngay_dat, $order_status_id, $ma_don_hang){
      try{
        $sql = "INSERT INTO orders (user_id, ten_nguoi_nhan, sdt_nguoi_nhan, email_nguoi_nhan, dia_chi_nguoi_nhan, ghi_chu, tong_tien, payment_method_id, ngay_dat, order_status_id, ma_don_hang)
        VALUES(:user_id, :ten_nguoi_nhan, :sdt_nguoi_nhan, :email_nguoi_nhan, :dia_chi_nguoi_nhan, :ghi_chu, :tong_tien, :payment_method_id, :ngay_dat, :order_status_id, :ma_don_hang)
        ";
        $stmt = $this->conn->prepare($sql);
                            
        $order = $stmt->execute([':user_id'=>$user_id,
                        ':ten_nguoi_nhan'=>$ten_nguoi_nhan,
                        ':sdt_nguoi_nhan'=>$sdt_nguoi_nhan,
                        ':email_nguoi_nhan'=>$email_nguoi_nhan,
                        ':dia_chi_nguoi_nhan'=>$dia_chi_nguoi_nhan,
                        ':ghi_chu'=>$ghi_chu,
                        ':tong_tien'=>$tong_tien,
                        ':payment_method_id'=>$payment_method_id,
                        ':ngay_dat'=>$ngay_dat,
                        ':order_status_id'=>$order_status_id,
                        ':ma_don_hang'=>$ma_don_hang
                        ]);
                            
        return $this->conn->lastInsertId();
        }catch(Exception $e){
        echo "Lỗi" .$e->getMessage();
                            
        }

    }

    public function addDetailOrder($product_id,$order_id,$don_gia,$so_luong,$thanh_tien) {
        try {
        $sql = "INSERT INTO `oder_details`(`oder_id`, `product_id`, `don_gia`, `so_luong`, `thanh_tien`) 
        VALUES (:order_id, :product_id, :don_gia, :so_luong, :thanh_tien)";
        $stmt = $this->conn->prepare($sql);
                            
        $result = $stmt->execute([
            ':order_id'=>$order_id,
            ':product_id'=>$product_id,
            ':don_gia'=>$don_gia,
            ':so_luong'=>$so_luong,
            ':thanh_tien'=>$thanh_tien,
        ]);
        return $result;
                
        } catch (Exception $e){
        echo "Lỗi: " .$e->getMessage();
                            
        }
    }

    public function deleteCartBought($product_id, $cart_id) {
        try {
            
            $sql = "DELETE FROM `cart_details` WHERE product_id = :product_id AND cart_id = :cart_id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':product_id' => $product_id, ':cart_id' => $cart_id ]);
        
        } catch (Exception $e) {
    
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    
    

    public function getCartIdByUser($user_id) {
        try {
            $sql = "SELECT id FROM `carts` WHERE user_id = :user_id";
            
            $stmt = $this->conn->prepare($sql);
            
            $stmt->execute([':user_id' => $user_id]);
    
            return $stmt->fetch(PDO::FETCH_COLUMN);
            
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }
    
    
}
?>