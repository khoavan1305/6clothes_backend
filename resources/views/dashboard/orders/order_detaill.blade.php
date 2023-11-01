@extends('dashboard.layouts.master')
@section('title', 'Order')
@section('body')

    <!-- Orders -->
    <div class="orders container-fluid">
        <div class="row container">
            <div class="">
                <div class="card container">
                    <div class="card-body container">
                        <h4 class="btn btn-warning">Chi Tiết Hóa Đơn </h4>
                    </div>
                    <form action="{{ route('order.update', $order->order_id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-body container">
                            <select class="form-control" aria-hidden="true" name="status">
                                <option value="{{ $order->order['status'] }}">
                                    @if ($order->order['status'] == 0)
                                        <span class="badge badge-danger">Chưa xác nhận</span>
                                <option value="1">Đã xác nhận</option>
                                <option value="2">Đã thanh toán</option>
                                <option value="3">Đang vận chuyển</option>
                                <option value="4">Hoàn thành</option>
                                <option value="5">Hủy đơn hàng</option>
                                @endif
                                @if ($order->order['status'] == 1)
                                    <span class="badge badge-complete">Đã xác nhận</span>
                                    <option value="0">Chưa xác nhận</option>
                                    <option value="2">Đã thanh toán</option>
                                    <option value="3">Đang vận chuyển</option>
                                    <option value="4">Hoàn thành</option>
                                    <option value="5">Hủy đơn hàng</option>
                                @endif
                                @if ($order->order['status'] == 2)
                                    <span class="badge badge-primary">Đã thanh toán</span>
                                    <option value="0">Chưa xác nhận</option>
                                    <option value="1">Đã xác nhận</option>
                                    <option value="3">Đang vận chuyển</option>
                                    <option value="4">Hoàn thành</option>
                                    <option value="5">Hủy đơn hàng</option>
                                @endif
                                @if ($order->order['status'] == 3)
                                    <span class="badge badge-warning">Đang vận chuyển</span>
                                    <option value="0">Chưa xác nhận</option>
                                    <option value="1">Đã xác nhận</option>
                                    <option value="2">Đã thanh toán</option>
                                    <option value="4">Hoàn thành</option>
                                    <option value="5">Hủy đơn hàng</option>
                                @endif
                                @if ($order->order['status'] == 4)
                                    <span class="badge badge-info">Hoàn thành</span>
                                    <option value="0">Chưa xác nhận</option>
                                    <option value="1">Đã xác nhận</option>
                                    <option value="2">Đã thanh toán</option>
                                    <option value="3">Đang vận chuyển</option>
                                    <option value="5">Hủy đơn hàng</option>
                                @endif
                                @if ($order->order['status'] == 5)
                                    <span class="badge badge-secondary">Hủy</span>
                                    <option value="0">Chưa xác nhận</option>
                                    <option value="1">Đã xác nhận</option>
                                    <option value="2">Đã thanh toán</option>
                                    <option value="3">Đang vận chuyển</option>
                                    <option value="4">Hoàn thành</option>
                                @endif
                                </option>
                            </select>
                            <br>
                            <button type="submit" class="btn btn-success w-100">Gửi</button>
                        </div>
                    </form>
                    <div class="card-body-- container">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr class="text-center">
                                        <th class="serial">#</th>
                                        <th>Mã Hóa Đơn</th>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Kích thước </th>
                                        <th>Màu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($order_detaill as $Order)
                                        <tr class="text-center">
                                            <td class="serial">@php
                                                echo $i++;
                                            @endphp.</td>
                                            <td> #{{ $Order->order_id }} </td>
                                            <td> <img src="{{ asset('dashboard/images/') }}/{{ $Order->product['image'] }}"
                                                    alt=""> </td>
                                            <td> <span>{{ $Order->amount }}</span> </td>
                                            <td> <span>{{ $Order->size }}</span> </td>
                                            <td> <span>{{ $Order->color }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div> <!-- /.table-stats -->

                    </div>

                </div> <!-- /.card -->

            </div> <!-- /.col-lg-8 -->
        </div>
    </div>


@endsection
