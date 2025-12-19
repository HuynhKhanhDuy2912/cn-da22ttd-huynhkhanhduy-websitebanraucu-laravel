@extends('layouts.client')

@section('title', 'Liên hệ')
@section('breadcrumb', 'Liên hệ')

@section('content')
    <!-- CONTACT ADDRESS AREA START -->
    <div class="ltn__contact-address-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{ asset('assets/clients/img/icons/10.png') }}" alt="Icon Image">
                        </div>
                        <h3>Địa chỉ email</h3>
                        <p>duy2912www@gmail.com</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{ asset('assets/clients/img/icons/11.png') }}" alt="Icon Image">
                        </div>
                        <h3>Số điện thoại</h3>
                        <p>0972 144 904</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{ asset('assets/clients/img/icons/12.png') }}" alt="Icon Image">
                        </div>
                        <h3>Công ty</h3>
                        <p>Thành Thới, Vĩnh Long, Việt Nam</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT ADDRESS AREA END -->

    <!-- CONTACT MESSAGE AREA START -->
    <div class="ltn__contact-message-area mb-120 mb--100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__form-box contact-form-box box-shadow white-bg">
                        <h4 class="title-2">Liên hệ</h4>
                        <form id="contact-form" action="{{ route('contact') }}"
                            method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-item input-item-name ltn__custom-icon">
                                        <input type="text" name="name" placeholder="Họ và tên">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-item input-item-email ltn__custom-icon">
                                        <input type="email" name="email" placeholder="Email">
                                    </div>
                                </div>                                
                                <div class="col-md-4">
                                    <div class="input-item input-item-phone ltn__custom-icon">
                                        <input type="text" name="phone" placeholder="Số điện thoại">
                                    </div>
                                </div>
                            </div>
                            <div class="input-item input-item-textarea ltn__custom-icon">
                                <textarea name="message" placeholder="Nhập tin nhắn..."></textarea>
                            </div>
                            @if (Auth::check())
                                <div class="btn-wrapper mt-0 text-end">
                                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Gửi</button>
                                </div>
                            @else
                                <div class="btn-wrapper mt-0 text-end">
                                    <a href="javascript:void(0)" onclick="showLoginWarning()"><button class="btn theme-btn-1 btn-effect-1 text-uppercase">Gửi</button></a>
                                </div>
                            @endif
                            <p class="form-messege mb-0 mt-20"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT MESSAGE AREA END -->

    <!-- GOOGLE MAP AREA START -->
    <div class="google-map mb-120">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62820.779084195274!2d106.33435142878578!3d10.237476326016925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310aa8f5e2e8bd09%3A0x9d5fd18ce4fa56bb!2zVHAuIELhur9uIFRyZSwgQuG6v24gVHJlLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1764041823113!5m2!1svi!2s" width="100%" height="100%" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <!-- GOOGLE MAP AREA END -->
@endsection
