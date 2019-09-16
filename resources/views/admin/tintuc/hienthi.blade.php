@extends('admin.layouts.index')
@section('content')
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
                            <th>Name</th>
                            <th>TomTat</th>
                            <th>NoiDung</th>
                            <th>Hinh</th>
                            <th>SoLuotXem</th>
                            <th>NoiBat</th>
                            <th>LoaiTin</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                         @if(isset($tintucs))
                            @foreach($tintucs as $tt)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$tt->id}}</td>
                                    <td>{{$tt->TieuDe}}</td>
                                    <td>{{$tt->TomTat}}</td>
                                    <td>{!!$tt->NoiDung!!}</td>
                                    <td>{{$tt->Hinh}}</td>
                                    <td>{{$tt->SoLuotXem}}</td>
                                    <td>{{$tt->NoiBat}}</td>
                                    <td>{{$tt->loaitin->Ten}}</td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/theloai/sua/{{$tt->id}}">Edit</a></td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/theloai/delete/{{$tt->id}}" onclick="return confirm('Bạn muốn có muốn xóa không?')"> Delete</a></td>
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