
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            @php
                $admin = Auth::guard('admin')->user();
            @endphp
            <ul class=" navbar-right" style="padding-right: 15px;">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                        data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('storage/' . ($admin->avatar ?? 'uploads/users/user.jpg')) }}" style="border: 3px solid #ffffff">
                        {{ $admin->name }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu text-center" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fa fa-user pr-2"></i> Tài khoản</a>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="fa fa-sign-out pr-2"></i> Đăng xuất</a>
                    </div>
                </li>

                <li role="presentation" class="nav-item dropdown open" style="margin-top: 5px;">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                        data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o" style="font-size: 20px;"></i>
                        <span class="badge bg-red">{{ $message->count() }}</span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                        @for ($i = 0; $i < min(5, $message->count()); $i++)
                            <li class="nav-item">
                                <a class="dropdown-item" href="{{ route('admin.contacts.index') }}">
                                    <span class="image"><img src="{{ asset('assets/admin/images/user_default.png') }}" alt="Profile Image" /></span>
                                    <span>
                                        <span>{{ $message[$i]->full_name }}</span>
                                        <span class="time">{{ $message[$i]->created_at->diffForHumans() }}</span>
                                    </span>
                                    <span class="message custom-message-top">
                                        {{ $message[$i]->message }}
                                    </span>
                                </a>
                            </li>
                        @endfor
                        <li class="nav-item">
                            <div class="text-center">
                                <a class="dropdown-item" href="{{ route('admin.contacts.index') }}">
                                    <strong>Xem tất cả liên hệ</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown open" style="margin-top: 5px; margin-right: 10px;">
                    <a href="javascript:;" class="dropdown-toggle info-number"
                        data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell-o" style="font-size: 20px;"></i>
                        <span class="badge bg-red">{{ $notifications->count() }}</span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                        @for ($i = 0; $i < min(5, $notifications->count()); $i++)
                            <li class="nav-item">
                            <a class="dropdown-item" href="{{ route('admin.notification.index') }}">
                                <span class="image"><img src="{{ asset('assets/admin/images/bell.png') }}" alt="Profile Image" /></span>
                                <span>
                                    <span>{{ $notifications[$i]->title }}</span>
                                    <span class="time">{{ $notifications[$i]->created_at->diffForHumans() }}</span>
                                </span>
                                <span class="message custom-message-top">
                                    {{ $notifications[$i]->message }}
                                </span>
                            </a>
                        </li>
                        @endfor
                        <li class="nav-item">
                            <div class="text-center">
                                <a class="dropdown-item" href="{{ route('admin.notification.index') }}">
                                    <strong>Xem tất cả thông báo</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>

