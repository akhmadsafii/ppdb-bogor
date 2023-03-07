@extends('layout.participant.main')
@section('content')
    @push('styles')
        @include('plugins.datetime.datetime_css')
    @endpush
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5">{{ session('title') }}</h5>
        </div>
        <div class="page-title-right d-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('participant.dashboard-participant') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Cetak</a>
                </li>
                <li class="breadcrumb-item active">{{ session('title') }}</li>
            </ol>
        </div>
    </div>
    <div class="row page-title clearfix d-flex justify-content-center">
        <a href="{{ route('participant.print.registration.print_register') }}" target="_blank"><i class="fas fa-print"></i> Print</a> &nbsp;&nbsp;|&nbsp;&nbsp;
        <a href="{{ route('participant.print.registration.print_pdf') }}" target="_blank" class="text-youtube"><i class="far fa-file-pdf"></i> Cetak PDF</a>
    </div>

    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-heading clearfix">
                        <div class="table-responsive">
                            <table style="width: 100%">
                                <thead>
                                    <tr>
                                        <td rowspan="4" style="vertical-align: middle">
                                            @if ($data['kop']['logo'] != null)
                                                <img src="{{ $data['kop']['logo'] }}"
                                                    style="max-height:138px; min-width: 128px">
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            <b>{{ $data['kop']['header1'] }}</b>
                                        </td>
                                        <td rowspan="4" style="vertical-align: middle">
                                            @if ($data['kop']['logo2'] != null)
                                                <img src="{{ $data['kop']['logo2'] }}"
                                                    style="max-height:138px; min-width: 128px">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">
                                            <h2 style="margin: 0"><b>{{ $data['kop']['header2'] }}</b></h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">
                                            <b>{{ $data['kop']['header3'] }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">
                                            <b>{{ $data['kop']['address'] }}</b>
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
                                            <u>Form
                                                Pendaftaran</u>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height: 10px"></td>
                                        <table style="width: 100%">
                                            <tbody>
                                                @foreach ($data['form'] as $key => $val)
                                                    <tr>
                                                        <td width="20%">{{ $val['name'] }}</td>
                                                        <td width="1%">:</td>
                                                        <td width="39%" class="tbl">
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
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
