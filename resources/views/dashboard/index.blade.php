@extends('dashboard.layouts.master')
@section('title', 'Home')
@section('body')
    <!-- Content -->
    <div class="content">
        <!-- Animated -->
        <div class="animated fadeIn">
            <!-- Widgets  -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <a href="{{ route('product.index') }}">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-box2"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">{{ $Products->count('id') }}</span>
                                            </div>
                                            <div class="stat-heading">Sản phẩm</div>
                                        </div>
                                    </div>
                                </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <a href="{{ route('user.index') }}">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-2">
                                    <i class="pe-7s-users"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{ $Users->count('id') }}</span></div>
                                        <div class="stat-heading">Thành Viên</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <a href="">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-3">
                                    <i class="pe-7s-browser"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{ $Order->count('id') }}</span></div>
                                        <div class="stat-heading">Đơn Hàng</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <a href="">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-3">
                                    <i class="pe-7s-cash"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="">{{ number_format($total, 3, ',') }}
                                                đ</span>
                                        </div>
                                        <div class="stat-heading">Doanh thu</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
    </div> <!-- /.card -->
    </div> <!-- /.col-lg-8 -->



@endsection
