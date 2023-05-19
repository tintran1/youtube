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
    <title>TiKi</title>

    <!-- Link icon youtube -->
    <link rel="icon" href="./img/lg-icon-youtube.png">

    <!-- Link font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Link css bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Link css -->
    <link rel="stylesheet" href="./css/index.css">

</head>

<body>

    <!-- Begin Header -->
    <header class="header d-flex justify-content-between align-items-center px-3 sticky-top bg-white">
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
                    <div id="studio" class="check-out-hover d-flex justify-content-start align-items-center p-2 pl-2">
                        <i class="fa-solid fa-file-video mr-3 text-center"></i>
                        <p class="m-0">Tải video lên</p>
                    </div>
                    <div class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2">
                        <i class="fa-solid fa-bell mr-3 text-center"></i>
                        <p class="m-0">Phát trực tiếp</p>
                    </div>
                </div>
            </a>
            <!-- notification -->
            <a id="header__user--bell" class="header__user-icon text-dark position-relative">
                <i class="fa-solid fa-bell d-flex position-relative bg-light p-2  rounded-circle">
                    <?php
                        $spl_count = "SELECT COUNT(id_notifi.ID ) AS count_id FROM (SELECT notification.ID FROM notification JOIN post_like ON notification.like = post_like.ID JOIN post on post.ID = post_like.ID_post WHERE post.ID_user = $ID
                            UNION SELECT notification.ID FROM notification JOIN sub ON sub.ID = notification.sub WHERE sub.ID_user_post =$ID
                            UNION SELECT notification.ID FROM notification JOIN post ON post.ID = notification.post_video  JOIN user ON user.ID = post.ID_user JOIN sub ON sub.ID_user_post = user.ID WHERE sub.ID_user =$ID
                            UNION SELECT notification.ID FROM notification JOIN post ON post.ID = notification.post_video  JOIN user ON `user`.ID = post.ID_user JOIN sub ON sub.ID_user_post = `user`.ID WHERE sub.ID_user = $ID
                            UNION SELECT notification.ID FROM notification JOIN comment ON comment.ID = notification.comment JOIN post ON comment.ID_post = post.ID WHERE post.ID_user =$ID and comment.ID_user != $ID) as id_notifi WHERE id_notifi.ID not in (SELECT view_notification.ID_notification FROM view_notification WHERE view_notification.ID_user = $ID) ORDER BY id_notifi.ID";
                        $result_count = mysqli_query($conn, $spl_count);
                        $row_count =  mysqli_fetch_array($result_count);
                        $count =  $row_count['count_id'];
                        echo "<p class='position-absolute text-white p-1 bg-danger rounded-circle header__user--bell-count'>$count</p>";
                    ?>
                </i>
                <div class="header__user--bell-check-out position-absolute bg-white border rounded">
                    <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                        <p class="m-0">Thông báo</p>
                        <i class="fa-solid fa-gear text-center"></i>
                    </div>
                    <?php
                        $sql_like = "SELECT post.ID_user, user.Name,notification.ID FROM notification JOIN post_like ON post_like.ID = notification.like JOIN user ON post_like.ID_user = user.ID JOIN post ON post.ID = post_like.ID_post";
                        $result_like = mysqli_query($conn, $sql_like);
                        if ($result_like->num_rows > 0) {
                            while ($row = $result_like->fetch_assoc()) {
                                $id_like = $row['ID_user'];
                                $name_like = $row['Name'];
                                $id_notification_like =  $row['ID'];
                                if ($id_like == $ID) {
                                    ?>
                                        <div id = "<?= $id_notification_like ?>" class="check-out-hover  py-2 pl-2">
                                            <div  class="d-flex align-items-center">
                                                <i class="fa-solid fa-bell mr-3 text-center"></i>
                                                <p class='m-0'><?= $name_like ?> đã thích kênh của bạn!</p>
                                            </div>
                                        </div>
                                    <?php
                                } 
                            }
                        }
                    ?>
                    <?php
                        $sql_sub = "SELECT notification.ID,user.Name,sub.ID_user_post FROM notification JOIN sub ON sub.ID = notification.sub JOIN user ON user.ID = sub.ID_user";
                        $result_sub = mysqli_query($conn, $sql_sub);
                        if ($result_sub->num_rows > 0) {
                            while ($row = $result_sub->fetch_assoc()) {
                                $id_sub = $row['ID_user_post'];
                                $name_sub = $row['Name'];
                                $id_notification_sub =  $row['ID'];
                                if ($id_sub == $ID) {
                                ?>
                                    <div id = "<?= $id_notification_sub ?>" class="check-out-hover  py-2 pl-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-bell mr-3 text-center"></i>
                                            <p class='m-0'><?= $name_sub ?> đã đăng ký kênh của bạn!</p>
                                        </div>
                                    </div>
                                <?php
                                } 
                            }
                        }
                    ?>
                    <?php
                        $sql_post = "SELECT  notification.ID,sub.ID_user,user.Name FROM notification JOIN post ON post.ID = notification.post_video JOIN user ON user.ID = post.ID_user JOIN sub ON sub.ID_user_post = user.ID";
                        $result_post = mysqli_query($conn, $sql_post);
                        if ($result_post->num_rows > 0) {
                            while ($row = $result_post->fetch_assoc()) {
                                $id_post = $row['ID_user'];
                                $name_post = $row['Name'];
                                $row_id_post = $row['ID'];
                                $id_notification_post = $row['ID'];
                                if ($id_post == $ID) {
                                ?>
                                    <div id = "<?= $id_notification_post ?>" class="check-out-hover  py-2 pl-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-bell mr-3 text-center"></i>
                                            <p class='m-0'><?= $name_post ?> đã đăng video mới!</p>
                                        </div>
                                    </div>
                                <?php
                                } 
                            }
                        }
                    ?>
                    <?php
                        $sql_comment = "SELECT post.ID_user as ID_user_post,notification.ID, comment.ID_user,user.Name,comment.ID_comment_parent FROM notification JOIN comment ON comment.ID = notification.comment JOIN post ON comment.ID_post = post.ID JOIN user ON user.ID = comment.ID_user";
                        $result_comment = mysqli_query($conn, $sql_comment);
                        if ($result_comment->num_rows > 0) {
                            while ($row = $result_comment->fetch_assoc()) {
                                $id_parent = $row['ID_comment_parent'];
                                $id_user_post = $row['ID_user_post'];
                                $id_comment = $row['ID_user'];
                                $name_comment = $row['Name'];
                                $id_notification_comment = $row['ID'];
                                if ($id_user_post == $ID &&  $id_comment !== $ID &&  $id_parent == 0) {
                                    ?>
                                        <div id = "<?= $id_notification_comment ?>" class="check-out-hover  py-2 pl-2">
                                            <div class="d-flex align-items-center">
                                                <i class="fa-solid fa-bell mr-3 text-center"></i>
                                                <p class='m-0'><?= $name_comment ?> đã bình luận video của bạn!</p>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                        }
                    ?>
                    <?php
                        $sql_comment_child = "SELECT notification.comment,notification.ID, comment.ID_user,user.Name,comment.ID_comment_parent FROM notification  JOIN comment ON comment.ID = notification.comment JOIN post ON comment.ID_post = post.ID JOIN user ON user.ID = comment.ID_user WHERE comment.ID_comment_parent != 0";
                        $result_comment_child = mysqli_query($conn, $sql_comment_child);
                        if ($result_comment_child->num_rows > 0) {
                            while ($row = $result_comment_child->fetch_assoc()) { 
                                $id_parent_child = $row['ID_comment_parent'];
                                $name = $row['Name'];
                                $id_notification_comment_child = $row['ID'];
                                $sql_user = "SELECT comment.ID,comment.ID_user,post.ID_user,comment.ID_comment_parent FROM notification JOIN comment ON comment.ID = notification.comment JOIN post ON comment.ID_post = post.ID WHERE post.ID_user =$ID AND comment.ID_comment_parent =0";
                                $result_user = mysqli_query($conn, $sql_user);
                                if ($result_user->num_rows > 0) {
                                    while ($row_user = $result_user->fetch_assoc()) { 
                                        $id = $row_user['ID'];
                                        if ($id_parent_child ==  $id ) {
                                        ?>
                                            <div id = "<?= $id_notification_comment_child ?>" class="check-out-hover  py-2 pl-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-solid fa-bell mr-3 text-center"></i>
                                                    <p class='m-0'><?= $name ?> đã phản hồi bình luận video của bạn!</p>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    }
                                }
                            }
                        }
                    ?>
                </div>
            </a>
            <!-- end notification -->
            
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
                    <?php
                         $sql = "SELECT * From user Where (Email = '$Email')";
                         $result = $conn->query($sql);
                         if ($result->num_rows > 0) {
                             while ($row = $result->fetch_assoc()) {
                                $Email = $row["Email"];  
                                if($Email == 'trannhutin.tk@gmail.com'){
                                ?>
                                    <a href="push_notification.php" class="check-out-hover d-flex justify-content-start align-items-center py-2 pl-2">
                                        <i class="fa-brands fa-youtube text-center"></i>
                                        <p class="m-0">Creat Notification</p>
                                    </a>
                                <?php
                                }else{}
                            }
                        }
                    ?>
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
    <div class="main d-flex justify-content-between">
        <div class="main__nav sticky-left bg-white">
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2">
                <i class="fa-solid fa-house text-center"></i>
                <p class="m-0">Trang chủ</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2">
                <i class="fa-solid fa-compass text-center"></i>
                <p class="m-0">Khám phá</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2">
                <i class="fa-solid fa-clapperboard text-center"></i>
                <p class="m-0">Shorts</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2 border-bottom">
                <i class="fa-solid fa-play text-center"></i>
                <p class="m-0">Kênh đăng ký</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2">
                <i class="fa-solid fa-tv text-center"></i>
                <p class="m-0">Thư viện</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2">
                <i class="fa-solid fa-clock-rotate-left text-center"></i>
                <p class="m-0">Video đã xem</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2">
                <i class="fa-solid fa-circle-play text-center"></i>
                <p class="m-0">Video của bạn</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2">
                <i class="fa-solid fa-clock text-center"></i>
                <p class="m-0">Xem sau</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2">
                <i class="fa-solid fa-thumbs-up text-center"></i>
                <p class="m-0">Video đã thích</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2 border-bottom">
                <i class="fa-solid fa-chevron-down text-center"></i>
                <p class="m-0">Thêm</p>
            </a>
            <div class="p-3">
                <h6 class="ml-2 mb-0">KÊNH ĐĂNG KÝ</h6>
            </div>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2 border-bottom">
                <i class="fa-solid fa-chevron-down text-center"></i>
                <p class="m-0">Thêm</p>
            </a>
            <div class="p-3">
                <h6 class="ml-2 mb-0">KHÁM PHÁ</h6>
            </div>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2">
                <i class="fa-solid fa-gamepad text-center"></i>
                <p class="m-0">Trò chơi</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2 border-bottom">
                <i class="fa-solid fa-trophy text-center"></i>
                <p class="m-0">Thể thao</p>
            </a>
            <div class="p-3">
                <h6 class="ml-2 mb-0">DỊCH VỤ KHÁC CỦA YOUTUBE</h6>
            </div>
            <a href="studio.php" class="main__nav--hover d-flex justify-content-start align-items-center p-2 text-dark">
                <i class="fa-brands fa-youtube text-center text-danger"></i>
                <p class="m-0">Creator Studio</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2">
                <i class="fa-brands fa-youtube text-center text-danger"></i>
                <p class="m-0">Youtube Music</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2">
                <i class="fa-brands fa-youtube text-center text-danger"></i>
                <p class="m-0">Youtube Kids</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2 border-bottom">
                <i class="fa-brands fa-youtube text-center text-danger"></i>
                <p class="m-0">Youtube TV</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2">
                <i class="fa-solid fa-gear text-center"></i>
                <p class="m-0">Cài đặt</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2">
                <i class="fa-solid fa-flag text-center"></i>
                <p class="m-0">Lịch sử báo cáo</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2">
                <i class="fa-solid fa-circle-question text-center"></i>
                <p class="m-0">Trợ giúp</p>
            </a>
            <a class="main__nav--hover d-flex justify-content-start align-items-center p-2 border-bottom">
                <i class="fa-solid fa-circle-exclamation text-center"></i>
                <p class="m-0">Gửi phản hồi</p>
            </a>
            <div class="main__nav--option p-3">
                <a class="mr-2 d-inline-block">Giới thiệu</a>
                <a class="mr-2 d-inline-block">Báo chí</a>
                <a class="mr-2 d-inline-block">Bản quyền</a>
                <a class="mr-2 d-inline-block">Liên hệ với chúng tôi</a>
                <a class="mr-2 d-inline-block">Người sáng tạo</a>
                <a class="mr-2 d-inline-block">Quảng cáo</a>
                <a class="mr-2 d-inline-block">Nhà phát triển</a>
            </div>
            <div class="main__nav--option p-3">
                <a class="mr-2 d-inline-block">Điều khoản</a>
                <a class="mr-2 d-inline-block">Quyền riêng tư</a>
                <a class="mr-2 d-inline-block">Chính sách và an toàn</a>
                <a class="mr-2 d-inline-block">Cách YouTube hoạt động</a>
                <a class="mr-2 d-inline-block">Thử các tính năng mới</a>
            </div>
            <span class="px-4">© 2022 Google LLC</span>
        </div>
        <div class="main__content w-100">
            <div class="main__content--category">
                <ul class="main__content--category-ul nav nav-pills d-flex justify-content-center align-items-center border-top border-bottom mb-3">
                    <li class="main__content--category-hover bg-white border px-3 py-2 m-1">
                        <a data-toggle="pill" href="#category_all" class="text-dark">Tất cả</a>
                    </li>
                    <?php
                    $sql_category = "SELECT * FROM post_category";
                    $result = $conn->query($sql_category);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $nameCategory = $row["Name"];
                            $IDCategory = $row["ID"];
                    ?>
                            <li class="main__content--category-hover bg-white border px-3 py-2 m-1">
                                <a data-toggle="pill" href="#category_<?= $IDCategory ?>" class="text-dark"><?= $nameCategory ?></a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="main__content--post tab-content">
                <div id="category_all" class="tab-pane fade show active in">
                    <div class="row m-0">
                        <?php
                        $sql_Post = "SELECT post.*, user.Name, user.Avatar FROM user JOIN post ON user.ID = post.ID_user ORDER BY `Date` DESC";
                        $result = $conn->query($sql_Post);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $IDPost = $row["ID"];
                                $videoPost = $row["Video"];
                                $avatarUser = $row["Avatar"];
                                $titlePost = $row["Title"];
                                $nameUser = $row["Name"];
                                $viewPost = $row["View"];
                                $datePost = $row["Date"];
                                $time_ago = strtotime($datePost);
                        ?>
                                <div class="main__content--post-post col-12 col-sm-4 col-md-3" id="<?= $IDPost ?>">
                                    <video class="w-100 mb-3" src="<?= $videoPost ?>" controls>
                                    </video>
                                    <div class="row">
                                        <div class="col-2 col-sm-2 col-md-2">
                                            <img class="rounded-circle border" src="<?= $avatarUser ?>" alt="<?= $nameUser ?>">
                                        </div>
                                        <div class="col-10 col-sm-10 col-md-10">
                                            <h4 class="text-dark"><?= $titlePost ?></h4>
                                            <p class="text-muted"><?= $nameUser ?></p>
                                            <p class="text-muted text-dark mr-1" class="text-dark mr-1"><?= $viewPost ?> Lượt xem <span class="ml-3"><?= timeAgo($time_ago) ?></span></p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <?php
                $sql_category = "SELECT * FROM post_category";
                $result_category = $conn->query($sql_category);
                if ($result_category->num_rows > 0) {
                    while ($row = $result_category->fetch_assoc()) {
                        $IDCategory = $row["ID"];
                ?>
                        <div id="category_<?= $IDCategory ?>" class="tab-pane fade">
                            <div class="row m-0">
                                <?php
                                $sql_Post = "SELECT post.*, user.Name, user.Avatar FROM user JOIN post ON user.ID = post.ID_user JOIN post_category ON post.ID_category = post_category.ID WHERE post_category.ID = $IDCategory ORDER BY `Date` DESC";
                                $result_Post = $conn->query($sql_Post);
                                if ($result_Post->num_rows > 0) {
                                    while ($row = $result_Post->fetch_assoc()) {
                                        $IDPost = $row["ID"];
                                        $videoPost = $row["Video"];
                                        $avatarUser = $row["Avatar"];
                                        $titlePost = $row["Title"];
                                        $nameUser = $row["Name"];
                                        $viewPost = $row["View"];
                                        $datePost = $row["Date"];
                                        $time_ago = strtotime($datePost);
                                ?>
                                        <div class="main__content--post-post col-12 col-sm-4 col-md-3" id="<?= $IDPost ?>">
                                            <video class="w-100 mb-3" src="<?= $videoPost ?>" controls></video>
                                            <div class="row">
                                                <div class="col-2 col-sm-2 col-md-2">
                                                    <img class="rounded-circle border" src="<?= $avatarUser ?>" alt="<?= $nameUser ?>">
                                                </div>
                                                <div class="col-10 col-sm-10 col-md-10">
                                                    <h4 class="text-dark"><?= $titlePost ?></h4>
                                                    <p class="text-muted"><?= $nameUser ?></p>
                                                    <p class="text-muted text-dark mr-1" class="text-dark mr-1"><?= $viewPost ?> Lượt xem <span class="ml-3"><?= timeAgo($time_ago) ?></span></p>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
    <!-- End Main -->

    <script src="./js/index.js"></script>

</body>


</html>