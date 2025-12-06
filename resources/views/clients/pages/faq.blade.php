@extends('layouts.client')

@section('title','FAQ')
@section('breadcrumb','Những câu hỏi thường gặp')

@section('content')

<!-- FAQ AREA START (faq-2) (ID > accordion_2) -->
<div class="ltn__faq-area mb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="ltn__faq-inner ltn__faq-inner-2">
                    <div id="accordion_2">
                        <!-- card -->
                        <div class="card">
                            <h6 class="collapsed ltn__card-title" data-bs-toggle="collapse"
                                data-bs-target="#faq-item-2-1" aria-expanded="false">
                                Làm thế nào để mua sản phẩm?
                            </h6>
                            <div id="faq-item-2-1" class="collapse" data-parent="#accordion_2">
                                <div class="card-body">
                                    <p>Bạn có thể mua rau củ trực tiếp trên website bằng cách thêm sản phẩm vào giỏ hàng,
                                        kiểm tra lại đơn hàng, sau đó tiến hành thanh toán. Chúng tôi hỗ trợ thanh toán
                                        online hoặc khi nhận hàng (COD) để thuận tiện nhất cho bạn.</p>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                        <div class="card">
                            <h6 class="ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-2"
                                aria-expanded="true">
                                Làm sao để yêu cầu hoàn tiền?
                            </h6>
                            <div id="faq-item-2-2" class="collapse show" data-parent="#accordion_2">
                                <div class="card-body">
                                    <div class="ltn__video-img alignleft">
                                        <img src="{{ asset('assets/clients/img/bg/17.jpg') }}" alt="video popup bg image">
                                        <a class="ltn__video-icon-2 ltn__video-icon-2-small ltn__video-icon-2-border----"
                                            href="https://www.youtube.com/embed/LjCzPp-MK48?autoplay=1&amp;showinfo=0"
                                            data-rel="lightcase:myCollection">
                                            <i class="fa fa-play"></i>
                                        </a>
                                    </div>
                                    <p>Nếu sản phẩm bị hư hỏng, sai loại hoặc không đạt chất lượng như cam kết,
                                        bạn có thể liên hệ với chúng tôi trong vòng 24 giờ kể từ khi nhận hàng để được hỗ trợ hoàn tiền hoặc đổi sản phẩm mới.</p>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                        <div class="card">
                            <h6 class="collapsed ltn__card-title" data-bs-toggle="collapse"
                                data-bs-target="#faq-item-2-3" aria-expanded="false">
                                Tôi là khách hàng mới, nên bắt đầu từ đâu?
                            </h6>
                            <div id="faq-item-2-3" class="collapse" data-parent="#accordion_2">
                                <div class="card-body">
                                    <p>Bạn chỉ cần đăng ký tài khoản miễn phí, sau đó đăng nhập để xem các loại rau củ, 
                                        chọn sản phẩm yêu thích và đặt hàng. Đội ngũ của chúng tôi sẽ nhanh chóng xử lý và giao hàng tận nơi cho bạn.</p>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                        <div class="card">
                            <h6 class="collapsed ltn__card-title" data-bs-toggle="collapse"
                                data-bs-target="#faq-item-2-4" aria-expanded="false">
                                Chính sách đổi trả và hoàn tiền
                            </h6>
                            <div id="faq-item-2-4" class="collapse" data-parent="#accordion_2">
                                <div class="card-body">
                                    <p>Chúng tôi chấp nhận đổi trả hàng trong vòng 1 ngày kể từ khi nhận hàng nếu sản phẩm không đạt chất lượng,
                                        bị dập nát hoặc không đúng loại đã đặt. Vui lòng giữ lại hình ảnh sản phẩm và liên hệ ngay với bộ phận hỗ trợ để được xử lý nhanh nhất.</p>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                        <div class="card">
                            <h6 class="collapsed ltn__card-title" data-bs-toggle="collapse"
                                data-bs-target="#faq-item-2-5" aria-expanded="false">
                                Thông tin cá nhân của tôi có được bảo mật không?
                            </h6>
                            <div id="faq-item-2-5" class="collapse" data-parent="#accordion_2">
                                <div class="card-body">
                                    <p>Chúng tôi cam kết bảo mật tuyệt đối thông tin cá nhân và dữ liệu giao dịch của khách hàng.
                                        Dữ liệu được mã hóa và chỉ sử dụng nhằm phục vụ quá trình giao hàng và chăm sóc khách hàng.</p>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                        <div class="card">
                            <h6 class="collapsed ltn__card-title" data-bs-toggle="collapse"
                                data-bs-target="#faq-item-2-6" aria-expanded="false">
                                Mã giảm giá không sử dụng được?
                            </h6>
                            <div id="faq-item-2-6" class="collapse" data-parent="#accordion_2">
                                <div class="card-body">
                                    <p>Vui lòng kiểm tra lại thời hạn sử dụng hoặc điều kiện áp dụng của mã giảm giá.
                                        Một số mã chỉ áp dụng cho đơn hàng đạt giá trị tối thiểu hoặc trong khung giờ khuyến mãi nhất định.</p>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                        <div class="card">
                            <h6 class="collapsed ltn__card-title" data-bs-toggle="collapse"
                                data-bs-target="#faq-item-2-7" aria-expanded="false">
                                Tôi có thể thanh toán bằng thẻ ngân hàng không?
                            </h6>
                            <div id="faq-item-2-7" class="collapse" data-parent="#accordion_2">
                                <div class="card-body">
                                    <p>Chắc chắn rồi! Chúng tôi hỗ trợ thanh toán qua thẻ ATM nội địa, thẻ Visa/MasterCard,
                                        ví điện tử Momo, ZaloPay và cả phương thức thanh toán khi nhận hàng (COD).</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="need-support text-center mt-100">
                        <h2>Vẫn cần hỗ trợ? Liên hệ với chúng tôi 24/7:</h2>
                        <div class="btn-wrapper mb-30">
                            <a href="{{ route('contact.index') }}" class="theme-btn-1 btn">Liên hệ ngay</a>
                        </div>
                        <h3><i class="fas fa-phone"></i> 0972 144 904</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="sidebar-area ltn__right-sidebar">
                    <!-- Newsletter Widget -->
                    <div class="widget ltn__search-widget ltn__newsletter-widget">
                        <h6 class="ltn__widget-sub-title">// Đăng ký nhận tin</h6>
                        <h4 class="ltn__widget-title">Nhận thông báo mới</h4>
                        <form action="#">
                            <input type="text" name="search" placeholder="Nhập email của bạn...">
                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                        </form>
                        <div class="ltn__newsletter-bg-icon">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                    </div>
                    <!-- Banner Widget -->
                    <div class="widget ltn__banner-widget">
                        <a href="{{ route('products.index') }}"><img src="{{ asset('assets/clients/img/banner/banner-3.jpg') }}" alt="Banner Quảng Cáo"></a>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>

