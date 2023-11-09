$(document).ready(function () {
    // Attach a click event handler to all buttons with the class 'addToCart'
    $("#goCheckout").click(function (event) {
        event.preventDefault();
        let user_id = $("#user_id").val();
        let phone = $("#phone").val();
        let path = $("#path").val();
        let fullname = $("#fullname").val();
        let country = $("#country").val();
        let email = $("#email").val();
        let address = $("#address").val();
        let note = $("#order_note").val();
        let total_price = $("#total_price").val();
        let payment = $("#payment").val();
        let cartIds = []; // Initialize an array to store the values

        $(".cart_id").each(function () {
            cartIds.push($(this).val());
        });
        // console.log(fullname, payment, cartIds, country, total_price, note, email, address);
        $.ajax({
            type: "POST",
            url: path + "/cart/handleCheckout",
            data: {

                user_id: user_id,
                phone: phone,
                fullname: fullname,
                country: country,
                address: address,
                email: email,
                note: note,
                total_price: total_price,
                payment: payment,
                cart_id: cartIds
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
                    window.location.href = path;

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