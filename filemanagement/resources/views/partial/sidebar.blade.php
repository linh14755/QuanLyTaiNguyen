<div class="sidebar-group d-print-none">
    <!-- Sidebar - Storage -->
    <div class="sidebar primary-sidebar show" id="storage">
        <div class="sidebar-header">
            <h4>Tổng quan bộ nhớ</h4>
        </div>
        <div class="sidebar-content">
            <div id="justgage_five" class="mb-3"></div>
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
                            <p class="mb-0">Ảnh</p>
                            <span class="small text-muted">{{isset($images_files)?$images_files:'0'}} Files</span>
                        </div>
                        <div>
                            <h5 class="text-primary" {{((isset($images_size))?$bytes = $images_size:$bytes = 0)}}>

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

                            </h5>
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
                            <span class="small text-muted">{{isset($videos_files)?$videos_files:'0'}} Files</span>
                        </div>
                        <div>
                            <h5 class="text-primary" {{((isset($videos_size))?$bytes = $videos_size:$bytes = 0)}}>


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


                            </h5>
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
                            <p class="mb-0">Tài liệu</p>
                            <span class="small text-muted">{{isset($document_files)?$document_files:'0'}} Files</span>
                        </div>
                        <div>
                            <h5 class="text-primary" {{((isset($document_size))?$bytes = $document_size:$bytes = 0)}}>

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

                            </h5>
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
                            <span class="small text-muted">{{isset($other_files)?$other_files:'0'}} Files</span>
                        </div>
                        <div>
                            <h5 class="text-primary" {{((isset($other_size))?$bytes = $other_size:$bytes = 0)}}>
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
                            </h5>
                        </div>
                    </a>

                </div>
            </div>

        </div>

    </div>
    <!-- ./ Sidebar - Storage -->

</div>
