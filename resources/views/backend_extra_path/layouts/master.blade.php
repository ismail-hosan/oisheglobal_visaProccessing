<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> @yield('title') - {{config('app.name')}} </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('backend_extra_path.layouts.partials.styles')
    <style>
        fieldset {
            background-color: #eeeeee;
            padding: 0 18px;
            margin-bottom: 12px;
        }

        .legend {
            background-color: gray !important;
            color: white;
            padding: 5px 10px;
            margin-bottom: 5px;
        }
    </style>
    
    @yield('styles')
    <script src="{{asset('public/backend/jquery.min.js')}}"></script>
</head>

<body class="sidebar-mini skin-purple-light sidebar-mini layout-fixed  text-sm">
    <?php
    $companyDetails = DB::table('companies')
        ->where('status', 'Active')
        ->orderBy('id', 'DESC')
        ->first();
    ?>
    @include('backend_extra_path.layouts.partials.alertmessage')
    @include('backend_extra_path.layouts.partials.header')
    @include('backend_extra_path.layouts.partials.sidebar')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('navbar-content')
        <section class="content">
            <div class="container-fluid">
                @yield('admin-content')
            </div>
        </section>
    </div>


    @include('backend_extra_path.layouts.partials.footer')
    @include('backend_extra_path.layouts.partials.alertmessage')
    @include('backend_extra_path.layouts.partials.scripts')
    @include('backend_extra_path.layouts.partials.messages')
    @yield('scripts')
</body>

</html>