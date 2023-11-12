@extends('dashboard.layouts.master')
@section('title', 'Product')
@section('body')

    <!-- Orders -->
    <div class="col-xl container-fluid">
        <div class="row-lg"><br>
            <div class="row-xl">
                <form action="" method="GET" class="form-inline" role="form">
                    <div class="form-group">
                        <input type="text" name="key" class="form-control" placeholder="Nhập tên sản phẩm">
                        {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <br>
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <h4 class="btn btn-warning"><i class="fa  fa-archive"></i> Sản Phẩm </h4>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('product.create') }}"class="btn btn-warning float-right"><i
                                    class="fa fa-plus"></i>
                                Thêm mới</a>
                        </div>
                    </div>
                    @if (Session::has('thongbao'))
                        <div class="alert alert-success">
                            {{ Session::get('thongbao') }}
                        </div>
                    @endif
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th class="avatar">Product</th>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Tên</th>
                                        <th class="text-center" style="min-width: 300px">Mô tả</th>
                                        <th class="text-center">Giá</th>
                                        <th class="text-center">discount</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Ẩn / Hiện</th>
                                        <th class="text-center">Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($Products as $Product)
                                        <tr>
                                            <td class="serial">@php
                                                echo $i++;
                                            @endphp.</td>
                                            <td class="avatar">
                                                <div class="round-img">
                                                    <a href="#"><img class="rounded-circle"
                                                            src="{{ asset('fonts/images') }}/{{ $Product->image }}"
                                                            alt=""></a>
                                                </div>

                                            </td>
                                            <td class="text-center"> {{ $Product->id }} </td>
                                            <td class="text-center"> <span class="name"> {{ $Product->name }}</span> </td>
                                            <td class="text-center"> <span class="email"
                                                    style="max-width: 100px">{{ $Product->description }}</span> </td>
                                            <td class="text-center"><span
                                                    class="password">{{ number_format($Product->price, 3) }} VNĐ</span>
                                            </td>
                                            <td class="text-center"><span
                                                    class="name">{{ number_format($Product->discount, 3) }} VNĐ</span>
                                            </td>
                                            <td class="text-center">
                                                @if ($Product->amount > 0)
                                                    <span class="badge badge-complete">Còn Hàng</span>
                                                @elseif ($Product->amount == 0)
                                                    <span class="badge badge-danger">Hết Hàng</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($Product->status == 0)
                                                    <span class="badge badge-complete">Hiện</span>
                                                @elseif ($Product->status == 1)
                                                    <span class="badge badge-secondary">Ẩn</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('product.edit', $Product->id) }}"
                                                    class=" btn btn-warning">
                                                    <i class="fa fa-edit"></i> Sửa</a>
                                                <hr>

                                                <a href="{{ route('product.destroy', $Product->id) }}"
                                                    class=" btn btn-danger btndelete"><i class="fa fa-trash"></i>
                                                    Xóa</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <form action="" method="POST" id="form-delete">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div> <!-- /.table-stats -->
                    </div>

                </div> <!-- /.card -->

            </div> <!-- /.col-lg-8 -->
            <div class="float-right">
                {{ $Products->appends(request()->all())->links() }}
            </div>

        </div>

    </div>

@endsection
@section('js')
    <script>
        $(".btndelete").click(function(e) {
            e.preventDefault();
            var _href = $(this).attr('href');
            $('form#form-delete').attr('action', _href);
            if (confirm("Bạn có chắc muốn xóa không")) {
                $('form#form-delete').submit();
            }

        });
    </script>
@endsection
