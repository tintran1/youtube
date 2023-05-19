<?php

include 'config.php';

if (isset($_POST)) {
    $Token = $_POST["Token"];
    $Token = stripcslashes($Token);
    $Token = mysqli_real_escape_string($conn, $Token);
    $Pass = $_POST["Pass"];
    $Pass = stripcslashes($Pass);
    $Pass = mysqli_real_escape_string($conn, $Pass);
    $ConfirmPass = $_POST["ConfirmPass"];
    $ConfirmPass = stripcslashes($ConfirmPass);
    $ConfirmPass = mysqli_real_escape_string($conn, $ConfirmPass);

    $sql_update = "UPDATE user SET Pass = '$Pass' WHERE Token = '$Token'";

    if ($Pass == $ConfirmPass) {
        if ($conn->query($sql_update) === TRUE) {
            $sql_select = "SELECT * FROM user WHERE Token = '$Token'";
            $result_select = mysqli_query($conn, $sql_select);
            $row_select = mysqli_fetch_array($result_select);
            $_SESSION['Email'] = $row_select["Email"];
            $_SESSION['Avatar'] = $row_select["Avatar"];
            $_SESSION["Name"] = $row_select["Name"];
            $_SESSION["ID"] = $row_select["ID"];
            echo "Đổi mật khẩu thành công";
        } else {
            echo "Lỗi rồi đại vương ơi!";
        }
    } else {
        echo "Lỗi rồi đại vương ơi!";
    }
}

$conn->close();
