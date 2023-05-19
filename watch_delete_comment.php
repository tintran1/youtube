<?php

session_start();

$ID = $_SESSION["ID"];

include 'config.php';

if (isset($_POST)) {
    $IDComment = $_POST["IDComment"];

    $sql_select = "SELECT * FROM comment WHERE ID_comment_parent = $IDComment";
    $result_select = $conn->query($sql_select);
    
    if ($result_select->num_rows > 0) {
        while ($row = $result_select->fetch_assoc()) {
            $ID = $row["ID"];
            $sql_delete_child = "DELETE FROM comment WHERE ID = $ID";
            $result_delete_child = mysqli_query($conn, $sql_delete_child);
        }
        $sql_delete = "DELETE FROM comment WHERE ID = $IDComment";
        if ($conn->query($sql_delete) === TRUE) {
            echo "Yes";
        } else {
            echo "Error";
        }
    } else {
        $sql_delete = "DELETE FROM comment WHERE ID = $IDComment";
        if ($conn->query($sql_delete) === TRUE) {
            echo "Yes";
        } else {
            echo "Error";
        }
    }
}

$conn->close();