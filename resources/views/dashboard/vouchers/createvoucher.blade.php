@extends('dashboard.layouts.master')
@section('title', 'Tạo voucher')
@section('body')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Thêm voucher</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('voucher.index') }}"class="btn btn-primary float-end">Danh Sách voucher</a>
                    </div>
                </div>
                @if ($errors->any())
                    @foreach ($errors->all() as $err)
                        <p class="alert alert-danger">{{ $err }}</p>
                    @endforeach
                @endif

            </div>
            <div class="card-body">
                <form action="{{ route('voucher.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <strong>Mã Code</strong>
                                <input type="text" name='code' value="{{ old('code') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <strong>Giảm</strong>
                                <input type="number" name='voucher' value="{{ old('voucher') }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Lưu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
