@extends('dashboard.layouts.master')
@section('title', 'Order')
@section('body')
    <div style="padding-left: 20px">
        <div class="col-sm">
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <h4 class="btn btn-warning">Đơn Hàng </h4>
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
                                        <th>ID</th>
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>SĐT</th>
                                        <th>Địa chỉ </th>
                                        <th>Ghi chú</th>
                                        <th>Ngày tạo đơn hàng</th>
                                        <th>PTTT</th>
                                        <th>Tổng Tiền</th>
                                        <th>Trạng Thái</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($Orders as $Order)
                                        <tr>
                                            <td class="serial">@php
                                                echo $i++;
                                            @endphp.</td>

                                            <td> #{{ $Order->id }} </td>
                                            <td> #{{ $Order->first_name . ' ' . $Order->last_name }} </td>
                                            <td> <span> {{ $Order->email }}</span> </td>
                                            <td> <span>{{ $Order->phone }}</span> </td>
                                            <td> <span>{{ $Order->street_address }}</span> </td>
                                            <td> <span>{{ $Order->note }}</span></td>
                                            <td> <span>{{ $Order->created_at }}</span></td>
                                            <td> <span>{{ $Order->pttt }}</span></td>
                                            <td> <span>{{ number_format($Order->total, 3) }}<strong>đ</strong></span></td>
                                            <td>
                                                @if ($Order->status == 0)
                                                    <span class="badge badge-danger">Chưa xác nhận</span>
                                                @endif
                                                @if ($Order->status == 1)
                                                    <span class="badge badge-complete">Đã xác nhận</span>
                                                @endif
                                                @if ($Order->status == 2)
                                                    <span class="badge badge-primary">Đã thanh toán</span>
                                                @endif
                                                @if ($Order->status == 3)
                                                    <span class="badge badge-warning">Đang vận chuyển</span>
                                                @endif
                                                @if ($Order->status == 4)
                                                    <span class="badge badge-info">Hoàn thành</span>
                                                @endif
                                                @if ($Order->status == 5)
                                                    <span class="badge badge-secondary">Hủy</span>
                                                @endif
                                                @if ($Order->status == 6)
                                                    <span class="badge badge-secondary">Chưa thanh toán</span>
                                                @endif
                                            </td>
                                            <td><a href="{{ route('orderdetail.show', $Order->id) }}"
                                                    class="btn btn-success">chi
                                                    tiết</a></td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- /.table-stats -->
                    </div>
                </div> <!-- /.card -->
            </div> <!-- /.col-lg-8 -->
            <div class="float-right">
                {{ $Orders->appends(request()->all())->links() }}

            </div>

        </div>
    </div>


@endsection
