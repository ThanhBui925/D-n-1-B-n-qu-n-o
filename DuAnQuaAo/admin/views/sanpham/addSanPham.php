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
            <div class="col-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thêm sản phẩm</h3>
                    </div>
                    <!-- form start -->
                    <form method="post" enctype="multipart/form-data">
                        <?php if (!empty($errors)): ?>
                            <p class="text-danger"><?= $errors[0] ?></p>
                        <?php endif; ?>  
                        <div class="card-body row">
                            <!-- Tên sản phẩm -->
                            <div class="form-group col-12">
                                <label>Tên sản phẩm</label>
                                <input type="text" class="form-control" name="ten_san_pham" value="<?= $_POST['ten_san_pham'] ?? '' ?>" placeholder="Nhập tên sản phẩm">
                                <?php if(isset($errors['ten_san_pham'])): ?>
                                    <p class="text-danger"><?= $errors['ten_san_pham'] ?></p>
                                <?php endif; ?>
                            </div>
                            <!-- Giá sản phẩm -->
                            <div class="form-group col-6">
                                <label>Giá sản phẩm</label>
                                <input type="number" class="form-control" name="gia_san_pham" value="<?= $_POST['gia_san_pham'] ?? '' ?>" placeholder="Nhập giá sản phẩm">
                                <?php if(isset($errors['gia_san_pham'])): ?>
                                    <p class="text-danger"><?= $errors['gia_san_pham'] ?></p>
                                <?php endif; ?>
                            </div>
                            <!-- Giá khuyến mãi -->
                            <div class="form-group col-6">
                                <label>Giá khuyến mãi</label>
                                <input type="number" class="form-control" name="gia_khuyen_mai" value="<?= $_POST['gia_khuyen_mai'] ?? '' ?>" placeholder="Nhập giá khuyến mãi">
                                <?php if(isset($errors['gia_khuyen_mai'])): ?>
                                    <p class="text-danger"><?= $errors['gia_khuyen_mai'] ?></p>
                                <?php endif; ?>
                            </div>
                            <!-- Hình ảnh -->
                            <div class="form-group col-6">
                                <label>Hình ảnh</label>
                                <input type="file" class="form-control" name="hinh_anh" id="fileInput" accept="image/*" onchange="previewImage(event)">
                                <?php if(isset($errors['hinh_anh'])): ?>
                                    <p class="text-danger"><?= $errors['hinh_anh'] ?></p>
                                <?php endif; ?>
                            </div>
                            <!-- Album ảnh -->
                            <div class="form-group col-6">
                                <label>Album ảnh</label>
                                <input type="file" class="form-control" name="img_array[]" multiple onchange="previewAlbum(event)">
                            </div>
                            <!-- Các trường nhập khác -->
                            <div class="form-group col-6">
                                <label>Số lượng</label>
                                <input type="number" class="form-control" name="so_luong" value="<?= $_POST['so_luong'] ?? '' ?>" placeholder="Nhập số lượng">
                                <?php if(isset($errors['so_luong'])): ?>
                                    <p class="text-danger"><?= $errors['so_luong'] ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-6">
                                <label>Ngày nhập</label>
                                <input type="date" class="form-control" name="ngay_nhap" id="ngay_nhap" value="<?= $_POST['ngay_nhap'] ?? '' ?>" placeholder="Nhập ngày nhập">
                                <?php if(isset($errors['ngay_nhap'])): ?>
                                    <p class="text-danger"><?= $errors['ngay_nhap'] ?></p>
                                <?php endif; ?>
                            </div>
                            <!-- Danh mục và trạng thái -->
                            <div class="form-group col-6">
                                <label>Danh mục</label>
                                <select class="form-control" name="category_id">
                                    <option selected disabled>Chọn danh mục sản phẩm</option>
                                    <?php foreach($listDanhMuc as $danhMuc): ?>
                                        <option value="<?= $danhMuc['id'] ?>" <?= (isset($_POST['category_id']) && $_POST['category_id'] == $danhMuc['id']) ? 'selected' : '' ?>><?= $danhMuc['ten_danh_muc'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?php if(isset($errors['category_id'])): ?>
                                    <p class="text-danger"><?= $errors['category_id'] ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-6">
                                <label>Trạng thái</label>
                                <select class="form-control" name="trang_thai">
                                    <option selected disabled>Chọn trạng thái sản phẩm</option>
                                    <option value="1" <?= (isset($_POST['trang_thai']) && $_POST['trang_thai'] == '1') ? 'selected' : '' ?>>Còn hàng</option>
                                    <option value="2" <?= (isset($_POST['trang_thai']) && $_POST['trang_thai'] == '2') ? 'selected' : '' ?>>Hết hàng</option>
                                </select>
                                <?php if(isset($errors['trang_thai'])): ?>
                                    <p class="text-danger"><?= $errors['trang_thai'] ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-12">
                                <label>Mô tả</label>
                                <textarea class="form-control" name="mo_ta" placeholder="Nhập mô tả"><?= $_POST['mo_ta'] ?? '' ?></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Hình ảnh sản phẩm</h3>
                    </div>
                    <form class="mx-auto">
                        <img id="imagePreview" style="width: 150px;" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="" onerror="this.onerror=null; this.src=''">
                    </form>
                    <div class="card-header">
                        <h3 class="card-title">Album sản phẩm</h3>
                    </div>
                    <div id="albumPreview"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
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

    function previewAlbum(event) {
        const files = event.target.files;
        const albumPreview = document.getElementById('albumPreview');
        albumPreview.innerHTML = ''; // Clear previous previews

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const img = document.createElement('img');
            img.style.width = '95px';
            img.style.margin = '5px';

            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
            }
            reader.readAsDataURL(file);

            albumPreview.appendChild(img);
        }
    }

    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $key => $error): ?>
            <?php if ($key == array_key_first($errors)): ?>
                document.querySelector('[name="<?= $key ?>"]').focus();
                // break;
                exit();
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    document.addEventListener("DOMContentLoaded", function() {
        var today = new Date().toISOString().split('T')[0]; // Lấy ngày hiện tại và chuyển về định dạng YYYY-MM-DD
        document.getElementById("ngay_nhap").value = today; // Cập nhật giá trị cho input ngày
    });
</script>

    <!-- /.content -->

</div>

<!-- footer -->
<?php include "./views/layout/footer.php"; ?>
<!-- end footer -->


</body>
</html>
