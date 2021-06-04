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
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Roboto and Roboto Mono fonts from Google Fonts-->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,500" rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Load main stylesheet-->
        <link href="{{asset('user-auth/css/styles.css')}}" rel="stylesheet" />

        @yield('css')
    </head>
    <body class="bg-primary">
        @yield('content')

        <!-- Load Bootstrap JS bundle-->
        
        <script src="{{asset('user-auth/js/bootstrap.bundle.min.js')}}" ></script>
        <!-- Load global scripts-->
        <script type="module" src="{{ asset('user-auth/js/material.js') }}"></script>
        <script src="{{asset('user-auth/js/scripts.js')}}"></script>
        <!-- Load Custom Checkbox Script-->
        <script src="{{asset('user-auth/js/checklist.js')}}"></script>
        <script src="{{asset('user-auth/js/common.js')}}"></script>
        @yield('js')
    </body>

</html>
