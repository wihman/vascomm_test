<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>eAssesment :: Login</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel=icon href="/img/logo.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .btnones {
            background-color: #1565c0 !important;
            color: white;
            border-radius: 5px;
            z-index: 9;
        }

        .btnones:hover {
            background-color: #0A4291 !important;
            color: white;
        }

        .full-img {
            background-image: url("/img/img_1.png");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .leftside {
            background-color: white;
            color: black;
            font-weight: bold;
            border-radius: 5px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            border-top-right-radius: 0px;
            border-bottom-right-radius: 0px;
        }

        .rightside {
            background-color: white;
            margin-left: -100px;
            color: black;
            font-weight: bold;
            border-radius: 5px;
            border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .form-control {
            background-color: #f5f5f5;
            border: 0;
        }
    </style>
</head>
<body style="background-color: white !important;">
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
<footer align="center" style="margin-top: 30px;">
    <p style="font-weight: bold; font-size: 14px;">VASCOMM TEST ASSESMENT</p>
    <p style="margin-top: -14px; font-size: 12px;">Copyright &copy; <?php echo date('Y') ?></p>
</footer>
</html>
