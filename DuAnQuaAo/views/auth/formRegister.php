<?php require_once 'views/layout/header.php'; ?>

<main>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đăng ký tài khoản</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="login-register-wrapper section-padding">
        <div class="container" style="max-width: 44vw">
            <div class="member-area-from-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap">
                            <h5 class="text-center">Đăng ký</h5>
                            <?php if (isset($_SESSION["error"])) { ?>
                                <p class="text-danger text-center"><?= $_SESSION["error"] ?></p>
                            <?php } else if (isset($_SESSION["success"])) { ?>
                                <p class="text-success text-center"><?= $_SESSION["success"] ?></p>
                            <?php } ?>
                            <form action="<?= BASE_URL . "?act=register" ?>" method="post">
                                <div class="single-input-item">
                                    <input type="text" placeholder="Họ và tên" name="ho_ten" required />
                                </div>
                                <div class="single-input-item">
                                    <input type="email" placeholder="Email" name="email" required />
                                </div>
                                <div class="single-input-item">
                                    <input type="password" placeholder="Mật khẩu" name="password" required />
                                </div>
                                <div class="single-input-item">
                                    <input type="password" placeholder="Xác nhận mật khẩu" name="confirm_password" required />
                                </div>
                                <div class="single-input-item">
                                    <input type="text" placeholder="Số điện thoại" name="so_dien_thoai" required />
                                </div>
                                <div class="single-input-item">
                                    <input type="date" placeholder="Ngày sinh" name="ngay_sinh" />
                                </div>
                                <div class="single-input-item">
                                    <select name="gioi_tinh" required>
                                        <option value="1">Nam</option>
                                        <option value="0">Nữ</option>
                                    </select>
                                </div>
                                <div class="single-input-item">
                                    <textarea placeholder="Địa chỉ" name="dia_chi"></textarea>
                                </div>
                                <div class="single-input-item">
                                    <button class="btn btn-sqr">Đăng ký</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'views/layout/footer.php'; ?>
