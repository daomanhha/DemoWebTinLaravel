@extends('admin.layouts.index')
@section('content')
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sửa
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
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="name" placeholder="Mời Nhập tên" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="Mời Nhập gmail" />
                        </div>
                        <div class="form-group">
                            <label>Quyen</label>
                            <input class="form-control" name="quyen" placeholder="Mời Nhập quyền" />
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
