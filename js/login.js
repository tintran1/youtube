/**
 * @return {!Object} The FirebaseUI config.
 */
function getUiConfig() {
  return {
    callbacks: {
      // Called when the user has been successfully signed in.
      signInSuccess: function (user, credential, redirectUrl) {
        handleSignedInUser(user);
        // Do not redirect.
        return false;
      }
    },
    // Opens IDP Providers sign-in flow in a popup.
    signInFlow: 'popup',
    signInOptions: [
      // The Provider you need for your app. We need the Phone Auth

      firebase.auth.GoogleAuthProvider.PROVIDER_ID,
      {
        provider: firebase.auth.PhoneAuthProvider.PROVIDER_ID,
        recaptchaParameters: {
          //size: getRecaptchaMode()
          type: 'image',
          size: 'invisible',
          badge: 'bottomleft'
        }
      }
    ],
    // Terms of service url.
    'tosUrl': 'https://www.google.com'
  };
}

// Initialize the FirebaseUI Widget using Firebase.
var ui = new firebaseui.auth.AuthUI(firebase.auth());


/**
 * Displays the UI for a signed in user.
 * @param {!firebase.User} user
 */
var handleSignedInUser = function (user) {
  document.getElementById('user-signed-in').style.display = 'block';
  document.getElementById('user-signed-out').style.display = 'none';
  document.getElementById('name').textContent = user.displayName;
  document.getElementById('email').textContent = user.email;
  document.getElementById('phone').textContent = user.phoneNumber;
  if (user.photoURL) {
    document.getElementById('photo').src = user.photoURL;
    document.getElementById('photo').style.display = 'block';
  } else {
    document.getElementById('photo').style.display = 'none';
  }
  login(user)
};


/**
 *             
 */
var handleSignedOutUser = function () {
  document.getElementById('user-signed-in').style.display = 'none';
  document.getElementById('user-signed-out').style.display = 'block';
  ui.start('#firebaseui-container', getUiConfig());
};


// Listen to change in auth state so it displays the correct UI for when
// the user is signed in or not.
firebase.auth().onAuthStateChanged(function (user) {
  document.getElementById('loading').style.display = 'none';
  document.getElementById('loaded').style.display = 'block';
  user ? handleSignedInUser(user) : handleSignedOutUser();
});


// Hide danger
$("#main__danger--1").hide()
$("#main__danger--2").hide()
$("#main__danger--3").hide()


// Login by google
function login(user) {
  var Email = user.email
  var Name = user.displayName
  var Avatar = user.photoURL
  $.ajax({
    url: "login_google.php",
    type: "POST",
    data: { 'Email': Email, 'Name': Name, 'Avatar': Avatar },
    success: function (data) {
      if (data == "Đăng nhập thành công") {
        window.location.replace('index.php')
      } else if (data == "Đăng nhập thành công") {
        window.location.replace('index.php')
      } else {

      }
    }
  })
}
// End login by google


// Login by account
$('#login').click(function (e) {

  e.preventDefault()

  var Email = $("#main__form--email").val()
  var Pass = $("#main__form--pass").val()

  if (Email == "" && Pass == "") {
    $("#main__danger--1").show()
    $("#main__danger--2").show()
    $("#main__danger--3").hide()
  } else {
    $.ajax({
      type: 'POST',
      url: 'login_account.php',
      data: { 'Email': Email, 'Pass': Pass },
      cache: false,
      success: function (data) {
        if (data == "Đăng nhập thành công") {
          window.location.replace('index.php')
        } else {
          $("#main__danger--3").show()
          $("#main__danger--1").hide()
          $("#main__danger--2").hide()
        }
      }
    })
  }
})
// End login by account


// Show password
$('#check-pass').click(function () {
  if (document.getElementById('check-pass').checked) {
    $('#main__form--pass').get(0).type = 'text'
  } else {
    $('#main__form--pass').get(0).type = 'password'
  }
})
// End show password