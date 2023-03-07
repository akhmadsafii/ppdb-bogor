@extends('layout.participant.main')
@section('content')
    @push('styles')
        <style>
            .absolute-date {
                position: absolute;
                background-color: rgba(250, 250, 250, 0.9);
                width: 120px;
                height: 80px;
                text-align: center;
                padding: 15px 0px;
                border-radius: 10px;
                right: 20px;
                top: 20px;
            }

            .shadow-lg {
                box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
                border-radius: 20px
            }
        </style>
    @endpush
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5">{{ session('title') }}</h5>
        </div>
        <div class="page-title-right d-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">{{ session('title') }}</li>
            </ol>
        </div>
    </div>

    <div class="widget-list">
        <div class="row">
            <div class="col-md-12">
                @if ($quota['quota'] <= $quota['registration'] && $quota['quota'] != 0)
                    <div class="container">
                        <div class="alert alert-icon alert-danger border-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span>
                            </button> <i class="material-icons list-icon">not_interested</i> <strong>PERINGATAN!</strong>
                            Saat ini quota pendaftaran sudah habis. Pembayaran anda tidak akan dikembalikan, Sebaiknya jangan melanjutkan proses pembayaran
                        </div>
                    </div>
                @endif

                <div class="container">
                    <div class="row">
                        @if ($setting_payment->payment == 1)
                            <div class="col-md-8 widget-holder">
                                <div class="card">
                                    @php
                                        $info = 'Belum dibayar';
                                        $class = 'danger';
                                        $notice = 'Saat ini anda belum melakukan proses pembayaran. silahkan lakukan pembayaran terlebih dahulu untuk bisa melakukan pendaftaran.';
                                        $label = 'Bayar Sekarang';
                                        if ($data['status_payment'] == 0) {
                                            $info = 'Pembayaran Menunggu Konfirmasi';
                                            $class = 'warning';
                                            $label = 'Edit Pembayaran';
                                            $notice = 'Anda telah melakukan pembayaran. saat ini pembayaran anda sedang menunggu dikonfirmasi oleh admin kami.';
                                        } elseif ($data['status_payment'] == 1) {
                                            $info = 'Pembayaran Diterima';
                                            $class = 'success';
                                            $notice = 'Selamat, pembayaran anda telah di terima oleh admin kami. Silahkan lanjutkan proses registrasi.';
                                            $label = 'Edit Pembayaran';
                                        } elseif ($data['status_payment'] == 2) {
                                            $info = 'Pembayaran Ditolak';
                                            $class = 'danger';
                                            $label = 'Edit Pembayaran';
                                            $notice = 'Mohon maaf, pembayaran anda kami tolak karena dengan alasan tertentu.';
                                        }
                                    @endphp
                                    <div class="card-header bg-{{ $class }} font-weight-bold">
                                        Detail Pembayaran
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 my-auto">
                                                <center>
                                                    <i class="fas fa-money-check-alt fa-8x"></i>
                                                    <h3 class="m-0">Rp
                                                        {{ str_replace(',', '.', number_format($data['registration_fee'])) }}
                                                    </h3>

                                                    Status: <span
                                                        class="text-{{ $class }}">{{ $info }}</span>
                                                </center>
                                            </div>
                                            <div class="col-md-8">
                                                <h3 class="box-title">Info Pembayaran</h3>
                                                <hr>
                                                <p>{{ $notice }}</p>
                                                <table class="w-100">
                                                    <tr>
                                                        <td width="150">{{ $label }}</td>
                                                        <td><a href="{{ route('participant.payment.billing') }}">Klik
                                                                Disini</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cetak Invoice</td>
                                                        <td><a href="{{ route('participant.payment.invoice', ['participant' => encrypt($data['id_participant'])]) }}"
                                                                target="_blank">Klik
                                                                Disini</a></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="text-center mt-3">
                                            <span>
                                                <i class="far fa-check-circle text-success"></i> pembayaran Anda akan
                                                tertuju
                                                langsung ke pihak sekolah
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 widget-holder">
                                <div class="card">
                                    <div class="card-header bg-{{ $class }} font-weight-bold">
                                        Ringkasan Pembayaran
                                    </div>
                                    <div class="card-body">
                                        <table class="w-100">
                                            <tr>
                                                <td class="align-top">Nama</td>
                                                <th class="text-capitalize">{{ $data['name'] ?? '-' }}</th>
                                            </tr>
                                            <tr>
                                                <td class="align-top">NISN</td>
                                                <th>{{ $data['nisn'] ?? '-' }}</th>
                                            </tr>
                                            <tr>
                                                <td class="align-top" width="100">Tahun Ajaran</td>
                                                <th>{{ $data['school_year'] ?? '-' }}</th>
                                            </tr>
                                            <tr>
                                                <td class="align-top">Status</td>
                                                <th><span class="text-{{ $class }}">{{ $info }}</span></th>
                                            </tr>
                                            <tr>
                                                <td class="align-top">Catatan</td>
                                                <th>{{ $data['note'] }}.</th>
                                            </tr>
                                        </table>
                                        <hr>
                                        <table class="w-100">
                                            <tr>
                                                <td>Total :</td>
                                                <th class="text-right">
                                                    <h2>Rp.
                                                        {{ str_replace(',', '.', number_format($data['registration_fee'])) }}
                                                    </h2>
                                                </th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-12">
                                <center>
                                    <img class="rounded" height="400" src="{{ asset('asset/image/empty.png') }}"
                                        alt="user">
                                    <h3 class="text-success my-0">Tidak ada tagihan pembayaran yang tersedia</h3>
                                </center>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        @include('plugins.sweetalert.sweetalert_js')
        <script type="text/javascript">
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>
    @endpush
@endsection
