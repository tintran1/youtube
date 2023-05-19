<?php

include 'config.php';

    $sql = "SELECT * FROM user ";
    $result_select = $conn->query($sql);
    $array_result_select = [];
    if ($result_select-> num_rows> 0) {
        while ($row = $result_select->fetch_assoc()) {
         
            $array_result_select[] = $row;

        }
        echo json_encode($array_result_select);
    }

$conn->close();
?>
