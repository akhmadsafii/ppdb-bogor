@extends('layout.public.main')
@section('content')
    @push('styles')
        <link rel="preload" href="{{ asset('asset/custom/schedule.css') }}" as="style"
            onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="{{ asset('asset/custom/schedule.css') }}">
        </noscript>
    @endpush
    @include('plugins.component.banner')
    <main class="main-wrapper clearfix">
        <div class="widget-list">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="row mx-3">
                    @if ($schedule->isNotEmpty())
                        @foreach ($schedule as $sd)
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading{{ $sd['id'] }}">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                href="#collapse{{ $sd['id'] }}" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                {{ $sd['name'] }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse{{ $sd['id'] }}" class="panel-collapse collapse in" role="tabpanel"
                                        aria-labelledby="heading{{ $sd['id'] }}">
                                        <div class="panel-body">
                                            <p><b>Tanggal Mulai : </b>
                                                {{ Helper::formatDay($sd['start_date']) }}</p>
                                            <p><b>Tanggal Berakhir : </b>
                                                {{ Helper::formatDay($sd['end_date']) }}</p>
                                            <p><b>Lokasi : </b>
                                                {{ $sd['place'] }}</p>
                                            <p><b>Keterangan : </b>
                                                {!! $sd['description'] !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12">
                            <center>
                                <img class="rounded" height="400" src="{{ asset('asset/image/empty.png') }}"
                                    alt="user">
                            </center>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </main>
@endsection
