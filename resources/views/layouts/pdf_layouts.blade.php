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

    <style>
        .hidden{
            display: none;
        },

        @media print {
               .noprint {
                  display: none !important;
               },
               @page {
  size: 8.5in 11in;
},
             
  
            .page-break
                {
                page-break-before:always !important;
                } 

            }
        </style>
</head>

@section('body')
    <body data-sidebar="dark">
@show
    <!-- Begin page -->
    <div id="layout-wrapper">
       
        <div class="main-content" style="margin-left:0">
            <div class="page-content">
                <div class="container-fluid">
                     @include('layouts.pdf_header')
                    @yield('content')
                    @include('layouts.footer')
                    
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            
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
