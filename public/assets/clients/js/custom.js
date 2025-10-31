$(document).ready(function(){
    /********************************
            PAGE LOGIN, REGISTER
    ********************************/

    //Validate register form
    $('#register-form').submit(function(e){
        let name = $('input[name="name"]').val();
        let email = $('input[name="email"]').val();
        let password = $('input[name="password"]').val();
        let confirmPassword = $('input[name="confirmpassword"]').val();
        let checkbox1 = $('input[name="checkbox1"]').is(':checked');
        let checkbox2 = $('input[name="checkbox2"]').is(':checked');
        
        let errorMessage = "";

        if(name.length < 3)
        {
            errorMessage += "Họ và tên phải có ít nhất 3 ký tự. <br>";
        }

        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailRegex.test(email))
        {
            errorMessage += "Email không hợp lệ. <br>";
        }

        if(password.length < 6)
        {
            errorMessage += "Mật khẩu phải có ít nhất 6 ký tự. <br>";
        }

        if(password != confirmPassword)
        {
            errorMessage += "Mật khẩu nhập lại khớp. <br>";
        }

        if(!checkbox1 || !checkbox2)
        {
            errorMessage += "Bạn phải đồng ý với các điều khoản trước khi tạo tài khoản. <br>";
        }

        if(errorMessage != "")
        {
            toastr.error(errorMessage,"Lỗi");
            e.preventDefault();
        }
    });


    //Validate login form
     $('#login-form').submit(function(e){
        toastr.clear();
        let email = $('input[name="email"]').val();
        let password = $('input[name="password"]').val();
        
        let errorMessage = "";

        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailRegex.test(email))
        {
            errorMessage += "Email không hợp lệ. <br>";
        }

        if(password.length < 6)
        {
            errorMessage += "Mật khẩu phải có ít nhất 6 ký tự. <br>";
        }

        if(errorMessage != "")
        {
            toastr.error(errorMessage,"Lỗi");
            e.preventDefault();
        }
    });

    
    //Validate reset password form
     $('#reset-password-form').submit(function(e){
        toastr.clear();
        let email = $('input[name="email"]').val();
        let password = $('input[name="password"]').val();
        let confirmPassword = $('input[name="password_confirmation"]').val();
        
        let errorMessage = "";

        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailRegex.test(email))
        {
            errorMessage += "Email không hợp lệ. <br>";
        }

        if(password.length < 6)
        {
            errorMessage += "Mật khẩu phải có ít nhất 6 ký tự. <br>";
        }

        if(password != confirmPassword)
        {
            errorMessage += "Mật khẩu nhập lại khớp. <br>";
        }

        if(errorMessage != "")
        {
            toastr.error(errorMessage,"Lỗi");
            e.preventDefault();
        }
    });


    /********************************
            PAGE ACCOUNT
    ********************************/

    //When clicking on the image => open input file
    $('.profile-pic').click(function(){
        $("#avatar").click();
    });

    //When selecting a image => display preview image
    $("#avatar").change(function(){
        let input = this;
        if(input.files && input.files[0]){
            let reader = new FileReader();
            reader.onload = function(e){
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    });

    $('#update-account').on("submit", function(e){
        e.preventDefault();

        let formData =  new FormData(this);
        let urlUpdate = $(this).attr('action');


        $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $.ajax({
            url: urlUpdate,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $(".btn-wrapper button").text('Đang cập nhật...').attr("disabled",true)
            },
            success: function(response){
                if(response.success){
                    toastr.success(response.message);

                    //Update new image
                    if(response.avatar){
                        $('#preview-image').attr('src', response.avatar);
                    }
                }
                else{
                    toastr.error(response.message);
                }
                
            },
            error: function(xhr){
                let errors = xhr.responseJSON.errors;
                $.each(errors,function(key,value){
                    toastr.error(value[0]);
                })
            },
            complete: function(){
                $(".btn-wrapper button").text('Cập nhật').attr("disabled",false)
            },
        })
    });
});