<!-- FAQ AREA START -->

<!-- COUNTER UP AREA START -->
<div class="ltn__counterup-area bg-image bg-overlay-theme-black-80 pt-115 pb-70" data-bg="{{ asset('assets/clients/img/bg/5.jpg') }}">
    <div class="container">
        <div class="row">
            <!-- Số lượng khách hàng -->
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item-3 text-color-white text-center">
                    <div class="counter-icon">
                        <img src="{{ asset('assets/clients/img/icons/icon-img/2.png') }}" alt="Khách hàng">
                    </div>
                    <h1><span class="counter">733</span><span class="counterUp-icon">+</span></h1>
                    <h6>Khách hàng tin tưởng</h6>
                </div>
            </div>
            <!-- Sản phẩm đã bán -->
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item-3 text-color-white text-center">
                    <div class="counter-icon">
                        <img src="{{ asset('assets/clients/img/icons/icon-img/3.png') }}" alt="Sản phẩm">
                    </div>
                    <h1><span class="counter">33</span><span class="counterUp-letter">K</span><span class="counterUp-icon">+</span></h1>
                    <h6>Sản phẩm đã được giao</h6>
                </div>
            </div>
            <!-- Giải thưởng -->
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item-3 text-color-white text-center">
                    <div class="counter-icon">
                        <img src="{{ asset('assets/clients/img/icons/icon-img/4.png') }}" alt="Giải thưởng">
                    </div>
                    <h1><span class="counter">100</span><span class="counterUp-icon">+</span></h1>
                    <h6>Giải thưởng & chứng nhận</h6>
                </div>
            </div>
            <!-- Khu vực phân phối -->
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item-3 text-color-white text-center">
                    <div class="counter-icon">
                        <img src="{{ asset('assets/clients/img/icons/icon-img/5.png') }}" alt="Khu vực">
                    </div>
                    <h1><span class="counter">21</span><span class="counterUp-icon">+</span></h1>
                    <h6>Tỉnh thành phân phối</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- COUNTER UP AREA END -->

@endsection
