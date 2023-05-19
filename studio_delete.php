<?php

session_start();

$ID = $_SESSION["ID"];

include 'config.php';

include 'time_ago.php';

if (isset($_POST)) {
    $IDPost = $_POST["IDPost"];
    $sql_delete = "DELETE FROM post WHERE ID = $IDPost";
    
    if ($conn->query($sql_delete) === TRUE) {
        $sql_studio = "SELECT post.* FROM post JOIN user ON post.ID_user = user.ID WHERE user.ID = $ID ORDER BY `Date` DESC";
        $result_studio = $conn->query($sql_studio);

        $array_result_studio = [];
        if ($result_studio->num_rows > 0) {
            while ($row = $result_studio->fetch_assoc()) {
                $array_result_studio[] = $row;
            }
            echo json_encode($array_result_studio);
        };
    } else {
        echo "Lỗi rồi đại vương ơi!";
    }
    $sql_notification = "DELETE FROM `notification` WHERE post_video = $IDPost";
    if ($conn->query($sql_notification) === TRUE) {
        echo "ok";
    } else {     
        echo "Error: " . $sql_notification . "<br>" . $conn->error;
    }   
}

$conn->close();
