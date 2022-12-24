<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>VASCOMM::eSHOP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel=icon href="/img/logo.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Caveat&family=Great+Vibes&display=swap');

         .theme--light.v-overlay {
            backdrop-filter: blur(2px) !important;
            background-color: rgba(167, 221, 255, 0.308) !important;
        }

        .theme--dark.v-overlay {
            backdrop-filter: blur(2px) !important;
            background-color: rgba(167, 221, 255, 0.308) !important;
        }

        .v-overlay__scrim {
            backdrop-filter: blur(2px) !important;
        }
    </style>
    @production
        <link href="{{ App\Helpers\VueCli::asset('npm.vuetify.css') }}" rel="stylesheet">
        <link href="{{ App\Helpers\VueCli::asset('app.css') }}" rel="stylesheet">
    @endproduction
    <script>
        var sembarang = '{{ $userdetail }}'
        var userInfo = '{{ $userinfo }}'
    </script>
</head>

<body class="sidebar-collapse layout-top-nav">
    <div id="app"></div>

    @env('local')
    <script src="{{ App\Helpers\VueCli::asset('chunk-vendors.js') }}"></script>
    <script src="{{ App\Helpers\VueCli::asset('app.js') }}"></script>
    @endenv
    @production
        <script src="{{ App\Helpers\VueCli::asset('npm.vuetify.js') }}"></script>
        <script src="{{ App\Helpers\VueCli::asset('chunk-vendors.js') }}"></script>
        <script src="{{ App\Helpers\VueCli::asset('app.js') }}"></script>

        <script src="{{ App\Helpers\VueCli::asset('npm.apexcharts.js') }}"></script>
        <script src="{{ App\Helpers\VueCli::asset('npm.vue-apexcharts.js') }}"></script>
    @endproduction

</body>

</html>
