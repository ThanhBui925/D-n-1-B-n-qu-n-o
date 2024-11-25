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
                            
        $stmt->execute([':user_id'=>$user_id,
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
    

  

}
?>