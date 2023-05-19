<?php

session_start();

$ID = $_SESSION["ID"];

include("config.php");

$id_list = $_POST['id'];
$arr = array_filter($id_list, fn ($value) => !is_null($value) && $value !== '');
foreach ($arr as $id) {
    $sql = "SELECT view_notification.ID_notification FROM view_notification where ID_notification = $id";
    $result =  mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result); 
    if($count == 0){
        $sql_insert = "INSERT INTO view_notification (ID_notification,ID_user)
                    VALUE ($id,$ID)";
            
        if ($conn->query($sql_insert) === TRUE) {
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }   
}

