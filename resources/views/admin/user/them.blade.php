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
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="name" placeholder="Please Enter Category Name" />
                        </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="Please Enter Category Name" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" name="password" placeholder="Please Enter Category Name" />
                        </div>
                        <div class="form-group">
                            <label>Nhập lại pass</label>
                            <input class="form-control" name="repassword" placeholder="Please Enter Category Name" />
                        </div>
                      <div class="form-group">
                            <label>Quyền:</label>
                            <label class="radio-inline">
                                <input name="rdoStatus" value="1"  type="radio">Admin
                            </label>
                            <label class="radio-inline">
                                <input name="rdoStatus" value="0" checked type="radio">Thường
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Them</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
