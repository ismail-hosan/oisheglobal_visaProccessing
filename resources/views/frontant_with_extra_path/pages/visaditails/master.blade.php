<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Online Visa Form</title>
    <noscript>
        <meta http-equiv="refresh" content="0; URL=no_js.html">
    </noscript>

    <link href="css/Online_regular.css" rel="stylesheet" type="text/css">
    <link href="css/jquery_theme_tvoa.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="images/favicon.ico">
    <link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/declarations.js"></script>
    <script type="text/javascript" src="js/blur_functions.js"></script>
    <script type="text/javascript" src="js/submit_functions.js"></script>
    <link href="{{asset('public/frontant/css/Online_regular.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet"
        href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
    
    <script>
        $(function() {
            $(".datepicker").datepicker();
        });
    </script>
    @yield('style')
    <style>
        #form_info {
            display: none;
            position: fixed;
            margin: 0 auto;
            top: 1%;
            left: 50%;
            margin-left: -25%;
            width: 50%;
            height: 50%;
            filter: alpha(opacity=50);
            -moz-opacity: 0.5;
            -khtml-opacity: 0.5;
            opacity: 1;
            z-index: 10000;
        }

        .col-3 {
            color: red;
        }

        #overlay {
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 0;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        ul.form_info_list {
            font-weight: bold;
        }

        ul.form_info_list li {
            font-weight: normal;
        }

        .know_req_info_span {
            color: #2080c9;
            font-size: 1.1em;
            cursor: pointer;
        }

        ul.errorMessage li {
            list-style-type: none;
            color: red;
        }
    </style>
</head>

<body style="background-color: #ededed;">
    <div class="logo">

    </div>

    <div class="" style="background-size: 100%;height: 125px;max-width: 100%;">
        @php
        $url = $company->logo ?? 'itwaybd-h.png';
        $path = asset("public/backend/logo/$url");
        @endphp
        <a href="{{'/'}}"><img class="max-width-200" src="{{$path}}" alt="{{$company->alt ?? 'N/A'}}" style="height: 134px;margin-left: 538px;"></a>
    </div>

    @yield('form')

    <br>
    @yield('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>