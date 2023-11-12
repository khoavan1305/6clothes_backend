@extends('dashboard.layouts.master')
@section('title', 'Danh Mục')
@section('body')
    <?php
    use App\Models\product;
    function countproduct($id)
    {
        $Product = product::where('product_category_id', $id)->get();
        return $Product->count();
    }
    ?>
    <div class="col-sm-9    container-fluid">
        <div class="row-lg"><br>
            <form action="" method="GET" class="form-inline" role="form">
                <div class="form-group">
                    <input type="text" name="key" class="form-control" placeholder="Nhập tên Danh Mục">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <br>
        <div class="row-xl">
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <h4 class="btn btn-warning"><i class="fa fa-users"></i> Danh Mục </h4>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('category.create') }}"class="btn btn-warning float-right"><i
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
                                        <th>Tên Danh Mục</th>
                                        <th>Số lượng sản phẩm</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($categorys as $category)
                                        <tr>
                                            <td class="serial">@php
                                                echo $i++;
                                            @endphp.</td>
                                            <td> #{{ $category->id }} </td>
                                            <td> <span class="text-left"> {{ $category->name }}</span> </td>
                                            <td> <span>
                                                    @php
                                                        echo countproduct($category->id);
                                                    @endphp
                                                    Sản phẩm
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('category.edit', $category->id) }}"
                                                    class=" btn btn-warning">
                                                    <i class="fa fa-edit"></i> Sửa</a>
                                                <a href="{{ route('category.destroy', $category->id) }}"
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
                    {{ $categorys->appends(request()->all())->links() }}
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
