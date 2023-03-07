@extends('layout.participant.main')
@section('content')
    @push('styles')
        @include('plugins.datatable.datatable_css')
        <style>
            div#list-participant_length {
                margin: 0;
            }

            div#list-participant_info {
                margin: 0;
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
                                    <th>No</th>
                                    <th>Peserta</th>
                                    <th>Judul Pesan</th>
                                    <th>Tanggapan</th>
                                    <th>Sesi</th>
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
        <div class="modal modal-info fade bs-modal-lg-primary"  role="dialog" id="modalForm" aria-hidden="true"
            style="display: none">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-inverse">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="myMediumModalLabel"></h5>
                    </div>
                    <form id="formSubmit">
                        <input type="hidden" name="id_participants" id="id_participant">
                        <input type="hidden" name="id" id="id_message">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="l0">File</label>
                                        <div class="col-md-10 my-auto">
                                            <input type="file" name="file" class="form-control-file" accept="image/*"
                                                onchange="readURL(this);">

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="l0">Judul</label>
                                        <div class="col-md-10">
                                            <input class="form-control" id="name" name="name" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <img id="image-preview" src="https://via.placeholder.com/150" alt="Preview"
                                        class="form-group my-1" width="200">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea name="content" id="content" class="editor" placeholder="Isi Pesan"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="action" id="action" value="Add" />
                            <button type="button" class="btn btn-danger btn-rounded ripple text-left"
                                data-dismiss="modal">Batal</button>
                            <button type="submit" id="btnSubmit"
                                class="btn btn-info btn-rounded ripple text-left">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endpush
    @push('scripts')
        @include('plugins.sweetalert.sweetalert_js')
        @include('plugins.tinymce.tinymce_js')
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
                        text: 'Pesan Baru',
                        className: 'btn btn-info btn-sm btn-add',
                    }, ],
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            className: 'align-middle'
                        },
                        {
                            data: 'name_participant',
                            name: 'name_participant',
                            className: 'align-middle text-capitalize'
                        },
                        {
                            data: 'name',
                            name: 'name',
                            className: 'align-middle'
                        },
                        {
                            data: 'response',
                            name: 'response',
                            className: 'align-middle text-center'
                        },
                        {
                            data: 'session',
                            name: 'session',
                            className: 'align-middle text-center widget-status-table'
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
                    $('#image-preview').attr('src', 'https://via.placeholder.com/150');
                    $('#action').val('Add');
                    $('#modalForm').modal('show');
                });

                $("#select-all").click(function(e) {
                    var table = $(e.target).closest('table');
                    $('td input:checkbox', table).prop('checked', this.checked);
                });

                $('body').on('submit', '#formSubmit', function(e) {
                    e.preventDefault();
                    $("#btnSubmit").html(
                        '<i class="fa fa-spin fa-sync"></i> Memproses');
                    $("#btnSubmit").attr("disabled", true);
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('participant.message.send') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            $('#formSubmit').trigger("reset");
                            $('#modalForm').modal('hide');
                            $('#data-tabel').dataTable().fnDraw(false);
                            $('#btnSubmit').html('Simpan');
                            $("#btnSubmit").attr("disabled", false);
                            swal('BERHASIL', data.message, 'success')
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
                                url: "{{ route('participant.message.delete') }}",
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
                                            '<i class="material-icons list-icon md-18">delete</i>'
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
                                        '<i class="material-icons list-icon md-18">delete</i>'
                                    );
                                    $(loader).attr("disabled", false);
                                }
                            })
                        }
                    }
                });

                $(document).on('click', '.closed', function() {
                    let id = $(this).data('id');
                    let loader = $(this);
                    if (id) {
                        if (confirm("Apa kamu yakin ingin menutup pembahasan ini?") == true) {
                            $.ajax({
                                url: "{{ route('participant.message.closed') }}",
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
                                            '<i class="material-icons list-icon md-18">close</i>'
                                        );
                                        $(loader).attr("disabled", false);
                                    } else {
                                        $('#data-tabel').dataTable().fnDraw(false);
                                    }
                                },
                                error: function(data) {
                                    const res = data.responseJSON;
                                    swal('GAGAL', res.message, 'error')
                                    $(loader).html(
                                        '<i class="material-icons list-icon md-18">delete</i>'
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
                        url: "{{ route('participant.message.detail') }}",
                        data: {
                            id
                        },
                        beforeSend: function() {
                            $(loader).html('<i class="fa fa-spin fa-sync"></i>');
                            $(loader).attr("disabled", true);
                        },
                        success: function(data) {
                            $('#action').val('Edit');
                            $('.modal-title').html("Edit {{ session('title') }}");
                            $('#id_message').val(data.id);
                            $('#name').val(data.name);
                            tinymce.get('content').setContent(data.content);
                            $('#image-preview').attr('src', data.file ??
                                'https://via.placeholder.com/150');
                            $('#modalForm').modal('show');
                            $(loader).html(
                                '<i class="material-icons list-icon md-18">edit</i>');
                            $(loader).attr("disabled", false);

                        }
                    });
                });


            });

            function readURL(input, id) {
                id = id || '#image-preview';
                if (input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(id).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                    $('#image-preview').removeClass('hidden');
                    $('#start').hide();
                }
            }
        </script>
    @endpush
@endsection
