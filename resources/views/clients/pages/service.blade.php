@extends('layouts.client')

@section('title','Dịch vụ')
@section('breadcrumb','Dịch vụ')

@section('content')

<!-- ABOUT US AREA START -->
<div class="ltn__about-us-area pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 align-self-center">
                <div class="about-us-img-wrap ltn__img-shape-left  about-img-left">
                    <img src="{{asset('assets/clients/img/service/11.jpg')}}" alt="Image">
                </div>
            </div>
            <div class="col-lg-7 align-self-center">
                <div class="about-us-info-wrap">
                    <div class="section-title-area ltn__section-title-2">
                        <h6 class="section-subtitle ltn__secondary-color">// DỊCH VỤ UY TÍN</h6>
                        <h1 class="section-title">Chúng tôi là đội ngũ chuyên nghiệp & tận tâm.</h1>
                        <p>Cam kết mang đến cho khách hàng những sản phẩm rau củ tươi sạch, an toàn và chất lượng cao nhất mỗi ngày.</p>
                    </div>
                    <div class="about-us-info-wrap-inner about-us-info-devide">
                        <p>Với nhiều năm kinh nghiệm trong lĩnh vực cung cấp thực phẩm sạch, chúng tôi luôn nỗ lực đem đến cho người tiêu dùng những loại rau củ quả tươi ngon, rõ nguồn gốc và đạt chuẩn VietGAP. Mọi sản phẩm đều được chọn lọc kỹ lưỡng, đóng gói cẩn thận và giao tận nơi nhanh chóng.</p>
                        <div class="list-item-with-icon">
                            <ul>
                                <li><a href="javascript:void(0)">Giao hàng tận nhà miễn phí 24/7</a></li>
                                <li><a href="javascript:void(0)">Đội ngũ chuyên viên tận tâm và chuyên nghiệp</a></li>
                                <li><a href="javascript:void(0)">Trang thiết bị bảo quản hiện đại</a></li>
                                <li><a href="javascript:void(0)">Nguồn sản phẩm phong phú, đa dạng</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ABOUT US AREA END -->

<!-- SERVICE AREA START (Service 1) -->
<div class="ltn__service-area section-bg-1 pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title white-color---">Dịch Vụ Của Chúng Tôi</h1>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">

            <!-- Dịch vụ 1 -->
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__service-item-1">
                    <div class="service-item-img">
                        <a href="javascript:void(0)"><img src="{{asset('assets/clients/img/service/1.jpg')}}" alt="Rau hữu cơ tươi sạch"></a>
                    </div>
                    <div class="service-item-brief">
                        <h3><a href="javascript:void(0)">Rau Hữu Cơ Tươi Sạch Và Dinh Dưỡng</a></h3>
                        <p>Rau củ được thu hoạch trong ngày từ các nông trại đạt chuẩn VietGAP, đảm bảo an toàn và giàu dinh dưỡng.</p>
                    </div>
                </div>
            </div>

            <!-- Dịch vụ 2 -->
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__service-item-1">
                    <div class="service-item-img">
                        <a href="javascript:void(0)"><img src="{{asset('assets/clients/img/service/2.jpg')}}" alt="Giao hàng tận nơi"></a>
                    </div>
                    <div class="service-item-brief">
                        <h3><a href="service-details.html">Giao Hàng Tận Nơi Nhanh Chóng</a></h3>
                        <p>Chúng tôi giao hàng tận nhà, giúp bạn luôn có rau củ tươi ngon mỗi ngày mà không cần ra chợ.</p>
                    </div>
                </div>
            </div>

            <!-- Dịch vụ 3 -->
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__service-item-1">
                    <div class="service-item-img">
                        <a href="javascript:void(0)"><img src="{{asset('assets/clients/img/service/3.jpg')}}" alt="Đặt hàng online dễ dàng"></a>
                    </div>
                    <div class="service-item-brief">
                        <h3><a href="javascript:void(0)">Đặt Hàng Online Dễ Dàng</a></h3>
                        <p>Website thân thiện, thao tác nhanh gọn giúp bạn chọn mua rau củ chỉ trong vài cú nhấp chuột.</p>
                    </div>
                </div>
            </div>

            <!-- Dịch vụ 4 -->
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__service-item-1">
                    <div class="service-item-img">
                        <a href="javascript:void(0)"><img src="{{asset('assets/clients/img/service/3.jpg')}}" alt="Đóng gói an toàn"></a>
                    </div>
                    <div class="service-item-brief">
                        <h3><a href="javascript:void(0)">Đóng Gói An Toàn & Thân Thiện</a></h3>
                        <p>Sản phẩm được đóng gói bằng vật liệu thân thiện với môi trường, đảm bảo vệ sinh và giữ độ tươi lâu.</p>
                    </div>
                </div>
            </div>

            <!-- Dịch vụ 5 -->
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__service-item-1">
                    <div class="service-item-img">
                        <a href="javascript:void(0)"><img src="{{asset('assets/clients/img/service/1.jpg')}}" alt="Tư vấn dinh dưỡng miễn phí"></a>
                    </div>
                    <div class="service-item-brief">
                        <h3><a href="javascript:void(0)">Tư Vấn Dinh Dưỡng Miễn Phí</a></h3>
                        <p>Đội ngũ của chúng tôi sẵn sàng hỗ trợ bạn lựa chọn thực phẩm phù hợp cho chế độ ăn lành mạnh.</p>
                    </div>
                </div>
            </div>

            <!-- Dịch vụ 6 -->
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__service-item-1">
                    <div class="service-item-img">
                        <a href="javascript:void(0)"><img src="{{asset('assets/clients/img/service/2.jpg')}}" alt="Ưu đãi hấp dẫn"></a>
                    </div>
                    <div class="service-item-brief">
                        <h3><a href="javascript:void(0)">Ưu Đãi & Khuyến Mãi Hấp Dẫn</a></h3>
                        <p>Thường xuyên có chương trình giảm giá và combo tiết kiệm giúp bạn mua rau củ tươi ngon với giá tốt nhất.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SERVICE AREA END -->

@endsection
