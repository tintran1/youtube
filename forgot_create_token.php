<?php

session_start();

include 'config.php';

require 'mail.php';

if (isset($_POST)) {
    $Email = $_POST["Email"];
    $Email = stripcslashes($Email);
    $Email = mysqli_real_escape_string($conn, $Email);
    $Token = md5($Email.time());
    $Token = stripcslashes($Token);
    $Token = mysqli_real_escape_string($conn, $Token);
    $MailSubject = 'Password recovery successful';
    $MailBody = 'Click the link below to change your password: http://localhost/youtube/forgot_pass.php?Token='.$Token.'';

    $sql_update = "UPDATE user SET Token = '$Token' WHERE Email = '$Email'";
    
    if ($conn->query($sql_update) === TRUE) {
        SendMail($Email,$MailSubject, $MailBody);
        echo "Tạo token thành công";
    } else {
        echo "Lỗi rồi đại vương ơi!";
    }
}

$conn->close();