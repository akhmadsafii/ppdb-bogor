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
                <li class="breadcrumb-item"><a href="{{ route('participant.announcement') }}">Pengumuman</a>
                </li>
                <li class="breadcrumb-item active">{{ session('title') }}</li>
            </ol>
        </div>
    </div>

    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="container">
                    <div class="card shadow-lg">
                        <div class="position-relative">
                            <div class="absolute-date">
                                <h6 class="my-0">
                                    {{ Helper::formatMonthYear($announcement['created_at']) }}
                                </h6>
                                <h3 class="my-1">
                                    {{ date('d', strtotime($announcement['created_at'])) }}</h3>
                            </div>
                            <img class="card-img-top" style="border-radius: 20px 20px 0 0"
                                src="{{ Helper::showImage('thumb/' . $announcement['file']) }}" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">{{ $announcement['title'] }}</h3>
                            <p class="card-text">Pengumuman <span class="float-right"><i class="fas fa-eye"></i>
                                    {{ $announcement['viewer'] ?? 0 }}</span> </p>
                            <hr>
                            <p>{!! $announcement['content'] !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <a href="{{ route('participant.announcement') }}" class="btn btn-danger btn-rounded">KEMBALI KE
                    PENGUMUMAN</a>
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
