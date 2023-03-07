@extends('layout.public.main')
@section('content')
    @push('styles')
        @include('plugins.datatable.datatable_css')
        <style>
            .shadow-lg {
                box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
                border-radius: 20px
            }
        </style>
    @endpush
    @include('plugins.component.banner')
    <main class="main-wrapper clearfix">
        <div class="widget-list">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h3 class="box-title">{{ Session::get('title') }}</h3>
                            <hr>
                            <table class="table table-striped" id="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Peserta</th>
                                        <th>NISN</th>
                                        <th>Asal Sekolah</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @push('scripts')
        @include('plugins.datatable.datatable_js')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                var table = $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "",
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
                            className: 'text-center'
                        },
                        {
                            data: 'nisn',
                            name: 'nisn',
                            className: 'align-middle'
                        },
                        {
                            data: 'school_origin',
                            name: 'school_origin',
                            defaultContent: '-',
                            className: 'align-middle'
                        },
                    ]
                });
            });
        </script>
    @endpush
@endsection
