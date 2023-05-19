<?php

session_start();

$ID = $_SESSION["ID"];

$Name = $_SESSION["Name"];

$Email = $_SESSION["Email"];

$Avatar = $_SESSION["Avatar"];

include 'config.php';

if (isset($_POST)) {
    $IDPost = $_POST["IDPost"];
    $IDPost = stripcslashes($IDPost);
    $IDPost = mysqli_real_escape_string($conn, $IDPost);

    $IDCommentParent = $_POST["IDCommentParent"];
    $IDCommentParent = stripcslashes($IDCommentParent);
    $IDCommentParent = mysqli_real_escape_string($conn, $IDCommentParent);
    
    $Main = $_POST["Main"];
    $Main = stripcslashes($Main);
    $Main = mysqli_real_escape_string($conn, $Main);

    // next id auto_increment
    $sql_auto_increment = "SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'comment'";
    $result_auto_increment = mysqli_query($conn, $sql_auto_increment);
    $row_auto_increment =  mysqli_fetch_array($result_auto_increment); 
    $id_increment = $row_auto_increment['auto_increment'];
  
    $sql_insert = "INSERT INTO comment (ID_user, ID_post, Main, ID_comment_parent) VALUES ($ID, $IDPost, '$Main', $IDCommentParent)";
    if ($conn->query($sql_insert) === TRUE) {
        echo "Yes";
    } else {
        echo "Error";
    }

    // insert notification
    $sql_notification = "INSERT INTO `notification`(`comment`) VALUE($id_increment)";
    if ($conn->query($sql_notification) === TRUE) {
    echo "ok";
    } else {     
    echo "Error: " . $sql_notification . "<br>" . $conn->error;
    }   
}

$conn->close();