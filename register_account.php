<?php

session_start();

include "config.php";

require "mail.php";

if (isset($_POST)) {
    $Name = $_POST["Name"];
    $Name = stripcslashes($Name);
    $Name = mysqli_real_escape_string($conn, $Name);
    $Email = $_POST["Email"];
    $Email = stripcslashes($Email);
    $Email = mysqli_real_escape_string($conn, $Email);
    $Pass = $_POST["Pass"];
    $Pass = stripcslashes($Pass);
    $Pass = mysqli_real_escape_string($conn, $Pass);
    $Avatar = "./img/avatar_user.png";
    $MailSubject = "Sign Up Success";
    $MailBody = "Welcome account: " . $Email . " registered successfully. Your password is: " . $Pass . "";

    $sql_insert = "INSERT INTO user ( Name, Email, Pass, Avatar) VALUES ('$Name','$Email', '$Pass', '$Avatar')";

    if ($conn->query($sql_insert) == TRUE) {
        SendMail($Email, $MailSubject, $MailBody);
        $sql_select = "SELECT * FROM user WHERE Email = '$Email'";
        $result_select = mysqli_query($conn, $sql_select);
        $row_select = mysqli_fetch_array($result_select);
        $_SESSION["Name"] = $Name;
        $_SESSION["Email"] = $Email;
        $_SESSION["Avatar"] = $Avatar;
        $_SESSION["ID"] = $row_select["ID"];
        echo "Đăng ký thành công";
    } else {
        echo "Lỗi rồi đại vương ơi!";
    }
}

$conn->close();