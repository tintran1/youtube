// Hide show icon in input header
$(".header__search--input-glass-one").hide()
$(".header__search--input-keyboard").hide()

$(".header__search--input-input").click(function (e) {
    $(".header__search--input-glass-one").show()
    $(".header__search--input-keyboard").show()
})
// End hide show icon in input header


// Hide show option user in header
$(".header__user--video-check-out").hide()
$(".header__user--bell-check-out").hide()
$(".header__user--avatar-check-out").hide()

function hideClass(e) {
    $(`.header__user--${e}-check-out`).toggle()
    if (e !== 'video') $(".header__user--video-check-out").hide()
    if (e !== 'avatar') $(".header__user--avatar-check-out").hide()
    if (e !== 'bell') $(".header__user--bell-check-out").hide()
}

// notification ajax

$(".header__user-icon").click(function () {
    var ID = $(this).attr('id').slice(14)
    hideClass(ID)
    var id_list = Array()
    $(".check-out-hover ").each(function () {
        var id = $(this).prop('id').replace(/[^\d.]/g, '') 
        id_list.push(id);
    });
    $.ajax({
        type: 'POST',
        url: 'notification_view.php',
        data: { 'id': id_list },
        success: function (data) {   
            console.log(data)
        }
    })
})
// End hide show option user in header


// Nav to studio
$('#studio').click(function (e) {
    window.location.replace(`studio.php`)
})
// End nav to studio


// Sign out
$('#sign-out').click(function (e) {
    localStorage.clear();
})
// End sign out


// Nav to watch
$('.main__content--post-post').click(function (e) {
    e.preventDefault()
    var ID = $(this).attr('id')
    
    $.ajax({
        type: 'POST',
        url: 'index_nav.php',
        data: { 'ID': ID },
        success: function (data) {
            if (data == "Có video") {
                window.location.replace(`http://localhost:8080/youtube/watch.php?ID=${ID}`)
            }
        }
    })
})
// End nav to watch
