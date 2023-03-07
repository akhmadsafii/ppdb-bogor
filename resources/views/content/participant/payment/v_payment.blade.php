@extends('layout.participant.main')
@section('content')
    @push('styles')
        @include('plugins.datatable.datatable_css')
    @endpush
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5">{{ session('title') }}</h5>
        </div>
        <div class="page-title-right d-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('participant.dashboard-participant') }}">Dashboard</a>
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
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tempat</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{-- @include('plugins.sweetalert.sweetalert_js') --}}
        @include('plugins.datatable.datatable_js')
        <script type="text/javascript">
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                var table = $('#data-tabel').DataTable({
                    // dom: "<'row'<'col-sm-9'B><'col-sm-3'f>>" +
                    //     "<'row'<'col-sm-12'tr>>" +
                    //     "<'row'<'col-sm-5'l><'col-sm-7'p>>",
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "",
                    // buttons: [{
                    //         text: '<i class="fas fa-plus"></i> Tambah',
                    //         className: 'btn btn-info btn-sm btn-add',
                    //     },

                    // ],
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            className: 'align-middle'
                        },
                        {
                            data: 'name',
                            name: 'name',
                            className: 'align-middle'
                        },
                        {
                            data: 'place',
                            name: 'place',
                            className: 'align-middle'
                        },
                        {
                            data: 'start_date',
                            name: 'start_date',
                            className: 'align-middle'
                        },
                        {
                            data: 'end_date',
                            name: 'end_date',
                            className: 'align-middle'
                        },
                        {
                            data: 'description',
                            name: 'description',
                            className: 'align-middle'
                        },
                    ]
                });


            });
        </script>
    @endpush
@endsection
