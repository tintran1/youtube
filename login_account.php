<?php

session_start();

include 'config.php';

if (isset($_POST)) {
    $Email = $_POST["Email"];
    $Email = stripcslashes($Email);
    $Email = mysqli_real_escape_string($conn, $Email);
    $Pass = $_POST["Pass"];
    $Pass = stripcslashes($Pass);
    $Pass = mysqli_real_escape_string($conn, $Pass);

    $sql_select = "SELECT * FROM user WHERE Email = '$Email' AND Pass = '$Pass'";
    $result_select = mysqli_query($conn, $sql_select);
    $row_select = mysqli_fetch_array($result_select);
    $count_select = mysqli_num_rows($result_select);

    if ($count_select == 1) {
        $_SESSION["Email"] = $Email;
        $_SESSION["Avatar"] = $row_select["Avatar"];
        $_SESSION["Name"] = $row_select["Name"];
        $_SESSION["ID"] = $row_select["ID"];
        echo "Đăng nhập thành công";
    } else {
        echo "Lỗi rồi đại vương ơi!";
    }
}

$conn->close();
