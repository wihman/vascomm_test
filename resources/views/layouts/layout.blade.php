<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VASCOMM :: Test Assesment</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .font-weight-bold {
            font-weight: bold;
        }
    </style>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <v-app-bar class="elevation-0" style="background-color: #fff; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;" fixed>
        <v-container>
            <v-row>
                <v-toolbar-title class="font-weight-bold">
                    The OnesPedia
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn text href="/">
                    Home
                </v-btn>
                @if (Auth::check())
                    <v-btn text href="/profile">
                        Profile
                    </v-btn>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <v-btn text type="submit">
                            Log Out
                        </v-btn>
                    </form>
                @else
                    <v-btn text href="/loginuser">Login</v-btn>
                    <v-btn text href="/register">Register</v-btn>
                @endif
            </v-row>
        </v-container>
    </v-app-bar>
    <v-app>
        <v-main class="mt-15">
            @yield('content')
        </v-main>
    </v-app>
    <template>
        <v-footer style="background-color: white !important;">
            <v-container style="background-color: white !important;">
                <v-divider></v-divider>
                <v-card
                    flat
                    tile
                    class="text-center"
                >
                    <v-card-text>
                        <v-btn
                            class="mx-4 white--text"
                            icon
                        >
                            <v-icon size="24px">
                                mdi-facebook
                            </v-icon>
                        </v-btn>
                        <v-btn
                            class="mx-4 white--text"
                            icon
                        >
                            <v-icon size="24px">
                                mdi-twitter
                            </v-icon>
                        </v-btn>
                        <v-btn
                            class="mx-4 white--text"
                            icon
                        >
                            <v-icon size="24px">
                                mdi-linkedin
                            </v-icon>
                        </v-btn>
                        <v-btn
                            class="mx-4 white--text"
                            icon
                        >
                            <v-icon size="24px">
                                mdi-instagram
                            </v-icon>
                        </v-btn>
                    </v-card-text>

                    <v-card-text class="white--text pt-0">
                        Phasellus feugiat arcu sapien, et iaculis ipsum elementum sit amet. Mauris cursus commodo interdum. Praesent ut risus eget metus luctus accumsan id ultrices nunc. Sed at orci sed massa consectetur dignissim a sit amet dui. Duis commodo vitae velit et faucibus. Morbi vehicula lacinia malesuada. Nulla placerat augue vel ipsum ultrices, cursus iaculis dui sollicitudin. Vestibulum eu ipsum vel diam elementum tempor vel ut orci. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                    </v-card-text>

                    <v-divider></v-divider>

                    <v-card-text class="white--text">
                        {{ date('Y') }} — <strong> Assesment Test VASCOMM</strong>
                    </v-card-text>
                </v-card>
            </v-container>
        </v-footer>
    </template>
</div>


<script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
<script>
    new Vue({
        el: '#app',
        vuetify: new Vuetify(),

        data: () => ({
            databanner: [],
            dataproduct: [],
        }),

        // Load Method Vue
        created() {
            this.loadBanner();
            this.loadProduct();
        },
        methods: {
            // load data banner using axios
            loadBanner() {
                // fetch api public banner
                fetch('/public/banner')
                    .then(response => response.json())
                    .then(data => {
                        this.databanner = data.data;
                    })
            },
        }
    })
</script>
</body>
</html>
