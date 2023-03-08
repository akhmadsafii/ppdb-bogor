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

    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-heading clearfix">
                        <table class="table table-striped" id="data-tabel">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Alamat</th>
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
        <div class="modal modal-info fade bs-modal-lg-primary" tabindex="-1" role="dialog" id="modalForm" aria-hidden="true"
            style="display: none">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-inverse">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="myMediumModalLabel"></h5>
                    </div>
                    <form id="formSubmit">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id_supervisor">
                            <div class="form-group">
                                <label class="col-form-label" for="l0">Nama</label>
                                <input class="form-control" id="name" name="name" placeholder="Nama Admin"
                                    type="text">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="l0">Email</label>
                                <input class="form-control" id="email" name="email" placeholder="Email Admin"
                                    type="email">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="l0">Nomer Telepon</label>
                                <input class="form-control" id="phone" name="phone" placeholder="Telepon Admin"
                                    type="text">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="l0">Password</label>
                                <div class="input-group">
                                    <input class="form-control input-lg" id="password"
                                        placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" name="password" type="password"
                                        value="">
                                    <span class="input-group-addon showPass" style="cursor: pointer"><i
                                            class="material-icons list-icon eye">remove_red_eye</i></span>
                                    <span class="input-group-addon generatePass" style="cursor: pointer"><i
                                            class="material-icons list-icon">shuffle</i></span>
                                </div>
                                <small class="text-red d-none" id="text-alert">*Bisa dikosongi jika tidak ingin
                                    mengganti password</small>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-1">
                                        <label class="col-form-label" for="l0">Alamat</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <textarea name="address" id="address" class="form-control" rows="4"></textarea>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="col-form-label" for="l0">Foto</label>
                                        <input type="file" name="file" id="" class="form-control-file"
                                            onchange="readURL(this);">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img id="image-preview" src="https://via.placeholder.com/150" alt="Preview"
                                        class="form-group my-1 rounded w-100">
                                    <br>
                                    <span>*Gunakan ukuran 150 x 150 untuk hasil yang terbaik</span>
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
                    }, ],
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
                            data: 'email',
                            name: 'email',
                            defaultContent: '-',
                            className: 'align-middle'
                        },
                        {
                            data: 'phone',
                            name: 'phone',
                            defaultContent: '-',
                            className: 'align-middle'
                        },
                        {
                            data: 'address',
                            name: 'address',
                            defaultContent: '-',
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

                $('.showPass').mousedown(function() {
                    $('#password').attr('type', 'text');
                });
                $('.showPass').mouseup(function() {
                    $('#password').attr('type', 'password');
                });

                $(document).on('click', '.generatePass', function() {
                    var length = 8,
                        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
                        retVal = "";
                    for (var i = 0, n = charset.length; i < length; ++i) {
                        retVal += charset.charAt(Math.floor(Math.random() * n));
                    }
                    $('#password').val(retVal);
                });

                $(document).on('click', '.btn-add', function() {
                    $('#formSubmit').trigger("reset");
                    $('#text-alert').addClass("d-none");
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
                        url: "",
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
                                url: "{{ route('supervisor.delete') }}",
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
                                    // console.log(data);
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
                        url: "{{ route('supervisor.detail') }}",
                        data: {
                            id
                        },
                        beforeSend: function() {
                            $(loader).html('<i class="fa fa-spin fa-sync"></i>');
                            $(loader).attr("disabled", true);
                        },
                        success: function(data) {
                            $('.modal-title').html("Edit {{ session('title') }}");
                            $('#text-alert').removeClass("d-none");
                            $('#id_supervisor').val(data.id);
                            $('#name').val(data.name);
                            $('#email').val(data.email);
                            $('#phone').val(data.phone);
                            $('#password').val('');
                            $('#address').val(data.address);
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
                        url: "{{ route('supervisor.update_status') }}",
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
                    $('#start').hide();
                }
            }
        </script>
    @endpush
@endsection
