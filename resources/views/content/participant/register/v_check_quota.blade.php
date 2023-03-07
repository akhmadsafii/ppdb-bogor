@extends('layout.participant.main')
@section('content')
    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-body clearfix text-center text-danger">
                        <i class="far fa-times-circle fa-5x"></i>
                        <h4>Akses ditolak!</h4>
                        <p class="mr-t-10 mb-0">Quota Pendaftaran Sudah terpenuhi.</p>
                        <p class="mt-0 mr-b-20">Mohon maaf, saat ini quota sudah terpenuhi. harap mendaftar di waktu lain lagi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
