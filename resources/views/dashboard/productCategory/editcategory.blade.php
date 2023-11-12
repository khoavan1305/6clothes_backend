@extends('dashboard.layouts.master')
@section('title', 'Sửa danh mục')
@section('body')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Cập nhật danh mục</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('category.index') }}"class="btn btn-primary float-end">Danh Sách danh mục</a>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif
            <div class="card-body">
                <form action="{{ route('category.update', $category->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <input type="hidden" value="{{ $category->id }}">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <strong>Tên</strong>
                                <input type="text" name='name' class="form-control" value="{{ $category->name }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Lưu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
