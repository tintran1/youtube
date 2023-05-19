<?php

include 'config.php';

include 'conn_js.php';

?>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khôi phục tài khoản</title>

    <!-- Link icon youtube -->
    <link rel="icon" href="./img/lg-icon-youtube.png">

    <!-- Link font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Link css bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Link css firebase -->
    <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/2.3.0/firebaseui.css">

    <!-- Link css -->
    <link rel="stylesheet" href="./css/forgot.css">

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
                    Khôi phục tài khoản
                </h6>
                <form>
                    <div class="mb-3">
                        <div class="main__form my-3">
                            <input id="main__form--email" class="main__form--input" type="text" placeholder=" ">
                            <label for="main__form--email" class="main__form--label">Hãy nhập tài khoản để nhận mã xác minh</label>
                        </div>
                        <div id="main__danger--1" class="text-danger">
                            <i class="bg-danger text-light rounded-circle fa-solid fa-exclamation"></i>
                            Hãy nhập tài khoản
                        </div>
                    </div>
                    <p class="mb-3">Chúng tôi sẽ gửi 1 mã xác minh về địa chỉ Gmail của bạn. Vui lòng kiểm tra.</p>
                    <div id="main__nav" class="d-flex justify-content-between">
                        <a href="login.php" type="button" class="btn btn-light text-primary">Đăng nhập</a>
                        <a id="forgot" href="" type="button" class="btn btn-primary">Truy cập Gmail</a>
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

    <script src="./js/forgot.js"></script>

</body>

</html>