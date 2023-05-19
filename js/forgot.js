// Hide danger
$("#main__danger--1").hide()


// Forgot
$('#forgot').click(function (e) {
  e.preventDefault()
  var Email = $("#main__form--email").val()

  if (Email == "") {
    $("#main__danger--1").show()
  } else {
    $.ajax({
      type: 'POST',
      url: 'forgot_create_token.php',
      data: { 'Email': Email },
      cache: false,
      success: function (data) {
        console.log(data)
        if (data == "Tạo token thành công") {
          window.location.replace('https://gmail.com/')
        } else {
          $("#main__danger--1").show()
        }
      }
    })
  }
})
// End forgot