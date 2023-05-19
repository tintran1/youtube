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

include 'wait_click.php';

include 'time_ago.php';

$IDWatch = $_GET["ID"];

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
    <link rel="stylesheet" href="./css/watch.css">

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

            <!-- // notification -->
            <a id="header__user--bell" class="header__user-icon text-dark position-relative">
                <i class="fa-solid fa-bell d-flex position-relative bg-light p-2  rounded-circle">
                    <?php
                        $spl_count = "SELECT COUNT(id_notifi.ID) AS count_id FROM (SELECT notification.ID FROM notification JOIN post_like ON notification.like = post_like.ID JOIN post on post.ID = post_like.ID_post WHERE post.ID_user = $ID
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
        <div class="main__content bg-white mx-3">
            <?php
            $sql_content = "SELECT post.*, user.Name, user.Avatar, user.Sub FROM post JOIN user ON post.ID_user = user.ID WHERE post.ID = $IDWatch";
            $result_content = $conn->query($sql_content);
            if ($result_content->num_rows > 0) {
                while ($row = $result_content->fetch_assoc()) {
                    $IDPost = $row["ID"];
                    $videoWatch = $row["Video"];
                    $titleWatch = $row["Title"];
                    $describeWatch = $row["Describe"];
                    $viewWatch = $row["View"];
                    $dateWatch = $row["Date"];
                    $time_ago = strtotime($dateWatch);
                    $nameUserWatch = $row["Name"];
                    $avatarUserWatch = $row["Avatar"];
                    $subUserWatch = $row["Sub"];
                    $IDUser = $row["ID_user"];
            ?>
                    <video class="main__content--video w-100 mb-3" src="<?= $videoWatch ?>" controls></video>
                    <h5 class="main__content--title"><?= $titleWatch ?></h5>
                    <div class="main__content--menu d-flex justify-content-between py-2">
                        <div class="main__content--menu-user d-flex">
                            <div class="main__content--menu-user-infor d-flex justify-content-between mr-3">
                                <div class="mr-3">
                                    <img class="border rounded-circle" src="<?= $avatarUserWatch ?>" alt="" width="40" height="40">
                                </div>
                                <div class="">
                                    <h6 class="m-0">
                                        <?= $nameUserWatch ?>
                                    </h6>
                                    <?php
                                    $sql_countSub = "SELECT COUNT(ID_user) AS Count_Sub FROM sub JOIN user ON sub.ID_user_post = user.ID WHERE ID_user_post = $IDUser";
                                    $result_countSub = $conn->query($sql_countSub);
                                    if ($result_countSub->num_rows > 0) {
                                        while ($row = $result_countSub->fetch_assoc()) {
                                            $countSub = $row["Count_Sub"];
                                    ?>
                                            <p id="main__content--menu-user-infor-sub" class="text-muted m-0">
                                                <?= $countSub ?> người đăng ký
                                            </p>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="main__content--menu-user-register">
                                <?php
                                if ($ID != $IDUser) {
                                    $sql_sub = "SELECT * FROM sub WHERE ID_user = $ID AND ID_user_post = $IDUser";
                                    $result_sub = mysqli_query($conn, $sql_sub);
                                    $count_sub = mysqli_num_rows($result_sub);
                                    if ($count_sub == 1) {
                                ?>
                                        <button id="register-<?= $IDUser ?>" class="main__content--menu-user-register-button btn btn-light mr-2">Đã đăng ký</button>
                                        <i class="fa-solid fa-bell"></i>
                                    <?php
                                    } else {
                                    ?>
                                        <button id="register-<?= $IDUser ?>" class="main__content--menu-user-register-button btn btn-dark">Đăng ký</button>
                                <?php
                                    }
                                } else {
                                    echo "";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="main__content--menu-option d-flex justify-content-end align-items-center">
                            <div id="main__content--menu-option-like-<?= $IDPost ?>" class="main__content--menu-option-like-hover btn mr-3">
                                <?php
                                $sql_select_like = "SELECT * FROM post_like WHERE ID_user = $ID AND ID_post= $IDPost";
                                $result_select_like = mysqli_query($conn, $sql_select_like);
                                $count_select_like = mysqli_num_rows($result_select_like);

                                if ($count_select_like == 1) {
                                    $sql_post_like = "SELECT COUNT(ID_user) AS COUNT FROM post_like WHERE ID_post = $IDWatch";
                                    $result_post_like = $conn->query($sql_post_like);
                                    if ($result_post_like->num_rows > 0) {
                                        while ($row = $result_post_like->fetch_assoc()) {
                                            $countLike = $row["COUNT"];
                                            ?>
                                            <i class="fa-solid fa-thumbs-down mr-1"></i>
                                            <span><?= $countLike ?></span>
                                             <?php
                                        }
                                    }
                                } else {
                                    $sql_post_like = "SELECT COUNT(ID_user) AS COUNT FROM post_like WHERE ID_post = $IDWatch";
                                    $result_post_like = $conn->query($sql_post_like);
                                    if ($result_post_like->num_rows > 0) {
                                        while ($row = $result_post_like->fetch_assoc()) {
                                            $countLike = $row["COUNT"];
                                        ?>
                                            <i class="fa-solid fa-thumbs-up mr-1"></i>
                                            <span><?= $countLike ?></span>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class="main__content--menu-option-share-hover btn mr-3">
                                <i class="fa-solid fa-share"></i>
                                Chia sẽ
                            </div>
                            <div class="main__content--menu-option-download-hover btn mr-3">
                                <i class="fa-solid fa-download"></i>
                                Tải xuống
                            </div>
                            <div class="main__content--menu-option-nav-hover btn d-flex align-items-center">
                                <i class="fa-solid fa-ellipsis"></i>
                            </div>
                        </div>
                    </div>
                    <div class="main__content--describe p-3">
                        <div class="main__content--describe-view text-dark font-weight-bold">
                            <?= $viewWatch ?> lượt xem
                            <span><?= timeAgo($time_ago) ?></span>
                        </div>
                        <?= $describeWatch ?>
                    </div>
                    <div id="main__content--comment-<?= $IDWatch ?>" class="main__content--comment">
                        <?php
                        $sql_comment_largest = "SELECT COUNT(comment.ID) AS commentLargest FROM comment WHERE comment.ID_post = $IDWatch";
                        $result_comment_largest = $conn->query($sql_comment_largest);
                        if ($result_comment_largest->num_rows > 0) {
                            while ($row = $result_comment_largest->fetch_assoc()) {
                                $comment_largest = $row["commentLargest"];
                        ?>
                                <div class="main__content--comment-write-comment">
                                    <p class="main__content--comment-write-comment-count my-3">
                                        <?= $comment_largest ?> bình luận <i class="fa-solid fa-bars mx-3"></i> <span>Sắp xếp theo</span>
                                    </p>
                                    <div class="d-flex mb-3">
                                        <div class="mr-3">
                                            <img class="border rounded-circle" src="<?= $Avatar ?>" alt="" width="40" height="40">
                                        </div>
                                        <div class="w-100">
                                            <input class="main__content--comment-write-comment-input border-bottom w-100 mb-3 p-2" type="text" placeholder="Viết bình luận...">
                                            <div class="d-flex justify-content-end">
                                                <button class="btn mr-2">Hủy</button>
                                                <button id="insert-comment-parent" class="btn btn-dark">Bình luận</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>

                        <?php
                        $sql_comment_parent = "SELECT user.ID AS ID_user, user.Name, user.Avatar, comment.Main, comment.Date, comment.ID FROM user JOIN comment ON user.ID = comment.ID_user WHERE comment.ID_post = $IDWatch && comment.ID_comment_parent = 0";
                        $result_comment_parent = $conn->query($sql_comment_parent);
                        if ($result_comment_parent->num_rows > 0) {
                            while ($row = $result_comment_parent->fetch_assoc()) {
                                $idUserCommentParent = $row["ID_user"];
                                $avatarCommentParent = $row["Avatar"];
                                $nameCommentParent = $row["Name"];
                                $dateCommentParent = $row["Date"];
                                $mainCommentParent = $row["Main"];
                                $idCommentParent = $row["ID"];
                                $time_agoParent = strtotime($dateCommentParent);

                        ?>
                                <div id="main__content--comment-parent-<?= $idCommentParent ?>" class="main__content--comment-parent d-flex mb-4">
                                    <div class="main__content--comment-parent-avatar mr-3">
                                        <img class="border rounded-circle" src="<?= $avatarCommentParent ?>" alt="" width="40" height="40">
                                    </div>
                                    <div class="main__content--comment-parent-main w-100">
                                        <div class="main__content--comment-parent-main-content mb-2 py-2">
                                            <div class="d-flex align-items-center">
                                                <h6 class="m-0 mx-3"><?= $nameCommentParent ?></h6>
                                                <p class="m-0"><?= timeAgo($time_agoParent) ?></p>
                                            </div>
                                            <p class="m-0 mx-3"><?= $mainCommentParent ?></p>
                                        </div>
                                        <div class="main__content--comment-parent-main-option d-flex align-items-center mb-2">
                                            <div id="main__content--comment-parent-main-option-like-<?= $idCommentParent ?>" class="main__content--comment-parent-main-option-like btn mr-3">
                                                <?php
                                                $sql_select_comment_like = "SELECT * FROM comment_like WHERE ID_user = $ID AND ID_comment= $idCommentParent";
                                                $result_select_comment_like = mysqli_query($conn, $sql_select_comment_like);
                                                $count_select_comment_like = mysqli_num_rows($result_select_comment_like);

                                                if ($count_select_comment_like == 1) {
                                                    $sql_comment_like = "SELECT COUNT(ID_user) AS COUNT FROM comment_like WHERE ID_comment= $idCommentParent";
                                                    $result_comment_like = $conn->query($sql_comment_like);
                                                    if ($result_comment_like->num_rows > 0) {
                                                        while ($row = $result_comment_like->fetch_assoc()) {
                                                            $countLike = $row["COUNT"];
                                                ?>
                                                            <i class="fa-solid fa-thumbs-down mr-2"></i>
                                                            <span><?= $countLike ?></span>
                                                        <?php
                                                        }
                                                    }
                                                } else {
                                                    $sql_comment_like = "SELECT COUNT(ID_user) AS COUNT FROM comment_like WHERE ID_comment= $idCommentParent";
                                                    $result_comment_like = $conn->query($sql_comment_like);
                                                    if ($result_comment_like->num_rows > 0) {
                                                        while ($row = $result_comment_like->fetch_assoc()) {
                                                            $countLike = $row["COUNT"];
                                                        ?>
                                                            <i class="fa-solid fa-thumbs-up mr-2"></i>
                                                            <span><?= $countLike ?></span>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div id="main__content--comment-parent-main-option-feedback-<?= $idCommentParent ?>" class="main__content--comment-parent-main-option-feedback btn mr-3">
                                                Phản hồi
                                            </div>
                                            <?php
                                            if ($ID == $idUserCommentParent) {
                                            ?>
                                                <div id="main__content--comment-parent-main-option-delete-<?= $idCommentParent ?>" class="main__content--comment-parent-main-option-delete btn mr-3">
                                                    Xóa
                                                </div>
                                            <?php
                                            } else {
                                                echo "";
                                            }
                                            ?>
                                        </div>
                                        <div id="main__content--comment-parent-write-comment-<?= $idCommentParent ?>" class="main__content--comment-parent-write-comment">
                                            <div class="d-flex mb-3">
                                                <div class="mr-3">
                                                    <img class="border rounded-circle" src="<?= $Avatar ?>" alt="" width="40" height="40">
                                                </div>
                                                <div class="w-100">
                                                    <input id="main__content--comment-parent-write-comment-input-<?= $idCommentParent ?>" class="main__content--comment-parent-write-comment-input border-bottom w-100 mb-3 p-2" type="text" placeholder="Viết bình luận...">
                                                    <div class="d-flex justify-content-end">
                                                        <button id="close-comment-<?= $idCommentParent ?>" class="main__content--comment-parent-write-comment-close btn mr-2">Hủy</button>
                                                        <button id="insert-comment-<?= $idCommentParent ?>" class="main__content--comment-parent-write-comment-insert btn btn-dark">Bình luận</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        $sql_feedback_largest = "SELECT COUNT(comment.ID) AS feedbackLargest FROM comment WHERE comment.ID_comment_parent = $idCommentParent";
                                        $result_feedback_largest = $conn->query($sql_feedback_largest);
                                        if ($result_feedback_largest->num_rows > 0) {
                                            while ($row = $result_feedback_largest->fetch_assoc()) {
                                                $feedback_largest = $row["feedbackLargest"];
                                                if ($feedback_largest != 0) {
                                        ?>
                                                    <div id="main__content--comment-child-feedback-<?= $idCommentParent ?>" class="main__content--comment-child-feedback d-flex align-items-center mb-2">
                                                        <div class="main__content--comment-child-feedback-count btn text-primary">
                                                            <i class="main__content--comment-child-feedback-count-down fa-solid fa-caret-down"></i>
                                                            <i class="main__content--comment-child-feedback-count-up fa-solid fa-caret-up d-none"></i>
                                                            <?= $feedback_largest ?> Phản hồi
                                                        </div>
                                                    </div>
                                                    <div id="main__content--comment-child-<?= $idCommentParent ?>" class="main__content--comment-child">
                                                        <?php
                                                        $sql_comment_child = "SELECT user.ID AS ID_user, user.Name, user.Avatar, comment.Main, comment.Date, comment.ID, comment.ID_comment_parent FROM comment JOIN user ON comment.ID_user = user.ID WHERE comment.ID_comment_parent = $idCommentParent";
                                                        $result_comment_child = $conn->query($sql_comment_child);
                                                        if ($result_comment_child->num_rows > 0) {
                                                            while ($row = $result_comment_child->fetch_assoc()) {
                                                                $idUserCommentChild = $row["ID_user"];
                                                                $avatarCommentChild = $row["Avatar"];
                                                                $nameCommentChild = $row["Name"];
                                                                $mainCommentChild = $row["Main"];
                                                                $dateCommentChild = $row["Date"];
                                                                $idCommentChild = $row["ID"];
                                                                $time_agoChild = strtotime($dateCommentChild);
                                                        ?>
                                                                <div class="d-flex">
                                                                    <div class="main__content--comment-child-avatar mr-3">
                                                                        <img class="border rounded-circle" src="<?= $avatarCommentChild ?>" alt="" width="40" height="40">
                                                                    </div>
                                                                    <div class="main__content--comment-child-main w-100">
                                                                        <div class="main__content--comment-child-main-content mb-2 py-2">
                                                                            <div class="d-flex align-items-center">
                                                                                <h6 id="main__content--comment-child-name-<?= $idCommentChild ?>" class="m-0 mx-3"><?= $nameCommentChild ?></h6>
                                                                                <p class="m-0"><?= timeAgo($time_agoChild) ?></p>
                                                                            </div>
                                                                            <p class="m-0 mx-3"><?= $mainCommentChild ?></p>
                                                                        </div>
                                                                        <div class="main__content--comment-child-main-option d-flex align-items-center mb-2">
                                                                            <div id="main__content--comment-child-main-option-like-<?= $idCommentChild ?>" class="main__content--comment-child-main-option-like btn mr-3">
                                                                                <?php
                                                                                $sql_select_comment_like = "SELECT * FROM comment_like WHERE ID_user = $ID AND ID_comment= $idCommentChild";
                                                                                $result_select_comment_like = mysqli_query($conn, $sql_select_comment_like);
                                                                                $count_select_comment_like = mysqli_num_rows($result_select_comment_like);

                                                                                if ($count_select_comment_like == 1) {
                                                                                    $sql_comment_like = "SELECT COUNT(ID_user) AS COUNT FROM comment_like WHERE ID_comment= $idCommentChild";
                                                                                    $result_comment_like = $conn->query($sql_comment_like);
                                                                                    if ($result_comment_like->num_rows > 0) {
                                                                                        while ($row = $result_comment_like->fetch_assoc()) {
                                                                                            $countLike = $row["COUNT"];
                                                                                ?>
                                                                                            <i class="fa-solid fa-thumbs-down mr-2"></i>
                                                                                            <span><?= $countLike ?></span>
                                                                                        <?php
                                                                                        }
                                                                                    }
                                                                                } else {
                                                                                    $sql_comment_like = "SELECT COUNT(ID_user) AS COUNT FROM comment_like WHERE ID_comment= $idCommentChild";
                                                                                    $result_comment_like = $conn->query($sql_comment_like);
                                                                                    if ($result_comment_like->num_rows > 0) {
                                                                                        while ($row = $result_comment_like->fetch_assoc()) {
                                                                                            $countLike = $row["COUNT"];
                                                                                        ?>
                                                                                            <i class="fa-solid fa-thumbs-up mr-2"></i>
                                                                                            <span><?= $countLike ?></span>
                                                                                <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                            <div id="main__content--comment-child-main-option-feedback-<?= $idCommentChild ?>" class="main__content--comment-child-main-option-feedback btn mr-3">
                                                                                Phản hồi
                                                                            </div>
                                                                            <?php
                                                                            if ($ID == $idUserCommentChild) {
                                                                            ?>
                                                                                <div id="main__content--comment-child-main-option-delete-<?= $idCommentChild ?>" class="main__content--comment-child-main-option-delete btn mr-3">
                                                                                    Xóa
                                                                                </div>
                                                                            <?php
                                                                            } else {
                                                                                echo "";
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <div id="main__content--comment-child-write-comment-<?= $idCommentChild ?>" class="main__content--comment-child-write-comment">
                                                                            <div class="d-flex mb-3">
                                                                                <div class="mr-3">
                                                                                    <img class="border rounded-circle" src="<?= $Avatar ?>" alt="" width="40" height="40">
                                                                                </div>
                                                                                <div class="w-100">
                                                                                    <input id="main__content--comment-child-write-comment-input-<?= $idCommentChild ?>" class="main__content--comment-child-write-comment-input border-bottom w-100 mb-3 p-2" type="text" placeholder="Viết bình luận...">
                                                                                    <div class="d-flex justify-content-end">
                                                                                        <button id="close-comment-<?= $idCommentChild ?>" class="main__content--comment-child-write-comment-close btn mr-2">Hủy</button>
                                                                                        <button id="insert-comment-2-<?= $idCommentChild ?>" class="main__content--comment-child-write-comment-insert btn btn-dark">Bình luận</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                <?php
                                                } else {
                                                    echo "";
                                                }
                                                ?>
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
            <?php
                }
            }
            ?>
        </div>
        <div class="main__nav mx-3">
            <?php
            $sql = "SELECT post.*, user.Name, user.Avatar FROM post JOIN user ON post.ID_user = user.ID WHERE post.ID != $IDWatch ORDER BY post.Date DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $IDPost = $row["ID"];
                    $videoPost = $row["Video"];
                    $titlePost = $row["Title"];
                    $viewPost = $row["View"];
                    $datePost = $row["Date"];
                    $avatarUser = $row["Avatar"];
                    $nameUser = $row["Name"];
                    $time_ago = strtotime($datePost);
            ?>
                    <div class="main__nav--post d-flex justify-content-between mb-3" id="<?= $IDPost ?>">
                        <video class="w-50 mr-3" src="<?= $videoPost ?>" controls></video>
                        <div class="w-50 d-flex">
                            <div class="main__nav--post-avatar d-none mx-3 my-2">
                                <img class="border rounded-circle" src="<?= $avatarUser ?>" alt="" width="40" height="40">
                            </div>
                            <div class="main__nav--post-infor">
                                <h6 class="my-2"><?= $titlePost ?></h6>
                                <p class="my-2"><?= $nameUser ?></p>
                                <p class="my-2"><?= $viewPost ?> lượt xem</p>
                                <p class="main__nav--post-date my-2"><?= timeAgo($time_ago) ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <!-- End Main -->

    <script src="./js/watch.js"></script>

</body>

</html>