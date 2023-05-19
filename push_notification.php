<?php
session_start();

$Name = $_SESSION["Name"];

$Email = $_SESSION["Email"];

$Avatar = $_SESSION["Avatar"];

include 'config.php';

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/virtual-select.min.css" >
    <script src="./js/virtual-select.min.js"></script>
    <title>Document</title>
</head>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId: "ea5cee97-5f21-498a-bcce-4379c4d9c839",
            safari_web_id: "web.onesignal.auto.049ba086-b9bb-478c-827f-71a35c67ecc8",
            notifyButton: {
                enable: true,
            },
            subdomainName: "gvhgvhgvhg",
        });
        OneSignal.push(function() {
            OneSignal.on('subscriptionChange', function(isSubscribed) {
                if (isSubscribed) {
                    OneSignal.getUserId(function(userId) {})
                } else {
                    console.log("Thanks a lot!! unsubscribed");
                }
            })
        });
    });
</script>

</script>

<body>
    <div class="d-flex justify-content-between">
        <div></div>
        <div>
            <div class="form-group form-md-6">
                <label for="exampleInputPassword1">Title</label>
                <input id="title" type="text" class="form-control">
            </div>
            <div class="form-group form-md-6">
                <label for="exampleInputPassword1">Message</label>
                <input id="message" class="form-control">
            </div>
            <div class="form-group md-6">
            <label for="image">Image</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image">
                    <label class="custom-file-label" for="image" aria-describedby="inputGroupFileAddon02">Choose Image</label>
                </div>
            </div>
            <div class="form-group form-md-6">
                <label for="exampleInputPassword1">URL</label>
                <input type="text" id="url" class="form-control">
            </div>
            <label for="ID_push_notification">Choose user</label>
            <select id="ID_push_notification" class="mb-5" multiple  placeholder="Select User" data-search="false" data-silent-initial-value-set="true">
            <?php
                $sql = "SELECT * FROM user Where ID_push_notification IS NULL OR ID_push_notification = '' IS FALSE ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {                      
                        $ID_push_notification = $row['ID_push_notification'];
                        $name = $row['Name'];
                        echo " <option value='$ID_push_notification'> $name </option>";
                    }
                }
                ?>
            </select>
            
            <button type="button" class="btn btn-secondary btn-lg btn-block" id="send">Gửi</button>
            <a href="index.php" type="button" class="btn btn-secondary btn-lg btn-block" id="send">Trở về trang chủ</a>
        </div>
        <div></div>
    </div>
</body>
<script src="./js/push_notification.js"></script>

</html>