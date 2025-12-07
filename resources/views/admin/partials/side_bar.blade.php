<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title">
            <a href="{{ route('admin.dashboard') }}" class="site_title">
                <i class="fa fa-leaf" style="font-size: 24px; color: #05ff24; border: 1px solid #05ff24"></i> 
                <span>VEGGIE SHOP!</span>
            </a>
        </div>

        <div class="clearfix"></div>
        @php
            $admin = Auth::guard('admin')->user();
        @endphp 
        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <a href="{{ route('admin.profile') }}" style="width: 100%" class="d-flex">
                <div class="profile_pic">
                    <img src="{{ asset('storage/' . ($admin->avatar ?? 'uploads/users/user.jpg')) }}" width="40">
                </div>
                <div class="profile_info">
                    <h2>Xin chào, {{ $admin->name }}!</h2>
                </div>
            </a>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Tổng quan</h3>
                @php
                    $adminUser = Auth::guard('admin')->user();
                @endphp
                <ul class="nav side-menu">
                    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>

                    @if ($adminUser->role->permissions->contains('name','manage_users'))
                        <li><a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i> Quản lý tài khoản</a></li>
                    @endif
                    
                    @if ($adminUser->role->permissions->contains('name','manage_categories'))
                        <li><a><i class="fa fa-th"></i> Quản lý danh mục <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">                                
                                <li><a href="{{ route('admin.category.showAddCateForm') }}">Thêm danh mục</a></li>  
                                <li><a href="{{ route('admin.category.index') }}">Danh sách danh mục</a></li>                              
                            </ul>
                        </li>
                    @endif                
                    
                    @if ($adminUser->role->permissions->contains('name','manage_products'))
                        <li><a><i class="fa fa-archive"></i> Quản lý sản phẩm <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('admin.product.showAddProductForm') }}">Thêm sản phẩm</a></li>
                                <li><a href="{{ route('admin.product.index') }}">Danh sách sản phẩm</a></li>
                            </ul>
                        </li>
                    @endif
                    
                    @if ($adminUser->role->permissions->contains('name','manage_orders'))
                        <li><a href="{{ route('admin.order.index') }}"><i class="fa fa-shopping-cart"></i> Quản lý đơn hàng</a></li>
                    @endif
                    
                    @if ($adminUser->role->permissions->contains('name','manage_contacts'))
                        <li><a href="{{ route('admin.contacts.index') }}"><i class="fa fa-envelope"></i> Quản lý liên hệ</a></li>
                    @endif                    
                </ul>
            </div>
        </div>

        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" href="{{ route('admin.logout') }}">
                <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Đăng xuất
            </a>
        </div>
    </div>
</div>
                                        