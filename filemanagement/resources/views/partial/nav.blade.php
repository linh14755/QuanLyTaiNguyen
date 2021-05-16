<div class="navigation">
    <div class="logo">
        <a href=index.html>
            <img src="{{asset('file-manager-template/assets/media/image/logo.png')}}" alt="logo">
        </a>
    </div>
    <ul>
        @can('list_dashboard')
            <li>
                <a href="{{route('dashboard.index')}}">
                    <i class="nav-link-icon ti-pie-chart"></i>
                    <span class="nav-link-label">Dashboard</span>
                </a>
            </li>
        @endcan
        @can('list_files')
            <li>
                <a href="{{route('filemanager.index')}}">
                    <i class="nav-link-icon ti-files"></i>
                    <span class="nav-link-label">Files</span>
                </a>
            </li>
        @endcan
        @can('upload_file_upload')
            <li>
                <a href="{{route('file.index')}}">
                    <i class="nav-link-icon ti-upload"></i>
                    <span class="nav-link-label">Tải lên</span>
                </a>
            </li>
        @endcan
        @can('list_user')
            <li>
                <a href="{{route('user.index')}}">
                    <i class="nav-link-icon ti-user"></i>
                    <span class="nav-link-label">Người dùng</span>
                </a>
            </li>
        @endcan
        @can('list_role')
            <li class="flex-grow-1">
                <a href="{{route('role.index')}}">
                    <i class="nav-link-icon ti-thumb-up"></i>
                    <span class="nav-link-label">Vai trò</span>
                </a>
            </li>
        @endcan
        <li>
            <a href="#">
                <i class="nav-link-icon ti-settings"></i>
                <span class="nav-link-label">Settings</span>
            </a>
        </li>
    </ul>
</div>
