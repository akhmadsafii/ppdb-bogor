<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.includes.head')
    @stack('styles')
    @php
        $setting = json_decode(file_get_contents(storage_path('app/settings.json')), true);
    @endphp

    <style>
        .swal-text {
            text-align: center;
        }

        .bg-custom {
            background-color: {{ $setting['background'] }};
        }

        .text-custom {
            color: {{ $setting['color'] }} !important;
        }

        .side-menu li:hover,
        .side-menu li.active {
            background: {{ $setting['background_active'] }};
        }

        .modal-header {
            margin: -1px calc(-25px - 1px) 0;
        }

        #profile-admin {
            width: 60px;
            height: 60px;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body class="sidebar-light sidebar-expand">
    <div id="wrapper" class="wrapper">
        <nav class="navbar bg-custom">
            <div class="navbar-header">
                @php
                    $logo = asset('asset/image/tutwuri.png');
                    if (session()->has('logo_school')) {
                        $logo = asset(session('logo_school'));
                    }
                @endphp
                <a href="{{ route('dashboard-admin') }}" class="navbar-brand bg-custom text-center">
                    <img class="logo-expand" alt="" src="{{ $logo }}" width="80">
                    <img class="logo-collapse" alt="" src="{{ $logo }}" width="80">
                </a>
            </div>
            <ul class="nav navbar-nav">
                <li class="sidebar-toggle my-auto">
                    <a href="javascript:void(0)" class="ripple"><i class="material-icons list-icon">menu</i></a>
                </li>
            </ul>
            <div class="spacer"></div>
            <ul class="nav navbar-nav">
                <li class="dropdown my-auto">
                    <a href="javascript:void(0);" class="dropdown-toggle ripple" style="line-height: normal;"
                        data-toggle="dropdown">
                        <span class="avatar thumb-sm">
                            @php
                                $img = asset('asset/image/user.png');
                                if (Auth::guard('admin')->check()) {
                                    $guard = 'admin';
                                } else {
                                    $guard = 'supervisor';
                                }
                                if (Auth::guard($guard)->user()->file != 'user.png') {
                                    $img = asset(session('avatar'));
                                }
                            @endphp
                            <div id="profile-admin" class="rounded-circle border"
                                style="background-image: url('{{ $img }}')">
                            </div>
                            <i class="material-icons list-icon">expand_more</i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-left admin w-auto p-3 mt-4">
                        <div class="card border-0 mb-2">
                            <ul class="list-unstyled sidecustom ">
                                <li>
                                    <a href="{{ route('account_admin.edit') }}" class="media text-info py-1">
                                        <i class="fas fa-user-alt mr-1 my-auto"></i> Ubah Profil </a>
                                </li>
                                <li>
                                    <a href="{{ route('auth.logout') }}" class="media text-info py-1"><i
                                            class="fas fa-sign-out-alt mr-1 my-auto"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{-- @switch (session('role'))
                        @case('admin-ppdb')
                            <div class="dropdown-menu dropdown-left dropdown-card admin dropdown-card-wide ">
                                <div class="card mb-2">
                                    <ul class="list-unstyled sidecustom ">
                                        <li><a href="{{ route('ubah_profil_admin') }}" class="media text-white">Ubah Profil</li>
                                        <li><a href="{{ route('ubah_password_admin') }}" class="media text-white">Ubah Password
                                        </li>
                                        <li><a href="{{ route('auth.logout') }}" class="media text-white">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        @break

                        @case('admin')
                            <div class="dropdown-menu dropdown-left dropdown-card admin dropdown-card-wide ">
                                <div class="card mb-2">
                                    <ul class="list-unstyled sidecustom ">
                                        <li><a href="{{ route('ubah_profil_admin') }}" class="media text-white">Ubah Profil</li>
                                        <li><a href="{{ route('ubah_password_admin') }}" class="media text-white">Ubah Password
                                        </li>
                                        <li><a href="{{ route('auth.logout') }}" class="media text-white">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        @break

                        @case('peserta-ppdb')
                            <div class="dropdown-menu dropdown-left dropdown-card user dropdown-card-wide ">
                                <div class="card mb-2">
                                    <ul class="list-unstyled sidecustom ">
                                        <li><a href="{{ route('ubah_profil_user') }}" class="media text-white">Ubah Profil</li>
                                        <li><a href="{{ route('ubah_password_user') }}" class="media text-white">Ubah Password
                                        </li>
                                        <li><a href="{{ route('auth.logout') }}" class="media text-white">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        @break
                    @endswitch --}}
                </li>
            </ul>
            <!-- /.navbar-right -->
        </nav>
        <!-- /.navbar -->
        <div class="content-wrapper">
            <!-- SIDEBAR -->
            <aside class="site-sidebar bg-custom scrollbar-enabled clearfix">
                <!-- User Details -->
                @include('layout.admin.sidebar')
                <!-- /.sidebar-nav -->
            </aside>
            <!-- /.site-sidebar -->
            <main class="main-wrapper clearfix">
                @yield('content')
            </main>
        </div>
        @stack('modal')
        @include('layout.includes.footer')
    </div>
    @include('layout.includes.foot')
    @error('message')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror
</body>

</html>
