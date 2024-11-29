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
                    <h1>Sửa thông tin sản phẩm : <?= $sanPham['ten_san_pham'] ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-8">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Thông tin chung</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <form method="post" enctype="multipart/form-data">
                
            <div class="card-body row ">
              <div class="form-group col-12">
                <input type="hidden" name="product_id" value="<?= $sanPham['id'] ?>">
                
                <label for="ten_san_pham">Tên sản phẩm</label>
                <input type="text" id="ten_san_pham" name="ten_san_pham" class="form-control" value="<?=$sanPham['ten_san_pham']?>">
                <?php if(isset($errors['ten_san_pham'])): ?>
                    <p class="text-danger"><?= $errors['ten_san_pham'] ?></p>
                <?php endif; ?>
              </div>

              <div class="form-group col-6">
                <label for="gia_san_pham">Giá sản phẩm</label>
                <input type="number" id="gia_san_pham" name="gia_san_pham" class="form-control" value="<?=$sanPham['gia_san_pham']?>">
                <?php if(isset($errors['gia_san_pham'])): ?>
                    <p class="text-danger"><?= $errors['gia_san_pham'] ?></p>
                <?php endif; ?>
              </div>

              <div class="form-group col-6">
                <label for="gia_khuyen_mai">Giá khuyến mãi</label>
                <input type="number" id="gia_khuyen_mai" name="gia_khuyen_mai" class="form-control" value="<?=$sanPham['gia_khuyen_mai']?>">
                <?php if(isset($errors['gia_khuyen_mai'])): ?>
                    <p class="text-danger"><?= $errors['gia_khuyen_mai'] ?></p>
                <?php endif; ?>
              </div>

              <div class="form-group col-12">
                <label for="hinh_anh">Hình ảnh</label>
                <input type="file" id="hinh_anh" name="hinh_anh" class="form-control">
              </div>

              <div class="form-group col-6">
                <label for="so_luong">Số lượng</label>
                <input type="number" id="so_luong" name="so_luong" class="form-control" value="<?=$sanPham['so_luong']?>">
                <?php if(isset($errors['so_luong'])): ?>
                    <p class="text-danger"><?= $errors['so_luong'] ?></p>
                <?php endif; ?>
              </div>

              <div class="form-group col-6">
                <label for="ngay_nhap">Ngày nhập</label>
                <input type="date" id="ngay_nhap" name="ngay_nhap" class="form-control" value="<?=$sanPham['ngay_nhap']?>">
                <?php if(isset($errors['ngay_nhap'])): ?>
                    <p class="text-danger"><?= $errors['ngay_nhap'] ?></p>
                <?php endif; ?>
              </div>

              <div class="form-group col-6">
                <label for="inputStatus">Danh mục sản phẩm</label>
                <select id="inputStatus" name="category_id" class="form-control custom-select">
                  <?php foreach($listDanhMuc as $danhMuc): ?>
                    <option <?= $danhMuc['id'] == $sanPham['category_id'] ? 'selected' : '' ?> value="<?= $danhMuc['id'] ?>"><?= $danhMuc['ten_danh_muc'] ?></option>
                  <?php endforeach ?>
                  
                </select>
                <?php if(isset($errors['category_id'])): ?>
                    <p class="text-danger"><?= $errors['category_id'] ?></p>
                <?php endif; ?>
              </div>
              <div class="form-group col-6">
                <label for="trang_thai">Trạng thái sản phẩm</label>
                <select id="trang_thai" name="trang_thai" class="form-control custom-select">
                    <option <?= $sanPham['trang_thai'] == 1 ? 'selected' : '' ?> value="1">Còn hàng</option>
                    <option <?= $sanPham['trang_thai'] == 2 ? 'selected' : '' ?> value="2">Hết hàng</option>
                  
                </select>
                <?php if(isset($errors['category_id'])): ?>
                    <p class="text-danger"><?= $errors['category_id'] ?></p>
                <?php endif; ?>
              </div>
              <div class="form-group col 12">
                <label for="mo_ta">Mô tả sản phẩm</label>
                <textarea id="mo_ta" name="mo_ta" class="form-control" rows="4"><?= $sanPham['mo_ta'] ?></textarea>
              </div>
            </div>
            <!-- /.card-body -->
             <div class="card-footer text-center">
                <button type="submit" class="btn btn-success">Sửa thông tin</button>
             </div>
        </div>
    </form>
          <!-- /.card -->
        </div>
        <div class="col-md-4">
          
          <!-- /.card -->
          <div class="card card-info card-warning">
            <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Hình ảnh sản phẩm</h3>
                    </div>
                    <form class="mx-auto">
                        <img id="imagePreview" style="width: 150px;" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="" onerror="this.onerror=null; this.src=''">
                    </form>
                <!-- </div> -->
            </div>
            <div class="card-header card-warning">
              <h3 class="card-title">Album ảnh sản phẩm</h3>
            
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
                <div class="padding">
                    <div class="table-responsive">
                    <form action="?act=sua-album-anh-san-pham" method="post" enctype="multipart/form-data">
                
                        <table id="faqs" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>File</th>
                                    <th>
                                        <div class="text-center"><button onclick="addfaqs();" type="button" class="badge badge-success"><i class="fa fa-plus"></i> Add</button></div>
                                    </th>
                                        
                                </tr>
                            </thead>
                            <tbody>
                                <input type="hidden" name="product_id" value="<?= $sanPham['id'] ?>">
                                <input type="hidden" id="img_delete" name="img_delete">
                                <?php foreach($listAnhSanPham as $key=>$value):?>
                                <tr id="faqs-row-<?= $key ?>">
                                    <input type="hidden" name="current_img_ids[]" value="<?= $value['id'] ?>">
                                    <td><img src="<?= BASE_URL . $value['link_hinh_anh'] ?>" style="width: 50px; height:50px" alt=""></td>
                                    <td><input type="file" name="img_array[]" placeholder="Product name" class="form-control"></td>
                                    <td class="mt-10"><button type="button" class="badge badge-danger" onclick="removeRow(<?= $key ?>,<?= $value['id'] ?>)"><i class="fa fa-trash"></i> Delete</button></td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
             <!-- /.card-body -->
             <div class="card-footer text-center">
                <button type="submit" class="btn btn-success">Sửa album</button>
             </div>
             </form>

          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        
      </div>
    </section>
    <!-- /.content -->

