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
    $('.btn-delete-category').on('click', function(e) {
        e.preventDefault();
        let button = $(this);
        let categoryId = button.data('id'); 
        let row = button.closest('tr');

        if (confirm('Bạn có chắc chắn muốn xóa danh mục này không?')) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/categories/delete/',
                type: 'POST',
                data: { 
                    category_id : categoryId 
                },
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                        row.fadeOut(300, function() {
                            $(this).remove();
                        });
                    } else {
                        toastr.error(response.error);
                    }
                },
                error: function() {
                    alert('Đã xảy ra lỗi khi xóa danh mục!');
                }
            });
        }
    });

    /********************************
          MANAGEMENT PRODUCTS
    ********************************/

    // Preview product image before upload - Add Product
   $('#product-images').on('change', function(e) {
        let files = e.target.files;
        console.log(files); 
        let previewContainer = $('#image-preview-container');
        previewContainer.empty(); // Clear previous previews
        
        if (files) {
            Array.from(files).forEach(file => {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = $('<img>').attr('src', e.target.result).addClass('image-preview');
                    img.css({
                        'max-width': '160px',
                        'max-height': '160px',
                        'margin': '10px',
                        'border': '1px solid #000',
                        'padding': '3px'
                    });
                    previewContainer.append(img);
                }
                reader.readAsDataURL(file);
            });
        } else {
            previewContainer.html('');
        }
    });

    // Preview product image before upload - Edit Product
    $('.product-images').on('change', function(e) {
        let files = e.target.files;
        let productId = $(this).data('id');
        let previewContainer = $('#image-preview-container-' + productId);
        previewContainer.empty(); // Clear previous previews
        if (files.length > 0) {
            for (let i = 0; i < files.length; i++) {
                let file = files[i];
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = $('<img>').attr('src', e.target.result).addClass('image-preview');
                    img.css({
                        'max-width': '80px',
                        'max-height': '80px'
                    });
                    previewContainer.append(img);
                };
                reader.readAsDataURL(file);
            }            
        } else {
            previewContainer.html('');
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
        let productId = button.data('id'); 
        let row = button.closest('tr');

        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                url: '/admin/product/delete/',
                type: 'POST',   
                data: { 
                    product_id : productId 
                },
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                        row.fadeOut(300, function() {
                            $(this).remove();
                        });
                    } else {
                        toastr.error(response.error);
                    }
                },
                error: function() {
                    alert('Đã xảy ra lỗi khi xóa sản phẩm!');
                }
            });
        }
    });
});
