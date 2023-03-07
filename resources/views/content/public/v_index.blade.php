<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.includes.head')
    <link rel="preload" href="{{ asset('asset/custom/countdown.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('asset/custom/countdown.css') }}">
    </noscript>
    <style>
        .bg-custom {
            background-color: {{ env('SETTING_BACKGROUND') }};
        }

        .swal-text {
            text-align: center;
        }

        .bg-image {
            background-position: center center;
            background-repeat: no-repeat;
        }

        .heading-page {
            background-position: center;
            background-size: cover;
            height: 500px;
            position: relative;
            text-align: center;
        }



        @media (max-width: 960px) {
            .heading-page {
                height: 150px;
            }

            img.rounded {
                height: auto !important
            }
        }
    </style>
</head>

<body class="header-centered sidebar-horizontal">
    <div id="wrapper" class="wrapper">
        <header>
            @include('layout.public.nav_menu')
        </header>
        <div class="content-wrapper">
            @if ($banner && $banner['file'] != null)
                <section class="heading-page header-text" id="top"
                    style="background-image: url({{ Helper::showImage('thumb/' . $banner['file']) }})">
                </section>
            @else
                <div class="row mt-3 mx-0">
                    <div class="col-md-12">
                        <div class="card widget-holder">
                            <div class="card-body">
                                <div class="text-center text-danger">
                                    <i class="far fa-image fa-5x"></i>
                                    <h5>Banner tidak terpasang</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <main class="main-wrapper clearfix pt-2">
                <div class="widget-list">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card widget-holder">
                                <div class="card-body">
                                    @if ($greeting)
                                        <h3 class="box-title">{{ $greeting['title'] }}</h3>
                                        <hr>
                                        <div class="float-left m-2">
                                            <a href="{{ asset($greeting->file) }}"><img
                                                    src="{{ Helper::showImage('thumb/' . $greeting['file']) }}"
                                                    alt="" width="300" height="400" class="rounded"></a>
                                        </div>
                                        <div class="text-justify">{!! $greeting['content'] !!}</div>
                                    @else
                                        <div class="text-center text-danger">
                                            <i class="fas fa-exclamation-triangle fa-5x"></i>
                                            <h5>Sambutan belum diset</h5>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card widget-holder">
                                <div class="card-body">
                                    @if ($setting && $setting['status_open'] == 0)
                                        <div class="text-center">
                                            <i class="fas fa-user-lock fa-5x"></i>
                                            <h3>Pendaftaran Ditutup</h3>
                                        </div>
                                    @else
                                        <span class="text text-white">Waktu Buka PPDB</span>
                                        @if ($setting &&
                                            $setting['open_date'] < date('Y-m-d H:i:s') &&
                                            $setting['closing_date'] . ' ' . $setting['closing_hour'] > date('Y-m-d H:i:s'))
                                            <center>
                                                <i class="far fa-check-circle fa-5x text-success"></i>
                                                <h5 class="text-success">Pendaftaran Dibuka</h5>
                                                <a href="{{ route('auth.register') }}" class="btn btn-success btn-lg"><i
                                                        class="fas fa-user-check"></i> Daftar Sekarang</a>
                                            </center>
                                        @else
                                            <hr>
                                            <div class="table-responsive">
                                                <div class="timer d-flex justify-content-around">
                                                    <div class="box">
                                                        <span class="num" id="day-box" data-days></span>
                                                        <span class="text text-white">Hari</span>
                                                    </div>
                                                    <div class="box">
                                                        <span class="num" id="hr-box" data-hours>00</span>
                                                        <span class="text text-white">Jam</span>
                                                    </div>
                                                    <div class="box">
                                                        <span class="num" id="min-box" data-minutes>00</span>
                                                        <span class="text text-white">Menit</span>
                                                    </div>
                                                    <div class="box">
                                                        <span class="num" id="sec-box" data-seconds>00</span>
                                                        <span class="text text-white">Detik</span>
                                                    </div>
                                                </div>
                                                <p class="text-center">Harap refresh bila waktu mundur telah berhenti <a
                                                        href=""><i class="fas fa-sync-alt"></i> Refresh
                                                        halaman</a></p>
                                            </div>
                                        @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card widget-holder">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2 text-center my-2">
                                            <i class="far fa-calendar-times fa-2x"></i> <br>
                                            <small>Tanggal Tutup</small><br>
                                            {{ $setting && $setting['closing_date'] != null ? Helper::formatDay($setting['closing_date']) : '-' }}
                                        </div>
                                        <div class="col-md-2 text-center my-2">
                                            <i class="far fa-clock fa-2x"></i> <br> <small> Jam
                                                Tutup</small><br>
                                            {{ $setting && $setting['closing_hour'] ? $setting['closing_hour'] : '-' }}
                                        </div>
                                        <div class="col-md-2 text-center my-2">
                                            <i class="fab fa-whatsapp fa-2x"></i> <br> <small> WhatApps
                                            </small><br>
                                            {{ $setting && $setting['whatsapp'] ? $setting['whatsapp'] : '-' }}
                                        </div>
                                        <div class="col-md-2 text-center my-2">
                                            <i class="fas fa-phone-volume fa-2x"></i> <br> <small> Telepon
                                            </small><br>
                                            {{ $setting && $setting['phone'] ? $setting['phone'] : '-' }}
                                        </div>
                                        <div class="col-md-2 text-center my-2">
                                            <i class="fas fa-map-marker-alt fa-2x"></i> <br> <small> Alamat
                                                Sekolah</small><br>
                                            {{ $setting && $setting['address'] ? $setting['address'] : '-' }}
                                        </div>
                                        <div class="col-md-2 text-center my-2">
                                            <i class="fas fa-users fa-2x"></i> <br> <small> Kouta
                                                Pendaftaran</small><br>
                                            {{ $setting && $setting['quota'] ? $setting['quota'] : '-' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
        <footer class="footer text-center clearfix">{{ env('SETTING_FOOTER') }}</footer>
    </div>
    @include('layout.includes.foot')
    @include('plugins.countdown.countdown_js')
    @if ($setting && $setting['status_open'] == 1)
        <script>
            timezz(document.querySelector('.timer'), {
                date: new Date("{{ $setting['open_date'] }}"),
                pause: false,
                stopOnZero: true,
                beforeCreate() {},
                beforeUpdate() {},
                update(event) {},
            });
        </script>
    @endif
</body>

</html>
