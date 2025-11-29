@extends('layouts.admin')

@section('title', 'Quản lý danh mục')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Quản lý danh mục</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Danh sách danh mục</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive" style="font-size: 15px;">
                                        <p class="text-muted font-13 m-b-30">
                                            Trang quản lý danh mục cho phép quản trị viên tạo, chỉnh sửa và xóa các danh mục
                                            sản phẩm.
                                            Các danh mục giúp tổ chức sản phẩm một cách hợp lý, giúp khách hàng dễ dàng tìm
                                            kiếm và lựa chọn hơn.
                                            Dữ liệu được hiển thị trong bảng hỗ trợ các chức năng như tìm kiếm, phân trang
                                            và xuất dữ liệu để thuận tiện cho việc quản lý.
                                        </p>
                                        <table id="datatable-buttons" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Hình ảnh</th>
                                                    <th>Tên danh mục</th>
                                                    <th>Slug</th>
                                                    <th>Mô tả</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                            <tbody>                                                
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td class="text-center">
                                                            @if ($category->image)
                                                                <img src="{{ asset('storage/' . $category->image) }}"
                                                                    alt="{{ $category->name }}" width="50">
                                                            @else
                                                                <span>Chưa có hình ảnh</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $category->name }}</td>
                                                        <td>{{ $category->slug }}</td>
                                                        <td>{{ $category->description }}</td>
                                                        <td class="text-center">
                                                            <button class="btn btn-warning" style="margin-top: 10px;"><i class="fa fa-edit" style="font-size: 15px;"> Chỉnh sửa</i></button>
                                                        </td>
                                                        <td class="text-center">
                                                            <button class="btn btn-danger" style="margin-top: 10px;"><i class="fa fa-trash" style="font-size: 15px;"> Xóa</i></button>
                                                        </td>
                                                    </tr>
                                                    
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
