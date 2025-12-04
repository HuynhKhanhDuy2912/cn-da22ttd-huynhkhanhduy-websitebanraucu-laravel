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
                                                            <button class="btn btn-primary btn-update-category"
                                                                data-toggle="modal"
                                                                data-target="#modalUpdate-{{ $category->id }}"><i
                                                                    class="fa fa-edit"></i> Sửa
                                                            </button>
                                                        </td>
                                                        <td class="text-center">
                                                            <button class="btn btn-danger btn-delete-category" data-id ="{{ $category->id }}"><i
                                                                    class="fa fa-trash"></i>  Xóa
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modalUpdate-{{ $category->id }}"
                                                        tabindex="-1" aria-labelledby="categoruModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Cập nhật danh mục</h5>
                                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="item form-group">
                                                                            <label class="col-form-label col-md-3 col-sm-3 label-align text-left"
                                                                                for="category-name" style="white-space: nowrap;">Tên danh mục: 
                                                                            </label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <input type="text" id="category-name" name="name" 
                                                                                class="form-control" value="{{ $category->name }}" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="item form-group">
                                                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                                                for="category-description">Mô tả:
                                                                            </label>
                                                                            <div class="col-md-9 col-sm-9 ">
                                                                                <input type="text" id="category-description" name="description"
                                                                                class="form-control" value="{{ $category->description }}" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="item form-group">
                                                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                                                for="category-image">Hình ảnh:
                                                                            </label>

                                                                            <div class="col-md-6 col-sm-6 text-center">
                                                                                <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}"
                                                                                    id="image-preview-{{ $category->id }}" class="image-preview">

                                                                                <input type="file" id="category-image-{{ $category->id }}" data-id ="{{ $category->id }}"
                                                                                    name="image" accept="image/*" class="category-image" />

                                                                                <label class="custom-file-upload" for="category-image-{{ $category->id }}">
                                                                                    <i class="fa fa-cloud-upload"></i> Chọn ảnh
                                                                                </label>
                                                                            </div>

                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">                                                                    
                                                                    <button type="button" class="btn btn-success btn-update-submit-category" data-id="{{ $category->id }}">Cập nhật</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
