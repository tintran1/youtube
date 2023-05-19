<?php

session_start();

$ID = $_SESSION["ID"];

include 'config.php';

require './vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$bucket = 'labtoidayhoc';
$keyname = 'AKIAVJH5OBNALLPJXXNB';
$s3secret = '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';
$region = 'ap-southeast-1';

$s3 = new S3Client([
    'version' => '2006-03-01',
    'scheme' => 'https',
    'region'  => $region,
    'credentials' => [
        'key'    => $keyname,
        'secret' => $s3secret,
    ],
]);

if (isset($_POST)) {
    $IDPost = $_POST['ID'];
    $Title = $_POST['Title'];
    $Describe = $_POST['Describe'];
    $IDCategory = $_POST['IDCategory'];
    if ($_FILES['files'] != NULL) {
        $Video = array();
        $name = $_FILES['files']['name'];

        $get = count($name);
        for ($i = 0; $i < $get && $i <= 100; $i++) {
            $namefile = $_FILES['files']['name'][$i];
            $filepath = $_FILES['files']['tmp_name'][$i];
            try {
                $result = $s3->putObject(array(
                    // $bucket,
                    // $namefile,
                    // fopen($filepath,$Video),
                    // 'public-read'
                    'Bucket'       => $bucket,
                    'Key'          => $namefile,
                    'SourceFile'   => $filepath,
                    'ContentType'  => 'text/plain',
                    'ACL'          => 'public-read',
                    // 'StorageClass' => 'REDUCED_REDUNDANCY'
                ));

                $Video = htmlspecialchars($result->get('ObjectURL'));

                $success = "upload video success";
            } catch (S3Exception  $e) {
                echo $e->getMessage();
            }

            $sql_update = "UPDATE post SET ID_category = $IDCategory, Title = '$Title', `Describe` = '$Describe', Video = '$Video' WHERE ID = $IDPost";

            if ($conn->query($sql_update) === TRUE) {
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
        }
    } else {
        $sql_update = "UPDATE post SET ID_category = $IDCategory, Title = '$Title', `Describe` = '$Describe' WHERE ID = $IDPost";

        if ($conn->query($sql_update) === TRUE) {
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
    }
}

$conn->close();
