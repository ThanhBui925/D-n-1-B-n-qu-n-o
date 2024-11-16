<?php
class AdminTaiKhoan{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllTaiKhoan($position_id){
        try{
            $sql = "SELECT * FROM users WHERE position_id = :position_id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':position_id'=>$position_id]);

            return $stmt->fetchAll();
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }

    public function insertTaiKhoan($ho_ten, $email, $password, $position_id){
        try{
            $sql = "INSERT INTO users (ho_ten, email, mat_khau, position_id) 
            VALUES (:ho_ten, :email, :password, :position_id)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':password' => $password,
                ':position_id' => $position_id,
        
               
            ]);

            return true;
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }

    public function getDetailTaiKhoan($id){
        try{
            $sql = "SELECT * FROM users WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch();
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }

    public function updateTaiKhoan($id, $ho_ten, $email, $so_dien_thoai, $trang_thai){
        try{
            // var_dump($id);die;
            $sql = "UPDATE users
            SET
             ho_ten = :ho_ten,
             email = :email,
             so_dien_thoai = :so_dien_thoai,
             trang_thai = :trang_thai
           WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
        //   var_dump($stmt);die;
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email'=> $email,
                ':so_dien_thoai'=> $so_dien_thoai,
                ':trang_thai' => $trang_thai,
                ':id'=> $id
            ]);
          
            return true;
            
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }
    public function resetPassword($id, $mat_khau){
        try{
            // var_dump($id);die;
            $sql = "UPDATE users
            SET
             mat_khau = :mat_khau
           WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
        //   var_dump($stmt);die;
            $stmt->execute([
                ':mat_khau' => $mat_khau,
                ':id' => $id
              
            ]);
          
            return true;
            
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }

    public function updateKhachHang($id, $ho_ten, $email, $so_dien_thoai, $trang_thai, $ngay_sinh, $gioi_tinh, $dia_chi){
        try{
            // var_dump($id);die;
            $sql = "UPDATE users
            SET
            ho_ten = :ho_ten,
            email = :email,
            so_dien_thoai = :so_dien_thoai,
            trang_thai = :trang_thai,
            ngay_sinh = :ngay_sinh,
            gioi_tinh = :gioi_tinh,
            dia_chi = :dia_chi

           WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
          
        //   var_dump($stmt);die;
        // var_dump($stmt);die;
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email'=> $email,
                ':so_dien_thoai'=> $so_dien_thoai,
                ':trang_thai' => $trang_thai,
                ':ngay_sinh' => $ngay_sinh,
                ':gioi_tinh' => $gioi_tinh,
                ':dia_chi' => $dia_chi,
                ':id'=> $id
            ]);
          
            return true;
            
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }
    
    

}


?>