<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | Enopoly Commerce</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Enopoly E-Commerce System" name="description" />
    <meta content="JCI" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">
    @include('layouts.head-css')
</head>

@section('body')
    <body data-sidebar="dark">
@show
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.topbar')
        @if(Auth::user()->type == 'client_corr')
            @include('layouts.client_corr_sidebar')
        @elseif(Auth::user()->type == 'sourcer')
            @include('layouts.sourcer_sidebar')
        @elseif(Auth::user()->type == 'caller')
            @include('layouts.caller_sidebar')
        @elseif(Auth::user()->type == 'checker')
            @include('layouts.checker_sidebar')
        @elseif(Auth::user()->type == 'admin')
            @include('layouts.admin_sidebar')
        @endif
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @if ($message = Session::get('success'))
                        <div id="success-alert" class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('failed'))
                        <div id="failed-alert" class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

      <!-- /Right-bar -->

    <!-- JAVASCRIPT -->
    @include('layouts.vendor-scripts')
    <script>
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("#success-alert").slideUp(500);
        });
        $("#failed-alert").fadeTo(10000, 500).slideUp(500, function(){
            $("#failed-alert").slideUp(500);
        });
        </script>
</body>

</html>
