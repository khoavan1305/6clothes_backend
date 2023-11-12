@extends('dashboard.layouts.master')
@section('title', 'Edit voucher')
@section('body')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Cập nhật voucher</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('voucher.index') }}"class="btn btn-primary float-end">Danh Sách voucher</a>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif
            <div class="card-body">
                <form action="{{ route('voucher.update', $voucher->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <input type="hidden" value="{{ $voucher->id }}">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <strong>Tên</strong>
                                <input type="text" name='code' class="form-control" value="{{ $voucher->code }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <strong>Tên</strong>
                                <input type="number" name='voucher' class="form-control" value="{{ $voucher->voucher }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Lưu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
