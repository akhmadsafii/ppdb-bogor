@extends('layout.admin.main')
@section('content')
    @push('styles')
        @include('plugins.datatable.datatable_css')
        <style>
            .dataTables_wrapper table.dataTable thead .sorting_asc::before {
                display: none !important;
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
                <div class="widget-bg">
                    <div class="widget-heading clearfix">

                        <table class="table table-striped" id="data-tabel">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NISN</th>
                                    <th>Peserta</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Tagihan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        @include('plugins.sweetalert.sweetalert_js')
        @include('plugins.datatable.datatable_js')
        <script type="text/javascript">
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var table = $('#data-tabel').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: '',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            className: 'align-middle'
                        },
                        {
                            data: 'nisn',
                            name: 'nisn',
                            className: 'align-middle'
                        },
                        {
                            data: 'name',
                            name: 'name',
                            defaultContent: '-',
                            className: 'align-middle'
                        },
                        {
                            data: 'email',
                            name: 'email',
                            className: 'align-middle'
                        },
                        {
                            data: 'phone',
                            name: 'phone',
                            className: 'align-middle'
                        },
                        {
                            data: 'nominal',
                            name: 'nominal',
                            className: 'align-middle text-left'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            searchable: false,
                            className: 'text-center align-middle widget-status-table'
                        },
                    ]
                });
            });
        </script>
    @endpush
@endsection
