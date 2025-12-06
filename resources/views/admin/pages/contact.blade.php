@extends('layouts.admin')

@section('title', 'Quản lý liên hệ')

@section('content')
    <div class="right_col" role="main">
        <div class="">

            <div class="page-title">
                <div class="title_left">
                    <h3>Quản lý liên hệ</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Tại đây bạn có thể xem và quản lý các thông tin liên lạc từ khách hàng, trả lời câu hỏi và
                                theo dõi các trao đổi để cải thiện dịch vụ </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-3 mail_list_column" style="overflow-y: scroll; max-height: ">
                                    <label class="badge bg-green"
                                        style=" width: 100%; font-size: 16px; line-height: 2">Hộp thư đến</label>
                                    @foreach ($contacts as $contact)
                                        <a href="javascript:void(0)" class="contact-item"
                                            data-name="{{ $contact->full_name }}" data-email="{{ $contact->email }}"
                                            data-message="{{ $contact->message }}" data-id="{{ $contact->id }}" data-is_replied="{{ $contact->is_replied }}">
                                            <div class="mail_list">
                                                <div class="left">
                                                    <i class="fa fa-circle"
                                                        style="color: {{ $contact->is_replied ? 'green' : 'red' }}"></i>
                                                </div>
                                                <div class="right">
                                                    <h3>{{ $contact->full_name }}
                                                        <small>{{ $contact->created_at->format('h:i A d-m-Y') }}</small>
                                                    </h3>
                                                    <p>{{ Str::limit($contact->message, 50) }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <!-- /MAIL LIST -->

                                <!-- CONTENT MAIL -->
                                <div class="col-sm-9 mail_view" style="display: none">
                                    <div class="inbox-body">
                                        <div class="sender-info"
                                            style="border-bottom: 1px solid #c6c6c6; padding-bottom: 5px">
                                            <div class="row" style="margin-left: -14px !important">
                                                <div class="col-md-12">
                                                    <strong></strong>
                                                    <span></span> đến
                                                    <b>tôi</b>
                                                    <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="view-mail" style="margin-top: 20px">
                                            <p style="font-size: 15px; color: #000;"></p>
                                            <div id="reply-status"></div>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-primary" type="button" id="compose">
                                                    <i class="fa fa-reply"></i> Phản hồi</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /CONTENT MAIL -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- compose -->
    <div class="compose col-md-6  ">
        <div class="compose-header">
            Phản hồi liên hệ
            <button type="button" class="close compose-close">
                <span>x</span>
            </button>
        </div>

        <div class="compose-body">
            <div id="editor-contact" class="editor-wrapper" style="min-height: 150px;"></div>
        </div>

        <div class="compose-footer">
            <button class="btn btn-sm btn-success send-reply-contact" type="button">Gửi</button>
        </div>
    </div>
    <!-- /compose -->
@endsection
