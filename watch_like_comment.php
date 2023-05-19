<?php

session_start();

$ID = $_SESSION["ID"];

include 'config.php';

if (isset($_POST)) {
    $IDComment = $_POST["IDComment"];

    $sql_like = "SELECT * FROM comment_like WHERE ID_user = $ID AND ID_comment = $IDComment";
    $result_like = mysqli_query($conn, $sql_like);
    $count_like = mysqli_num_rows($result_like);

    if ($count_like == 1) {
        $sql_delete = "DELETE FROM comment_like WHERE ID_user = $ID AND ID_comment = $IDComment";
        if ($conn->query($sql_delete) === TRUE) {
            echo "Dislike";

            $sql_countLike = "SELECT COUNT(ID_user) AS Count_Like FROM comment_like WHERE ID_comment = $IDComment";
            $result_countLike = $conn->query($sql_countLike);
            if ($result_countLike->num_rows > 0) {
                while ($row = $result_countLike->fetch_assoc()) {
                    echo $row["Count_Like"];
                }
            }
        } else {
            echo "Error";
        }
    } else {
        $sql_insert = "INSERT INTO comment_like (ID_user, ID_comment) VALUES ($ID, $IDComment)";
        if ($conn->query($sql_insert) === TRUE) {
            echo "Like";

            $sql_countLike = "SELECT COUNT(ID_user) AS Count_Like FROM comment_like WHERE ID_comment = $IDComment";
            $result_countLike = $conn->query($sql_countLike);
            if ($result_countLike->num_rows > 0) {
                while ($row = $result_countLike->fetch_assoc()) {
                    echo $row["Count_Like"];
                }
            }

        } else {
            echo "Error";
        }
    }
}

$conn->close();