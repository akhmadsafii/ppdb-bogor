@extends('layout.participant.main')
@section('content')
    @push('styles')
        <style>
            .shadow-lg {
                box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
                transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), .3s box-shadow, .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
                cursor: pointer;
            }

            .shadow-lg:hover {
                transform: scale(1.05);
                box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
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
            <div class="col-md-12 widget-holder">
                @if ($announcement->isNotEmpty())
                    @foreach ($announcement as $anc)
                        <table class="table">
                            <tr>
                                <td>
                                    <a
                                        href="{{ route('participant.announcement.preview', ['title' => str_slug($anc['title'])]) }}">
                                        <div class="card shadow-lg">
                                            <table class="table bg-white mb-0">
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="card-header bg-white text-muted border-bottom-0">
                                                            <b>Pengumuman</b>
                                                            <span class="float-right"><i class="fas fa-eye"></i>
                                                                {{ $anc['viewer'] ?? 0 }}</span>
                                                        </div>
                                                    </td>
                                                    <td rowspan="3" class="align-middle">
                                                        <img src="{{ Helper::showImage('thumb/' . $anc['file']) }}"
                                                            alt="" class="w-100 rounded">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="120" class="text-center align-middle">
                                                        <div class="down-content">
                                                            <div class="date">
                                                                <h6 class="my-0">
                                                                    {{ Helper::formatMonthYear($anc['created_at']) }}
                                                                </h6>
                                                                <h3 class="my-1">
                                                                    {{ date('d', strtotime($anc['created_at'])) }}</h3>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td width="850px">
                                                        <div class="col-12">
                                                            <h4 class="my-2">
                                                                <b>{{ str_limit($anc['title'], 50, ' ...') }}</b>
                                                            </h4>
                                                            <span>
                                                                <p>{!! str_limit($anc['content'], 120, ' ...') !!}</p>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    @endforeach
                @else
                    <center>
                        <img class="rounded" height="400" src="{{ asset('asset/image/empty.png') }}" alt="user">
                    </center>
                @endif
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
