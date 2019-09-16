@extends('admin.layouts.index')
@section('content')
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) > 0 )
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
                    <form action="" method="POST">
                        @csrf
                        @if(isset($theloais))
                            <div class="form-group">
                            <label>TheLoai</label>
                            <select class="form-control" name="idTheLoai">
                                    <option 
                                        value="{{$theloai->id}}">
                                        {{$theloai->Ten}}
                                    </option>
                                @foreach($theloais as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                            </div>
                        @endif
                        <div class="form-group">
                            <label>LoạiTin</label>
                            <input class="form-control" name="loaitin" placeholder="{{$loaitin->Ten}}" />
                        </div>
                        <button type="submit" class="btn btn-default">Sửa</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
