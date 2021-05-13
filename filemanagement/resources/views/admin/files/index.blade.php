@extends('layouts.layout')

@section('title')
    <title>Filedash - File Manager Dashboard</title>
@endsection

@section('js')
    {{$parentid = 0}}

    {{$images_files = 0}}
    {{$images_size = 0}}

    {{$videos_files = 0}}
    {{$videos_size = 0}}

    {{$document_files = 0}}
    {{$document_size = 0}}

    @if(isset($root_parent)) {{$parentid = $root_parent->id}}@endif{{$parentid = 0}}
    @if(isset($root_parent)) {{$parentid = $root_parent->id}}@endif
    <script>
        let jsonDataView = {
            'data': [
                {
                    'text': 'Root',
                    'type': 'folder',
                    @if($parentid == 0)
                    'state': {
                        'opened': true,
                        'selected': true
                    },
                    @endif
                    "a_attr": {
                        "href": "{{route('folder.selected',['id'=> 0])}}"
                    },
                    'children': [
                            @foreach($listFolder as $folder)
                            @if($folder->parent_id == 0)
                        {
                            'text': '{{$folder->name}}',
                            'type': 'folder',
                            @if($folder->id == $parentid)
                            'state': {
                                'opened': true,
                                'selected': true
                            },
                            @endif
                            "a_attr": {
                                "href": "{{route('folder.selected',['id'=>$folder->id])}}"
                            },
                            @include('admin.files.root',['folder'=>$folder,'parentid'=>$parentid])
                        },
                        @endif
                        @endforeach
                    ]
                }
            ],
            themes: {
                dots: false
            }
        };
    </script>
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
                    {{--Cay thu muc--}}
                    <div id="files"></div>
                    {{--Cay thu muc--}}
                </div>
            </div>
            <div class="col-xl-9">
                <div class="content-title mt-0">
                    <h4>{{(isset($root_parent))?str_replace('/storage/app','',$root_parent->feature_path):'/root' }}</h4>
                </div>
                <div class="d-md-flex justify-content-between mb-4">
                    <ul class="list-inline mb-3">
                        <li class="list-inline-item mb-0">
                            <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                                Thêm
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item action_add_folder"
                                   data-url="{{route('folder.createfolder',['id'=>$parentid])}}"
                                   href="">Thư mục mới</a>
                                <a class="dropdown-item" href="{{route('file.selected',['id'=>$parentid])}}">Tải lên</a>
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
                                <a data-url="{{route('folder.multi_delete')}}" href="#" class="btn btn-outline-danger"
                                   data-toggle="tooltip" title="Xóa" id="btn_customCheckDelete">
                                    <i class="ti-trash"></i>
                                </a>
                            </li>
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
                            <th>Name</th>
                            <th>Modified</th>
                            <th>Type</th>

                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--Danh sach file va folder--}}
                        @if(isset($listFolderAndFileForId) && $listFolderAndFileForId->count())
                            @foreach($listFolderAndFileForId as $listFolderAndFileForIdItem)
                                <tr>
                                    <td class="dt-body-center">
                                        <div class="custom-control custom-checkbox">
                                            <input name="customCheck" value="{{$listFolderAndFileForIdItem->id}}"
                                                   type="checkbox"
                                                   class="custom-control-input checkbox_children messageCheckbox"
                                                   id="customCheck{{$listFolderAndFileForIdItem->id}}">
                                            <label class="custom-control-label"
                                                   for="customCheck{{$listFolderAndFileForIdItem->id}}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <figure class="avatar avatar-sm mr-3">
                                    <span
                                        class="avatar-title text-black-50 rounded-pill {{($listFolderAndFileForIdItem->type =='folder')?'bg-warning':''}}">
                                        <i class="
                                        {{$ex = $listFolderAndFileForIdItem->extenstion}}
                                        @if($ex =='jpg' ||$ex =='png')
                                            ti-image {{$images_files = $images_files + 1}}{{$images_size = $images_size +$listFolderAndFileForIdItem->size}}
                                        @elseif($ex =='docx' ||$ex =='txt')
                                            ti-file {{$document_files = $document_files + 1}}{{$document_size = $document_size +$listFolderAndFileForIdItem->size}}
                                        @elseif($ex =='mp4')
                                            ti-video-camera {{$videos_files = $videos_files + 1}}{{$videos_size = $videos_size +$listFolderAndFileForIdItem->size}}
                                        @else
                                            ti-folder
                                            @endif
                                            "></i>
                                    </span>
                                            </figure>
                                            <span class="d-flex flex-column">
                                    <span
                                        class="text-primary">@if(strlen($listFolderAndFileForIdItem->name) > 30){{substr($listFolderAndFileForIdItem->name, 0, 30)}}
                                        ... @else {{$listFolderAndFileForIdItem->name}}@endif</span>
                                    <span
                                        class="small font-italic">
                                        @if(($bytes = $listFolderAndFileForIdItem->size) != 0)
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
                                    <td>{{$listFolderAndFileForIdItem->updated_at}}</td>
                                    <td>
                                        <div
                                            class="badge bg-info-bright text-info">{{($listFolderAndFileForIdItem->type =='folder')?'Folder':'File'}}</div>
                                    </td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @if($listFolderAndFileForIdItem->type =='file')
                                                    <a href="{{route('folder.download',['id'=>$listFolderAndFileForIdItem->id])}}"
                                                       class="dropdown-item">Tải về</a>
                                                    <a href="{{route('folder.file_edit',['id'=>$listFolderAndFileForIdItem->id])}}"
                                                       class="dropdown-item move_file_or_folder">Chỉnh sửa</a>
                                                @endif

                                                <a data-url="{{route('folder.delete',['id'=>$listFolderAndFileForIdItem->id])}}"
                                                   href="" class="dropdown-item action_delete_file_orFolder">Xóa</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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

@endsection
