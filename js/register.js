// Hide danger
$("#main__danger--1").hide()
$("#main__danger--2").hide()
$("#main__danger--3").hide()
$("#main__danger--4").hide()
$("#main__danger--5").hide()
$("#main__danger--6").hide()
$("#main__danger--7").hide()


// Register
$('#register').click(function (e) {
    e.preventDefault()
    var FirstName = $("#main__form--first-name").val()
    var LastName = $("#main__form--last-name").val()
    var Email = $("#main__form--email").val()
    var Pass = $("#main__form--pass").val()
    var ConfirmPass = $("#main__form--confirm-pass").val()
    var Name = FirstName + " " + LastName

    if (FirstName != "" && LastName != "" && Email != "" && Pass != "" && Pass == ConfirmPass) {
        $.ajax({
            type: 'POST',
            url: 'register_account.php',
            data: { 'Name': Name, 'Email': Email, 'Pass': Pass },
            cache: false,
            success: function (data) {
                console.log(data)
                if (data == "Đăng ký thành công") {
                    window.location.replace('index.php')
                } else {
                    $("#main__danger--1").hide()
                    $("#main__danger--2").hide()
                    $("#main__danger--3").hide()
                    $("#main__danger--4").hide()
                    $("#main__danger--5").show()
                    $("#main__danger--6").hide()
                    $("#main__danger--7").hide()
                }
            }
        })
    } else {
        if (FirstName == "" && LastName == "") {
            $("#main__danger--1").show()
            $("#main__danger--2").hide()
            $("#main__danger--3").hide()
        } else if (FirstName == "" && LastName != "") {
            $("#main__danger--1").hide()
            $("#main__danger--2").show()
            $("#main__danger--3").hide()
        } else if (FirstName != "" && LastName == "") {
            $("#main__danger--1").hide()
            $("#main__danger--2").hide()
            $("#main__danger--3").show()
        } else {
            $("#main__danger--1").hide()
            $("#main__danger--2").hide()
            $("#main__danger--3").hide()
        }

        if (Email == "") {
            $("#main__danger--4").show()
            $("#main__danger--5").hide()
        } else {
            $("#main__danger--4").hide()
            $("#main__danger--5").show()
        }

        if (Pass == "") {
            $("#main__danger--6").show()
            $("#main__danger--7").hide()
        } else if (Pass != "" && ConfirmPass == "") {
            $("#main__danger--6").hide()
            $("#main__danger--7").show()
        } else {
            $("#main__danger--6").hide()
            $("#main__danger--7").hide()
        }
    }
})
// End register


// Show password
$('#check-pass').click(function () {
    if (document.getElementById('check-pass').checked) {
      $('#main__form--pass').get(0).type = 'text'
      $('#main__form--confirm-pass').get(0).type = 'text'
    } else {
      $('#main__form--pass').get(0).type = 'password'
      $('#main__form--confirm-pass').get(0).type = 'password'
    }
  })
// End show password