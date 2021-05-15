@extends('layouts.layout2')

@section('title')
    <title>Chỉnh sửa người dùng</title>
@endsection
@section('css')
    <link href="{{asset('admins/main.css')}}" rel="stylesheet"/>

    <link href="{{asset('admins/select2.min.css')}}" rel="stylesheet"/>

@endsection

@section('js')
    <script src="{{asset('admins/select2.min.js')}}"></script>
    <script>
        $('.select2_init').select2({
            'placeholder':'Chọn vai trò'
        });
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
                    <h4>Chỉnh sửa người dùng</h4>
                </div>

                {{--Table danh sach user--}}

                <form class="mb-5" action="{{route('user.update',['id'=>$userEdit->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Tên người dùng</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Tên người dùng" value="{{$userEdit->name}}">
                        @error('name')
                        <div class="alert alert-danger-custom">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ email</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Địa chỉ email" value="{{$userEdit->email}}">
                        @error('email')
                        <div class="alert alert-danger-custom">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input name="password" type="password" class="form-control" placeholder="Mật khẩu">
                    </div>
                    <div class="form-group">
                        <label>Ảnh đại diện</label>
                        <input type="file"  name="image_path" class="input-group">
                    </div>
                    <div class="form-group">
                        <img src="{{asset($userEdit->image_path)}}" class="w-20 h-20">
                    </div>
                    <div class="form-group">
                        <label>Chọn vai trò</label>
                        <select name="role_id[]" class="form-control select2_init" multiple>
                            <option value="">Chọn vai trò</option>

                            @foreach($roles as $role)
                                <option
                                    {{($rolesOfUser->contains('id',$role->id) ? 'selected':'')}}
                                    value="{{$role->id}}">{{$role->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                {{--Table danh sach user--}}

            </div>
        </div>
    </div>

@endsection
