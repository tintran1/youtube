//Select option
VirtualSelect.init({ 
    ele: '#ID_push_notification' 
  });

OneSignal.push(function() {
    OneSignal.isPushNotificationsEnabled(function(isEnabled) {
        if (isEnabled){
            console.log("Push notifications are enabled!");
            OneSignal.getUserId( function(userId) {
               var user = userId
                $.ajax({
                    type: 'POST',
                    url: 'push_notification_post_id.php',
                    dataType: "text",
                    async: false,
                    data: {'userid':user},
                    success: function(data) {
                        console.log(data)
                    }
                })
            });
        }else
        console.log("Push notifications are not enabled yet.");    
    });
});

$(document).ready( function () {
    $.ajax({
        type: 'POST',
        url: 'push_notification_getdata.php',
        dataType: "json",
        success: function (data) {
            $.each(data, function (k) {
                 $("#ID_push_notification").val(`${data[k].ID_push_notification}`) 
            })
        }
    })
})

$(document).ready(function(){
    $('#send').click(function(){ 
        var ID_push =$('#ID_push_notification').val()
        var title =$('#title').val()
        var message =$('#message').val()
        var img = $('#image').get(0).files[0]
        var url =$('#url').val()
        var formdata = new FormData()
        formdata.append('title',title)
        formdata.append('img',img)
        formdata.append('url',url)
        formdata.append('message',message)
        formdata.append('id_push',ID_push)
        $.ajax({
            type: 'POST',
            url: 'push_notification_send.php',
            dataType: "text",
            async: false,
            data: formdata,
            processData: false,  
            contentType: false, 
            cache: false,
            success: function(data) {
                console.log(data)
            }
        })
    });
})

