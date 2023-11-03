@extends('dashboard.layouts.master')
@section('title', 'Sửa Sản Phẩm')
@section('body')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-sm-8">
                            <div class="page-title-box">
                                <h4 class="font-size-18">Sửa Sản Phẩm</h4>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                                            <i class="fa fa-home "></i></a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Sản phẩm</a></li>
                                    <li class="breadcrumb-item active">Sửa Sản Phẩm</li>
                                </ol>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 float-right">
                        <a href="{{ route('product.index') }}"class="btn btn-primary float-end">Danh Sách sản phẩm</a>
                    </div>

                </div>
                @if ($errors->any())
                    @foreach ($errors->all() as $err)
                        <p class="alert alert-danger">{{ $err }}</p>
                    @endforeach
                @endif

            </div>

            <div class="card-body col-lg">
                <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $product->id }}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="productname">Tên sản phẩm</label>
                                <input id="name" name="name" value="{{ $product->name }}" type="text"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="price">Giá</label>
                                <input id="price" name="price" min="0" type="number"
                                    value="{{ $product->price }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="price">Giá(Sale)</label>
                                <input id="price" name="discount" min="0"
                                    type="number"value="{{ $product->discount ?? 0 }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="price">Số Lượng</label>
                                <input id="price" name="amount" min="0"
                                    type="number"value="{{ $product->amount }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Danh mục</label>
                                <select class="form-control select2 select2-hidden-accessible" data-select2-id="1"
                                    tabindex="-1" aria-hidden="true" name="product_category_id">
                                    <option value="{{ $product->product_category_id }}">
                                        {{ $product->product_catelogy->name }}
                                    </option>
                                    @foreach ($category as $ct)
                                        @if ($ct->id != $product->product_category_id)
                                            <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <label class="control-label">Đặc tả sản phẩm</label>
                            <select class="form-control select2 select2-hidden-accessible" data-select2-id="1"
                                tabindex="-1" aria-hidden="true" name="featured">
                                <option data-select2-id="3"value="0">Bình thường</option>
                                <option value="1">Nổi bật</option>
                                <option value="2">Hàng mới</option>
                                <option value="3">Giảm giá</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label class="control-label">Thương hiệu</label>
                            <select class="form-control select2 select2-hidden-accessible" data-select2-id="1"
                                tabindex="-1" aria-hidden="true"name="brand_id">
                                <option value="{{ $product->brand_id }}">
                                    {{ $product->Brand->name }}
                                </option>

                                @foreach ($brand as $bra)
                                    @if ($bra->id != $product->brand_id)
                                        <option value="{{ $bra->id }}">{{ $bra->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Ản Hiện Sản Phẩm</label> <br>
                                @if ($product->status === 0)
                                    <input type="radio" name='status' id="hien" value="0" checked>
                                    <label for="hien">Hiện sản phẩm</label>
                                    <input type="radio" name="status" id="an"value="1">
                                    <label for="an">Ẩn sản phẩm</label>
                                @elseif ($product->status === 1)
                                    <input type="radio" name='status' id="hien" value="0">
                                    <label for="hien">Hiện sản phẩm</label>
                                    <input type="radio" name="status" id="an"value="1" checked>
                                    <label for="an">Ẩn sản phẩm</label>
                                @endif>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="images">Hình ảnh</label>
                                <input type="file" id="imageFile" onchange="chooseFile(this)" name="file_upload"
                                    class="form-control" value="{{ $product->image }}"><br>
                                <img src="{{ asset('fonts/images') }}/{{ $product->image }}" alt=""
                                    id="image" width="100" height="100">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="productdesc">Mô Tả Sản phẩm</label>
                            <textarea class="form-control" id="summernote" name="description" rows="12"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-1 waves-effect waves-light col-sm-4"
                        style="margin-left: 10px">lưu</button>
                    <a style="float:right" href="{{ route('product.index') }}"
                        class="btn btn-secondary waves-effect col-sm-4">Thoát</a>
                </form>
            </div>

        </div>
    </div>
    </div>
@endsection
@section('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(function() {
            $('#summernote').summernote()
        })
    </script>
    <script>
        function chooseFile(fileInput) {
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image').attr('src', e.target.result);
                }
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
@endsection
