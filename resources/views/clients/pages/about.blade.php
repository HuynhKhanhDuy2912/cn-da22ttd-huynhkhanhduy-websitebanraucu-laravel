@extends('layouts.client')

@section('title','Về chúng tôi')
@section('breadcrumb','Về chúng tôi')

@section('content')

<!-- ABOUT US AREA START -->
<div class="ltn__about-us-area pt-120--- pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="about-us-img-wrap about-img-left">
                    <img src="{{asset('assets/clients/img/others/6.png')}}" alt="About Us Image">
                </div>
            </div>
            <div class="col-lg-6 align-self-center">
                <div class="about-us-info-wrap">
                    <div class="section-title-area ltn__section-title-2">
                        <h6 class="section-subtitle ltn__secondary-color">Tìm hiểu thêm về cửa hàng</h6>
                        <h1 class="section-title">Cửa hàng thực phẩm <br class="d-none d-md-block"> Hữu Cơ Uy Tín</h1>
                        <p>Chúng tôi cam kết mang đến những sản phẩm chất lượng, an toàn và tốt cho sức khỏe.</p>
                    </div>
                    <p>
                        Những người bán hàng khao khát trở thành người tốt, làm điều tốt và lan tỏa lòng tốt. 
                        Chúng tôi là một thị trường dân chủ, tự chủ, hai chiều, phát triển mạnh mẽ trên nền tảng niềm tin và được xây dựng dựa 
                        trên cộng đồng và nội dung chất lượng.
                    </p>
                    <div class="about-author-info d-flex">
                        <div class="author-name-designation  align-self-center">
                            <h4 class="mb-0">KhanhDuy</h4>
                            <small>/ Giám đốc cửa hàng</small>
                        </div>
                        <div class="author-sign">
                            <img src="{{asset('assets/clients/img/icons/icon-img/author-sign.png')}}" alt="#">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ABOUT US AREA END -->

<!-- FEATURE AREA START ( Feature - 6) -->
<div class="ltn__feature-area section-bg-1 pt-115 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h6 class="section-subtitle ltn__secondary-color">// Đặc điểm //</h6>
                    <h1 class="section-title">Tại Sao Chọn Chúng Tôi.</h1>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="ltn__feature-item ltn__feature-item-7">
                    <div class="ltn__feature-icon-title">
                        <div class="ltn__feature-icon">
                            <span><img src="{{asset('assets/clients/img/icons/icon-img/21.png')}}" alt="#"></span>
                        </div>
                        <h3><a href="{{route('service')}}">Đa dạng thương hiệu</a></h3>
                    </div>
                    <div class="ltn__feature-info">
                        <p>Chúng tôi cung cấp nhiều thương hiệu uy tín, đảm bảo chất lượng và nguồn gốc rõ ràng.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="ltn__feature-item ltn__feature-item-7">
                    <div class="ltn__feature-icon-title">
                        <div class="ltn__feature-icon">
                            <span><img src="{{asset('assets/clients/img/icons/icon-img/22.png')}}" alt="#"></span>
                        </div>
                        <h3><a href="{{route('service')}}">Sản phẩm tuyển chọn</a></h3>
                    </div>
                    <div class="ltn__feature-info">
                        <p>Mỗi sản phẩm đều được chọn lọc kỹ lưỡng, mang đến sự an tâm và hài lòng cho khách hàng.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="ltn__feature-item ltn__feature-item-7">
                    <div class="ltn__feature-icon-title">
                        <div class="ltn__feature-icon">
                            <span><img src="{{asset('assets/clients/img/icons/icon-img/23.png')}}" alt="#"></span>
                        </div>
                        <h3><a href="{{route('service')}}">Không chứa thuốc trừ sâu</a></h3>
                    </div>
                    <div class="ltn__feature-info">
                        <p>Cam kết cung cấp sản phẩm sạch, an toàn, không hóa chất độc hại hay thuốc trừ sâu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FEATURE AREA END -->

<!-- TEAM AREA START (Team - 3) -->
<div class="ltn__team-area pt-115 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title white-color---">Thành viên nhóm</h1>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="ltn__team-item">
                    <div class="team-img">
                        <img src="{{asset('assets/clients/img/team/1.jpg')}}" alt="Image">
                    </div>
                    <div class="team-info">
                        <h6 class="ltn__secondary-color">// founder //</h6>
                        <h4><a href="{{route('contact.index')}}">Rosalina D. William</a></h4>
                        <div class="ltn__social-media">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="ltn__team-item">
                    <div class="team-img">
                        <img src="{{asset('assets/clients/img/team/2.jpg')}}" alt="Image">
                    </div>
                    <div class="team-info">
                        <h6 class="ltn__secondary-color">// founder //</h6>
                        <h4><a href="{{route('contact.index')}}">Rosalina D. William</a></h4>
                        <div class="ltn__social-media">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="ltn__team-item">
                    <div class="team-img">
                        <img src="{{asset('assets/clients/img/team/3.jpg')}}" alt="Image">
                    </div>
                    <div class="team-info">
                        <h6 class="ltn__secondary-color">// founder //</h6>
                        <h4><a href="{{route('contact.index')}}">Rosalina D. William</a></h4>
                        <div class="ltn__social-media">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="ltn__team-item">
                    <div class="team-img">
                        <img src="{{asset('assets/clients/img/team/4.jpg')}}" alt="Image">
                    </div>
                    <div class="team-info">
                        <h6 class="ltn__secondary-color">// founder //</h6>
                        <h4><a href="{{route('contact.index')}}">Rosalina D. William</a></h4>
                        <div class="ltn__social-media">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- TEAM AREA END -->

@endsection
