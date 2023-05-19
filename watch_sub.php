<?php

session_start();

$ID = $_SESSION["ID"];

include 'config.php';

if (isset($_POST)) {
    $IDUserPost = $_POST["IDUserPost"];

    $sql_sub = "SELECT * FROM sub WHERE ID_user = $ID AND ID_user_post= $IDUserPost";
    $result_sub = mysqli_query($conn, $sql_sub);
    $count_sub = mysqli_num_rows($result_sub);

    if ($count_sub == 1) {
        $sql_delete = "DELETE FROM sub WHERE ID_user = $ID AND ID_user_post= $IDUserPost";
        if ($conn->query($sql_delete) === TRUE) {
            echo "Xóa đăng ký thành công";

            $sql_countSub = "SELECT COUNT(ID_user) AS Count_Sub FROM sub JOIN user ON sub.ID_user_post = user.ID WHERE ID_user_post = $IDUserPost";
            $result_countSub = $conn->query($sql_countSub);
            if ($result_countSub->num_rows > 0) {
                while ($row = $result_countSub->fetch_assoc()) {
                    echo $row["Count_Sub"];
                }
            }

        } else {
            echo "Lỗi rồi đại vương ơi!";
        }
    } else {
        $sql_insert = "INSERT INTO sub (ID_user, ID_user_post) VALUES ($ID, $IDUserPost)";
        if ($conn->query($sql_insert) === TRUE) {
            echo "Đăng ký thành công";

            $sql_countSub = "SELECT COUNT(ID_user) AS Count_Sub FROM sub JOIN user ON sub.ID_user_post = user.ID WHERE ID_user_post = $IDUserPost";
            $result_countSub = $conn->query($sql_countSub);
            if ($result_countSub->num_rows > 0) {
                while ($row = $result_countSub->fetch_assoc()) {
                    echo $row["Count_Sub"];
                }
            }

        } else {
            echo "Lỗi rồi đại vương ơi!";
        }

        // insert notification
        $notification = "SELECT * FROM sub where ID_user = $ID AND ID_user_post= $IDUserPost";
        $result_notification = mysqli_query($conn, $notification);
        $row_notification =  mysqli_fetch_array($result_notification); 
        $id = $row_notification['ID'];
        $sql_notification = "INSERT INTO `notification`(sub) VALUE($id)";
        if ($conn->query($sql_notification) === TRUE) {
        echo "ok";

        } else {     
        echo "Error: " . $sql_notification . "<br>" . $conn->error;
        }   
    }
}

$conn->close();