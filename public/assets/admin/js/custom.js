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
                    status == "banned" ? button.text("Đã chặn") : button.text("Đã xóa");
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
});
