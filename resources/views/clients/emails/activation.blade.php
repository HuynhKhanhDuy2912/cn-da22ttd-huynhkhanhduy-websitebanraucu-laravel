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
        .email-wrapper {
            width: 100%;
            padding: 40px 0;
            background-color: #f4f4f7;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: #28a745;
            color: #ffffff;
            text-align: center;
            padding: 30px 20px;
        }
        .header img {
            max-width: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .body {
            padding: 30px 40px;
            color: #333333;
        }
        .body h2 {
            font-size: 22px;
            color: #28a745;
        }
        .body p {
            font-size: 16px;
            line-height: 1.6;
            color: #555555;
        }
        .btn {
            display: inline-block;
            background-color: #28a745;
            color: #ffffff !important;
            text-decoration: none;
            font-weight: bold;
            padding: 14px 28px;
            border-radius: 8px;
            margin: 25px 0;
            font-size: 16px;
            transition: 0.2s;
        }
        .btn:hover {
            background-color: #218838;
        }
        .footer {
            background: #f1f1f1;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #777777;
        }
        .footer a {
            color: #28a745;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <!-- Header -->
            <div class="header">
                {{-- <img src="" alt="Logo Website" onerror="this.style.display='none'"> --}}
                <h1>Broccoli Shop</h1>
            </div>

            <!-- Body -->
            <div class="body">
                <h2>Xin chào, {{ $user->name }} 🌿</h2>
                <p>
                    Cảm ơn bạn đã đăng ký tài khoản tại <strong>Broccoli Shop</strong>.<br>
                    Để kích hoạt tài khoản của bạn, vui lòng nhấn vào nút bên dưới:
                </p>

                <p style="text-align:center;">
                    <a href="{{ url('/activate/'.$token) }}" class="btn">Kích hoạt tài khoản</a>
                </p>

                <p>
                    Nếu bạn không yêu cầu đăng ký tài khoản, vui lòng bỏ qua email này.<br>
                    Trân trọng,<br>
                    <strong>Đội ngũ hỗ trợ khách hàng</strong>
                </p>
            </div>

            <!-- Footer -->
            <div class="footer">
                © {{ date('Y') }} Broccoli Shop.
            </div>
        </div>
    </div>
</body>
</html>
