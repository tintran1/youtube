<?php

session_start();

$mail = $_SESSION["Email"];

include 'config.php';  

$id_notification = $_POST['userid'];

$spl="SELECT * FROM user Where (Email = '$mail')";
$run = mysqli_query($conn, $spl);  
$row = mysqli_fetch_array($run);
$id_user = $row['ID'];
$id_push = $row['ID_push_notification'];
if($id_push !== $id_notification){
    $insert = " UPDATE user SET ID_push_notification = '$id_notification' where ID = $id_user";
    if ($conn->query($insert) === TRUE) {
        echo "ok";
        
    } else {     
        echo "Error: " . $insert . "<br>" . $conn->error;
    }
}else{
    echo "ok";
}
    $conn->close();
          
?>