<?php
class TaiKhoan{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function checkLogin($email, $mat_khau){
        try{
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $user = $stmt->fetch();
    
            if($user && password_verify($mat_khau, $user['mat_khau'])){
                if($user["position_id"] == 2){
                    if($user["trang_thai"] == 1){
                        return $user["email"]; // TH đăng nhập thành công
                    }else{
                        return "Tài khoản bị cấm !";
                    }
                }else{
                    return "Tài khoản không có quyền đăng nhập !";
                }
            }else{
                return "Tài khoản hoặc mật khẩu không đúng !";
            }
        }catch(Exception $e){
                echo "Lỗi".$e->getMessage();
                return false;
            }
    }   


    public function getTaiKhoanfromEmail($email){
        try{
            $sql = "SELECT * FROM users WHERE email = :email";
    
            $stmt = $this->conn->prepare($sql);
    
            $stmt->execute([
                ':email' => $email
            ]);
    
            return $stmt->fetch();
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }
}
?>