<?php

session_start();

include 'config.php';

if (isset($_POST)) {
    $Name = $_POST["Name"];
    $Name = stripcslashes($Name);
    $Name = mysqli_real_escape_string($conn, $Name);
    $Email = $_POST["Email"];
    $Email = stripcslashes($Email);
    $Email = mysqli_real_escape_string($conn, $Email);
    $Avatar = $_POST["Avatar"];
    $Avatar = stripcslashes($Avatar);
    $Avatar = mysqli_real_escape_string($conn, $Avatar);

    $sql_select = "SELECT * FROM user WHERE Email = '$Email'";
    $result_select = mysqli_query($conn, $sql_select);
    $count = mysqli_num_rows($result_select);
    $row_select = mysqli_fetch_array($result_select);
    $ID = $row_select["ID"];

    $sql_insert = "INSERT INTO user ( Name, Email, Avatar) VALUES ('$Name','$Email', '$Avatar')";

    if ($count == 1) {
        $_SESSION['Email'] = $Email;
        $_SESSION['Avatar'] = $Avatar;
        $_SESSION["Name"] = $Name;
        $_SESSION["ID"] = $ID;
        echo "Đăng nhập thành công";
    } else {
        if ($conn->query($sql_insert) === TRUE) {
            $result_select = mysqli_query($conn, $sql_select);
            $row_select = mysqli_fetch_array($result_select);
            $_SESSION['Email'] = $Email;
            $_SESSION['Avatar'] = $Avatar;
            $_SESSION["Name"] = $Name;
            $_SESSION["ID"] = $row_select["ID"];
            echo "Đăng nhập thành công";
        } else {
            echo "Lỗi rồi đại vương ơi!";
        }
    }
}

$conn->close();
