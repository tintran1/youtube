// Hide danger
$("#main__danger--1").hide()
$("#main__danger--2").hide()


// Register
$('#forgot-pass').click(function (e) {
    e.preventDefault()
    var Token = $("#main__form--token").val()
    var Pass = $("#main__form--pass").val()
    var ConfirmPass = $("#main__form--confirm-pass").val()

    if (Token != "" && Pass != "" && Pass == ConfirmPass) {
        $.ajax({
            type: 'POST',
            url: 'forgot_update_pass.php',
            data: { 'Token': Token, 'Pass': Pass, 'ConfirmPass': ConfirmPass },
            cache: false,
            success: function (data) {
                console.log(data)
                if (data == "Đổi mật khẩu thành công") {
                    window.location.replace('index.php')
                } else {
                    $("#main__danger--1").show()
                    $("#main__danger--2").show()
                }
            }
        })
    } else {
        $("#main__danger--1").show()
        $("#main__danger--2").show()
    }
})
// End register


// Show password
$('#invalidCheck').click(function () {
    if (document.getElementById('invalidCheck').checked) {
      $('#main__form--pass').get(0).type = 'text'
      $('#main__form--confirm-pass').get(0).type = 'text'
    } else {
      $('#main__form--pass').get(0).type = 'password'
      $('#main__form--confirm-pass').get(0).type = 'password'
    }
  })
// End show password