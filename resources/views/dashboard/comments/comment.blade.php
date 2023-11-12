@extends('dashboard.layouts.master')
@section('title', 'Product_comment')
@section('body')

    <!-- Orders -->
    <div class="orders container">
        <div class="row">
            <div class="">
                <br>
                <div class="row-xl">
                    <form action="" method="GET" class="form-inline" role="form">
                        <div class="form-group">
                            <input type="text" name="key" class="form-control" placeholder="Nhập Email">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <h4 class="btn btn-warning">Đánh Giá Sản Phẩm</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Product_ID</th>
                                        <th class="text-center">User_ID</th>
                                        <th class="text-center ">E-Mail</th>
                                        <th class="text-center w-50">Tên</th>
                                        <th class="text-center w-100">Bình luận</th>
                                        <th class="text-center">Đánh giá</th>
                                        <th class="text-center">Ngày Đăng </th>
                                        <th class="text-center">Trạng Thái</th>
                                        <th class="text-center">Hành Động </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($Product_comment as $Product_cm)
                                        <tr>
                                            <td class="serial">@php
                                                echo $i++;
                                            @endphp.</td>

                                            <td class="text-center"> #{{ $Product_cm->id }} </td>
                                            <td class="text-center">
                                                <img
                                                    src="{{ asset('fonts/images') }}/{{ $Product_cm->products['image'] }}"alt="">
                                            <td class="text-center"> <span> {{ $Product_cm->user_id }}</span> </td>
                                            <td class="text-center"> <span>{{ $Product_cm->email }}</span> </td>
                                            <td class="text-center"> <span>{{ $Product_cm->name }}</span> </td>
                                            <td class="text-center"><span>{{ $Product_cm->messages }}</span></td>
                                            <td class="text-center"><span>{{ $Product_cm->rating }} <i
                                                        class="fa fa-star"></i> </span></td>
                                            <td class="text-center"><span>{{ $Product_cm->created_at }}</span></td>
                                            <td class="text-center">
                                                @if ($Product_cm->status == 0)
                                                    <span class="badge badge-complete">Hiện</span>
                                                @elseif ($Product_cm->status == 1)
                                                    <span class="badge badge-secondary"> Ẩn</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('comment.show', $Product_cm->id) }}"
                                                    class=" btn btn-success ">
                                                    <i class="fa fa-edit"></i> Chi tiết</a>
                                                <hr>
                                                <a href="{{ route('comment.destroy', $Product_cm->id) }}"
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
                {{ $Product_comment->appends(request()->all())->links() }}
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
