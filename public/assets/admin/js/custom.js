$(document).ready(function () {
    /********************************
            MANAGEMENT USERS
    ********************************/

    // Upgrade user to staff
    $(document).on("click", ".upgradeStaff", function () {
        let button = $(this);
        let userId = button.data("userid");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/admin/user/upgrade",
            type: "POST",
            data: {
                user_id: userId,
            },
            success: function (response) {
                if (response.status) {
                    toastr.success(response.message);
                    button
                        .closest(".profile_view")
                        .find(".brief i")
                        .text("STAFF");
                    button
                        .closest(".profile_view")
                        .find(".changeStatus")
                        .hide();
                    button
                        .closest(".profile_view")
                        .find(".upgradeStaff")
                        .hide();
                } else {
                    toastr.error(response.error);
                }
            },
            error: function () {
                alert("Đã xảy ra lỗi khi thay đổi trạng thái!");
            },
        });
    });

    // Change user status (ban or delete)
    $(document).on("click", ".changeStatus", function () {
        let button = $(this);
        let userId = button.data("userid");
        let status = button.data("status"); // New status to set

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: "/admin/user/updateStatus",
            type: "POST",
            data: {
                user_id: userId,
                status: status,
            },
            success: function (response) {
                if (response.status) {
                    toastr.success(response.message);
                    status == "banned"
                        ? button.text("Đã chặn")
                        : button.text("Đã xóa");
                    button.addClass("disabled").prop("disabled", true);
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                } else {
                    toastr.error(response.error);
                }
            },
            error: function () {
                alert("Đã xảy ra lỗi khi thay đổi trạng thái!");
            },
        });
    });

    $(".btn-reset").on("click", function () {
        let form = $(this).closest("form");
        form.trigger("reset");
        form.find('input[type="file"]').val("");
        form.find("#image-preview").html("").attr("src", "");
        form.find("#image-preview-container").html("");
    });

    /********************************
          MANAGEMENT CATEGORIES
    ********************************/

    // Preview category image before upload - Add Category
    $("#category-image").on("change", function () {
        let file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $("#image-preview").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
        } else {
            $("#image-preview").attr("src", "");
        }
    });

    // Preview category image before upload - Edit Category
    $(".category-image").change(function () {
        let file = this.files[0];
        let categoryId = $(this).data("id");

        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $("#image-preview-" + categoryId).attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
        } else {
            $("#image-preview-" + categoryId).attr("src", "");
        }
    });

    // Update category
    $(document).on("click", ".btn-update-submit-category", function (e) {
        e.preventDefault();
        let button = $(this);
        let categoryId = button.data("id");
        let form = button.closest(".modal").find("form");
        let formData = new FormData(form[0]);
        formData.append("category_id", categoryId);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/admin/categories/update/",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                button.prop("disabled", true).text("Đang cập nhật...");
            },
            success: function (response) {
                if (response.status) {
                    toastr.success(response.message);
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                } else {
                    toastr.error(response.error);
                }
            },
            error: function () {
                button.prop("disabled", false).text("Cập nhật");
                toastr.error(response.message);
            },
        });
    });

    // Delete category
    $(".btn-delete-category").on("click", function (e) {
        e.preventDefault();
        let button = $(this);
        let categoryId = button.data("id");
        let row = button.closest("tr");

        if (confirm("Bạn có chắc chắn muốn xóa danh mục này không?")) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                url: "/admin/categories/delete/",
                type: "POST",
                data: {
                    category_id: categoryId,
                },
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.message);
                        row.fadeOut(300, function () {
                            $(this).remove();
                        });
                    } else {
                        toastr.error(response.error);
                    }
                },
                error: function () {
                    alert("Đã xảy ra lỗi khi xóa danh mục!");
                },
            });
        }
    });

    /********************************
          MANAGEMENT PRODUCTS
    ********************************/

    // Preview product image before upload - Add Product
    $("#product-images").on("change", function (e) {
        let files = e.target.files;
        console.log(files);
        let previewContainer = $("#image-preview-container");
        previewContainer.empty(); // Clear previous previews

        if (files) {
            Array.from(files).forEach((file) => {
                let reader = new FileReader();
                reader.onload = function (e) {
                    let img = $("<img>")
                        .attr("src", e.target.result)
                        .addClass("image-preview");
                    img.css({
                        "max-width": "160px",
                        "max-height": "160px",
                        margin: "10px",
                        border: "1px solid #000",
                        padding: "3px",
                    });
                    previewContainer.append(img);
                };
                reader.readAsDataURL(file);
            });
        } else {
            previewContainer.html("");
        }
    });

    // Preview product image before upload - Edit Product
    $(".product-images").on("change", function (e) {
        let files = e.target.files;
        let productId = $(this).data("id");
        let previewContainer = $("#image-preview-container-" + productId);
        previewContainer.empty(); // Clear previous previews
        if (files.length > 0) {
            for (let i = 0; i < files.length; i++) {
                let file = files[i];
                let reader = new FileReader();
                reader.onload = function (e) {
                    let img = $("<img>")
                        .attr("src", e.target.result)
                        .addClass("image-preview");
                    img.css({
                        "max-width": "80px",
                        "max-height": "80px",
                    });
                    previewContainer.append(img);
                };
                reader.readAsDataURL(file);
            }
        } else {
            previewContainer.html("");
        }
    });

    // Update product
    $(document).on("click", ".btn-update-submit-product", function (e) {
        e.preventDefault();
        let button = $(this);
        let productId = button.data("id");
        let form = button.closest(".modal").find("form");
        let formData = new FormData(form[0]);
        formData.append("product_id", productId);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: "/admin/product/update/",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                button.prop("disabled", true).text("Đang cập nhật...");
            },
            success: function (response) {
                if (response.status) {
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                } else {
                    toastr.error(response.error);
                }
            },
            error: function () {
                button.prop("disabled", false).text("Cập nhật");
                toastr.error(response.message);
            },
        });
    });

    // Delete product
    $(document).on("click", ".btn-delete-product", function (e) {
        e.preventDefault();
        let button = $(this);
        let productId = button.data("id");
        let row = button.closest("tr");

        if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                url: "/admin/product/delete/",
                type: "POST",
                data: {
                    product_id: productId,
                },
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.message);
                        row.fadeOut(300, function () {
                            $(this).remove();
                        });
                    } else {
                        toastr.error(response.error);
                    }
                },
                error: function () {
                    alert("Đã xảy ra lỗi khi xóa sản phẩm!");
                },
            });
        }
    });

    /********************************
          MANAGEMENT ORDERS
    ********************************/

    // Confirm order
    $(document).on("click", ".confirm-order", function (e) {
        e.preventDefault();
        let button = $(this);
        let orderId = button.data("id");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/admin/order/confirm/",
            type: "POST",
            data: {
                id: orderId,
            },
            success: function (response) {
                if (response.status) {
                    toastr.success(response.message);
                    button
                        .closest("tr")
                        .find(".order-status")
                        .html(
                            '<span class="custom-badge badge badge-primary">Đang giao hàng</span>'
                        );
                    button.hide();
                } else {
                    toastr.error(response.error);
                }
            },
            error: function () {
                alert("Đã xảy ra lỗi khi xác nhận đơn hàng!");
            },
        });
    });

    // Send mail to customer
    $(document).on("click", ".send-invoice-mail", function (e) {
        e.preventDefault();
        let button = $(this);
        let orderId = button.data("id");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "send-invoice",
            type: "POST",
            data: {
                id: orderId,
            },
            success: function (response) {
                if (response.status) {
                    toastr.success(response.message);
                    button.remove();
                } else {
                    toastr.error(response.error);
                }
            },
            error: function () {
                alert("Đã xảy ra lỗi khi gửi hóa đơn cho khách hàng!");
            },
        });
    });

    //Cancel order
    $(document).on("click", ".cancel-order", function (e) {
        e.preventDefault();
        let button = $(this);
        let orderId = button.data("id");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "cancel-order",
            type: "POST",
            data: {
                id: orderId,
            },
            success: function (response) {
                if (response.status) {
                    toastr.success(response.message);
                    button
                        .closest("tr")
                        .find(".order-status")
                        .html(
                            '<div class="text-center bg-red" style="font-size: 16px; padding: 5px;"> Đơn hàng đã hủy</div>'
                        );
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                } else {
                    toastr.error(response.error);
                }
            },
            error: function () {
                alert("Đã xảy ra lỗi khi hủy đơn hàng!");
            },
        });
    });

    /********************************
          MANAGEMENT CONTACT
    ********************************/

    // Add ckeditor
    if ($("#editor-contact").length) {
        CKEDITOR.replace("editor-contact");
    }

    // Show message when click item in mail list
    $(document).on("click", ".contact-item", function (e) {
        // Get contact data from clicked item
        let contactName = $(this).data("name");
        let contactEmail = $(this).data("email");
        let contactMessage = $(this).data("message");
        let contactId = $(this).data("id");
        let isReplied = $(this).data("is_replied");

        $(".mail_view .inbox-body .sender-info strong").text(contactName);
        $(".mail_view .inbox-body .sender-info span").text(
            "(" + contactEmail + ")"
        );
        $(".mail_view .inbox-body .view-mail p").text(contactMessage);

        $(".mail_view").show();

        if (isReplied != 0) {
            $("#compose").hide();
            $("#reply-status").text("Đã phản hồi").css("color", "#c6c6c6");
        } else {
            // Add attribute data-email to button reply
            $(".send-reply-contact").attr("data-email", contactEmail);
            $(".send-reply-contact").attr("data-id", contactId);

            $("#reply-status").text("");
            $("#compose").show();
        }
    });

    // Send reply contact
    $(document).on("click", ".send-reply-contact", function (e) {
        e.preventDefault();
        let button = $(this);
        let email = button.data("email");
        let contactId = button.data("id");
        let message = CKEDITOR.instances["editor-contact"].getData();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/admin/contact/reply",
            type: "POST",
            data: {
                email: email,
                message: message,
                contact_id: contactId,
            },
            success: function (response) {
                if (response.status) {
                    toastr.success(response.message);
                    $(".mail_view").hide();
                    $("#compose").hide();
                    CKEDITOR.instances["editor-contact"].setData("");
                    $("#editor-contact").empty();
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                } else {
                    toastr.error(response.error);
                }
            },
            error: function () {
                alert("Đã xảy ra lỗi khi gửi thư phản hồi cho khách hàng!");
            },
        });
    });

    // Show form change password admin
    $(".form-change-pass").on("click", function (e) {
        e.preventDefault();
        $("#change-password").toggle();
        if ($("#change-password").is(":visible")) {
            $(this).text("Đóng");
        } else {
            $(this).text("Đổi mật khẩu");
        }
    });

    /********************************
          MANAGEMENT INFO
    ********************************/

    $(".update-avatar").on("click", function (e) {
        e.preventDefault();
        $("#avatar").trigger("click");
    });

    // Preview avatar
    $("#avatar").change(function () {
        let file = this.files[0];

        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $("#avatar-preview").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);

            let formData = new FormData();

            formData.append("type", "avatar");
            formData.append("avatar", file);
            updateProfile(formData);
        } else {
            $("#avatar-preview").attr("src", "");
        }
    });

    // Update info in database
    $("#update-profile").submit(function (e) {
        let valid = true;
        let name = $("#name").val().trim();
        let phone = $("#phone").val().trim();
        let address = $("#address").val().trim();
        e.preventDefault();

        if (name.length < 3) {
            toastr.error("Họ và tên phải có ít nhất 3 ký tự.");
            valid = false;
        }
        let phoneRegex = /^0\d{9}$/;
        if (!phoneRegex.test(phone)) {
            toastr.error(
                "Số điện thoại không hợp lệ. Số điện thoại bắt đầu từ 0 và phải đủ 10 số."
            );
            valid = false;
        }
        if (address === "") {
            toastr.error("Đị chỉ không được để trống.");
            valid = false;
        }
        if (valid) {
            let formData = new FormData();

            formData.append("type", "profile");
            formData.append("name", name);
            formData.append("phone", phone);
            formData.append("address", address);

            updateProfile(formData);
        }
    });

    $("#change-password").submit(function (e) {
        let valid = true;
        let current_password = $("#current_password").val().trim();
        let new_password = $("#new_password").val().trim();
        let confirm_password = $("#confirm_password").val().trim();
        e.preventDefault();

        if (current_password.length === "") {
            toastr.error("Bạn cần phải nhập mật khẩu hiện tại!");
            valid = false;
        }
        if (new_password.length < 6) {
            toastr.error("Mật khẩu mới phải có ít nhất 6 ký tự!");
            valid = false;
        }
        if (confirm_password !== new_password) {
            toastr.error("Mật khẩu xác nhận không khớp!");
            valid = false;
        }
        if (valid) {
            let formData = new FormData();

            formData.append("type", "password");
            formData.append("current_password", current_password);
            formData.append("new_password", new_password);
            formData.append("confirm_password", confirm_password);

            updateProfile(formData);
        }
    });

    function updateProfile(formData) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/admin/profile/update/",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    toastr.success(response.message);
                    if(formData.get("type") === "profile")
                    {
                        $("#user-name").text(formData.get("name"));
                        $("#user-address").text(formData.get("address"));
                        $("#user-phone").text(formData.get("phone"));
                        $("#user-name").text(formData.get("name"));
                    }

                    if(formData.get("type") === "password")
                    {
                        $("#change-password")[0].reset();
                    }
                    
                    if(formData.get("type") === "avatar")
                    {
                        $("#avatar-preview").attr("src", response.avatar_url);
                    }
                } else {
                    toastr.error(response.message);
                }
            },
            error: function () {
                alert("Đã xảy ra lỗi cập nhật tài khoản!");
            },
        });
    }
});
