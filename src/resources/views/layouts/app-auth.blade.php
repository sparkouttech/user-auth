<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        
        <title>@yield('title','Bank less kingdom')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no"/>

        @include('user-auth::includes.favicons')

        @include('user-auth::includes.meta')

        <!-- Load Material Icons from Google Fonts-->
        <link href="{{ asset('user-auth::/css/material-fonts.css') }}" rel="preload" as="font" />
        <!-- Load main stylesheet-->
        <link href="{{ asset('user-auth::/css/styles.css') }}" rel="stylesheet" />

        @yield('css')
    </head>
    <body class="bg-primary">
        @yield('content')

        <!-- Load Bootstrap JS bundle-->
        
        <script src="{{asset('user-auth::/js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
        <!-- Load global scripts-->
        <script type="module" src="{{url('/')}}/user-auth/js/material.js"></script>
        <script src="{{url('/')}}/user-auth/js/scripts.js"></script>
        <!-- Load Custom Checkbox Script-->
        <script src="{{url('/')}}/user-auth/js/checklist.js"></script>
        <script src="{{url('/')}}/user-auth/js/common.js"></script>
        @yield('js')
    </body>

</html>
