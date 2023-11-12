@extends('dashboard.layouts.master')
@section('title', 'Tài Khoản')
@section('body')

    <div class="col-xl-9 container-fluid">
        <div class="row-lg"><br>
            <form action="" method="GET" class="form-inline" role="form">
                <div class="form-group">
                    <input type="text" name="key" class="form-control" placeholder="Nhập Email">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <br>
        <div class="row-xl">
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <h4 class="btn btn-warning"><i class="fa fa-users"></i> Tài khoản </h4>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('user.create') }}"class="btn btn-warning float-right"><i
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
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th class="avatar">Avatar</th>
                                        <th>ID</th>
                                        <th style="min-width: 100px">Tên</th>
                                        <th>Email</th>
                                        <th style="min-width: 100px">Cấp độ tài khoản</th>
                                        <th style="min-width: 100px">Tình trạng</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($Users as $User)
                                        <tr>
                                            <td class="serial">@php
                                                echo $i++;
                                            @endphp.</td>
                                            <td class="avatar">
                                                <div class="round-img">
                                                    <a href="#"><img class="rounded-circle"
                                                            src="{{ asset('fonts/avatars/') }}/{{ $User->avatar ?? '5.jpg' }}"
                                                            alt=""></a>
                                                </div>
                                            </td>
                                            <td> #{{ $User->id }} </td>
                                            <td> <span class="name"> {{ $User->name }}</span> </td>
                                            <td> <span class="email">{{ $User->email }}</span> </td>
                                            <td>
                                                @if ($User->level == 1)
                                                    <span class="name">Quản trị</span>
                                                @elseif ($User->level == 2)
                                                    <span class="name">Khách hàng</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($User->status == 1)
                                                    <span class="badge badge-complete">Hoạt Động</span>
                                                @elseif ($User->status == 0)
                                                    <span class="badge badge-danger">Vô Hiệu Hóa</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('user.edit', $User->id) }}" class=" btn btn-warning">
                                                    <i class="fa fa-edit"></i> Sửa</a>
                                                <a href="{{ route('user.destroy', $User->id) }}"
                                                    class=" btn btn-danger btndelete"><i class="fa fa-trash"></i>
                                                    Xóa</a>
                                                <hr>
                                                <a href="{{ route('unblock', $User->id) }}"
                                                    class=" btn btn-success w-50 btnupdate"><i class="fa fa-key"></i>
                                                    Mở</a>
                                                <a href="{{ route('block', $User->id) }}"
                                                    class=" btn btn-danger btnupdate"><i class="fa fa-lock"></i>
                                                    Khóa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <form action="" method="POST" id="form-delete">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div> <!-- /.card -->
                <div class="float-right">
                    {{ $Users->appends(request()->all())->links() }}
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
