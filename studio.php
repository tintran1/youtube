<?php

session_start();

$ID = $_SESSION["ID"];

$Name = $_SESSION["Name"];

$Email = $_SESSION["Email"];

$Avatar = $_SESSION["Avatar"];

if (!empty($ID)) {
} else {
    header('location:login.php');
}

include 'config.php';

include 'conn_js.php';

include 'time_ago.php';

?>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube</title>

    <!-- Link icon youtube -->
    <link rel="icon" href="./img/lg-icon-youtube.png">

    <!-- Link font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Link css bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Link css -->
    <link rel="stylesheet" href="./css/studio.css">

</head>

<body class="p-0">

    <!-- Begin Header -->
    <header class="header d-flex justify-content-between align-items-center px-3 sticky-top bg-white border-bottom">
        <a href="index.php" class="header__logo d-flex align-items-center text-dark" title="Trang chủ youtube">
            <i class="fa-solid fa-bars mx-2"></i>
            <div class="header__logo--img mx-3">
                <img src="./img/lg-youtube.png" alt="" width="90" height="20">
            </div>
            <p>VN</p>
        </a>
        <div class="header__search d-flex justify-content-center align-items-center">
            <div class="header__search--input d-flex justify-content-center align-items-center">
                <i class="header__search--input-glass-one fa-solid fa-magnifying-glass"></i>
                <input class="header__search--input-input" type="text" placeholder="Tìm kiếm">
                <i class="header__search--input-keyboard fa-solid fa-keyboard mr-2"></i>
                <i class="header__search--input-glass-two fa-solid fa-magnifying-glass"></i>
            </div>
            <i class="header__search--microphone border rounded-circle fa-solid fa-microphone ml-2"></i>
        </div>
        <div class="header__user d-flex justify-content-between align-items-center">
            <i class="header__user-glass fa-solid fa-magnifying-glass d-none"></i>
            <a id="header__user--video" class="header__user-icon text-dark position-relative">
                <i class="fa-solid fa-video"></i>
                <div class="header__user--video-check-out position-absolute bg-white border rounded">
                    <div id="button-modal-insert" data-toggle="modal" data-target="#modal-insert" class="check-out-hover d-flex justify-content-start align-items-center p-2 pl-2">
                        <i class="fa-solid fa-file-video mr-3 text-center"></i>
                        <p class="m-0">Tải video lên</p>
                    </div>
                    <div class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2">
                        <i class="fa-solid fa-bell mr-3 text-center"></i>
                        <p class="m-0">Phát trực tiếp</p>
                    </div>
                </div>
            </a>
            <a id="header__user--bell" class="header__user-icon text-dark position-relative">
                <i class="fa-solid fa-bell"></i>
                <div class="header__user--bell-check-out position-absolute bg-white border rounded">
                    <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                        <p class="m-0">Thông báo</p>
                        <i class="fa-solid fa-gear text-center"></i>
                    </div>
                    <div class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2">
                        <i class="fa-solid fa-bell mr-3 text-center"></i>
                        <p class="m-0">Chúc mừng <?= $Name ?> đã đăng nhập thành công!</p>
                    </div>
                </div>
            </a>
            <a id="header__user--avatar" class="header__user-icon text-dark position-relative">
                <img class="border rounded-circle" src="<?= $Avatar ?>" alt="" width="32" height="32">
                <div class="header__user--avatar-check-out position-absolute bg-white border rounded">
                    <div class="d-flex justify-content-start my-2">
                        <div class="img mx-2">
                            <img class="border rounded-circle" src="<?= $Avatar ?>" alt="" width="40" height="40">
                        </div>
                        <div class="mx-2">
                            <h6>
                                <?= $Name ?>
                            </h6>
                            <a href="">Quản lý Tài khoản Google của bạn</a>
                        </div>
                    </div>
                    <a href="studio.php" class="check-out-hover d-flex justify-content-start align-items-center text-dark py-2 pl-2">
                        <i class="fa-solid fa-user text-center"></i>
                        <p class="m-0">Kênh của bạn</p>
                    </a>
                    <a class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2">
                        <i class="fa-brands fa-youtube text-center"></i>
                        <p class="m-0">Youtube Studio</p>
                    </a>
                    <a class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2">
                        <i class="fa-solid fa-user-plus text-center"></i>
                        <p class="m-0">Chuyển đổi tài khoản</p>
                    </a>
                    <a id="sign-out" href="signout.php" class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2 border-bottom text-dark">
                        <i class="fa-solid fa-right-from-bracket text-center"></i>
                        <p class="m-0">Đăng xuất</p>
                    </a>
                    <a class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2">
                        <i class="fa-solid fa-file-invoice-dollar text-center"></i>
                        <p class="m-0">Giao dịch mua và gói thành viên</p>
                    </a>
                    <a class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2 border-bottom">
                        <i class="fa-solid fa-address-card text-center"></i>
                        <p class="m-0">Dữ liệu của bạn trong youtube</p>
                    </a>
                    <a class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2">
                        <i class="fa-solid fa-moon text-center"></i>
                        <p class="m-0">Giao diện: Sáng</p>
                    </a>
                    <a class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2">
                        <i class="fa-solid fa-language text-center"></i>
                        <p class="m-0">Ngôn ngữ: Tiếng Việt</p>
                    </a>
                    <a class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2">
                        <i class="fa-solid fa-shield-halved text-center"></i>
                        <p class="m-0">Chế độ hạn chế: Đã tắt</p>
                    </a>
                    <a class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2">
                        <i class="fa-solid fa-globe text-center"></i>
                        <p class="m-0">Địa điểm: Việt Nam</p>
                    </a>
                    <a class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2 border-bottom">
                        <i class="fa-solid fa-keyboard text-center"></i>
                        <p class="m-0">Phím tắt</p>
                    </a>
                    <a class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2 border-bottom">
                        <i class="fa-solid fa-gear text-center"></i>
                        <p class="m-0">Cài đặt</p>
                    </a>
                    <a class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2">
                        <i class="fa-regular fa-circle-question text-center"></i>
                        <p class="m-0">Trợ giúp</p>
                    </a>
                    <a class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2">
                        <i class="fa-solid fa-message text-center"></i>
                        <p class="m-0">Gửi phản hồi</p>
                    </a>
                </div>
            </a>
        </div>
    </header>
    <!-- End Header -->

    <!-- Begin Main -->
    <div class="main d-flex">
        <div class="main__nav bg-white border-right">
            <div class="main__nav--user">
                <div class="d-flex justify-content-center">
                    <img class="border rounded-circle w-50 m-3" src="<?= $Avatar ?>" alt="">
                </div>
                <h6 class="d-flex justify-content-center">
                    Kênh của bạn
                </h6>
                <p class="d-flex justify-content-center mb-2">
                    <?= $Name ?>
                </p>
                <h6 class="d-flex justify-content-center text-light bg-dark p-3 m-0">
                    <?php
                    $sql_countSub = "SELECT COUNT(ID_user) AS Count_Sub FROM sub JOIN user ON sub.ID_user_post = user.ID WHERE ID_user_post = $ID";
                    $result_countSub = $conn->query($sql_countSub);
                    if ($result_countSub->num_rows > 0) {
                        while ($row = $result_countSub->fetch_assoc()) {
                            $countSub = $row["Count_Sub"];
                    ?>
                                <?= $countSub ?> người đăng ký
                    <?php
                        }
                    }
                    ?>
                </h6>
            </div>
            <a class="main__nav--hover d-flex justify-content-between align-items-center p-3 text-muted">
                <i class="fa-solid fa-house text-center"></i>
                <p class="m-0">Trang tổng quan</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-between align-items-center p-3 text-muted">
                <i class="fa-solid fa-compass text-center"></i>
                <p class="m-0">Nội dung</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-between align-items-center p-3 text-muted">
                <i class="fa-solid fa-clapperboard text-center"></i>
                <p class="m-0">Danh sách phát</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-between align-items-center p-3 text-muted ">
                <i class="fa-solid fa-play text-center"></i>
                <p class="m-0">Số liệu phân tích</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-between align-items-center p-3 text-muted">
                <i class="fa-solid fa-tv text-center"></i>
                <p class="m-0">Bình luận</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-between align-items-center p-3 text-muted">
                <i class="fa-solid fa-clock-rotate-left text-center"></i>
                <p class="m-0">Phụ đề</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-between align-items-center p-3 text-muted">
                <i class="fa-solid fa-circle-play text-center"></i>
                <p class="m-0">Bản quyền</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-between align-items-center p-3 text-muted">
                <i class="fa-solid fa-clock text-center"></i>
                <p class="m-0">Kiếm tiền</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-between align-items-center p-3 text-muted">
                <i class="fa-solid fa-thumbs-up text-center"></i>
                <p class="m-0">Tùy chỉnh</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-between align-items-center p-3 text-muted">
                <i class="fa-solid fa-chevron-down text-center"></i>
                <p class="m-0">Thư viện âm thanh</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-between align-items-center p-3 text-muted border-top">
                <i class="fa-solid fa-gear text-center"></i>
                <p class="m-0">Cài đặt</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-between align-items-center p-3 text-muted border-bottom">
                <i class="fa-solid fa-circle-exclamation text-center"></i>
                <p class="m-0">Gửi phản hồi</p>
            </a>
        </div>
        <div class="main__content">
            <h3 class="m-3">
                Nội dung của kênh
            </h3>
            <div class="main__content--post">
                <div class="main__content--post-infor d-flex border-top border-bottom">
                    <h6 class="main__content--post-infor-video m-0 p-3 text-center border-right">
                        Video của bạn
                    </h6>
                    <h6 class="main__content--post-infor-title m-0 p-3 text-center border-right">
                        Tiêu đề video
                    </h6>
                    <h6 class="main__content--post-infor-describe m-0 p-3 text-center border-right">
                        Mô tả video
                    </h6>
                    <h6 class="main__content--post-infor-edit m-0 p-3 text-center border-right">
                        Chỉnh sửa video
                    </h6>
                    <h6 class="main__content--post-infor-delete m-0 p-3 text-center border-right">
                        Xóa video
                    </h6>
                </div>
                <?php
                $sql_studio = "SELECT post.* FROM post JOIN user ON post.ID_user = user.ID WHERE user.ID = $ID ORDER BY `Date` DESC";
                $result_studio = $conn->query($sql_studio);
                if ($result_studio->num_rows > 0) {
                    while ($row = $result_studio->fetch_assoc()) {
                        $IDPost = $row["ID"];
                        $videoPost = $row["Video"];
                        $titlePost = $row["Title"];
                        $describePost = $row["Describe"];
                        $viewPost = $row["View"];
                        $datePost = $row["Date"];
                        $time_ago = strtotime($datePost);
                ?>
                        <div class="main__content--post-post d-flex border-bottom">
                            <div class="main__content--post-post-video m-0 p-3 border-right">
                                <video src="<?= $videoPost ?>" controls></video>
                            </div>
                            <div class="main__content--post-post-title m-0 p-3 border-right">
                                <p class="text-dark"><?= $titlePost ?></p>
                            </div>
                            <div class="main__content--post-post-describe m-0 p-3 border-right">
                                <p class="text-muted"><?= $describePost ?></p>
                            </div>
                            <div class="main__content--post-post-edit m-0 p-3 d-flex justify-content-center align-items-center border-right">
                                <button id="main__content--post-edit-<?= $IDPost ?>" data-toggle="modal" data-target="#modal-edit" class="main__content--post-edit btn btn-success">Chỉnh sửa video</button>
                            </div>
                            <div class="main__content--post-post-delete m-0 p-3 d-flex justify-content-center align-items-center border-right">
                                <button id="main__content--post-delete-<?= $IDPost ?>" class="main__content--post-delete btn btn-danger">Xóa video</button>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

        <!-- Begin Modal Insert -->
        <div class="modal fade" id="modal-insert" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header mb-3">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tải video lên</h5>
                        <button type="button" class="close button-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="modal-center px-3">
                        <div class="main__form d-flex justify-content-center my-3">
                            <input id="main__form--title-insert" class="main__form--input" type="text" placeholder=" ">
                            <label for="main__form--title-insert" class="main__form--label">Thêm tiêu đề video</label>
                        </div>
                        <div class="main__form d-flex justify-content-center my-4">
                            <input id="main__form--describe-insert" class="main__form--input" type="text" placeholder=" ">
                            <label for="main__form--describe-insert" class="main__form--label">Thêm mô tả video</label>
                        </div>
                        <h6 class="px-3">
                            Chọn danh mục video
                        </h6>
                        <div class="main__form d-flex justify-content-center mb-3">
                            <select id="main__form--ID-category-insert" class="p-2 w-75">
                                <?php
                                $sql_category = "SELECT * FROM post_category";
                                $result = $conn->query($sql_category);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $nameCategory = $row["Name"];
                                        $IDCategory = $row["ID"];
                                ?>
                                        <option value="<?= $IDCategory ?>"><?= $nameCategory ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-center">
                            <label for="main__form--video-insert" class="btn btn-primary">CHỌN VIDEO TẢI LÊN</label>
                            <input id="main__form--video-insert" class="main__form--input d-none" type='file' accept="video/*">
                        </div>
                        <div class="main__form--gallery-video-insert d-flex justify-content-center"></div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="button-close btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button id="main__form--insert" type="button" class="btn btn-primary" data-dismiss="modal">Đăng video</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Insert -->

        <!-- Begin Modal Edit -->
        <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header mb-3">
                        <h5 class="modal-title" id="exampleModalLongTitle">Chỉnh sửa video</h5>
                        <button type="button" class="close button-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="modal-center px-3">
                        <div class="main__form d-flex justify-content-center my-3">
                            <input id="main__form--ID-edit" class="d-none" type="text" placeholder=" ">
                            <input id="main__form--title-edit" class="main__form--input" type="text" placeholder=" ">
                            <label for="main__form--title-edit" class="main__form--label">Chỉnh sửa tiêu đề video</label>
                        </div>
                        <div class="main__form d-flex justify-content-center my-4">
                            <input id="main__form--describe-edit" class="main__form--input" type="text" placeholder=" ">
                            <label for="main__form--describe-edit" class="main__form--label">Chỉnh sửa mô tả video</label>
                        </div>
                        <h6 class="px-3">
                            Chỉnh sửa danh mục video
                        </h6>
                        <div class="main__form d-flex justify-content-center mb-3">
                            <select id="main__form--ID-category-edit" class="p-2 w-75">
                                <?php
                                $sql_category = "SELECT * FROM post_category";
                                $result = $conn->query($sql_category);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $nameCategory = $row["Name"];
                                        $IDCategory = $row["ID"];
                                ?>
                                        <option value="<?= $IDCategory ?>"><?= $nameCategory ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-center">
                            <label for="main__form--video-edit" class="btn btn-primary">CHỌN VIDEO TẢI LÊN</label>
                            <input id="main__form--video-edit" class="main__form--input d-none" type='file' accept="video/*">
                        </div>
                        <div class="main__form--gallery-video-edit d-flex justify-content-center"></div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="button-close btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button id="main__form--edit" type="button" class="btn btn-primary" data-dismiss="modal">Lưu chỉnh sửa</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Edit -->

    </div>
    <!-- End Main -->

    <script src="./js/studio.js"></script>

</body>

</html>