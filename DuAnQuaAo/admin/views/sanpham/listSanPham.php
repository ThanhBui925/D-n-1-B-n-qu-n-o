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
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="<?= BASE_URL_ADMIN.'?act=create-san-pham' ?>">
                  <button class="btn btn-success">Thêm sản phẩm</button>
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead  class="text-center align-middle">
                  <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Giá tiền</th>
                    <th>Số lượng</th>
                    <th>Danh mục sản phẩm</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  
                  <tbody class="text-center align-middle">
                    <?php foreach ($listSanPham as $key=>$sanPham):?>
                        <tr>
                          <td style="vertical-align: middle;"><?= $key+1?></td>
                          <td style="vertical-align: middle;"><?= $sanPham["ten_san_pham"] ?></td>
                          <td style="vertical-align: middle;">
                            <img style="width: 60px; height: 70px" src= "<?= BASE_URL . $sanPham['hinh_anh']?>" alt=""
                            onerror="this.onerror=null; this.src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRg2IWOhm7wMIde-u1ePywcsBY6iN1--pwXCQ&s'"
                            >
                            
                          </td>
                          <td style="vertical-align: middle;"><?= $sanPham["gia_san_pham"] ?></td>
                          <td style="vertical-align: middle;"><?= $sanPham["so_luong"] ?></td>
                          <td style="vertical-align: middle;"><?= $sanPham["ten_danh_muc"] ?></td>
                          <td style="vertical-align: middle;"><?= $sanPham["trang_thai"] == 1 ? 'Còn hàng' : 'Hết hàng' ?></td>
                          <td style="vertical-align: middle;">
                          <a href="<?= BASE_URL_ADMIN.'?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                              <button class="btn btn-success"><i class="fas fa-eye"></i></button>
                            </a>
                            <a href="<?= BASE_URL_ADMIN.'?act=edit-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                              <button class="btn btn-warning"><i class="fas fa-tools"></i></button>
                            </a>
                            <a href="<?= BASE_URL_ADMIN.'?act=xoa-san-pham&id_san_pham=' . $sanPham['id'] ?>"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không ?')">
                              <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </a>
                          </td>
                        </tr>
                    <?php endforeach ?>
                  
                  </tbody>
                  <tfoot class="text-center align-middle">
                  <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Giá tiền</th>
                    <th>Số lượng</th>
                    <th>Danh mục sản phẩm</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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
</script>
</body>
</html>