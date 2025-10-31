<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kích hoạt tài khoản</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo img {
            max-width: 150px;
        }
        h1 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            color: #555555;
            font-size: 16px;
            line-height: 1.5;
        }
        .btn-activate {
            display: inline-block;
            margin: 20px 0;
            padding: 12px 25px;
            background-color: #28a745;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('assets/clients/img/logo.png')}}" alt="Logo Website">
        </div>

        <h1>Xin chào, {{$user->name}} </h1>
        <p>Cảm ơn bạn đã đăng ký tài khoản tại website của chúng tôi. Để kích hoạt tài khoản, vui lòng nhấn vào nút bên dưới:</p>
        <a href="{{url('/activate/'.$token)}}" class="btn-activate">Kích hoạt tài khoản</a>
        <p>Trân trọng,</p>
        <p>Đội ngũ hỗ trợ khách hàng</p>

        <div class="footer">
            Nếu bạn không yêu cầu kích hoạt tài khoản, vui lòng bỏ qua email này.
        </div>
    </div>
</body>
</html>
