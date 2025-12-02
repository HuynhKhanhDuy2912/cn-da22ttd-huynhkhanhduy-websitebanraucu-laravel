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
                            <h2>Thêm danh mục mới</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                                
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="add-category" action="{{ route('admin.category.add') }}" method="POST" class="form-horizontal form-label-left"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="category-name">
                                        Tên danh mục:
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="category-name" name="name" required="required" class="form-control ">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        for="category-description">Mô tả:
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="category-description" name="description"
                                            required="required" class="form-control">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="category-image">Hình ảnh:</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="file" id="category-image" name="image" accept="image/*" required/>
                                        <img src="" alt="Ảnh xem trước" id="image-preview" class="image-preview">
                                        <br>
                                        <label class="custom-file-upload" for="category-image">
                                            <i class="fa fa-cloud-upload"></i> Chọn ảnh
                                        </label>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="col-md-6 col-sm-6 offset-md-3 btn-category_product">
                                        <button class="btn btn-primary btn-reset" type="reset">Làm lại</button>
                                        <button type="submit" class="btn btn-success">Thêm danh mục</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
