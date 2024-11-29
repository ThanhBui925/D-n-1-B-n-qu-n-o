<!-- header -->
<?php include "./views/layout/header.php"; ?>
<!-- end header -->
  <!-- Navbar -->

 <?php include "./views/layout/navbar.php"; ?>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

<?php include "./views/layout/sidebar.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý tài khoản khách hàng</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

   <!-- Main content -->
   <div class="container-fluid">
	<div class="row">
      <!-- left column -->
    
            <div class="col-md-3">
                <div class="text-center">
                <img src="<?= BASE_URL . $thongTin["anh_dai_dien"] ?>" style="width:200px"class="avatar img-circle" alt="avatar"
                onerror="this.onerror=null; this.src='https://imgcdn.stablediffusionweb.com/2024/3/27/374a7884-efc9-4546-b53e-d29d6033e7d9.jpg'">
                <h6 class="mt-2"> <?=$thongTin["ho_ten"]?></h6>
                <h6 class="mt-2">Chức vụ: <?=$thongTin["position_id"] == 1 ? "Admin" : "Khách hàng"?></h6>
               
                </div>
            </div>
            <!-- edit form column -->
            <div class="col-md-9 personal-info">
            <form action="<?= BASE_URL_ADMIN . "?act=sua-thong-tin-ca-nhan-quan-tri"?>" method="post">
                <hr>
                <h3>Thông tin cá nhân: </h3>
                <input type="hidden" name="id_ca_nhan" value="<?=$thongTin ["id"]?>">
                <div class="form-group">
                    <label class="col-lg-3 control-label">Họ tên:</label>
                    <div class="col-lg-12">
                    <input class="form-control" type="text" value="<?=$thongTin ["ho_ten"] ?>" name="ho_ten">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email</label>
                    <div class="col-lg-12">
                    <input class="form-control" type="email" value="<?=$thongTin ["email"] ?>" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Số điện thoại</label>
                    <div class="col-lg-12">
                    <input class="form-control" type="number" value="<?=$thongTin ["so_dien_thoai"] ?>" name="so_dien_thoai">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Ngày sinh</label>
                    <div class="col-lg-12">
                    <input class="form-control" type="date" value="<?=$thongTin ["ngay_sinh"] ?>" name="ngay_sinh">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Địa chỉ:</label>
                    <div class="col-lg-12">
                    <input class="form-control" type="text" value="<?=$thongTin ["dia_chi"] ?>" name="dia_chi">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Giới tính</label>
                    <div class="col-lg-12">
                    <select id="inputStatus" name="gioi_tinh" class="form-control custom-select">
                    <option <?= $thongTin['gioi_tinh'] == 1 ? 'selected':'' ?> value="1">Nam</option>
                    <option <?= $thongTin['gioi_tinh'] !== 1 ? 'selected':'' ?> value="2">Nữ</option>
                    </select>
                    </div>
                </div>
               
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-12">
                    <input type="submit" class="btn btn-primary" value="Save Changes">
                    </div>
                </div>
          </form>
          <hr>
         
          <h3>Đổi mật khẩu</h3>
          <?php if(isset($_SESSION["success"])){ ?>
                <div class="alert alert-info alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a> 
                    <i class="fa fa-coffee"></i>
                   <?= $_SESSION["success"];?>
                </div>
          <?php }?>
          
          <form action="<?= BASE_URL_ADMIN . '?act=sua-mat-khau-ca-nhan-quan-tri'?>" method="post">
          <div class="form-group">
            <label class="col-md-3 control-label">Mật khẩu cũ: </label>
            <div class="col-md-12">
              <input class="form-control" type="password" value="" name="old_pass">
              <?php if(isset($_SESSION['error']["old_pass"])){ ?>
                            <p class="text-danger"><?= $_SESSION['error']["old_pass"]?></p>
              <?php }?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Mật khẩu mới: </label>
            <div class="col-md-12">
              <input class="form-control" type="password" value="" name="new_pass">
              <?php if(isset($_SESSION['error']["new_pass"])){ ?>
                            <p class="text-danger"><?= $_SESSION['error']["new_pass"]?></p>
              <?php }?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Nhập lại mật khẩu mới: </label>
            <div class="col-md-12">
              <input class="form-control" type="password" value="" name="confirm_pass">
              <?php if(isset($_SESSION['error']["confirm_pass"])){ ?>
                            <p class="text-danger"><?= $_SESSION['error']["confirm_pass"]?></p>
              <?php }?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary" value="Lưu lại">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
<hr>
    <!-- /.content -->
 
<!-- footer -->
 <?php include "./views/layout/footer.php" ?>
<!-- end footer -->

</body>
</html>