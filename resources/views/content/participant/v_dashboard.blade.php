@extends('layout.participant.main')
@section('content')
    @push('styles')
        <link rel="preload" href="{{ asset('asset/custom/countdown.css') }}" as="style"
            onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="{{ asset('asset/custom/countdown.css') }}">
        </noscript>
    @endpush
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5">{{ session('title') }}</h5>
        </div>
    </div>
    <div class="widget-list">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 widget-holder">
                <center>
                    <div class="text-info">
                        <i class="fas fa-comment-alt fa-4x"></i>
                        <h5>Selamat datang di Program PPDB, {{ Auth::guard('participant')->user()->name }}</h5>
                        @if ($check_payment == false)
                            <p class="text-danger">Kamu mempunyai 1 tagihan yang belum dibayar. harap segera lakukan
                                pembayaran agar dapat
                                membuka semua fitur</p>
                            <a href="{{ route('participant.payment.history') }}" class="btn btn-lg btn-success btn-rounded"><i class="fas fa-money-check"></i>
                                Lihat Tagihan</a>
                        @endif
                    </div>
                </center>
            </div>
            <div class="col-md-5">
                <div class="table-responsive">
                    <h2 class="text-center">Waktu Tutup Pendaftaran</h2>
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
                </div>
            </div>
        </div>
    </div>
    @php
        $date = date('Y-m-d H:i:s', strtotime($setting['closing_date'] . ' ' . $setting['closing_hour']));
    @endphp
    @push('scripts')
        @include('plugins.countdown.countdown_js')

        <script type="text/javascript">
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                timezz(document.querySelector('.timer'), {
                    date: new Date("{{ $date }}"),
                    pause: false,
                    stopOnZero: true,
                    beforeCreate() {},
                    beforeUpdate() {},
                    update(event) {},
                });


            });
        </script>
    @endpush
@endsection
