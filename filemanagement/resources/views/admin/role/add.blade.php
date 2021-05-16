@extends('layouts.layout2')

@section('title')
    <title>Thêm vai trò</title>
@endsection
@section('css')
    <link href="{{asset('admins/main.css')}}" rel="stylesheet"/>

    <link href="{{asset('admins/select2.min.css')}}" rel="stylesheet"/>

@endsection

@section('js')
    <script src="{{asset('admins/select2.min.js')}}"></script>
    <script>
        $('.checkbox_wrapper').on('click', function () {
            $(this).parents('.card').find('.checkbox_children').prop('checked', $(this).prop('checked'))
        })
    </script>
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
                    <h4>Thêm vai trò</h4>
                </div>

                {{--Table danh sach user--}}

                <form class="mb-5" action="{{route('role.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tên vai trò</label>
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   placeholder=" Nhập tên vai trò"
                                   value="{{old('name')}}">
                            @error('name')
                            <div class="alert alert-danger-custom">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Mô tả vai trò</label>
                            <input name="display_name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Nhập mô tả vai trò"
                                   value="{{old('display_name')}}">
                            @error('display_name')
                            <div class="alert alert-danger-custom">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        @foreach($roleParents as $roleParent)
                            <div class="card text-white bg-dark-gradient mb-3">
                                <div class="card-header">
                                    <input type="checkbox" class="checkbox_wrapper">
                                    <lable>Modul {{$roleParent->display_name}}</lable>
                                </div>
                                <div class="card-body" style="background: #ec4646">
                                    <div class="row">
                                        @foreach($roleParent->permissionChildren as $perChild)
                                            <div class="col-md-3">
                                                <input class="checkbox_children" type="checkbox" name="permission_id[]"
                                                       value="{{$perChild->id}}">
                                                <lable>{{$perChild->display_name}}</lable>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>

                {{--Table danh sach user--}}

            </div>
        </div>
    </div>

@endsection
