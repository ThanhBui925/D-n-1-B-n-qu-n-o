<?php 
class AdminSanPham{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllSanPham(){
        try{
            // $sql = "SELECT * FROM products";
            $sql = "SELECT products.*, categories.ten_danh_muc
            FROM products
            INNER JOIN categories ON products.category_id = categories.id
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }


    public function insertSanPham($ten_san_pham, 
    $gia_san_pham,
    $gia_khuyen_mai,
    $so_luong, 
    $ngay_nhap,
    $mo_ta,
    $category_id,
    $trang_thai, $hinh_anh){
        try{
            $sql = "INSERT INTO products (ten_san_pham, gia_san_pham, gia_khuyen_mai, so_luong, ngay_nhap, mo_ta, category_id, trang_thai, hinh_anh) 
            VALUES (:ten_san_pham, :gia_san_pham, :gia_khuyen_mai, :so_luong, :ngay_nhap, :mo_ta, :category_id, :trang_thai, :hinh_anh)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham'=> $gia_san_pham,
                ':gia_khuyen_mai'=> $gia_khuyen_mai,
                ':mo_ta' => $mo_ta,
                ':so_luong'=> $so_luong,
                ':ngay_nhap'=> $ngay_nhap,
                ':category_id'=> $category_id,
                ':ngay_nhap'=> $ngay_nhap,
                ':hinh_anh'=> $hinh_anh,
                ':trang_thai'=> $trang_thai
            ]);
            // lấy id sản phẩm vừa thêm
            return $this->conn->lastInsertId();
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
}




public function insertAlbumAnhSanPham($product_id, $link_hinh_anh){
    try{
        $sql = "INSERT INTO product_images (product_id, link_hinh_anh) 
        VALUES (:product_id, :link_hinh_anh)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':product_id' => $product_id,
            ':link_hinh_anh' => $link_hinh_anh,
        ]);
        return true;
    }catch(Exception $e){
        echo "Lỗi".      $e->getMessage();
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


public function updateSanPham($san_pham_id,$ten_san_pham, 
$gia_san_pham,
$gia_khuyen_mai,
$so_luong, 
$ngay_nhap,
$mo_ta,
$category_id,
$trang_thai, 
$hinh_anh){
    try{
        $sql = "UPDATE products
        SET
         ten_san_pham = :ten_san_pham,
         gia_san_pham = :gia_san_pham,
         gia_khuyen_mai = :gia_khuyen_mai,
         so_luong = :so_luong,
         ngay_nhap = :ngay_nhap,
         category_id = :category_id,
         trang_thai = :trang_thai,
         mo_ta = :mo_ta,
         hinh_anh = :hinh_anh
       WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        // var_dump($sql);die;

        $stmt->execute([
            ':ten_san_pham' => $ten_san_pham,
            ':gia_san_pham'=> $gia_san_pham,
            ':gia_khuyen_mai'=> $gia_khuyen_mai,
            ':mo_ta' => $mo_ta,
            ':so_luong'=> $so_luong,
            ':ngay_nhap'=> $ngay_nhap,
            ':category_id'=> $category_id,
           
            ':trang_thai'=> $trang_thai,
            ':id' => $san_pham_id,
            ':hinh_anh'=> $hinh_anh,
        ]);
        // lấy id sản phẩm vừa thêm
        return true;
        
    }catch(Exception $e){
        echo "Lỗi".      $e->getMessage();
    }
}

public function getDetailAnhSanPham($id){
    try{
        $sql = "SELECT * FROM product_images WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([':id'=>$id]);

        return $stmt->fetch();
    }catch(Exception $e){
        echo "Lỗi". $e->getMessage();
    }
}



public function updateAnhSanPham($id,$new_file){
    try{
        $sql = "UPDATE product_images SET link_hinh_anh = :new_file WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':new_file' => $new_file,
            ':id'=> $id,
            
        ]);
        return true;
        
    }catch(Exception $e){
        echo "Lỗi".      $e->getMessage();
    }
}

public function destroyAnhSanPham($id){
    try{
        $sql = "DELETE FROM product_images WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return true;
    }catch(Exception $e){
        echo "Lỗi".      $e->getMessage();
    }
}

public function destroySanPham($id){
    try{
        $sql = "DELETE FROM products WHERE id = :id";

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