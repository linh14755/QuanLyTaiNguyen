<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
@yield('title')

<!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('file-manager-template/assets/media/image/favicon.png')}}"/>

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('file-manager-template/vendors/bundle.css')}}" type="text/css">

    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">

    <!-- quill -->
    <link href="{{asset('file-manager-template/vendors/quill/quill.snow.css')}}" rel="stylesheet" type="text/css">
    <!-- quill -->
    <link href="{{asset('file-manager-template/vendors/jstree/themes/default/style.min.css')}}" rel="stylesheet"
          type="text/css">

{{--    <!-- Clockpicker -->--}}
{{--    <link rel="stylesheet" href="{{asset('file-manager-template/vendors/clockpicker/bootstrap-clockpicker.min.css')}}"--}}
{{--          type="text/css">--}}

{{--    <!-- Datepicker -->--}}
{{--    <link rel="stylesheet" href="{{asset('file-manager-template/vendors/datepicker/daterangepicker.css')}}"--}}
{{--          type="text/css">--}}

<!-- Datatable -->
    <link rel="stylesheet" href="{{asset('file-manager-template/vendors/dataTable/datatables.min.css')}}"
          type="text/css">

{{--    <!-- Select2 -->--}}
{{--    <link rel="stylesheet" href="{{asset('file-manager-template/vendors/select2/css/select2.min.css')}}"--}}
{{--          type="text/css">--}}

<!-- App css -->
    <link rel="stylesheet" href="{{asset('file-manager-template/assets/css/app.min.css')}}" type="text/css">

    <!--Icon-->
    <link href="{{asset('file-manager-template/assets/themify-icons/themify-icons.css')}}" rel="stylesheet">

    @yield('css')
</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="preloader-icon"></div>
</div>
<!-- ./ Preloader -->

<!-- Layout wrapper -->
<div class="layout-wrapper">
    <!-- Header -->
@include('partial.header')
<!-- ./ Header -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- begin::navigation -->
    @include('partial.nav')
    <!-- end::navigation -->

        <!-- Content body -->
        <div class="content-body">
            <!-- Content -->
        @yield('content')
        <!-- ./ Content -->

            <!-- Footer -->
        {{--            @include('partial.footer')--}}
        <!-- ./ Footer -->
        </div>
        <!-- ./ Content body -->

        <!-- Sidebar group -->
{{--    @include('partial.sidebar')--}}
    <!-- ./ Sidebar group -->
    </div>
    <!-- ./ Content wrapper -->
</div>
<!-- ./ Layout wrapper -->

<!-- Main scripts -->
<script src="{{asset('file-manager-template/vendors/bundle.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/justgage/1.2.9/justgage.min.js"></script>

<!-- Datatable -->
<script src="{{asset('file-manager-template/vendors/dataTable/datatables.min.js')}}"></script>

<!-- Jstree -->
<script src="{{asset('file-manager-template/vendors/jstree/jstree.min.js')}}"></script>

<!-- Files page examples -->
<script src="{{asset('file-manager-template/assets/js/examples/files.js')}}"></script>

<!-- App scripts -->
<script src="{{asset('file-manager-template/assets/js/app.min.js')}}"></script>

@yield('js')
</body>
</html>
