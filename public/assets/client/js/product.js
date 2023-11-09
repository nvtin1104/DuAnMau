$(document).ready(function () {
    // Attach a click event handler to all buttons with the class 'addToCart'
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
    $("#addToCart").click(function (event) {
        event.preventDefault();
        let product_id = $("#product_id").val();
        let quantity = $("#quantity").val();
        let path = $("#path").val();
        console.log(product_id, quantity, path);
        $.ajax({
            type: "POST",
            url: path + "/cart/handleAddToCart",
            data: {
                product_id: product_id,
                quantity: quantity,
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
});