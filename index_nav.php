<?php

session_start();

include 'config.php';

if (isset($_POST)) {
    $ID = $_POST["ID"];
    $sql = "SELECT * FROM post WHERE ID = '$ID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        echo "Có video";
    } else {    
        echo "Không";
    }
}

$conn->close();