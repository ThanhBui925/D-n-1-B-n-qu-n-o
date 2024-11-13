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
}

?>