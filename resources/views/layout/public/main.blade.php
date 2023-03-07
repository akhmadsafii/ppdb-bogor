<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.includes.head')
    @stack('styles')
    <style>
        .bg-custom {
            background-color: {{ env('SETTING_BACKGROUND') }};
        }

        .swal-text {
            text-align: center;
        }

        .bg-image {
            /* width: 60px;
            height: 60px; */
            background-position: center center;
            background-repeat: no-repeat;
            /* background-size: auto 60px; */
        }


    </style>
</head>

<body class="header-centered sidebar-horizontal">
    <div id="wrapper" class="wrapper">
        <header>
            @include('layout.public.nav_menu')
        </header>
        <div class="content-wrapper">
            @yield('content')
        </div>
        <footer class="footer text-center clearfix">{{ env('SETTING_FOOTER') }}</footer>
    </div>
    @include('layout.includes.foot')

</body>

</html>
