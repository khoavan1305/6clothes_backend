@extends('dashboard.layouts.master')
@section('title', 'Voucher')
@section('body')
    <div class="col-sm-9    container-fluid">
        <div class="row-lg"><br>
        </div>
        <br>
        <div class="row-xl">
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <h4 class="btn btn-warning"><i class="fa fa-users"></i> Voucher </h4>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('voucher.create') }}"class="btn btn-warning float-right"><i
                                    class="fa fa-plus"></i>
                                Thêm mới</a>
                        </div>
                    </div>
                    @if (Session::has('thongbao'))
                        <div class="alert alert-success">
                            {{ Session::get('thongbao') }}
                        </div>
                    @endif
                    <div class="">
                        <div class="table-stats order-table ov-h">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>ID</th>
                                        <th>Mã Khuyến Mãi</th>
                                        <th>Giảm</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($vouchers as $voucher)
                                        <tr>
                                            <td class="serial">@php
                                                echo $i++;
                                            @endphp.</td>
                                            <td> #{{ $voucher->id }} </td>
                                            <td> <span class="text-left"> {{ $voucher->code }}</span> </td>
                                            <td> <span>{{ number_format($voucher->voucher, 3) }} VNĐ</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('voucher.edit', $voucher->id) }}"
                                                    class=" btn btn-warning">
                                                    <i class="fa fa-edit"></i> Sửa</a>
                                                <a href="{{ route('voucher.destroy', $voucher->id) }}"
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
                <div class="float-right">
                    {{ $vouchers->appends(request()->all())->links() }}
                </div>
            </div> <!-- /.col-lg-8 -->
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
