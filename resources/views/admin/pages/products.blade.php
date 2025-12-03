@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Quản lý sản phẩm</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Danh sách sản phẩm</h2>
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
                                            Trang quản lý sản phẩm cho phép quản trị viên thêm mới, chỉnh sửa và xóa các sản
                                            phẩm trong hệ thống.
                                            Sản phẩm được tổ chức và quản lý một cách khoa học, giúp khách hàng dễ dàng tìm
                                            kiếm và lựa chọn hơn trên website.
                                            Dữ liệu sản phẩm được hiển thị dưới dạng bảng, hỗ trợ các chức năng như tìm
                                            kiếm, phân trang và xuất dữ liệu, giúp việc quản lý trở nên thuận tiện và hiệu
                                            quả.
                                        </p>
                                        <table id="datatable-buttons" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Hình ảnh</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Danh mục</th>
                                                    <th>Slug</th>
                                                    <th>Mô tả</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá</th>
                                                    <th>Đơn vị</th>
                                                    <th>Trạng thái</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($products as $product)
                                                    <tr id="product-row-{{ $product->id }}">
                                                        <td class="text-center">
                                                            <img src="{{ $product->image_url }}"
                                                                alt="{{ $product->name }}" class="image-product" width="80" height="80">
                                                        </td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->category->name }}</td>
                                                        <td>{{ $product->slug }}</td>
                                                        <td>{{ $product->description }}</td>
                                                        <td>{{ $product->stock }}</td>
                                                        <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                                                        <td>{{ $product->unit }}</td>
                                                        <td>{{ $product->status == 'in_stock' ? 'Còn hàng' : 'Hết hàng' }}</td>
                                                        <td class="text-center">
                                                            <button class="btn btn-primary btn-update-product"
                                                                data-toggle="modal"
                                                                data-target="#modalUpdate-{{ $product->id }}"><i
                                                                    class="fa fa-edit"></i> Chỉnh sửa
                                                            </button>
                                                        </td>
                                                        <td class="text-center">
                                                            <button class="btn btn-danger btn-delete-product"
                                                                data-id ="{{ $product->id }}"><i class="fa fa-trash"></i>
                                                                Xóa
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal -->
                                                    {{-- <div class="modal fade" id="modalUpdate-{{ $product->id }}"
                                                        tabindex="-1" aria-labelledby="categoruModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Cập nhật danh mục</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST"
                                                                        class="form-horizontal form-label-left"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="item form-group">
                                                                            <label
                                                                                class="col-form-label col-md-3 col-sm-3 label-align text-left"
                                                                                for="product-name"
                                                                                style="white-space: nowrap;">Tên danh mục:
                                                                            </label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <input type="text" id="product-name"
                                                                                    name="name" class="form-control"
                                                                                    value="{{ $product->name }}" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="item form-group">
                                                                            <label
                                                                                class="col-form-label col-md-3 col-sm-3 label-align"
                                                                                for="product-description">Mô tả:
                                                                            </label>
                                                                            <div class="col-md-9 col-sm-9 ">
                                                                                <input type="text"
                                                                                    id="product-description"
                                                                                    name="description" class="form-control"
                                                                                    value="{{ $product->description }}"
                                                                                    required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="item form-group">
                                                                            <label
                                                                                class="col-form-label col-md-3 col-sm-3 label-align"
                                                                                for="product-image">Hình ảnh:
                                                                            </label>

                                                                            <div class="col-md-6 col-sm-6 text-center">
                                                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                                                    alt="{{ $product->name }}"
                                                                                    id="image-preview-{{ $product->id }}"
                                                                                    class="image-preview">

                                                                                <input type="file"
                                                                                    id="product-image-{{ $product->id }}"
                                                                                    data-id ="{{ $product->id }}"
                                                                                    name="image" accept="image/*"
                                                                                    class="product-image" />

                                                                                <label class="custom-file-upload"
                                                                                    for="product-image-{{ $product->id }}">
                                                                                    <i class="fa fa-cloud-upload"></i> Chọn
                                                                                    ảnh
                                                                                </label>
                                                                            </div>

                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-success btn-update-submit-category"
                                                                        data-id="{{ $category->id }}">Cập nhật</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Quay lại</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
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
