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
                    <form action="" method="POST">
                        @csrf
                        @if(isset($theloais))
                            <div class="form-group">
                                <label>TheLoai</label>
                                <select class="form-control" name="idTheLoai" id= "TheLoai">
                                        <option value="">Mời chọn thể loại</option>
                                        @foreach($theloais as $tl)
                                            <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                        @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="form-group">
                            <label>LoaiTin</label>
                            <select class="form-control" name="idTheLoai" id = "LoaiTin">
                                <option value="">Mời chọn thể loại</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>TinTuc</label>
                            <input class="form-control" name="loaitin" placeholder="Please Enter Category Name" />
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
