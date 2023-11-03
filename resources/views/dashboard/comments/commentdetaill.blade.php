@extends('dashboard.layouts.master')
@section('title', 'Bình Luận')
@section('body')

    <!-- Orders -->
    <div class="orders container-fluid">
        <div class="row container">
            <div class="">
                <div class="card container">
                    <div class="card-body container">
                        <h4 class="btn btn-warning">Chi Tiết Bình Luận </h4>
                    </div>
                    <form action="{{ route('comment.update', $comment->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-body container">
                            <select class="form-control" aria-hidden="true" name="status">
                                <option value="0">Hiện</option>
                                <option value="1">Ẩn</option>
                            </select>
                            <br>
                            <button type="submit" class="btn btn-success w-100">Cập Nhật</button>
                        </div>
                    </form>
                    <div class="card-body-- container">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Product_ID</th>
                                        <th class="text-center">User_ID</th>
                                        <th class="text-center">E-Mail</th>
                                        <th class="text-center">Tên</th>
                                        <th class="text-center">Bình luận</th>
                                        <th class="text-center">Đánh giá</th>
                                        <th class="text-center">Ngày Đăng </th>
                                        <th class="text-center">Trạng Thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    <tr>
                                        <td class="serial">@php
                                            echo $i++;
                                        @endphp.</td>

                                        <td class="text-center"> #{{ $comment->id }} </td>
                                        <td class="text-center"> <img
                                                src="{{ asset('fonts/images') }}/{{ $comment->products['image'] }}"
                                                alt="">
                                        </td>
                                        <td class="text-center"> <span> {{ $comment->user_id }}</span> </td>
                                        <td class="text-center"> <span>{{ $comment->email }}</span> </td>
                                        <td class="text-center"> <span>{{ $comment->name }}</span> </td>
                                        <td class="text-center"><span>{{ $comment->messages }}</span></td>
                                        <td class="text-center"><span>{{ $comment->rating }} <i class="fa fa-star"></i>
                                            </span></td>
                                        <td class="text-center"><span>{{ $comment->created_at }}</span></td>
                                        <td class="text-center">
                                            @if ($comment->status == 0)
                                                <span class="badge badge-complete">Hiện</span>
                                            @elseif ($comment->status == 1)
                                                <span class="badge badge-secondary"> Ẩn</span>
                                            @endif
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                        </div> <!-- /.table-stats -->

                    </div>

                </div> <!-- /.card -->

            </div> <!-- /.col-lg-8 -->
        </div>
    </div>


@endsection
