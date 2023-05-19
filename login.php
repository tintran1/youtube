<?php

include 'config.php';

include 'conn_js.php';

?>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập YouTube</title>

    <!-- Link icon youtube -->
    <link rel="icon" href="./img/lg-icon-youtube.png">

    <!-- Link font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Link css bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Link css firebase -->
    <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/2.3.0/firebaseui.css">

    <!-- Link css -->
    <link rel="stylesheet" href="./css/login.css">

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
                    Đăng nhập bằng tài khoản tới YouTube
                </h6>
                <form>
                    <div class="mb-3">
                        <div class="main__form">
                            <input id="main__form--email" class="main__form--input" type="text" placeholder=" ">
                            <label for="main__form--email" class="main__form--label">Tài khoản đăng nhập</label>
                        </div>
                        <div id="main__danger--1" class="text-danger">
                            <i class="bg-danger text-light rounded-circle fa-solid fa-exclamation"></i>
                            Hãy nhập tài khoản
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="main__form">
                            <input id="main__form--pass" class="main__form--input" type="password" placeholder=" ">
                            <label for="main__form--pass" class="main__form--label">Mật khẩu</label>
                        </div>
                        <div id="main__danger--2" class="text-danger">
                            <i class="bg-danger text-light rounded-circle fa-solid fa-exclamation"></i>
                            Hãy nhập mật khẩu
                        </div>
                        <div id="main__danger--3" class="text-danger">
                            <i class="bg-danger text-light rounded-circle fa-solid fa-exclamation"></i>
                            Tài khoản hoặc mật khẩu không chính xác
                        </div>
                    </div>
                    <div class="mb-2">
                        <input type="checkbox" value="" id="check-pass">
                        <label for="check-pass">Hiện mật khẩu</label>
                    </div>
                    <a href="forgot.php" type="button" class="btn btn-light text-primary mb-3">Quên mật khẩu</a>
                    <h6 class="p-3">
                        Đăng nhập bằng tài khoản Google hoặc số điện thoại
                    </h6>
                    <div id="container" class="mb-3">
                        <div id="loading">Loading...</div>
                        <div id="loaded" class="hidden">
                            <div id="main">
                                <div id="user-signed-in" class="hidden">
                                    <div id="user-info">
                                        <div id="photo-container">
                                            <img id="photo">
                                        </div>
                                        <div id="name"></div>
                                        <div id="email"></div>
                                        <div id="phone"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div id="user-signed-out" class="hidden">
                                    <div id="firebaseui-spa">
                                        <div id="firebaseui-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <a href="register.php" type="button" class="btn btn-light text-primary">Tạo tài khoản</a>
                        <a id="login" href="" type="button" class="btn btn-primary">Đăng nhập</a>
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

    <script src="./js/login.js"></script>

</body>

</html>