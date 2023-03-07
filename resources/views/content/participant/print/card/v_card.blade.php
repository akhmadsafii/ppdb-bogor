@extends('layout.participant.main')
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5">{{ session('title') }}</h5>
        </div>
        <div class="page-title-right d-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('participant.dashboard-participant') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Pendaftaran</a>
                </li>
                <li class="breadcrumb-item active">{{ session('title') }}</li>
            </ol>
        </div>
    </div>
    <div class="row page-title clearfix d-flex justify-content-center">
        <a href="{{ route('participant.print.card.print_register') }}" target="_blank"><i class="fas fa-print"></i> Print</a> &nbsp;&nbsp;|&nbsp;&nbsp;
        <a href="{{ route('participant.print.card.print_pdf') }}" target="_blank" class="text-youtube"><i class="far fa-file-pdf"></i> Cetak PDF</a>
    </div>

    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-heading clearfix">
                        <div class="table-responsive">
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td rowspan="4" style="vertical-align: middle">
                                            @if ($kop['logo'] != null)
                                                <img src="{{ $kop['logo'] }}" style="max-height:138px; min-width: 125px;">
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            <b>{{ $kop['header1'] }}</b>
                                        </td>
                                        <td rowspan="4" style="vertical-align: middle">
                                            @if ($kop['logo2'] != null)
                                                <img src="{{ $kop['logo2'] }}" style="max-height:138px; min-width: 125px;">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">
                                            <h2 style="margin: 0"><b>{{ $kop['header2'] }}</b></h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">
                                            <b>{{ $kop['header3'] }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">
                                            <b>{{ $kop['address'] }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <hr style="border: solid 2px #000">
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" style="text-align: center; font-weight: bold; font-size: 14pt">
                                            <u>Kartu
                                                Peserta</u>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height: 10px;" colspan="2">
                                            @foreach ($setting as $formx => $list)
                                                @if ($formx == 0)
                                                    <table style="width:30%;">
                                                        <tbody>
                                                            @foreach ($form as $key => $val)
                                                                <tr>
                                                                    <td style="30%;">{{ $val['name'] }}</td>
                                                                    <td width="1%">:</td>
                                                                    <td class="tbl">
                                                                        @isset($val['value'])
                                                                            @switch($val['value'])
                                                                                @case('l')
                                                                                    <span> laki -laki </span>
                                                                                @break

                                                                                @case('p')
                                                                                    <span> Perempuan </span>
                                                                                @break

                                                                                @default
                                                                                    <span>{{ $val['value'] }}</span>
                                                                            @endswitch
                                                                        @else
                                                                            <span class="text-muted">-</span>
                                                                        @endisset
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($setting as $formx => $list)
                                                @if ($list['initial'] == 'tampil_foto' && $list['active'] == 1)
                                                    @php
                                                        $img = asset('asset/image/user.png');
                                                        if (Auth::guard('participant')->user()->file != 'user.png') {
                                                            $img = Helper::showImage(Auth::guard('participant')->user()->file);
                                                        }
                                                    @endphp
                                                    <img id="modal-preview" class=" float-right" src="{{ $img }}"
                                                        alt="Preview" width="150">
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    @foreach ($setting as $formx => $list)
                                        @if ($list['initial'] == 'jadwal_ppdb' && $list['active'] == 1)
                                            <tr>
                                                <td colspan="3"
                                                    style="text-align: center; font-weight: bold; font-size: 14pt">
                                                    <u> Jadwal</u>
                                                </td>
                                            </tr>
                                            <tr>
                                                <table id="table_jadwal" class="table table-striped table-responsive">
                                                    <thead>
                                                        <tr class="bg-info text-inverse">
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Tanggal Mulai </th>
                                                            <th>Tanggal Berakhir </th>
                                                            <th>Keterangan </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($schedule as $key => $val)
                                                            <tr>
                                                                <td>#</td>
                                                                <td>{{ $val['name'] }}</td>
                                                                <td>{{ Carbon\Carbon::parse($val['start_date'])->formatLocalized('%A %d %B %Y') }}
                                                                </td>
                                                                <td>{{ Carbon\Carbon::parse($val['end_date'])->formatLocalized('%A %d %B %Y') }}
                                                                </td>
                                                                <td>{{ $val['description'] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        @include('plugins.datetime.datetime_js')
        @include('plugins.sweetalert.sweetalert_js')
    @endpush
@endsection
