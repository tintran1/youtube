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

$(".header__user-icon").click(function () {
    var ID = $(this).attr('id').slice(14)
    hideClass(ID)
})
// End hide show option user in header


// Sign out
$('#sign-out').click(function (e) {
    localStorage.clear();
})
// End sign out


// Show modal insert post
$('#button-modal-insert').click()
// End show modal insert post


// Preview video
$('.button-close').click(function () {
    $('.main__form--input').val('')
    $('.main__form--gallery-video-insert').html('')
    $('.main__form--gallery-video-edit').html('')
})

$('#main__form--video-insert').click(function () {
    $('.main__form--gallery-video-insert').html('')
})

$('#main__form--video-edit').click(function () {
    $('.main__form--gallery-video-edit').html('')
})

$(function () {
    var videosPreview = function (input, placeToInsertvideoPreview) {
        if (input.files) {
            var filesAmount = input.files.length
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    $($.parseHTML('<video></video>')).attr('src', event.target.result).attr('class', 'w-50 my-3').attr('controls', '').appendTo(placeToInsertvideoPreview);
                }
                reader.readAsDataURL(input.files[i])
            }
        }
    }

    $('#main__form--video-insert').on('change', function () {
        videosPreview(this, '.main__form--gallery-video-insert')
    })

    $('#main__form--video-edit').on('change', function () {
        videosPreview(this, '.main__form--gallery-video-edit')
    })
})
// End preview video


// Insert post
$('#main__form--insert').click(function (e) {
    $(".main__content--post").html("")
    var Form = new FormData()
    var Title = $("#main__form--title-insert").val()
    Form.append("Title", Title)
    var Describe = $("#main__form--describe-insert").val()
    Form.append("Describe", Describe)
    var IDCategory = $("#main__form--ID-category-insert").val()
    Form.append("IDCategory", IDCategory)
    var Video = $("#main__form--video-insert").get(0).files
    for (var i = 0; i < Video.length; i++) {
        Form.append("files[]", Video[i]);
    }

    if (Title !== "" && Describe !== "") {
        $.ajax({
            type: 'POST',
            url: 'studio_insert.php',
            dataType: "json",
            async: false,
            data: Form,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".main__form--input").val("")
                $(".main__form--gallery-video-insert").html("")
                $(".main__content--post").append(
                    `<div class="main__content--post-infor d-flex border-top border-bottom">
                        <h6 class="main__content--post-infor-video m-0 p-3 text-center border-right">
                            Video của bạn
                        </h6>
                        <h6 class="main__content--post-infor-title m-0 p-3 text-center border-right">
                            Tiêu đề video
                        </h6>
                        <h6 class="main__content--post-infor-describe m-0 p-3 text-center border-right">
                            Mô tả video
                        </h6>
                        <h6 class="main__content--post-infor-edit m-0 p-3 text-center border-right">
                            Chỉnh sửa video
                        </h6>
                        <h6 class="main__content--post-infor-delete m-0 p-3 text-center border-right">
                            Xóa video
                        </h6>
                    </div>`
                )
                $.each(data, function (k) {
                    $(".main__content--post").append(
                        $(
                            `<div class="main__content--post-post d-flex border-bottom">
                                <div class="main__content--post-post-video m-0 p-3 border-right">
                                    <video src="${data[k].Video}" controls></video>
                                </div>
                                <div class="main__content--post-post-title m-0 p-3 border-right">
                                    <p class="text-dark">${data[k].Title}</p>
                                </div>
                                <div class="main__content--post-post-describe m-0 p-3 border-right">
                                    <p class="text-muted">${data[k].Describe}</p>
                                </div>
                                <div class="main__content--post-post-edit m-0 p-3 d-flex justify-content-center align-items-center border-right">
                                    <button id="main__content--post-edit-${data[k].ID}" data-toggle="modal" data-target="#modal-edit" class="main__content--post-edit btn btn-success">Chỉnh sửa video</button>
                                </div>
                                <div class="main__content--post-post-delete m-0 p-3 d-flex justify-content-center align-items-center border-right">
                                    <button id="main__content--post-delete-${data[k].ID}" class="main__content--post-delete btn btn-danger">Xóa video</button>
                                </div>
                            </div>`
                        )
                    )
                })
            }
        })
    }
})
// End insert post


// Edit post
// Get data form edit
$(document).on("click", ".main__content--post-edit", function () {
    var IDPost = $(this).attr('id').slice(25)
    $.ajax({
        type: 'POST',
        url: 'studio_edit_data.php',
        data: { 'IDPost': IDPost },
        dataType: "json",
        success: function (data) {
            $.each(data, function (k) {
                $("#main__form--ID-edit").val(data[k].ID)
                $("#main__form--title-edit").val(data[k].Title)
                $("#main__form--describe-edit").val(data[k].Describe)
                $("#main__form--ID-category-edit").val(data[k].ID_category)
                console.log($("#main__form--ID-category-edit"))
            })
        }
    })
})
// End get data form edit

