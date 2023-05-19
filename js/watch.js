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


// Like post
$(document).on("click", ".main__content--menu-option-like-hover", function () {
    var IDPost = $(this).attr('id').slice(32)
    $('.main__content--menu-option-like-hover').html("")

    $.ajax({
        type: 'POST',
        url: 'watch_like.php',
        data: { 'IDPost': IDPost },
        success: function (data) {
            if (data.slice(0, 15) == "Like thành công") {
                $('.main__content--menu-option-like-hover').html(`<i class="fa-solid fa-thumbs-down mr-2"></i><span>${data.slice(15)}</span>`)
            }
            else if (data.slice(0, 18) == "Bỏ like thành công") {
                $('.main__content--menu-option-like-hover').html(`<i class="fa-solid fa-thumbs-up mr-2"></i><span>${data.slice(18)}</span>`)
            }
        }
    })
})
// End like post


// Subsribe
$(document).on("click", ".main__content--menu-user-register", function () {
    var IDUserPost = $('.main__content--menu-user-register-button').attr('id').slice(9)
    $('.main__content--menu-user-register').html('')
    $('#main__content--menu-user-infor-sub').html('')

    $.ajax({
        type: 'POST',
        url: 'watch_sub.php',
        data: { 'IDUserPost': IDUserPost },
        success: function (data) {
            if (data.slice(0, 22) == "Xóa đăng ký thành công") {
                $('.main__content--menu-user-register').html(`<button id="register-${IDUserPost}" class="main__content--menu-user-register-button btn btn-dark">Đăng ký</button>`)
                $('#main__content--menu-user-infor-sub').html(`${data.slice(22)} người đăng ký`)
            }
            else if (data.slice(0, 18) == "Đăng ký thành công") {
                $('.main__content--menu-user-register').html(`<button id="register-${IDUserPost}" class="main__content--menu-user-register-button btn btn-light mr-2">Đã đăng ký</button><i class="fa-solid fa-bell"></i>`)
                $('#main__content--menu-user-infor-sub').html(`${data.slice(18)} người đăng ký`)
            }
        }
    })
})
// End subsribe


// Like comment
$(document).on("click", ".main__content--comment-parent-main-option-like", function () {
    var IDComment = $(this).attr('id').slice(47)
    $(this).html("")

    $.ajax({
        type: 'POST',
        url: 'watch_like_comment.php',
        data: { 'IDComment': IDComment },
        success: function (data) {
            if (data.slice(0, 4) == "Like") {
                $(`#main__content--comment-parent-main-option-like-${IDComment}`).html(`<i class="fa-solid fa-thumbs-down mr-2"></i><span>${data.slice(4)}</span>`)
            }
            else if (data.slice(0, 7) == "Dislike") {
                $(`#main__content--comment-parent-main-option-like-${IDComment}`).html(`<i class="fa-solid fa-thumbs-up mr-2"></i><span>${data.slice(7)}</span>`)
            }
        }
    })
})

$(document).on("click", ".main__content--comment-child-main-option-like", function () {
    var IDComment = $(this).attr('id').slice(46)
    $(this).html("")
    $.ajax({
        type: 'POST',
        url: 'watch_like_comment.php',
        data: { 'IDComment': IDComment },
        success: function (data) {
            if (data.slice(0, 4) == "Like") {
                $(`#main__content--comment-child-main-option-like-${IDComment}`).html(`<i class="fa-solid fa-thumbs-down mr-2"></i><span>${data.slice(4)}</span>`)
            }
            else if (data.slice(0, 7) == "Dislike") {
                $(`#main__content--comment-child-main-option-like-${IDComment}`).html(`<i class="fa-solid fa-thumbs-up mr-2"></i><span>${data.slice(7)}</span>`)
            }
        }
    })
})
// End like comment


// Insert comment
$('#insert-comment-parent').click(function (e) {
    const IDPost = $('.main__content--comment').attr('id').slice(23)
    const IDCommentParent = "0"
    const Main = $('.main__content--comment-write-comment-input').val()
    $.ajax({
        type: 'POST',
        url: 'watch_insert_comment.php',
        data: { 'IDPost': IDPost, 'IDCommentParent': IDCommentParent, 'Main': Main },
        success: function (data) {
            if (data == "Yes") {
                window.location.replace(`watch.php?ID=${IDPost}`)
            }
        }
    })
})

