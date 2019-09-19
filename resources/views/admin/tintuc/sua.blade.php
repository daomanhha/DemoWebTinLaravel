@extends('admin.layouts.index')
@section('content')
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tức
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
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($theloais))
                            <div class="form-group">
                                <label>TheLoai</label>
                                <select class="form-control" name="TheLoai" id= "TheLoai">
                                        <option value="">Mời chọn thể loại</option>
                                        @foreach($theloais as $tl)
                                            <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                        @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="form-group">
                            <label>LoaiTin</label>
                            <select class="form-control" name="LoaiTin" id = "LoaiTin">
                                <option value="">Mời chọn thể loại</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiêu Đề</label>
                            <input class="form-control" name="tieude" placeholder="Mời Nhập tiêu đề" />
                        </div>
                        <div class="form-group">
                            <label>Tóm Tắt</label>
                            <textarea name="tomtat" id="demo" class="form-control ckeditor" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label><input type="file" name="img">Nhập file</label>
                        </div>
                        <div class="form-group">
                                <label>Nổi Bật:</label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="1" checked type="radio">Nổi bật
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="0" type="radio">Không nối bật
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
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh Sách
                    </h1>
                </div>
                @if(Session('thongbao'))
                    <div class="alert alert-success">
                        {{Session('thongbao')}}
                    </div>
                @endif
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>User</th>
                            <th>NoiDung</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                         @if(isset($comments))
                            @foreach($comments as $comment)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$comment->id}}</td>
                                    <td>{{$comment->user->name}}</td>
                                    <td>{{$comment->NoiDung}}</td>
                                    
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$comment->id}}">Edit</a></td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/delete/{{$comment->id}}" onclick="return confirm('Bạn muốn có muốn xóa không?')"> Delete</a></td>
                                </tr>
                            @endforeach
                         @endif

                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('#TheLoai').change(function(){
            let idTheLoai =  $('#TheLoai').val() || 0;
            $.ajax({
                url : 'admin/ajax/tintuc/'+idTheLoai,
                type: 'get',
                dataType: 'text',
                success($result){
                    $('#LoaiTin').html($result);
                }
            })
        });
    </script>
@endsection
