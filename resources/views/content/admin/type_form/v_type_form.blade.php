@extends('layout.admin.main')
@section('content')
    @push('styles')
        <link href="{{ asset('asset/css/switch-custom.css') }}" rel="stylesheet" type="text/css">
        @include('plugins.datatable.datatable_css')
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
    <div class="page-title clearfix">
        <a href="{{ route('setting.type_form') }}" class="mx-3"><i class="fas fa-arrow-left"></i> Kembali</a>|<a
            href="{{ route('form.sort_number') }}" class="mx-3"><i class="fas fa-sort"></i> Urutkan Form</a>|<a href="{{ route('form') }}"
            class="mx-3"><i class="fas fa-tasks"></i> Form</a>
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
                                    <th>Initial</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-info fade bs-modal-md-primary" tabindex="-1" role="dialog" id="modalForm" aria-hidden="true"
        style="display: none">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header text-inverse">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myMediumModalLabel"></h5>
                </div>
                <form id="formSubmit">
                    <div class="modal-body">
                        <p class="text-danger float-right my-0"> <i class="material-icons list-icon">warning</i> Tanda
                            (*) Form harus disi!.</p>
                        <input type="hidden" id="id_type" name="id" class="form-control" />
                        <div class="form-group">
                            <label for="">Nama <span class="text-red">*</span></label>
                            <input id="name" type="text" name="name" class="form-control">
                            <input type="hidden" name="status" id="status">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-rounded ripple text-left"
                            data-dismiss="modal">Batal</button>
                        <button type="submit" id="btnSubmit"
                            class="btn btn-info btn-rounded ripple text-left">Simpan</button>
                    </div>
                </form>
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
                    dom: "<'row'<'col-sm-9'B><'col-sm-3'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'l><'col-sm-7'p>>",
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "",
                    buttons: [{
                            text: '<i class="fas fa-plus"></i> Tambah',
                            className: 'btn btn-info btn-sm btn-add',
                        },

                    ],
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            className: 'align-middle'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'initial',
                            name: 'initial',
                            className: 'align-middle'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            className: 'align-middle'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-center align-middle'
                        },
                    ]
                });

                $(document).on('click', '.btn-add', function() {
                    $('#formSubmit').trigger("reset");
                    $('.modal-title').html("Tambah {{ session('title') }}");
                    $('#modalForm').modal('show');
                });

                $('#formSubmit').on('submit', function(event) {
                    event.preventDefault();
                    $("#btnSubmit").html(
                        '<i class="fa fa-spin fa-sync"></i> Memproses..');
                    $("#btnSubmit").attr("disabled", true);
                    $.ajax({
                        url: "{{ route('type_form.send') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            $('#formSubmit').trigger("reset");
                            $('#modalForm').modal('hide');
                            $('#data-tabel').dataTable().fnDraw(false);
                            $('#btnSubmit').html('Simpan');
                            $("#btnSubmit").attr("disabled", false);
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            swal('GAGAL', res.message, 'error')
                            console.log(data);
                            $('#btnSubmit').html('<i class="fas fa-save"></i> Simpan');
                            $("#btnSubmit").attr("disabled", false);
                        }
                    });
                });

                $(document).on('click', '.edit', function() {
                    var id = $(this).data('id');
                    let loader = $(this);
                    $.ajax({
                        url: "{{ route('type_form.detail') }}",
                        data: {
                            id
                        },
                        beforeSend: function() {
                            $(loader).html('<i class="fa fa-spin fa-sync"></i>');
                            $(loader).attr("disabled", true);
                        },
                        success: function(data) {
                            $('.modal-title').html("Edit {{ session('title') }}");
                            $('#id_type').val(data.id);
                            $('#name').val(data.name);
                            $('#status').val(data.status);
                            $('#modalForm').modal('show');
                            $(loader).html(
                                '<i class="material-icons list-icon md-18 text-muted">edit</i>');
                            $(loader).attr("disabled", false);

                        }
                    });
                });

                $(document).on('click', '.status_check', function() {
                    let id = $(this).data('id');
                    let value = $(this).is(':checked') ? 1 : 2;
                    $.ajax({
                        url: "{{ route('type_form.update_status') }}",
                        data: {
                            id,
                            value
                        },
                        success: (data) => {
                            console.log(data.message);
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            swal('GAGAL', res.message, 'error')
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
