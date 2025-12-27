<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Hóa đơn đặt hàng - Broccoli Shop</title>
</head>

<body style="background:#f5f5f5; padding:20px; font-family:Arial, sans-serif;">
    <table align="center" width="600" cellpadding="0" cellspacing="0"
        style="background:#ffffff; border-radius:8px; overflow:hidden;">

        <!-- Header -->
        <tr>
            <td style="background:#28a745; padding:20px; color:#fff; text-align:center;">
                <h2 style="margin:0;">BROCCOLI SHOP</h2>
                <p style="margin:0;">Hóa đơn mua hàng</p>
            </td>
        </tr>

        <tr>
            <td style="padding:0 20px; font-size:15px; color:#333; line-height:1.6;">
                <p>Xin chào <strong>{{ $order->shippingAddress->full_name }}</strong>,</p>

                <p>
                    Cảm ơn bạn đã tin tưởng và đặt hàng tại <strong>Broccoli Shop</strong>.
                    Chúng tôi gửi đến bạn thông tin chi tiết đơn hàng bên dưới.
                    Nếu có bất kỳ thắc mắc nào, bạn có thể trả lời email này hoặc liên hệ bộ phận hỗ trợ của chúng tôi.
                </p>
            </td>
        </tr>

        <!-- Invoice Title -->
        <tr>
            <td style="padding:0 20px;">
                <h3 style="margin:0; color:#333;">
                    Hóa đơn: <span
                        style="color:#28a745;">{{ 'HD-' . $order->created_at->format('Ymd') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                </h3>
                <p style="margin:5px 0 0; color:#777;">Ngày tạo: {{ $order->created_at->format('d/m/Y H:i') }}</p>
            </td>
        </tr>

        <!-- Customer Info -->
        <tr>
            <td style="padding:0 20px;">
                <h3 style="margin-bottom:10px; color:#000;">Thông tin khách hàng</h3>
                <p style="margin:0; color:#333;">
                    Họ và tên: <strong>{{ $order->shippingAddress->full_name }}</strong><br>
                    Địa chỉ: {{ $order->shippingAddress->address }}<br>
                    Thành phố: {{ $order->shippingAddress->city }}<br>
                    Số điện thoại: {{ $order->shippingAddress->phone }}<br>
                    Email: {{ $order->user->email }}
                </p>
            </td>
        </tr>

        <!-- Order Table -->
        <tr>
            <td style="padding:0 20px;">
                <h3 style="margin-bottom:10px; color:#000;">Chi tiết đơn hàng</h3>

                <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse; font-size:14px;">
                    <thead class="text-center">
                        <tr style="background:#28a745; color:#fff;">
                            <th>Ảnh</th>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)
                            <tr style="border-bottom:1px solid #ddd; text-align: center">
                                <td><img src="{{ $item->product->image_url }}" width="50"
                                        style="border-radius:4px;"></td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                <td>{{ $item->quantity }}</td>
                                <td><strong>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                        VNĐ</strong>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>

        <!-- Payment Method -->
        <tr>
            <td style="padding:0 20px;">
                <h3 style="color:#000;">Phương thức thanh toán</h3>
                <p
                    style="margin-bottom: 20px; color:#fff; background-color: #28a745; padding: 10px 0; text-align: center; font-size: 14px;">
                    @if ($order->payment->payment_method == 'paypal')
                        Thanh toán bằng <strong>PayPal</strong> (đã xử lý online).
                    @else
                        <strong>Tiền mặt khi nhận hàng (COD)</strong>.
                    @endif
                </p>
            </td>
        </tr>

        <!-- Summary -->
        <tr>
            <td style="padding:0 20px;">
                <h3 style="color:#000; margin-bottom: 0">Tóm tắt thanh toán:</h3>
                <table width="100%" style="font-size:14px;">
                    <tr>
                        <td style="color:#333;">Tạm tính:</td>
                        <td style="text-align:right;">{{ number_format($order->total_price - 25000, 0, ',', '.') }} VNĐ
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#333;">Phí vận chuyển:</td>
                        <td style="text-align:right;">25.000 VNĐ</td>
                    </tr>
                    <tr style="background-color: #28a745">
                        <td style="color:#fff; font-weight:bold; padding: 10px 0;" colspan="2">Tổng thanh toán:
                            <span style="float:right; font-weight:bold; color:#000;">
                                {{ number_format($order->total_price, 0, ',', '.') }} VNĐ</span>
                        </td>

                    </tr>
                </table>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background:#fff; text-align:center; padding:15px; color:#333; font-size:13px;">
                Cảm ơn bạn đã mua hàng tại Broccoli Shop! <br>
                Mọi thắc mắc xin liên hệ: 0999 999 999 - Email: duy2912www@gmail.com
            </td>
        </tr>

    </table>
</body>

</html>
