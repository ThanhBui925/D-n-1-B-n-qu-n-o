<!-- header -->
<?php include "./views/layout/header.php"; 
?>
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
            <h1>Quản lý danh sách sản phẩm</h1>
          </div>
          <!-- --------------------------------------------------------------------------------------------- -->
          <!-- THÔNG BÁO XÓA THÀNH CÔNG -->
          <div class="col-sm-6">
          <?php  
            // Kiểm tra và hiển thị thông báo nếu có  
            if (isset($_SESSION['message'])) {  
                echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';  
                // Xóa thông báo khỏi session sau khi hiển thị  
                unset($_SESSION['message']);  
            }  
            ?>
          </div>
          <!-- ---------------------------------------------------------------------------------------------- -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">

<!-- Default box -->
<div class="card card-solid">
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-sm-6">
        <div class="col-12">
          <img style="width: 400px; height:500px" src="<?= BASE_URL. $sanPham['hinh_anh']?>" class="product-image" alt="Product Image">
        </div>
        <div class="col-12 product-image-thumbs">
          <!-- <div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg" alt="Product Image"></div> -->
           <?php foreach($listAnhSanPham as $key=>$anhSP): ?>
              <div class="product-image-thumb <?=$anhSP[$key]==0?'active':''?>" ><img src="<?= BASE_URL.$anhSP['link_hinh_anh']?>" alt="Product Image"></div>
           <?php endforeach ?>
        
        </div>
      </div>
      <div class="col-12 col-sm-6">
        <h3 class="my-3">Tên sản phẩm: <?=$sanPham["ten_san_pham"]?></h3>
        <hr>
        <h4 class="mt-3">Giá tiền: <small><?= $sanPham["gia_san_pham"]?></small></h4>
        <h4 class="mt-3">Giá khuyến mãi <small><?= $sanPham["gia_khuyen_mai"]?></small></h4>
        <h4 class="mt-3">Số lượng còn: <small><?= $sanPham["so_luong"]?></small></h4>
        <h4 class="mt-3">Lượt xem: <small><?= $sanPham["luot_xem"]?></small></h4>
        <h4 class="mt-3">Ngày nhập: <small><?= $sanPham["ngay_nhap"]?></small></h4>
        <h4 class="mt-3">Danh mục: <small><?= $sanPham["ten_danh_muc"]?></small></h4>
        
        <h4 class="mt-3">Trạng thái: <small><?= $sanPham["trang_thai"] == 1 ? 'Còn hàng' : 'Dừng bán' ?></small></h4>
        <h4 class="mt-3">Mô tả: <small><?= $sanPham["mo_ta"]?></small></h4>
       

      </div>
    </div>
 
  <ul class="nav nav-tabs row mt-4" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Bình luận của sản phẩm</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="hone" role="tabpanel" aria-labelledby="home-tab"></div>
    <table class="table table-striped table-hover">
            <thead>
              <tr>
                  <th>#</th>
                  <th>Tên người bình luận</th>
                  <th>Nội dung</th>
                  <th>Ngày đăng</th>
                  <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                  <td>1</td>
                  <td>Nguyễn Quang Quyền</td>
                  <td>Sản phẩm hơi cũ, form ọp ẹp</td>
                  <td>20/07/2024</td>
                  <td>
                   <div class="btn-group">
                    <a href="#"><button class="btn btn-warning">Ẩn</button></a>
                    <a href="#"><button class="btn btn-danger">Xóa</button></a>
                   </div>
                  </td>
            </tr>
            </tbody>
          </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

</section>
 
<!-- footer -->
 <?php include "./views/layout/footer.php" ?>
<!-- end footer -->
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- JS cho form detail SP-->
<script>
  $(document).ready(function() {
    $('.product-image-thumb').on('click', function () {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  })
</script>
<!-- Code injected by live-server -->
</body>
</html>