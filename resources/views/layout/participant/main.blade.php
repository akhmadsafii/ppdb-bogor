<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.includes.head')
    @php
        $setting = json_decode(file_get_contents(storage_path('app/settings.json')), true);
    @endphp
    @stack('styles')

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
            background-size: auto 60px;
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
                        $logo = Helper::showImage(session('logo_school'));
                    }
                @endphp
                <a href="{{ route('participant.dashboard-participant') }}" class="navbar-brand bg-custom text-center">
                    <img class="logo-expand" alt="" src="{{ $logo }}" height="80">
                    <img class="logo-collapse" alt="" src="{{ $logo }}" height="80">
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
                                if (Auth::guard('participant')->user()->file != 'user.png') {
                                    $img = Helper::showImage('thumb/' . Auth::guard('participant')->user()->file);
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
                                    <a href="{{ route('participant.account_participant.edit') }}"
                                        class="media text-info py-1">
                                        <i class="fas fa-user-alt mr-1 my-auto"></i> Ubah Profil </a>
                                </li>
                                <li>
                                    <a href="{{ route('auth.logout') }}" class="media text-info py-1"><i
                                            class="fas fa-sign-out-alt mr-1 my-auto"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <div class="content-wrapper">
            <aside class="site-sidebar bg-custom scrollbar-enabled clearfix">
                @include('layout.participant.sidebar')
            </aside>
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
