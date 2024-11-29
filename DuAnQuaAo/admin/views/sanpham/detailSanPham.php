<!-- header -->
<?php require "./views/layout/header.php"; ?>
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
            <h1>Quản lý sản phẩm</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

   <!-- Main content -->
   <section class="content">

      <!-- Default box -->
      <div class="card card-solid card-warning">
        <div class="card-header ">
            <h1 style="font-size: 25px;" class="card-title">Chi tiết sản phẩm</h1>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="col-12 text-center">
                <img style="width:350px; height:400px" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs ">
                <?php foreach($listAnhSanPham as $key=>$anhSP): ?>
                <div class="product-image-thumb text-center <?= $anhSP[$key == 0 ? 'active' : '' ] ?>"><img src="<?= BASE_URL . $anhSP['link_hinh_anh'] ?>" alt="Product Image"></div>
                <?php endforeach ?>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?= $sanPham['ten_san_pham'] ?></h3>

              <hr>
              

              <h4 class="mt-3">Giá tiền : <small><?= $sanPham['gia_san_pham'] ?></small></h4>
              <h4 class="mt-3">Giá khuyến mãi : <small><?= $sanPham['gia_khuyen_mai'] ?></small></h4>
              <h4 class="mt-3">Số lượng : <small><?= $sanPham['so_luong'] ?></small></h4>
              <h4 class="mt-3">Lượt xem : <small><?= $sanPham['luot_xem'] ?></small></h4>
              <h4 class="mt-3">Ngày nhập : <small><?= $sanPham['ngay_nhap'] ?></small></h4>
              <h4 class="mt-3">Danh mục : <small><?= $sanPham['ten_danh_muc'] ?></small></h4>
              <h4 class="mt-3">Trạng thái : <small><?= $sanPham['trang_thai'] == 1 ? 'Còn hàng' : 'Hết hàng' ?></small></h4>
              <h4 class="mt-3">Mô tả : <small><?= $sanPham['mo_ta'] ?></small></h4>

              

              

             

            </div>
          </div>
          <!-- <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#binh-luan" role="tab" aria-controls="product-desc" aria-selected="true">Quản lý bình luận</a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="binh-luan" role="tabpanel" aria-labelledby="product-desc-tab"> 
                    <div class="container-fluid">

                    
                        
                    </div>
            </div>
            </div>
          </div> -->
          <ul style="margin-left: 1px;" class="nav nav-tabs row mt-4" id="myTab" role="tablist">
            <li  class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Bình luận sản phẩm</button>
            </li>
            
            </ul>
            <div class="tab-content" id="myTabContent">
            <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên tài khoản</th>
                            <th>Nội dung</th>
                            <th>Ngày đăng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($listBinhLuan as $key => $binhLuan):?>
                        <tr>
                          <td><?= $key+1 ?></td>
                          <td>
                            <a target="_blank" href="<?= BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' .$binhLuan['user_id']?>"><?= $binhLuan["ho_ten"] ?></a>
                          </td>
                          <td><?= $binhLuan["noi_dung"] ?></td>
                          <td><?= $binhLuan["ngay_dang"] ?></td>
                          <td><?= $binhLuan["trang_thai"] == 1 ? "Hiển thị" : "Bị ẩn" ?></td>
                        
                          <td>
                             <form action="<?= BASE_URL_ADMIN . '?act=update-trang-thai-binh-luan'?>" method="post">
                                <input type="hidden" name="id_binh_luan" value="<?=$binhLuan['id']?>">
                                <input type="hidden" name="name_view" value="detail_sanpham">
                              
                                <button   onclick="return confirm('Bạn có chắc chắn muốn ẩn bình luận này không?')" class="btn btn-warning">
                                  <?= $binhLuan['trang_thai'] == 1 ? "Ẩn" : "Bỏ ẩn" ?>
                                </button>
                             </form>  
                            </div>
                            
                           
                          </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
 
<!-- footer -->
 <?php include "./views/layout/footer.php" ?>
<!-- end footer -->
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
  $(document).ready(function() {
    $('.product-image-thumb').on('click', function () {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  })
</script>
</body>
</html>