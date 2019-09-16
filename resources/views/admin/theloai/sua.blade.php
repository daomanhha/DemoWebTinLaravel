@extends('admin.layouts.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>Thể Loại</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/theloai/sua/{{$theloai->id}}" method="POST">
                    @csrf
                    @if(count($errors) > 0)
                        @foreach($errors->all() as $err)
                            <div class="alert alert-danger">
                                {{$err}}
                            </div>
                        @endforeach
                    @endif
                    @if(Session('thongbao'))
                        <div class="alert alert-success">
                                {{Session('thongbao')}}
                        </div>
                    @endif
                    <div class="form-group">
                       <label>Nhập tên muốn sửa</label>
                        <input class="form-control" name="Name" placeholder="{{$theloai->Ten}}"  />
                    </div>
                    <button type="submit" class="btn btn-default">Category Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection