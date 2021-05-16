@extends('layouts.layout')

@section('title')
    <title>Dashboard</title>
@endsection

@section('css')
    {{$parentid = 0}}

    {{$images_files = 0}}
    {{$images_size = 0}}

    {{$videos_files = 0}}
    {{$videos_size = 0}}

    {{$document_files = 0}}
    {{$document_size = 0}}

    {{$other_files = 0}}
    {{$other_size = 0}}


@endsection

@section('js')
    <script src="{{asset('file-manager-template/assets/js/sweetalert2@10.js')}}"></script>
    <script src="{{asset('admins/main.js')}}"></script>

@endsection

@section('content')

    <form action="{{route('dashboard.multi_download')}}">

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
                        {{--Cay thu muc--}}
                        <div class="sidebar primary-sidebar show" id="storage">

                            <div class="sidebar-content">

                                <div>
                                    <div class="list-group list-group-flush mb-3">
                                        <a href="{{route('dashboard.selected',['id'=>'images'])}}"
                                           class="list-group-item px-0 d-flex align-items-center">
                                            <div class="mr-3">
                                                <figure class="avatar">
                                        <span class="avatar-title bg-primary-bright text-primary rounded">
                                            <i class="ti-image"></i>
                                        </span>
                                                </figure>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0">Ảnh</p>

                                            </div>

                                        </a>
                                        <a href="{{route('dashboard.selected',['id'=>'videos'])}}"
                                           class="list-group-item px-0 d-flex align-items-center">
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
                                        <a href="{{route('dashboard.selected',['id'=>'documents'])}}"
                                           class="list-group-item px-0 d-flex align-items-center">
                                            <div class="mr-3">
                                                <figure class="avatar">
                                        <span class="avatar-title bg-primary-bright text-primary rounded">
                                            <i class="ti-files"></i>
                                        </span>
                                                </figure>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0">Tài liệu</p>

                                            </div>

                                        </a>
                                        <a href="{{route('dashboard.selected',['id'=>'other_files'])}}"
                                           class="list-group-item px-0 d-flex align-items-center">
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
                        </div>
                        {{--Cay thu muc--}}
                    </div>
                </div>

                <div class="col-xl-9">
                    <div class="content-title mt-0">
                        <h4>Tất cả file</h4>
                    </div>
                    <div class="d-md-flex justify-content-between mb-4">
                        <ul class="list-inline mb-3">

                            <li class="list-inline-item mb-0">
                                <div class="input-group">

                                    <input id="searchInput" type="text" class="form-control" placeholder="Tìm kiếm...">

                                </div>
                            </li>
                        </ul>
                        <div id="file-actions" class="d-none">
                            <ul class="list-inline">
                                @can('download_dashboard')
                                    <li class="list-inline-item mb-0">
                                        <button type="submit" class="btn btn-primary">Đồng ý</button>
                                    </li>
                                    <li class="list-inline-item mb-0">
                                        <div class="form-group p-1 border border-primary rounded">
                                            <input type="radio" value="checkDownload" name="checkCheck">
                                            <lable>Tải xuống</lable>
                                            <i class="ti-download"></i>
                                        </div>
                                    </li>
                                @endcan
                                @can('delete_dashboard')
                                    <li class="list-inline-item mb-0">
                                        <a data-url="{{route('dashboard.multi_delete')}}" href="#"
                                           class="btn btn-outline-danger"
                                           data-toggle="tooltip" title="Xóa" id="btn_customCheckDelete">
                                            <i class="ti-trash"></i>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </div>
                    {{--Phan danh sach file va folder--}}
                    <div class="table-responsive">
                        <table id="table-files" class="table table-borderless table-hover">
                            <thead>
                            <tr>
                                <th>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="files-select-all">
                                        <label class="custom-control-label" for="files-select-all"></label>
                                    </div>
                                </th>
                                <th>Tên</th>
                                <th>Đã chỉnh sửa</th>
                                <th>Người tạo</th>

                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="tableSearchInput">
                            {{--Danh sach file va folder--}}
                            @if(isset($listFilesNew) && $listFilesNew != null)
                                @foreach($listFilesNew as $listFilesNewItem)
                                    @if($listFilesNewItem->type == 'file')
                                        <tr>
                                            <td class="dt-body-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input name="customCheck[]"
                                                           value="{{$listFilesNewItem->id}}"
                                                           type="checkbox"
                                                           class="custom-control-input checkbox_children messageCheckbox"
                                                           id="customCheck{{$listFilesNewItem->id}}">
                                                    <label class="custom-control-label"
                                                           for="customCheck{{$listFilesNewItem->id}}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="d-flex align-items-center">
                                                    <figure class="avatar avatar-sm mr-3">
                                    <span
                                        class="avatar-title text-black-50 rounded-pill bg-twitter">
                                        <i class="
                                        {{$ex = $listFilesNewItem->extenstion}}
                                        @if($ex =='jpg' ||$ex =='png')
                                            ti-image {{$images_files = $images_files + 1}}{{$images_size = $images_size +$listFilesNewItem->size}}
                                        @elseif($ex =='docx' ||$ex =='txt' || $ex =='pptx' ||$ex =='pdf' ||$ex =='xlsx')
                                            ti-files {{$document_files = $document_files + 1}}{{$document_size = $document_size +$listFilesNewItem->size}}
                                        @elseif($ex =='mp4')
                                            ti-video-clapper {{$videos_files = $videos_files + 1}}{{$videos_size = $videos_size +$listFilesNewItem->size}}
                                        @else
                                            ti-file {{$other_files = $other_files + 1}}{{$other_size = $other_size +$listFilesNewItem->size}}
                                        @endif
                                            "></i>
                                    </span>
                                                    </figure>
                                                    <span class="d-flex flex-column">
                                    <span
                                        class="text-primary">@if(strlen($listFilesNewItem->name) > 30){{substr($listFilesNewItem->name, 0, 30)}}
                                        ... @else {{$listFilesNewItem->name}}@endif</span>
                                    <span
                                        class="small font-italic">
                                        @if(($bytes = $listFilesNewItem->size) != 0)
                                            @if ($bytes >= 1073741824)
                                                {{
                                                    $bytes = number_format($bytes / 1073741824, 2) . ' GB'
                                                }}
                                            @elseif ($bytes >= 1048576)
                                                {{
                                                    $bytes = number_format($bytes / 1048576, 2) . ' MB'
                                                }}
                                            @elseif ($bytes >= 1024)
                                                {{
                                                    $bytes = number_format($bytes / 1024, 2) . ' KB'
                                                }}
                                            @elseif ($bytes > 1)
                                                {{
                                                    $bytes = $bytes . ' bytes'
                                                }}
                                            @elseif ($bytes == 1)
                                                {{
                                                    $bytes = $bytes . ' byte'
                                                }}
                                            @else
                                                {{
                                                    $bytes = '0 bytes'
                                                }}
                                            @endif
                                        @endif
                                    </span>
                                </span>
                                                </a>
                                            </td>
                                            <td>{{$listFilesNewItem->updated_at}}</td>
                                            <td>
                                                <div class="avatar-group">
                                                    <figure class="avatar avatar-sm"
                                                            title="{{$listFilesNewItem->getUserId->name}}"
                                                            data-toggle="tooltip">
                                                        <img
                                                            src="{{(isset($listFilesNewItem->getUserId))?asset($listFilesNewItem->getUserId->image_path):''}}"
                                                            class="rounded-circle"
                                                            alt="image">
                                                    </figure>
                                                </div>
                                            </td>

                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                        <i class="ti-more-alt"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @can('download_dashboard')
                                                            @if($listFilesNewItem->type =='file')
                                                                <a href="{{route('dashboard.download',['id'=>$listFilesNewItem->id])}}"
                                                                   class="dropdown-item">Tải về</a>
                                                            @endif
                                                        @endcan
                                                        @can('delete_dashboard')
                                                            <a data-url="{{route('dashboard.delete',['id'=>$listFilesNewItem->id])}}"
                                                               href=""
                                                               class="dropdown-item action_delete_file_orFolder">Xóa</a>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            {{--Danh sach file va folder--}}
                            </tbody>
                        </table>
                    </div>
                    {{--Phan danh sach file va folder--}}

                </div>

            </div>
        </div>
    </form>

@endsection
