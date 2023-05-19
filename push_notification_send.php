<?PHP
   
    include 'config.php';
   
    function sendMessage($row_count){
        $url =$_POST['url'];
        $title = $_POST['title'];
        $message = $_POST['message'];
       $tmpFilePath = $_FILES['img']['tmp_name'];
       $newFilePath = "./images/" . $_FILES['img']['name'];
        move_uploaded_file($tmpFilePath, $newFilePath);
        $img =  "https://trannhutin.toidayhoc.com/youtube/images/ " . $tmpFilePath;
    
        $fields = array(
            'app_id' => 'ea5cee97-5f21-498a-bcce-4379c4d9c839',
            'include_player_ids' => array($row_count),
            'contents' => array("en" =>$message),
            'headings' => array("en"=>$title),
            'chrome_web_image' => $img , 
            'url' => $url,
        );
        
        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                'Authorization: Basic NzViM2QxZDQtZjY3Ni00ZDk4LThiYzctOTRlNWE2N2U1NGFh'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
    if(isset($_POST)){
        $id_push = explode(',', $_POST["id_push"]);
        $sql = "SELECT * FROM user Where ID_push_notification IN ( '" . implode( "', '", $id_push ) . "' )";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result -> fetch_assoc()) {
                $row_count = $row['ID_push_notification'];
                $response = sendMessage($row_count);
                $return["allresponses"] = $response;
            }
            
        } else {
            echo "Lỗi rồi đại vương ơi!";
        }
    }
    
?>