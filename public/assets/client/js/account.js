$(document).ready(function () {
    $("#resetPassword").click(function (event) {
        event.preventDefault();
        let value = $("#value").val();
        let path = $("#path").val();
        $.ajax({
            type: "POST",
            url: path + "/auth/handle_reset_password",
            data: {
                value: value,
            },
            dataType: "json", // Loại dữ liệu mà bạn mong đợi từ máy chủ
            beforeSend: function () {
                // Thêm hiệu ứng loading tại đây (ví dụ: hiển thị một biểu tượng loading)
                $("#bg_loading").show();
            },
            success: function (response) {
                $("#bg_loading").hide();
                if (response.error) {
                    // Hiển thị thông báo lỗi
                    alert(response.error);
                } else if (response.success) {
                    // Hiển thị thông báo thành công
                    alert(response.success);
                    location.href = path + '/auth';
                }
            },
            error: function (xhr, status, error) {
                $("#bg_loading").hide();
                // Xử lý lỗi AJAX (nếu có)
                console.error("Lỗi AJAX: " + status + " - " + error);
            }
        });
    });
    $("#editBtn").click(function (event) {
        event.preventDefault();
        var username = $("#username").val();
        var fullname = $("#fullname").val();
        var sex = $('input[name="sex"]:checked').val();
        var birthday = $("#birthday").val();
        var id = $("#user_id").val();
        var create_at = $("#create_at").val();
        var path = $("#path").val();
        console.log(sex)
        $.ajax({
            type: "POST",
            url: path + "/profile/edit",
            data: {
                username: username,
                fullname: fullname,
                sex: sex,
                id: id,
                birthday: birthday,
                create_at: create_at,
            },
            dataType: "json", // Loại dữ liệu mà bạn mong đợi từ máy chủ
            beforeSend: function () {
                // Thêm hiệu ứng loading tại đây (ví dụ: hiển thị một biểu tượng loading)
                $("#bg_loading").show();
            },
            success: function (response) {
                $("#bg_loading").hide();
                if (response.error) {
                    // Hiển thị thông báo lỗi
                    alert(response.error);
                } else if (response.success) {
                    // Hiển thị thông báo thành công
                    alert(response.success);
                    if (response.location) {
                        window.location.href = "home";
                    }
                } else if (response.log) {
                    // Hiển thị thông báo thành công
                    console.log(response.log);
                }
            },
            error: function (xhr, status, error) {
                $("#bg_loading").hide();
                // Xử lý lỗi AJAX (nếu có)
                console.error("Lỗi AJAX: " + status + " - " + error);
            }
        });
    });
    $("#editAddressBtn").click(function (event) {
        event.preventDefault();
        var address = $("#addressValue").val();
        var phone = $("#phone").val();
        var create_at = $("#create_at").val();
        var path = $("#path").val();
        var id = $("#user_id").val();
        $.ajax({
            type: "POST",
            url: path + "/profile/edit_address",
            data: {
                address: address,
                phone: phone,
                create_at: create_at,
                id: id,
            },
            dataType: "json", // Loại dữ liệu mà bạn mong đợi từ máy chủ
            beforeSend: function () {
                // Thêm hiệu ứng loading tại đây (ví dụ: hiển thị một biểu tượng loading)
                $("#bg_loading").show();
            },
            success: function (response) {
                $("#bg_loading").hide();
                if (response.error) {
                    // Hiển thị thông báo lỗi
                    alert(response.error);
                } else if (response.success) {
                    // Hiển thị thông báo thành công
                    alert(response.success);
                    if (response.location) {
                        window.location.href = "home";
                    }
                } else if (response.log) {
                    // Hiển thị thông báo thành công
                    console.log(response.log);
                }
            },
            error: function (xhr, status, error) {
                $("#bg_loading").hide();
                // Xử lý lỗi AJAX (nếu có)
                console.error("Lỗi AJAX: " + status + " - " + error);
            }
        });
    });
    $("#btnChangePass").click(function (event) {
        event.preventDefault();
        var password = $("#password").val();
        var newPassword = $("#new-password").val();
        var cfPassword = $("#cf-password").val();
        var path = $("#path").val();
        var id = $("#id").val();
        console.log(password, cfPassword, path, id,newPassword);
        $.ajax({
            type: "POST",
            url: path + "/profile/handle_change_password",
            data: {
                password: password,
                newPassword: newPassword,
                cfPassword: cfPassword,
                id: id,
            },
            dataType: "json", // Loại dữ liệu mà bạn mong đợi từ máy chủ
            beforeSend: function () {
                // Thêm hiệu ứng loading tại đây (ví dụ: hiển thị một biểu tượng loading)
                $("#bg_loading").show();
            },
            success: function (response) {
                $("#bg_loading").hide();
                if (response.error) {
                    // Hiển thị thông báo lỗi
                    alert(response.error);
                } else if (response.success) {
                    // Hiển thị thông báo thành công
                    alert(response.success);
                    window.location.href = path + "/quan-ly-tai-khoan";

                } else if (response.log) {
                    // Hiển thị thông báo thành công
                    console.log(response.log);
                }
            },
            error: function (xhr, status, error) {
                $("#bg_loading").hide();
                // Xử lý lỗi AJAX (nếu có)
                console.error("Lỗi AJAX: " + status + " - " + error);
            }
        });
    });
});