$(".main__content--comment-parent-write-comment").hide()
$(document).on("click", ".main__content--comment-parent-main-option-feedback", function () {
    var IDComment = $(this).attr('id').slice(51)
    $(`#main__content--comment-parent-write-comment-${IDComment}`).toggle()
    $(document).on("click", ".main__content--comment-parent-write-comment-close", function () {
        var IDCommentClose = $(this).attr('id').slice(14)
        $(`#main__content--comment-parent-write-comment-${IDCommentClose}`).hide()
    })
    $(document).on("click", ".main__content--comment-parent-write-comment-insert", function () {
        const IDCommentParent = $(this).attr('id').slice(15)
        $(`#main__content--comment-parent-write-comment-${IDCommentParent}`).toggle()
        const IDPost = $('.main__content--comment').attr('id').slice(23)
        const Main = $(`#main__content--comment-parent-write-comment-input-${IDCommentParent}`).val()
        $.ajax({
            type: 'POST',
            url: 'watch_insert_comment.php',
            data: { 'IDPost': IDPost, 'IDCommentParent': IDCommentParent, 'Main': Main },
            success: function (data) {
                if (data == "Yes") {
                    window.location.replace(`watch.php?ID=${IDPost}`)
                }
            }
        })
    })
})

$(".main__content--comment-child").hide()
$(document).on("click", ".main__content--comment-child-feedback", function () {
    const IDComment = $(this).attr('id').slice(38)
    $(`#main__content--comment-child-${IDComment}`).toggle()
})


$(".main__content--comment-child-write-comment").hide()
$(document).on("click", ".main__content--comment-child-main-option-feedback", function () {
    var IDComment = $(this).attr('id').slice(50)
    $(`#main__content--comment-child-write-comment-${IDComment}`).toggle()
    var Name = $(`#main__content--comment-child-name-${IDComment}`).html()
    $(`#main__content--comment-child-write-comment-input-${IDComment}`).val(`${Name}: `)
    $(document).on("click", ".main__content--comment-child-write-comment-close", function () {
        var IDCommentClose = $(this).attr('id').slice(14)
        $(`#main__content--comment-child-write-comment-${IDCommentClose}`).hide()
    })
    $(document).on("click", ".main__content--comment-child-write-comment-insert", function () {
        const divParent = $(this).parents().eq(8)
        const IDCommentParent = divParent.attr('id').slice(30)
        const IDCommentChild = $(this).attr('id').slice(17)   
        $(`#main__content--comment-child-write-comment-${IDCommentChild}`).toggle()
        const IDPost = $('.main__content--comment').attr('id').slice(23)
        const Main = $(`#main__content--comment-child-write-comment-input-${IDCommentChild}`).val()
        $.ajax({
            type: 'POST',
            url: 'watch_insert_comment.php',
            data: { 'IDPost': IDPost, 'IDCommentParent': IDCommentParent, 'Main': Main },
            success: function (data) {
                console.log(data)
                if (data == "Yes") {
                    window.location.replace(`watch.php?ID=${IDPost}`)
                }
            }
        })
    })
})
// End insert comment


// Delete comment
$(document).on("click", ".main__content--comment-parent-main-option-delete", function () {
    var IDComment = $(this).attr('id').slice(49)
    var IDPost = $('.main__content--comment').attr('id').slice(23)
    $.ajax({
        type: 'POST',
        url: 'watch_delete_comment.php',
        data: { 'IDComment': IDComment },
        success: function (data) {
            if (data == "Yes") {
                window.location.replace(`watch.php?ID=${IDPost}`)
            }
        }
    })
})

$(document).on("click", ".main__content--comment-child-main-option-delete", function () {
    var IDComment = $(this).attr('id').slice(48)
    var IDPost = $('.main__content--comment').attr('id').slice(23)
    $.ajax({
        type: 'POST',
        url: 'watch_delete_comment.php',
        data: { 'IDComment': IDComment },
        success: function (data) {
            if (data == "Yes") {
                window.location.replace(`watch.php?ID=${IDPost}`)
            }
        }
    })
})
// End delete comment


// Nav to watch
$('.main__nav--post').click(function (e) {
    var ID = $(this).attr('id')

    $.ajax({
        type: 'POST',
        url: 'watch_nav.php',
        data: { 'ID': ID },
        success: function (data) {
            if (data == "Có video") {
                window.location.replace(`watch.php?ID=${ID}`)
            }
        }
    })
})
// End nav to watch

