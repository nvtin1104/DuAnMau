$(document).ready(function () {
    // Sử dụng jQuery để bắt sự kiện click cho các nút có class là 'updateCart'
    $('.updateCart').click(function (event) {
        event.preventDefault();
        let dataPath = $(this).data('path');
        let id = $(this).data('id');
        let product_id = $(this).data('product_id');

        let parentTd = $(this).closest('td');
        let quantityInput = parentTd.find('input[type=number]');
        let quantityValue = quantityInput.val();
        $.ajax({
            url: dataPath + '/cart/handleUpdateCart', // Replace with the actual endpoint URL
            type: 'POST', // or 'GET' depending on your server-side implementation
            data: {
                id: id,
                quantity: quantityValue,
                product_id: product_id,
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
                    // if (response.location) {
                    //     window.location.href = "<? echo _WEB_ROOT ?>/home";
                    // }
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

    // Attach a click event handler to all buttons with the class 'addToCart'
    $('.removeCart').click(function (event) {
        // Prevent the default behavior of the button
        event.preventDefault();

        // Get the data-id attribute value for the clicked button
        let dataId = $(this).data('id');
        let dataPath = $(this).data('path');
        // Perform your AJAX request with the specific dataId
        $.ajax({
            url: dataPath + '/cart/handleRemoveCart', // Replace with the actual endpoint URL
            type: 'POST', // or 'GET' depending on your server-side implementation
            data: {
                id: dataId,
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
                    // if (response.location) {
                    //     window.location.href = "<? echo _WEB_ROOT ?>/home";
                    // }
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
    $('.removeWishlist').click(function (event) {
        // Prevent the default behavior of the button
        event.preventDefault();

        // Get the data-id attribute value for the clicked button
        let dataId = $(this).data('id');
        let dataPath = $(this).data('path');
        // Perform your AJAX request with the specific dataId
        $.ajax({
            url: dataPath + '/cart/handleRemoveWishlist', // Replace with the actual endpoint URL
            type: 'POST', // or 'GET' depending on your server-side implementation
            data: {
                id: dataId,
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
                    // if (response.location) {
                    //     window.location.href = "<? echo _WEB_ROOT ?>/home";
                    // }
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
    $('.addToCart').click(function (event) {
        // Prevent the default behavior of the button
        event.preventDefault();

        // Get the data-id attribute value for the clicked button
        let dataId = $(this).data('id');
        let dataPath = $(this).data('path');
        // Perform your AJAX request with the specific dataId
        $.ajax({
            url: dataPath + '/cart/handleAddToCart', // Replace with the actual endpoint URL
            type: 'POST', // or 'GET' depending on your server-side implementation
            data: {
                product_id: dataId,
                quantity: 1
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
                    // if (response.location) {
                    //     window.location.href = "<? echo _WEB_ROOT ?>/home";
                    // }
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
    $('.addToWishlist').click(function (event) {
        // Prevent the default behavior of the button
        event.preventDefault();

        // Get the data-id attribute value for the clicked button
        let dataId = $(this).data('id');
        let dataPath = $(this).data('path');

        // Perform your AJAX request with the specific dataId
        $.ajax({
            url: dataPath + '/cart/handleAddToWishlist', // Replace with the actual endpoint URL
            type: 'POST', // or 'GET' depending on your server-side implementation
            data: {
                product_id: dataId,
                quantity: 1
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
                    // if (response.location) {
                    //     window.location.href = "<? echo _WEB_ROOT ?>/home";
                    // }
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
    $("#cancelOrder").click(function (event) {
        event.preventDefault();
        let order_id = $("#order_id").val();
        let reason = $("#reason").val();
        let agent = $("#agent").val();
        let path = $("#path").val();
        $.ajax({
            type: "POST",
            url: path + "/cart/handleCancelOrder",
            data: {
                order_id: order_id,
                reason: reason,
                agent: agent
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
                    location.href = path + "/quan-ly-tai-khoan";
                    // Hiển thị thông báo thành công
                    alert(response.success);
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
