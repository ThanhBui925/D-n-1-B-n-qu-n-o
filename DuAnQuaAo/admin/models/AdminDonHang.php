<?php 
class AdminDonHang{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllDonHang(){
        try{
            // $sql = "SELECT * FROM products";
            $sql = "SELECT orders.*, order_status.ten_trang_thai
            FROM orders
            INNER JOIN order_status ON orders.order_status_id = order_status.id
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }

    public function getAllTrangThaiDonHang(){
        try{
            // $sql = "SELECT * FROM products";
            $sql = "SELECT * FROM order_status ";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }

public function getDetailDonHang($id){
    try{
        $sql = "SELECT orders.*, 
                order_status.ten_trang_thai, 
                users.ho_ten, users.email, 
                users.so_dien_thoai,
                payment_methods.ten_phuong_thuc
            FROM orders
            INNER JOIN order_status ON orders.order_status_id = order_status.id
            INNER JOIN users ON orders.user_id = users.id
            INNER JOIN payment_methods ON orders.payment_method_id = payment_methods.id
            WHERE orders.id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([':id'=>$id]);

        return $stmt->fetch();
    }catch(Exception $e){
        echo "Lỗi". $e->getMessage();
    }
}
public function getListSpDonHang($id){
    try{
        $sql = "SELECT oder_details.*, products.ten_san_pham
        FROM oder_details
        INNER JOIN products ON oder_details.product_id = products.id
            WHERE oder_details.oder_id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([':id'=>$id]);

        return $stmt->fetchAll();
    }catch(Exception $e){
        echo "Lỗi". $e->getMessage();
    }
}


public function updateDonHang($id, $ten_nguoi_nhan, $sdt_nguoi_nhan, $email_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $order_status_id){
    try{
        // var_dump($id);die;
        $sql = "UPDATE orders
        SET
         ten_nguoi_nhan = :ten_nguoi_nhan,
         sdt_nguoi_nhan = :sdt_nguoi_nhan,
         email_nguoi_nhan = :email_nguoi_nhan,
         dia_chi_nguoi_nhan = :dia_chi_nguoi_nhan,
         ghi_chu = :ghi_chu,
         order_status_id = :order_status_id
       WHERE id = :id ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':ten_nguoi_nhan' => $ten_nguoi_nhan,
            ':sdt_nguoi_nhan'=> $sdt_nguoi_nhan,
            ':email_nguoi_nhan'=> $email_nguoi_nhan,
            ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
            ':ghi_chu'=> $ghi_chu,
            ':order_status_id' => $order_status_id,
            ':id'=> $id
        ]);
      
        return true;
        
    }catch(Exception $e){
        echo "Lỗi".      $e->getMessage();
    }
}

public function getDonHangFromKhachHang($id){
    try{
        // $sql = "SELECT * FROM products";
        $sql = "SELECT orders.*, order_status.ten_trang_thai
        FROM orders
        INNER JOIN order_status ON orders.order_status_id = order_status.id
        WHERE orders.user_id = :id
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([':id' => $id]);

        return $stmt->fetchAll();
    }catch(Exception $e){
        echo "Lỗi".      $e->getMessage();
    }
}



}


?>