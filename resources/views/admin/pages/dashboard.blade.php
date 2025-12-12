@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row" style="display: inline-block; width: 100%;">
            <div class="tile_count">
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Tổng số người dùng</span>
                    <div class="count green">{{ $users->count() }}</div>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-th"></i> Tổng số lượng danh mục</span>
                    <div class="count green">{{ $categories->count() }}</div>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-bar-chart"></i> Tổng số lượng sản phẩm</span>
                    <div class="count green">{{ $products->count() }}</div>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-shopping-cart"></i> Tổng số lượng đơn hàng</span>
                    <div class="count green">{{ $orders->count() }}</div>
                </div>
                <div class="col-md-4 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-money"></i> Tổng doanh thu</span>
                    <div class="count green">{{ number_format($orders->sum('total_price'), 0, 0) }} VNĐ</div>
                </div>
            </div>
        </div>
        <!-- /top tiles -->

        <br />

        <div class="row">

            <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Doanh thu hàng tháng</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="revenueBarChart" data-labels='@json($monthlyRevenue->pluck('month')->toArray())'
                            data-values='@json($monthlyRevenue->pluck('revenue')->toArray())'>
                        </canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Sản phẩm bán chạy nhất</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng đã bán</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topSelling as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <img src="{{ $item->image_url }}" width="50" height="50"
                                                alt="{{ $item->name }}">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                        <td>{{ $item->total_sold }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-4 ">
                <div class="x_panel tile overflow_hidden" style="height: 307px;">
                    <div class="x_title">
                        <h2>Danh mục sản phẩm</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="" style="width:100%">
                            <tr>
                                <th style="width:37%;">
                                    <p>Top {{ $categories->count() }}</p>
                                </th>
                                <th>
                                    <div class="col-lg-7 col-md-7 col-sm-7 ">
                                        <p class="">Danh mục</p>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                        <p class="text-center">Sản phẩm</p>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <canvas class="canvasDoughnutCategory" height="140" width="140"
                                        data-labels='@json($categories->pluck('name'))'
                                        data-counts='@json($categories->map(fn($category) => $category->products->count()))'>
                                    </canvas>
                                </td>
                                <td>
                                    <table class="tile_info">
                                        @foreach ($categories as $index => $category)
                                            <tr>
                                                <td>
                                                    <p><i class="fa fa-square"
                                                            style="color: {{ ['#22D015', '#8E44AD', '#FF1800', '#F8E802', '#3498DB'][$index % 5] }};"></i>
                                                        {{ $category->name }}</p>
                                                </td>
                                                <td>{{ $category->products->count() }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Người dùng mới</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên khách hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < min(3, $users->count()); $i++)
                                    <tr>
                                        <td scope="row">{{ $i + 1 }}</td>
                                        <td>{{ $users[$i]->name }}</td>
                                        <td>{{ $users[$i]->phone_number }}</td>
                                        <td>
                                            @if ($users[$i]->status == 'banned')
                                                <span class="custom-badge badge badge-danger">Bị chặn</span>
                                            @elseif ($users[$i]->status == 'deleted')
                                                <span class="custom-badge badge badge-warning">Đã xóa</span>
                                            @elseif ($users[$i]->status == 'pending')
                                                <span class="custom-badge badge badge-primary">Chưa kích hoạt</span>
                                            @else
                                                <span class="custom-badge badge badge-success">Đã kích hoạt</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



            <div class="col-md-12 col-sm-6  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Đơn hàng mới</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Khách hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < min(3, $orders->count()); $i++)
                                    <tr>
                                        <td scope="row">{{ $i + 1 }}</td>
                                        <td>{{ $orders[$i]->shippingAddress->full_name }}</td>
                                        <td>{{ number_format($orders[$i]->total_price, 0, ',', '.') }} VNĐ</td>
                                        <td>
                                            @if ($orders[$i]->status == 'pending')
                                                <span class="custom-badge badge badge-warning">Đợi xác nhận</span>
                                            @elseif ($orders[$i]->status == 'canceled')
                                                <span class="custom-badge badge badge-danger">Đã hủy</span>
                                            @elseif ($orders[$i]->status == 'processing')
                                                <span class="custom-badge badge badge-primary">Đang giao hàng</span>
                                            @else
                                                <span class="custom-badge badge badge-success">Đã hoàn thành</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $orders[$i]->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.order.detail', ['id' => $orders[$i]->id]) }}"
                                                class="btn btn-info btn-sm">Xem</a>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
