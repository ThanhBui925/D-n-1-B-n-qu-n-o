<?php 
class AdminDanhMuc{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllDanhMuc(){
        try{
            $sql = "SELECT * FROM categories";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }


    public function insertDanhMuc($ten_danh_muc, $mo_ta){
        try{
            $sql = "INSERT INTO categories (ten_danh_muc, mo_ta) VALUES (:ten_danh_muc, :mo_ta)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_danh_muc' => $ten_danh_muc,
                ':mo_ta' => $mo_ta
            ]);

            return true;
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }

    public function getDetailDanhMuc($id){
        try{
            $sql = "SELECT * FROM categories WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch();
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }


    public function updateDanhMuc($id, $ten_danh_muc, $mo_ta){
        try{
            $sql = "UPDATE categories SET ten_danh_muc = :ten_danh_muc, mo_ta = :mo_ta WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_danh_muc' => $ten_danh_muc,
                ':mo_ta' => $mo_ta,
                ':id' => $id
            ]);

            return true;
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }



    public function destroyDanhMuc($id){
        try{
            $sql = "DELETE FROM categories WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return true;
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }
}

?>