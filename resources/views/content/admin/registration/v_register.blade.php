@extends('layout.admin.main')
@section('content')
    @push('styles')
        <link href="{{ asset('asset/css/switch-custom.css') }}" rel="stylesheet" type="text/css">
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
                    <div class="widget-heading clearfix m-0 p-0">
                        <div class="float-left mt-2">
                            <a href="{{ route('master_registration', ['based' => 'all-account']) }}"><i
                                    class="fas fa-list-ol"></i> Semua Pendaftar</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="{{ route('master_registration', ['based' => 'pending']) }}"><i
                                    class="fas fa-pause-circle"></i> Menunggu</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="{{ route('master_registration', ['based' => 'approved']) }}"><i
                                    class="fas fa-tasks"></i> Diterima</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="{{ route('master_registration', ['based' => 'rejected']) }}"><i
                                    class="fas fa-times"></i> Ditolak</a>
                        </div>
                        <div class="float-right">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label for="inputPassword6">Filter Berdasarkan Tahun :</label>
                                    <select id="filter-shool_year" class="form-control ml-2">
                                        <option value="" disabled selected>-- Pilih Tahun Ajaran --</option>
                                        @foreach ($years as $yr)
                                            <option value="{{ $yr['school_year'] }}"
                                                {{ $setting['school_year'] == $yr['school_year'] ? 'selected' : '' }}>
                                                {{ $yr['school_year'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-heading clearfix">

                        <table class="table table-striped" id="data-tabel">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="select-all">
                                    </th>
                                    <th>Foto</th>
                                    <th>Peserta</th>
                                    <th>Email</th>
                                    <th>Jarak Zonasi</th>
                                    <th>Jalur Pendaftaran</th>
                                    <th>Keputusan</th>
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
    @push('modal')
        <div class="modal modal-info fade bs-modal-md-primary" tabindex="-1" role="dialog" id="modalAtOnce" aria-hidden="true"
            style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header text-inverse">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="titleAtOnce"></h5>
                    </div>
                    <form id="formAtOnce">
                        <div class="modal-body">
                            <div class="form-group row m-0">
                                <label class="col-md-3 col-form-label">Keputusan <span class="text-danger">*</span></label>
                                <div class="col-md-9 my-auto">
                                    <select name="decision" class="form-control">
                                        <option value="" selected disabled>-- Pilih Keputusan --</option>
                                        <option value="3">Ditolak</option>
                                        <option value="1">Diterima</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mx-0 my-2">
                                <label class="col-md-3 col-form-label">Catatan <span class="text-danger">*</span></label>
                                <div class="col-md-9 my-auto">
                                    <textarea name="decision_statement" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-rounded ripple text-left"
                                data-dismiss="modal">Batal</button>
                            <button type="submit" id="btnSubmitAtOnce"
                                class="btn btn-info btn-rounded ripple text-left">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal modal-info fade bs-modal-lg-primary" tabindex="-1" role="dialog" id="modalForm" aria-hidden="true"
            style="display: none">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-inverse">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="modal-title"></h5>
                    </div>
                    <form id="formSubmit">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <img id="image-preview" src="https://via.placeholder.com/150" alt=""
                                                height="150">
                                        </div>
                                        <div class="card-footer text-center bg-info">
                                            <h3 class="box-title my-0 text-white text-capitalize detail-name">Whoopi Floyd</h3>
                                            <h3 class="box-title my-0 text-white">NISN. <span class="detail-nisn"></span></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="id" id="id_participant">
                                    <div class="form-group row m-0">
                                        <label class="col-md-3 col-form-label">Nama</label>
                                        <div class="col-md-9 my-auto">
                                            <p class="form-control-plaintext text-capitalize detail-name"></p>
                                        </div>
                                    </div>
                                    <div class="form-group row m-0">
                                        <label class="col-md-3 col-form-label">NISN</label>
                                        <div class="col-md-9 my-auto">
                                            <p class="form-control-plaintext text-capitalize detail-nisn"></p>
                                        </div>
                                    </div>
                                    <div class="form-group row m-0">
                                        <label class="col-md-3 col-form-label">Jenkel</label>
                                        <div class="col-md-9 my-auto">
                                            <p class="form-control-plaintext text-capitalize detail-gender"></p>
                                        </div>
                                    </div>
                                    <div class="form-group row m-0">
                                        <label class="col-md-3 col-form-label">Keputusan <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9 my-auto">
                                            <select name="decision" id="decision" class="form-control">
                                                <option value="" selected disabled>-- Pilih Keputusan --</option>
                                                <option value="3">Ditolak</option>
                                                <option value="1">Diterima</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mx-0 my-2">
                                        <label class="col-md-3 col-form-label">Catatan <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9 my-auto">
                                            <textarea name="decision_statement" id="decision_statement" rows="3" class="form-control"></textarea>
                                        </div>
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
        @include('plugins.component.modal_detail')
    @endpush
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

                reloadRegister($('#filter-shool_year').val());

                $('#filter-shool_year').change(function() {
                    reloadRegister($(this).val());
                })

                $("#select-all").click(function(e) {
                    var table = $(e.target).closest('table');
                    $('td .single-check', table).prop('checked', this.checked);
                    if (this.checked) {
                        $('.btn-edit').removeClass('d-none');
                    } else {
                        $('.btn-edit').addClass('d-none');
                    }
                });

                $(document).on('change', '.single-check', function() {
                    var check_box = $('input[name="participant[]"]:checked').length > 0;
                    if (check_box) {
                        $('.btn-edit').removeClass('d-none');
                    } else {
                        $('.btn-edit').addClass('d-none');
                    }
                });

                $(document).on('click', '.edit', function() {
                    var id = $(this).data('id');
                    let loader = $(this);
                    $.ajax({
                        url: "{{ route('participant.detail') }}",
                        data: {
                            id
                        },
                        beforeSend: function() {
                            $(loader).html('<i class="fa fa-spin fa-sync"></i>');
                            $(loader).attr("disabled", true);
                        },
                        success: function(data) {
                            $('.modal-title').html("Edit {{ session('title') }}");
                            $('#id_participant').val(data.id);
                            $('.detail-name').html(data.name);
                            $('.detail-nisn').html(data.nisn);
                            $('.detail-gender').html(data.gender);
                            $('#decision').val(data.decision).trigger('change');
                            $('#decision_statement').val(data.decision_statement);
                            $('#image-preview').attr('src', data.file ??
                                'https://via.placeholder.com/150');
                            $('#modalForm').modal('show');
                            $(loader).html(
                                '<i class="material-icons list-icon md-18">edit</i>');
                            $(loader).attr("disabled", false);

                        }
                    });
                });

                $(document).on('click', '.status_check', function() {
                    let id = $(this).data('id');
                    let value = $(this).is(':checked') ? 1 : 2;
                    $.ajax({
                        url: "{{ route('participant.update_status') }}",
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

                $(document).on('click', '.btn-edit', function() {
                    $('#titleAtOnce').html("Keputusan Massal");
                    $('#formAtOnce').trigger("reset");
                    $('#modalAtOnce').modal('show');
                });

                $(document).on('click', '.btn-download', function() {
                    let year = $(this).attr("title");
                    console.log(year);
                    window.location.href = "registration/export?year=" + year;
                });

                $(document).on('click', '.detail', function() {
                    var id = $(this).data('id');
                    let loader = $(this);
                    $.ajax({
                        url: "{{ route('master_registration.detail') }}",
                        data: {
                            id
                        },
                        beforeSend: function() {
                            $(loader).html('<i class="fa fa-spin fa-sync"></i>');
                            $(loader).attr("disabled", true);
                        },
                        success: function(data) {
                            $('#modal-title_detail').html("Detail {{ session('title') }}");

                            var script_html = `<div class="row">`;
                            $.each(data, function(key, val) {
                                script_html += `<div class="col-md-6">
                                    <div class="form-group row m-0">
                                        <label class="col-md-4 col-form-label">` + val.label + `</label>
                                        <div class="col-md-8 my-auto">
                                            <p class="form-control-plaintext text-capitalize">` + val.value + `</p>
                                        </div>
                                    </div>
                                </div>`;
                            });
                            script_html += `</div>`;
                            $('#content-mod_detail').html(script_html);
                            $('#modalDetail').modal('show');
                            $(loader).html(
                                '<i class="material-icons list-icon md-18">info_outline</i>');
                            $(loader).attr("disabled", false);

                        }
                    });
                });

                $('#formAtOnce').on('submit', function(event) {
                    event.preventDefault();
                    $("#btnSubmitAtOnce").html(
                        '<i class="fa fa-spin fa-sync"></i> Memproses..');
                    $("#btnSubmitAtOnce").attr("disabled", true);
                    var id_participant = [];
                    $("input:checkbox[class=single-check]:checked").each(function() {
                        id_participant.push($(this).val());
                    });
                    if (id_participant.length > 0) {
                        let moveConfirm = confirm('Apa anda yakin ingin mengupdate sekaligus yang terpilih?');
                        if (moveConfirm == true) {
                            $.ajax({
                                url: "{{ route('master_registration.update_decision_at_time') }}",
                                type: "POST",
                                data: $(this).serialize() + "&id_participant=" + JSON.stringify(
                                    id_participant),
                                success: function(data) {
                                    $('#formAtOnce').trigger("reset");
                                    $('#modalAtOnce').modal('hide');
                                    $('#data-tabel').dataTable().fnDraw(false);
                                    $('#btnSubmitAtOnce').html('Simpan');
                                    $("#btnSubmitAtOnce").attr("disabled", false);
                                },
                                error: function(data) {
                                    const res = data.responseJSON;
                                    swal('GAGAL', res.message, 'error')
                                    console.log(data);
                                    $('#btnSubmitAtOnce').html('Simpan');
                                    $("#btnSubmitAtOnce").attr("disabled", false);
                                }
                            });
                        }
                    }
                })

                $('#formSubmit').on('submit', function(event) {
                    event.preventDefault();
                    $("#btnSubmit").html(
                        '<i class="fa fa-spin fa-sync"></i> Memproses..');
                    $("#btnSubmit").attr("disabled", true);
                    $.ajax({
                        url: "{{ route('master_registration.update_decision') }}",
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
            });

            function reloadRegister(school_year) {
                var table = $('#data-tabel').DataTable({
                    dom: "<'row'<'col-sm-9'B><'col-sm-3'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'l><'col-sm-7'p>>",
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    bDestroy: true,
                    ajax: {
                        url: "",
                        data: {
                            school_year
                        }
                    },
                    buttons: [{
                            text: '<i class="fas fa-pencil-alt"></i>',
                            className: 'btn btn-edit d-none mx-1'
                        },
                        {
                            text: '<i class="far fa-arrow-alt-circle-down"></i>',
                            className: 'btn btn-download mx-1',
                            titleAttr: school_year,
                        },

                    ],
                    columns: [{
                            data: 'check',
                            name: 'check',
                            orderable: false,
                            searchable: false,
                            className: 'align-middle'
                        },
                        {
                            data: 'image',
                            name: 'image',
                            orderable: false,
                            searchable: false,
                            className: 'text-center align-middle'
                        },
                        {
                            data: 'name',
                            name: 'name',
                            className: 'align-middle'
                        },
                        {
                            data: 'email',
                            name: 'email',
                            defaultContent: '-',
                            className: 'align-middle'
                        },
                        {
                            data: 'distance',
                            name: 'distance',
                            defaultContent: '-',
                            className: 'align-middle'
                        },
                        {
                            data: 'lane_register',
                            name: 'lane_register',
                            className: 'align-middle'
                        },
                        {
                            data: 'decision',
                            name: 'decision',
                            className: 'align-middle widget-status-table'
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
            }
        </script>
    @endpush
@endsection
