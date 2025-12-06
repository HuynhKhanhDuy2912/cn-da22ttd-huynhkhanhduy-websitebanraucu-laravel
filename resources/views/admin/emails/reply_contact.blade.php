<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Phản hồi liên hệ</title>
</head>

<body style="font-family: Arial, sans-serif; background: #f5f6f8; padding: 20px;">

    <div
        style="max-width: 650px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">

        <!-- Header -->
        <div style="background: #28a745; padding: 18px 25px; color: #fff; font-size: 20px; font-weight: bold; text-align: center;">
            Phản hồi từ quản trị viên Veggie Shop
        </div>

        <!-- Body -->
        <div style="padding: 25px; color: #333; font-size: 15px; line-height: 1.6;">

            <p>Xin chào quý khách,</p>

            <p>Cảm ơn quý khách đã liên hệ với chúng tôi. Dưới đây là phản hồi từ bộ phận hỗ trợ:</p>

            <div
                style="background: #f1f3f5; border-left: 4px solid #28a745; padding: 15px; margin: 20px 0; font-style: italic;">
                {!! $content !!}
            </div>

            <p>Nếu quý khách cần thêm hỗ trợ, xin vui lòng phản hồi lại email này.
                Chúng tôi luôn sẵn sàng hỗ trợ!</p>

            <p>Trân trọng,<br>
                <strong>Đội ngũ hỗ trợ khách hàng</strong>
            </p>
        </div>
    </div>

</body>

</html>
