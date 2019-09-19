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
                            <th>Email</th>
                            <th>Quyen</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                         @if(isset($users))
                            @foreach($users as $user)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->quyen}}</td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/user/sua/{{$user->id}}">Edit</a></td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/user/delete/{{$user->id}}" onclick="return confirm('Bạn muốn có muốn xóa không?')"> Delete</a></td>
                                    
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