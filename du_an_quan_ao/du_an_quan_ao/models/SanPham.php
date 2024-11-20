<?php
class SanPham{
    public $conn; // Khai báo phương thức

    public function __construct(){

        $this->conn = connectDB();

    }

    // Viết hàm lấy toàn bộ danh sách sản phẩm
    public function getAllSanPham(){
        try{
            $sql = "SELECT products.*, categories.ten_danh_muc
            FROM products
            INNER JOIN categories ON products.category_id = categories.id
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        }catch(Exception $e){
            echo "Lỗi" . $e->getMessage();
    }
}
public function getDetailSanPham($id){
    try{
        $sql = "SELECT products.*, categories.ten_danh_muc
            FROM products
            INNER JOIN categories ON products.category_id = categories.id
            
        
        
        WHERE products.id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([':id'=>$id]);

        return $stmt->fetch();
    }catch(Exception $e){
        echo "Lỗi". $e->getMessage();
    }
}


public function getListAnhSanPham($id){
    try{
        $sql = "SELECT * FROM product_images WHERE product_id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([':id'=>$id]);

        return $stmt->fetchAll();
    }catch(Exception $e){
        echo "Lỗi". $e->getMessage();
    }
}

// BÌNH LUẬN 
public function getBinhLuanFromSanPham($id){
    try{
        // $sql = "SELECT * FROM products";
        $sql = "SELECT comments.*, users.ho_ten, users.anh_dai_dien
        FROM comments
        INNER JOIN users ON comments.user_id = users.id
        WHERE comments.product_id = :id
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([':id' => $id]);

        return $stmt->fetchAll();
    }catch(Exception $e){
        echo "Lỗi".      $e->getMessage();
    }
}


public function getListSanPhamDanhMuc($category_id){
    try{
        $sql = "SELECT products.*, categories.ten_danh_muc
        FROM products
        
        INNER JOIN categories ON products.category_id = categories.id

        WHERE products.category_id = " .$category_id ;

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();

    }catch(Exception $e){
        echo "Lỗi" . $e->getMessage();
}
}

}
