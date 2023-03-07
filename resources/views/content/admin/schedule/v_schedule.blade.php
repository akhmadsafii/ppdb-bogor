@extends('layout.admin.main')
@section('content')
    @push('styles')
        <link href="{{ asset('asset/css/switch-custom.css') }}" rel="stylesheet" type="text/css">
        @include('plugins.datetime.datetime_css')
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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Informasi</a>
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
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Status Ditampilkan</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-info fade bs-modal-lg-primary" tabindex="-1" role="dialog" id="modalForm" aria-hidden="true"
        style="display: none">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-inverse">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myMediumModalLabel"></h5>
                </div>
                <form id="formSubmit">
                    <div class="modal-body">
                        <p class="text-danger text-right "> <i class="material-icons list-icon">warning</i> Tanda
                            (*) Form harus disi!.</p>
                        <input type="hidden" id="id_schedule" name="id" class="form-control" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama <span class="text-red">*</span></label>
                                    <input id="name" type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tempat <span class="text-red">*</span></label>
                                    <input id="place" type="text" name="place" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tanggal Mulai <span class="text-red">*</span></label>
                                    <input id="start_date" type="text" name="start_date" value="{{ date('d/m/Y') }}"
                                        class="form-control datepicker">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tanggal Akhir <span class="text-red">*</span></label>
                                    <input id="end_date" type="text" name="end_date" class="form-control datepicker"
                                        value="{{ date('d/m/Y') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Urutan <span class="text-red">*</span></label>
                                    <input id="sort" type="text" name="sort" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Status <span class="text-red">*</span></label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Tampilkan</option>
                                        <option value="2">Sembunyikan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Deskripsi <span class="text-red">*</span></label>
                                    <textarea name="description" id="description" rows="6" class="form-control"></textarea>
                                </div>
                            </div>
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
        @include('plugins.datetime.datetime_js')
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
                            name: 'name',
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
                    $('#id_schedule').val("");
                    $('#formSubmit').trigger("reset");
                    $('.modal-title').html("Tambah {{ session('title') }}");
                    $('#modalForm').modal('show');
                });

                $('body').on('submit', '#formSubmit', function(e) {
                    $("#btnSubmit").html(
                        '<i class="fa fa-spin fa-sync"></i> Memproses');
                    $("#btnSubmit").attr("disabled", true);
                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('registration_schedule.send') }}",
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
                            $('#btnSubmit').html('Simpan');
                            $("#btnSubmit").attr("disabled", false);
                        }
                    });
                });

                $(document).on('click', '.delete', function() {
                    var id = $(this).data('id');
                    let loader = $(this);
                    if (id) {
                        if (confirm("Apa kamu yakin ingin menghapus data ini?") == true) {
                            $.ajax({
                                url: "{{ route('registration_schedule.delete') }}",
                                type: "DELETE",
                                data: {
                                    id
                                },
                                beforeSend: function() {
                                    $(loader).html('<i class="fa fa-spin fa-sync"></i>');
                                    $(loader).attr("disabled", true);
                                },
                                success: function(data) {
                                    if (data.status == false) {
                                        swal('GAGAL', data.message, 'error');
                                        $(loader).html(
                                            '<i class="material-icons list-icon md-18 text-muted">delete</i>'
                                        );
                                        $(loader).attr("disabled", false);
                                    } else {
                                        $('#data-tabel').dataTable().fnDraw(false);
                                    }
                                },
                                error: function(data) {
                                    const res = data.responseJSON;
                                    swal('GAGAL', res.message, 'error')
                                    console.log(data);
                                    $(loader).html(
                                        '<i class="material-icons list-icon md-18 text-muted">delete</i>'
                                    );
                                    $(loader).attr("disabled", false);
                                }
                            })
                        }
                    }
                });

                $(document).on('click', '.edit', function() {
                    var id = $(this).data('id');
                    let loader = $(this);
                    $.ajax({
                        url: "{{ route('registration_schedule.detail') }}",
                        data: {
                            id
                        },
                        beforeSend: function() {
                            $(loader).html('<i class="fa fa-spin fa-sync"></i>');
                            $(loader).attr("disabled", true);
                        },
                        success: function(data) {
                            $('.modal-title').html("Edit {{ session('title') }}");
                            $('#id_schedule').val(data.id);
                            $('#name').val(data.name);
                            $('#place').val(data.place);
                            $('#start_date').val(data.start_date);
                            $('#end_date').val(data.end_date);
                            $('#sort').val(data.sort);
                            $('#description').val(data.description);
                            $('#status').val(data.status).trigger('change');
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
                        url: "{{ route('registration_schedule.update_status') }}",
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
