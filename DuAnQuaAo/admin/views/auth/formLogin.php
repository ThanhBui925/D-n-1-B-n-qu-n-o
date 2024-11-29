<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="./assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./assets/dist/css/adminlte.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #6A82FB, #FC5C7D);
            font-family: 'Source Sans Pro', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-box {
            width: 360px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #6A82FB, #FC5C7D);
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .card-header .h1 {
            font-size: 1.8rem;
            font-weight: bold;
            margin: 0;
        }

        .card-body {
            padding: 20px;
        }

        .btn-primary {
            background-color: #6A82FB;
            border-color: #6A82FB;
        }

        .btn-primary:hover {
            background-color: #FC5C7D;
            border-color: #FC5C7D;
        }

        .input-group-text {
            background-color: #f0f0f0;
        }

        a {
            color: #6A82FB;
            text-decoration: none;
        }

        a:hover {
            color: #FC5C7D;
            text-decoration: underline;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="./assets/index2.html" class="h1">Welcome !</a>
            </div>
            <div class="card-body"> 
            <?php if(isset($_SESSION["error"])){ ?>
                    <p class="text-danger"><?php foreach($_SESSION["error"] as $error){
                    } ?></p>
                <?php }else{?>
                    <p class="login-box-msg">Vui lòng đăng nhập</p>
                <?php } ?>
                <p class="text-danger login-box-msg"> <?= $_SESSION["error"] ?> </p>

                <form action="<?= BASE_URL_ADMIN.'?act=check-login-admin'?>" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                        </div>
                    </div>
                </form>
                <br>
                <p class="mb-1">
                    <a href="#">Quên mật khẩu</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
