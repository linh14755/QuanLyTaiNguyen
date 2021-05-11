@extends('layouts.layout')

@section('title')
    <title>Dashboard</title>
@endsection

@section('js')
    <script src="{{asset('file-manager-template/assets/js/sweetalert2@10.js')}}"></script>
    <script src="{{asset('admins/main.js')}}"></script>

@endsection

@section('content')

    <div class="content">
        <div class="page-header d-flex justify-content-between">
            <h2>Files</h2>
            <a href="#" class="files-toggler">
                <i class="ti-menu"></i>
            </a>
        </div>

        <div class="row">
            <div class="col-xl-3 files-sidebar">
                <div class="card border-0">
                    <h6 class="card-title">My Folders</h6>
                    {{--Cay thu phan loai--}}
                    <div class="sidebar-content">
                        <div>
                            <div class="list-group list-group-flush mb-3">
                                <a href="#" class="list-group-item px-0 d-flex align-items-center">
                                    <div class="mr-3">
                                        <figure class="avatar">
                                        <span class="avatar-title bg-primary-bright text-primary rounded">
                                            <i class="ti-image"></i>
                                        </span>
                                        </figure>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">Images</p>

                                    </div>

                                </a>
                                <a href="#" class="list-group-item px-0 d-flex align-items-center">
                                    <div class="mr-3">
                                        <figure class="avatar">
                                        <span class="avatar-title bg-primary-bright text-primary rounded">
                                            <i class="ti-control-play"></i>
                                        </span>
                                        </figure>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">Videos</p>

                                    </div>

                                </a>
                                <a href="#" class="list-group-item px-0 d-flex align-items-center">
                                    <div class="mr-3">
                                        <figure class="avatar">
                                        <span class="avatar-title bg-primary-bright text-primary rounded">
                                            <i class="ti-files"></i>
                                        </span>
                                        </figure>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">Documents</p>

                                    </div>

                                </a>
                                <a href="#" class="list-group-item px-0 d-flex align-items-center">
                                    <div class="mr-3">
                                        <figure class="avatar">
                                        <span class="avatar-title bg-primary-bright text-primary rounded">
                                            <i class="ti-file"></i>
                                        </span>
                                        </figure>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">Other Files</p>

                                    </div>

                                </a>
                            </div>
                        </div>

                    </div>
                    {{--Cay thu phan loai--}}

                </div>
            </div>
            <div class="col-xl-9">
                <div class="content-title mt-0">
                    <h4>duong dan</h4>
                </div>
                <div class="d-md-flex justify-content-between mb-4">
                    <ul class="list-inline mb-3">
                        <li class="list-inline-item mb-0">
                            <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                                Add
                            </a>
                            <div class="dropdown-menu">

                                <a data-url="" href=""
                                   class="dropdown-item action_add_folder">New Folder</a>

                                <a href="" class="dropdown-item">New File</a>
                            </div>
                        </li>
                        <li class="list-inline-item mb-0">
                            <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                                Tags
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Public</a>
                                <a class="dropdown-item" href="#">Project</a>
                                <a class="dropdown-item" href="#">Software</a>
                                <a class="dropdown-item" href="#">Social Media</a>
                                <a class="dropdown-item" href="#">Design</a>
                            </div>
                        </li>
                        <li class="list-inline-item mb-0">
                            <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                                Sort
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Ascending</a>
                                <a class="dropdown-item" href="#">Descending</a>
                            </div>
                        </li>
                    </ul>
                    <div id="file-actions" class="d-none">
                        <ul class="list-inline">
                            <li class="list-inline-item mb-0">
                                <a href="#" class="btn btn-outline-light" data-toggle="tooltip" title="Move">
                                    <i class="ti-arrow-top-right"></i>
                                </a>
                            </li>
                            <li class="list-inline-item mb-0">
                                <a href="#" class="btn btn-outline-light" data-toggle="tooltip"
                                   title="Download">
                                    <i class="ti-download"></i>
                                </a>
                            </li>
                            <li class="list-inline-item mb-0">
                                <a href="#" class="btn btn-outline-danger" data-toggle="tooltip" title="Delete">
                                    <i class="ti-trash"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                {{--Phan danh sach file va folder--}}

                {{--Phan danh sach file va folder--}}
            </div>
        </div>
    </div>

@endsection
