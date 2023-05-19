<?php

include 'config.php';

if (isset($_POST)) {
    $IDPost = $_POST["IDPost"];

    $sql_select = "SELECT * FROM post WHERE ID = $IDPost";
    $result_select = $conn->query($sql_select);
    $array_result_select = [];

    if ($result_select->num_rows > 0) {
        while ($row = $result_select->fetch_assoc()) {
            $array_result_select[] = $row;
        }
        echo json_encode($array_result_select);
    }
}

$conn->close();
?>