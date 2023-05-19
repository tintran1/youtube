<?php

session_start();

$ID = $_SESSION["ID"];

$Name = $_SESSION["Name"];

$Email = $_SESSION["Email"];

$Avatar = $_SESSION["Avatar"];

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
    $Title = $_POST['Title'];
    $Describe = $_POST['Describe'];
    $IDCategory = $_POST['IDCategory'];

    $Video = array();
    $name = $_FILES['files']['name'];

    $countVideo = count($name);
    for ($i = 0; $i < $countVideo && $i <= 100; $i++) {
        $namefile = $_FILES['files']['name'][$i];
        $filepath = $_FILES['files']['tmp_name'][$i];
        try {
            $result = $s3->putObject(array(
                'Bucket'       => $bucket,
                'Key'          => $namefile,
                'SourceFile'   => $filepath,
                'ContentType'  => 'text/plain',
                'ACL'          => 'public-read',
            ));

            $Video = htmlspecialchars($result->get('ObjectURL'));

            $success = "upload video success";
        } catch (S3Exception  $e) {
            echo $e->getMessage();
        }

        $sql_auto_increment = "SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'comment'";
        $result_auto_increment = mysqli_query($conn, $sql_auto_increment);
        $row_auto_increment =  mysqli_fetch_array($result_auto_increment); 
        $id_increment = $row_auto_increment['auto_increment'];
        
        $sql_insert = "INSERT INTO post (ID_user, ID_category, Title, `Describe`, Video) VALUES ($ID, $IDCategory, '$Title', '$Describe', '$Video')";
        if ($conn->query($sql_insert) === TRUE) {
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

        // insert notification
        $sql_notification = "INSERT INTO `notification`(post_video) VALUE($row_auto_increment)";
        if ($conn->query($sql_notification) === TRUE) {
            echo "ok";
        } else {     
            echo "Error: " . $insert . "<br>" . $conn->error;
        } 
    }  
}

$conn->close();