</div>

<!-- footer -->
<?php include "./views/layout/footer.php"; ?>
<!-- end footer -->

<!-- Page specific script -->
<script>
    // Focus on the first input with error if errors exist
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $key => $error): ?>
            <?php if ($key == array_key_first($errors)): ?>
                document.querySelector('[name="<?= $key ?>"]').focus();
                // break;
                exit();
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</script>
<script>
    // Set giá trị của input date thành ngày hôm nay
    document.addEventListener("DOMContentLoaded", function() {
        var today = new Date().toISOString().split('T')[0]; // Lấy ngày hiện tại và chuyển về định dạng YYYY-MM-DD
        document.getElementById("ngay_nhap").value = today; // Cập nhật giá trị cho input ngày
    });
    // Đếm số hàng để đảm bảo id duy nhất
// Biến đếm số hàng để đảm bảo id duy nhất cho mỗi hàng
var faqs_row = <?= count($listAnhSanPham) ?>;

// Hàm thêm hàng mới vào bảng album ảnh sản phẩm
function addfaqs() {
    var html = '<tr id="faqs-row-' + faqs_row + '">';
    html += '<td><img id="img-preview-' + faqs_row + '" src="https://via.placeholder.com/50" style="width: 50px; height:50px" alt="Ảnh sản phẩm"></td>';
    html += '<td><input type="file" name="img_array[]" class="form-control" onchange="previewImage(this, \'img-preview-' + faqs_row + '\')"></td>';
    html += '<td class="mt-10"><button type="button" class="badge badge-danger" onclick="removeRow('+ faqs_row +', null);"><i class="fa fa-trash"></i> Delete</button></td>';
    html += '</tr>';

    // Thêm hàng mới vào bảng tbody
    $('#faqs tbody').append(html);

    // Tăng số hàng lên
    faqs_row++;
}

// Hàm xem trước ảnh sau khi người dùng chọn file ảnh
function previewImage(input, imgId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            // Đặt ảnh từ FileReader vào src của thẻ img với id tương ứng
            document.getElementById(imgId).src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]); // Đọc file thành DataURL
    }
}

// Hàm xóa hàng ảnh khỏi bảng và thêm id ảnh cần xóa vào img_delete nếu có
function removeRow(rowId, imgId){
    // Xóa hàng hiện tại dựa trên rowId
    $('#faqs-row-' + rowId).remove();

    // Nếu imgId có giá trị (tức là ảnh đã tồn tại), thêm id vào input img_delete
    if(imgId !== null){
        var imgDeleteInput = document.getElementById('img_delete');
        var currentValue = imgDeleteInput.value;
        imgDeleteInput.value = currentValue ? currentValue + ',' + imgId : imgId;
    }
}

function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>

</script>
</body>
</html>
