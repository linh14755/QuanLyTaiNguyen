@extends('layouts.layout2')

@section('title')
    <title>Người dùng</title>
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
                    <h4>Người dùng
                        @can('add_user')
                            <a href="{{route('user.create')}}"
                               class="btn btn-outline-success float-right">Add</a>
                        @endcan
                    </h4>
                </div>

                {{--Table danh sach user--}}

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>

                            <td>
                                @can('edit_user')
                                    <a href="{{route('user.edit',['id'=>$user->id])}}"
                                       class="btn btn-outline-github">Edit</a>
                                @endcan
                                @can('delete_user')
                                    <a href=""
                                       data-url="{{route('user.delete',['id'=>$user->id])}}"
                                       class="btn btn-outline-danger action_delete">Delete</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    <td>
                        {{$users->links()}}
                    </td>
                    </tbody>
                </table>

                {{--Table danh sach user--}}

            </div>
        </div>
    </div>

@endsection
