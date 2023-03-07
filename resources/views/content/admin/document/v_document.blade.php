@extends('layout.admin.main')
@section('content')
    @push('styles')
        <link href="{{ asset('asset/css/switch-custom.css') }}" rel="stylesheet" type="text/css">
        @include('plugins.datatable.datatable_css')
    @endpush
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5 text-capitalize">{{ session('title') }}</h5>
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
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        @php
                                            $img = asset('asset/image/user.png');
                                            if($participant['file'] != 'user.png'){
                                               $img = asset('thumbnail/' . $participant->file);
                                            }
                                        @endphp
                                        <img src="{{ $img }}" alt="" height="150">
                                    </div>
                                    <div class="card-footer text-center bg-info">
                                        <h3 class="box-title my-0 text-white">{{ $participant['name'] }}</h3>
                                        <h3 class="box-title my-0 text-white">NISN. {{ $participant['nisn'] ?? '-' }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <table class="table table-striped" id="data-tabel">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>File</th>
                                            <th>Nama</th>
                                            <th>Peserta</th>
                                            <th>NISN</th>
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
                        <input type="hidden" id="id_document" name="id" class="form-control" />
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="col-form-label" for="l1">Peserta</label>
                                    <input type="text" class="form-control" value="{{ $participant['name'] }}" readonly>
                                    <input type="hidden" name="id_participant" value="{{ $participant['id'] }}"
                                        id="id_participant">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="l1">Nama</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="">File</label>
                                    <input id="file" type="file" class="form-control-file" name="file"
                                        accept="image/*" onchange="readURL(this);">
                                </div>
                            </div>
                            <div class="col-md-4 m-auto">
                                <div class="form-group">
                                    <img id="image-preview" src="https://via.placeholder.com/150" alt="Preview"
                                        class="form-group mb-1" height="150px">
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
                            data: 'image',
                            name: 'image',
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                        },
                        {
                            data: 'name',
                            name: 'name',
                            className: 'align-middle'
                        },
                        {
                            data: 'participant',
                            name: 'participant',
                            className: 'align-middle'
                        },
                        {
                            data: 'nisn',
                            name: 'nisn',
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
                    $('#id_document').val("");
                    $('#formSubmit').trigger("reset");
                    $('.modal-title').html("Tambah {{ session('title') }}");
                    $('#image-preview').attr('src', 'https://via.placeholder.com/150');
                    $('#modalForm').modal('show');
                });

                $('body').on('submit', '#formSubmit', function(e) {
                    $("#btnSubmit").html(
                        '<i class="fa fa-spin fa-sync"></i> Memproses');
                    $("#btnSubmit").attr("disabled", true);
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('document.send') }}",
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
                                url: "{{ route('document.delete') }}",
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
                        url: "{{ route('document.detail') }}",
                        data: {
                            id
                        },
                        beforeSend: function() {
                            $(loader).html('<i class="fa fa-spin fa-sync"></i>');
                            $(loader).attr("disabled", true);
                        },
                        success: function(data) {
                            $('.modal-title').html("Edit {{ session('title') }}");
                            $('#id_document').val(data.id);
                            $('#name').val(data.name);
                            $('#image-preview').attr('src', data.file ??
                                'https://via.placeholder.com/150');
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
                        url: "{{ route('document.update_status') }}",
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

            function readURL(input, id) {
                id = id || '#image-preview';
                if (input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(id).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                    $('#image-preview').removeClass('hidden');
                    // $('#start').hide();
                }
            }
        </script>
    @endpush
@endsection
