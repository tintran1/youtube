<?php

include 'config.php';

include 'conn_js.php';

?>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Tài khoản Youtube</title>

    <!-- Link icon youtube -->
    <link rel="icon" href="./img/lg-icon-youtube.png">

    <!-- Link font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Link css bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Link css firebase -->
    <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/2.3.0/firebaseui.css">

    <!-- Link css -->
    <link rel="stylesheet" href="./css/register.css">

</head>

<body>

    <!-- Begin Main -->
    <div class="main card d-flex justify-content-center">
        <div class="card-body d-flex justify-content-between">
            <div>
                <div>
                    <img class="m-2 py-2 w-25" src="./img/lg-youtube.png" alt="">
                </div>
                <h6 class="p-3">
                    Tạo tài khoản Youtube
                </h6>
                <form>
                    <div class="mb-3">
                        <div class="d-flex mb-3">
                            <div class="main__form mr-2 w-50">
                                <input id="main__form--first-name" class="main__form--input" type="text" placeholder=" " name="First-name">
                                <label for="main__form--first-name" class="main__form--label">Họ</label>
                            </div>
                            <div class="main__form w-50">
                                <input id="main__form--last-name" class="main__form--input" type="text" placeholder=" " name="Last-name">
                                <label for="main__form--last-name" class="main__form--label">Tên</label>
                            </div>
                        </div>
                        <div id="main__danger--1" class="text-danger">
                            <i class="bg-danger text-light rounded-circle fa-solid fa-exclamation"></i>
                            Nhập tên và họ
                        </div>
                        <div id="main__danger--2" class="text-danger">
                            <i class="bg-danger text-light rounded-circle fa-solid fa-exclamation"></i>
                            Hãy nhập họ
                        </div>
                        <div id="main__danger--3" class="text-danger">
                            <i class="bg-danger text-light rounded-circle fa-solid fa-exclamation"></i>
                            Hãy nhập tên
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="main__form">
                            <input id="main__form--email" class="main__form--input" type="email" placeholder=" " name="Email">
                            <label for="main__form--email" class="main__form--label">Địa chỉ email của bạn</label>
                        </div>
                        <div id="main__danger--4" class="text-danger">
                            <i class="bg-danger text-light rounded-circle fa-solid fa-exclamation"></i>
                            Chọn 1 địa chỉ Email
                        </div>
                        <div id="main__danger--5" class="text-danger">
                            <i class="bg-danger text-light rounded-circle fa-solid fa-exclamation"></i>
                            Email bạn nhập đã tồn tại
                        </div>
                    </div>
                    <p>Bạn cần phải xác nhận rằng email này là của bạn</p>
                    <div class="mb-3">
                        <a href="">Tạo địa chỉ Gmail mới</a>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex">
                            <div class="main__form mr-2 w-50">
                                <input id="main__form--pass" class="main__form--input" type="password" placeholder=" " name="Pass">
                                <label for="main__form--pass" class="main__form--label">Mật khẩu</label>
                            </div>
                            <div class="main__form w-50">
                                <input id="main__form--confirm-pass" class="main__form--input" type="password" placeholder=" ">
                                <label for="main__form--confirm-pass" class="main__form--label">Xác nhận mật khẩu</label>
                            </div>
                        </div>
                        <div id="main__danger--6" class="text-danger">
                            <i class="bg-danger text-light rounded-circle fa-solid fa-exclamation"></i>
                            Nhập mật khẩu
                        </div>
                        <div id="main__danger--7" class="text-danger">
                            <i class="bg-danger text-light rounded-circle fa-solid fa-exclamation"></i>
                            Xác nhận mật khẩu của bạn
                        </div>
                    </div>
                    <p>Sử dụng 8 ký tự trở lên và kết hợp chữ cái, chữ số và biểu tượng</p>
                    <div class="mb-2">
                        <input type="checkbox" value="" id="check-pass">
                        <label for="check-pass">Hiện mật khẩu</label>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="login.php" type="button" class="btn btn-light text-primary">Đăng nhập</a>
                        <button id="register" class="btn btn-primary">Tiếp theo</button>
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

    <script src="./js/register.js"></script>

</body>

</html>