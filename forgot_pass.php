<?php

include 'config.php';

include 'conn_js.php';

$Token = $_GET['Token'];

$sql_token = "SELECT * FROM user WHERE Token = '$Token'";
$result_token = mysqli_query($conn, $sql_token);
$row_token = mysqli_fetch_array($result_token);
$count_token = mysqli_num_rows($result_token);
if ($count_token == 1) {
} else {
    header('location:forgot_pass_error.php');
}

?>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>

    <!-- Link icon youtube -->
    <link rel="icon" href="./img/lg-icon-youtube.png">

    <!-- Link font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Link css bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Link css firebase -->
    <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/2.3.0/firebaseui.css">

    <!-- Link css -->
    <link rel="stylesheet" href="./css/forgot_pass.css">

</head>

<body>

    <!-- Begin Main -->
    <div class="main card d-flex justify-content-center">
        <div class="card-body d-flex justify-content-center">
            <div>
                <div>
                    <img class="m-2 py-2 w-25" src="./img/lg-youtube.png" alt="">
                </div>
                <h6 class="p-3">
                    Đặt lại mật khẩu
                </h6>
                <form>
                    <div class="mb-3">
                        <div class="main__form">
                            <input id="main__form--token" class="d-none" type="text" value="<?= $Token ?>">
                            <input id="main__form--pass" class="main__form--input" type="password" placeholder=" ">
                            <label for="main__form--pass" class="main__form--label">Hãy nhập mật khẩu mới</label>
                        </div>
                        <div id="main__danger--1" class="text-danger">
                            <i class="bg-danger text-light rounded-circle fa-solid fa-exclamation"></i>
                            Hãy nhập mật khẩu
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="main__form">
                            <input id="main__form--confirm-pass" class="main__form--input" type="password" placeholder=" ">
                            <label for="main__form--confirm-pass" class="main__form--label">Xác nhận lại mật khẩu</label>
                        </div>
                        <div id="main__danger--2" class="text-danger">
                            <i class="bg-danger text-light rounded-circle fa-solid fa-exclamation"></i>
                            Xác nhận mật khẩu của bạn
                        </div>
                    </div>
                    <div class="mb-2">
                        <input type="checkbox" value="" id="invalidCheck">
                        <label for="invalidCheck">Hiện mật khẩu</label>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <a id="forgot-pass" href="" type="button" class="btn btn-primary">Tiếp theo</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Main -->

    <!-- Begin Footer -->
    <div class="footer d-flex justify-content-between">
        <div class="text-md-center text-sm-left">
            <span class="p-3">Tiếng Việt<i class="p-2 fa-solid fa-sort-down"></i></span>
        </div>
        <div class="">
            <span class="p-3">Trợ giúp</span>
            <span class="p-3">Bảo mật</span>
            <span class="p-3">Điều khoản</span>
        </div>
    </div>
    <!-- End Footer -->

    <script src="./js/forgot_pass.js"></script>

</body>


</html>