// Update post
$('#main__form--edit').click(function () {
    $(".main__content--post").html("")
    var Form = new FormData()
    var ID = $("#main__form--ID-edit").val()
    Form.append("ID", ID)
    var Title = $("#main__form--title-edit").val()
    Form.append("Title", Title)
    var Describe = $("#main__form--describe-edit").val()
    Form.append("Describe", Describe)
    var IDCategory = $("#main__form--ID-category-edit").val()
    Form.append("IDCategory", IDCategory)
    var Video = $("#main__form--video-edit").get(0).files
    for (var i = 0; i < Video.length; i++) {
        Form.append("files[]", Video[i]);
    }

    if (Title !== "" && Describe !== "") {
        $.ajax({
            type: 'POST',
            url: 'studio_edit.php',
            dataType: "json",
            async: false,
            data: Form,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".main__form--input").val("")
                $(".main__form--gallery-video-edit").html("")
                $(".main__content--post").append(
                    `<div class="main__content--post-infor d-flex border-top border-bottom">
                        <h6 class="main__content--post-infor-video m-0 p-3 text-center border-right">
                            Video của bạn
                        </h6>
                        <h6 class="main__content--post-infor-title m-0 p-3 text-center border-right">
                            Tiêu đề video
                        </h6>
                        <h6 class="main__content--post-infor-describe m-0 p-3 text-center border-right">
                            Mô tả video
                        </h6>
                        <h6 class="main__content--post-infor-edit m-0 p-3 text-center border-right">
                            Chỉnh sửa video
                        </h6>
                        <h6 class="main__content--post-infor-delete m-0 p-3 text-center border-right">
                            Xóa video
                        </h6>
                    </div>`
                )
                $.each(data, function (k) {
                    $(".main__content--post").append(
                        $(
                            `<div class="main__content--post-post d-flex border-bottom">
                                <div class="main__content--post-post-video m-0 p-3 border-right">
                                    <video src="${data[k].Video}" controls></video>
                                </div>
                                <div class="main__content--post-post-title m-0 p-3 border-right">
                                    <p class="text-dark">${data[k].Title}</p>
                                </div>
                                <div class="main__content--post-post-describe m-0 p-3 border-right">
                                    <p class="text-muted">${data[k].Describe}</p>
                                </div>
                                <div class="main__content--post-post-edit m-0 p-3 d-flex justify-content-center align-items-center border-right">
                                    <button id="main__content--post-edit-${data[k].ID}" data-toggle="modal" data-target="#modal-edit" class="main__content--post-edit btn btn-success">Chỉnh sửa video</button>
                                </div>
                                <div class="main__content--post-post-delete m-0 p-3 d-flex justify-content-center align-items-center border-right">
                                    <button id="main__content--post-delete-${data[k].ID}" class="main__content--post-delete btn btn-danger">Xóa video</button>
                                </div>
                            </div>`
                        )
                    )
                })
            }
        })
    }
})
// End update post
// End edit post


// Delete post
$(document).on("click", ".main__content--post-delete", function () {
    $(".main__content--post").html("")
    var IDPost = $(this).attr('id').slice(27)
    console.log(IDPost)
    $.ajax({
        type: 'POST',
        url: 'studio_delete.php',
        dataType: "json",
        async: false,
        data: { 'IDPost': IDPost },
        success: function (data) {
            $(".main__content--post").append(
                `<div class="main__content--post-infor d-flex border-top border-bottom">
                    <h6 class="main__content--post-infor-video m-0 p-3 text-center border-right">
                        Video của bạn
                    </h6>
                    <h6 class="main__content--post-infor-title m-0 p-3 text-center border-right">
                        Tiêu đề video
                    </h6>
                    <h6 class="main__content--post-infor-describe m-0 p-3 text-center border-right">
                        Mô tả video
                    </h6>
                    <h6 class="main__content--post-infor-edit m-0 p-3 text-center border-right">
                        Chỉnh sửa video
                    </h6>
                    <h6 class="main__content--post-infor-delete m-0 p-3 text-center border-right">
                        Xóa video
                    </h6>
                </div>`
            )
            $.each(data, function (k) {
                $(".main__content--post").append(
                    $(
                        `<div class="main__content--post-post d-flex border-bottom">
                            <div class="main__content--post-post-video m-0 p-3 border-right">
                                <video src="${data[k].Video}" controls></video>
                            </div>
                            <div class="main__content--post-post-title m-0 p-3 border-right">
                                <p class="text-dark">${data[k].Title}</p>
                            </div>
                            <div class="main__content--post-post-describe m-0 p-3 border-right">
                                <p class="text-muted">${data[k].Describe}</p>
                            </div>
                            <div class="main__content--post-post-edit m-0 p-3 d-flex justify-content-center align-items-center border-right">
                                <button id="main__content--post-edit-${data[k].ID}" data-toggle="modal" data-target="#modal-edit" class="main__content--post-edit btn btn-success">Chỉnh sửa video</button>
                            </div>
                            <div class="main__content--post-post-delete m-0 p-3 d-flex justify-content-center align-items-center border-right">
                                <button id="main__content--post-delete-${data[k].ID}" class="main__content--post-delete btn btn-danger">Xóa video</button>
                            </div>
                        </div>`
                    )
                )
            })
        }
    })
})
// End delete post