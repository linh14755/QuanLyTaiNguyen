@extends('layouts.layout2')

@section('title')
    <title>Vai trò</title>
@endsection

@section('js')
    <script src="{{asset('admins/user/user.js')}}"></script>
    <script src="{{asset('file-manager-template/assets/js/sweetalert2@10.js')}}"></script>
@endsection

@section('content')

    <div class="content">
        <div class="page-header d-flex justify-content-between">

        </div>
        <div class="row">
            <div class="col-xl-3 files-sidebar">
                <div class="card border-0">

                </div>
            </div>
            <div class="col-xl-9">
                <div class="content-title mt-0 ">
                    <h4>Vai trò
                        @can('add_role')
                            <a href="{{route('role.create')}}" class="btn btn-outline-success float-right">Add</a>
                        @endcan
                    </h4>
                </div>

                {{--Table danh sach user--}}

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Tên hiển thị</th>
                        <th scope="col">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <th scope="row">{{$role->id}}</th>
                            <td>{{$role->name}}</td>
                            <td>{{$role->display_name}}</td>

                            <td>
                                @can('edit_role')
                                    <a href="{{route('role.edit',['id'=>$role->id])}}"
                                       class="btn btn-outline-github">Edit</a>
                                @endcan
                                @can('delete_role')
                                    <a href=""
                                       data-url="{{route('role.delete',['id'=>$role->id])}}"
                                       class="btn btn-outline-danger action_delete">Delete</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    <td>
                        {{$roles->links()}}
                    </td>
                    </tbody>
                </table>

                {{--Table danh sach user--}}

            </div>
        </div>
    </div>

@endsection
