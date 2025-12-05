@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Quản lý đơn hàng</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Danh sách đơn hàng</h2>
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
                                            Trang quản lý đơn hàng cho phép quản trị viên theo dõi, xử lý và cập nhật trạng
                                            thái các đơn hàng trong hệ thống.
                                            Các đơn hàng được tổ chức và hiển thị một cách rõ ràng, giúp quản trị viên dễ
                                            dàng kiểm tra thông tin khách hàng, sản phẩm đã mua và phương thức thanh toán.
                                            Dữ liệu đơn hàng được trình bày dưới dạng bảng, hỗ trợ các chức năng như tìm
                                            kiếm, lọc theo trạng thái, phân trang và xuất dữ liệu, giúp việc quản lý trở nên
                                            nhanh chóng và hiệu quả.
                                        </p>
                                        <table id="datatable-buttons" class="table table-striped table-bordered text-center"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Tài khoản</th>
                                                    <th>Thông tin người đặt</th>
                                                    <th>Tổng tiền</th>
                                                    <th>Trạng thái đơn hàng</th>
                                                    <th>Trạng thái thanh toán</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>{{ $order->id }}</td>
                                                        <td>{{ $order->user->name }}</td>
                                                        <td><a href="">{{ $order->shippingAddress->address }}</a></td>
                                                        <td>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                                                        <td>
                                                            @if ($order->status == 'pending')
                                                                <span class="custom-badge badge badge-warning">Đợi xác nhận</span>
                                                            @elseif ($order->status == 'processing')
                                                                <span class="custom-badge badge badge-primary">Đang giao hàng</span>
                                                            @elseif ($order->status == 'completed')
                                                                <span class="custom-badge badge badge-success">Đã hoàn thành</span>
                                                            @elseif ($order->status == 'canceled')
                                                                <span class="custom-badge badge badge-danger">Đã hủy</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($order->payment->status == 'completed')
                                                                <span class="custom-badge badge badge-success">Đã thanh toán</span>
                                                            @else
                                                                <span class="custom-badge badge badge-secondary">Chưa thanh toán</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-info"> Xem </button>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal -->
                                                    {{-- <div class="modal fade" id="modalUpdate-{{ $product->id }}"
                                                        tabindex="-1" aria-labelledby="categoruModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Cập nhật sản phẩm</h5>
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
                                                                                class="col-form-label col-md-3 col-sm-3 label-align"
                                                                                for="product-name"
                                                                                style="white-space: nowrap;">Tên sản phẩm:
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
                                                                                for="product-name"
                                                                                style="white-space: nowrap;">Danh mục:
                                                                            </label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <select name="category_id"
                                                                                    id="product-category"
                                                                                    class="form-select" required>
                                                                                    <option value="" disabled
                                                                                        selected>Chọn danh mục</option>
                                                                                    @foreach ($categories as $category)
                                                                                        <option value="{{ $category->id }}"
                                                                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                                                            {{ $category->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
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
                                                                                for="product-description">Giá:
                                                                            </label>
                                                                            <div class="col-md-9 col-sm-9 ">
                                                                                <input type="number" id="product-price"
                                                                                    name="price" class="form-control"
                                                                                    value="{{ $product->price }}" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="item form-group">
                                                                            <label
                                                                                class="col-form-label col-md-3 col-sm-3 label-align"
                                                                                for="product-stock">Số lượng:
                                                                            </label>
                                                                            <div class="col-md-9 col-sm-9 ">
                                                                                <input type="number" id="product-stock"
                                                                                    name="stock" class="form-control"
                                                                                    value="{{ $product->stock }}"
                                                                                    required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="item form-group">
                                                                            <label
                                                                                class="col-form-label col-md-3 col-sm-3 label-align"
                                                                                for="product-unit">Đơn vị:
                                                                            </label>
                                                                            <div class="col-md-9 col-sm-9 ">
                                                                                <input type="text" id="product-unit"
                                                                                    name="unit" class="form-control"
                                                                                    value="{{ $product->unit }}" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="item form-group">
                                                                            <label
                                                                                class="col-form-label col-md-3 col-sm-3 label-align"
                                                                                for="product-images">Hình ảnh:
                                                                            </label>

                                                                            <div class="col-md-6 col-sm-6">
                                                                                <div id="image-preview-container-{{ $product->id }}"
                                                                                    class="image-preview-container image-preview-listproduct"
                                                                                    data-id="{{ $product->id }}">
                                                                                    @foreach ($product->images as $image)
                                                                                        <img src="{{ asset('storage/' . $image->image) }}"
                                                                                            alt="Ảnh sản phẩm"
                                                                                            width="80" height="80">
                                                                                    @endforeach
                                                                                </div>

                                                                                <input type="file"
                                                                                    id="product-images-{{ $product->id }}"
                                                                                    data-id ="{{ $product->id }}"
                                                                                    name="images[]" accept="image/*"
                                                                                    class="product-images" multiple />

                                                                                <label class="custom-file-upload"
                                                                                    for="product-images-{{ $product->id }}">
                                                                                    <i class="fa fa-cloud-upload"></i> Chọn
                                                                                    ảnh
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-success btn-update-submit-product"
                                                                        data-id="{{ $product->id }}">Cập nhật</button>
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
