<div class="navigation">
    <div class="logo">
        <a href=index.html>
            <img src="{{asset('file-manager-template/assets/media/image/logo.png')}}" alt="logo">
        </a>
    </div>
    <ul>
        <li>
            <a href="">
                <i class="nav-link-icon ti-pie-chart"></i>
                <span class="nav-link-label">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{route('filemanager.index')}}">
                <i class="nav-link-icon ti-files"></i>
                <span class="nav-link-label">Files</span>
            </a>
        </li>
        <li>
            <a href="{{route('file.index')}}">
                <i class="nav-link-icon ti-upload"></i>
                <span class="nav-link-label">Upload File</span>
            </a>
        </li>
        <li>
            <a href="users.html">
                <i class="nav-link-icon ti-user"></i>
                <span class="nav-link-label">Users</span>
            </a>
        </li>
        <li class="flex-grow-1">
            <a href="alert.html">
                <i class="nav-link-icon ti-layers"></i>
                <span class="nav-link-label">Components</span>
            </a>
        </li>
        <li>
            <a href="settings.html">
                <i class="nav-link-icon ti-settings"></i>
                <span class="nav-link-label">Settings</span>
            </a>
        </li>
    </ul>
</div>
