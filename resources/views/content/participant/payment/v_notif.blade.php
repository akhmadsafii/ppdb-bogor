@extends('layout.participant.main')
@section('content')
    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-body clearfix text-center text-danger">
                        <i class="far fa-times-circle fa-5x"></i>
                        <h4>Akses ditolak!</h4>
                        <p class="mr-t-10 mb-0">Anda tidak memiliki izin untuk mengakses di Halaman ini.</p>
                        <p class="mt-0 mr-b-20">Anda belum melakukan pembayaran.silahkan klik tagihan pembayaran untuk melakukan konfirmasi.</p>
                        <a href="{{ route('participant.dashboard-participant') }}" class="btn btn-danger btn-lg btn-rounded mx-1 mr-b-20 ripple"><i class="fas fa-chevron-left"></i> Kembali</a>
                        <a href="{{ route('participant.payment.history') }}" class="btn btn-success btn-lg btn-rounded mr-b-20 mx-1 ripple"><i class="fas fa-check-circle"></i> Tagihan Pembayaran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
