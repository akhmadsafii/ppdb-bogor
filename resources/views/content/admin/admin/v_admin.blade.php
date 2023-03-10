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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-inverse">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="myMediumModalLabel"></h5>
                    </div>
                    <form id="formSubmit">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="id" id="id_admin">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="l0">Nama</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="name" name="name" placeholder="Nama Admin"
                                                type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="l0">Email</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="email" name="email" placeholder="Email Admin"
                                                type="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="l0">Tmpt lhr</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="place_of_birth" name="place_of_birth"
                                                placeholder="Tempat Lahir" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="l0">Tgl lhr</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="date_of_birth" name="date_of_birth"
                                                placeholder="Tanggal Lahir" type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="l0">Jenkel</label>
                                        <div class="col-md-9">
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="male">Laki laki</option>
                                                <option value="female">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="l0">Agama</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="religion" id="religion">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="l0">Username</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="username" name="username">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="l0">Password</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input class="form-control input-lg" id="password"
                                                    placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" name="password"
                                                    type="password" value="">
                                                <span class="input-group-addon showPass" style="cursor: pointer"><i
                                                        class="material-icons list-icon eye">remove_red_eye</i></span>
                                                <span class="input-group-addon generatePass" style="cursor: pointer"><i
                                                        class="material-icons list-icon">shuffle</i></span>
                                            </div>
                                            <small class="text-red d-none" id="text-alert">*Bisa dikosongi jika tidak ingin
                                                mengganti password</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="l0">Alamat</label>
                                        <div class="col-md-9">
                                            <textarea name="address" id="address" class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row mb-1">
                                        <label class="col-md-3 col-form-label" for="l0">Foto</label>
                                        <div class="col-md-9 my-auto">
                                            <input type="file" name="file" id="" class="form-control-file"
                                                onchange="readURL(this);">
                                        </div>
                                    </div>
                                    <div class="row d-flex flex-row-reverse">
                                        <div class="col-md-9">
                                            <img id="image-preview" src="https://via.placeholder.com/150" alt="Preview"
                                                class="form-group my-1 rounded" width="50%">
                                            <br>
                                            <span>*Gunakan ukuran 150 x 150 untuk hasil yang terbaik</span>
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

                var table = $('#data-tabel').DataTable({
                    dom: "<'row'<'col-sm-9'B><'col-sm-3'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'l><'col-sm-7'p>>",
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "",
                    buttons: buttons,
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
                            className: 'align-middle',
                            visible: isVisibleColumns
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-center align-middle',
                            visible: isVisibleColumns
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
                        url: "{{ route('account_admin.send') }}",
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
                                url: "{{ route('account_admin.delete') }}",
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

                $(document).on('click', '.edit', function() {
                    var id = $(this).data('id');
                    let loader = $(this);
                    $.ajax({
                        url: "{{ route('account_admin.detail') }}",
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
                            $('#id_admin').val(data.id);
                            $('#name').val(data.name);
                            $('#email').val(data.email);
                            $('#place_of_birth').val(data.place_of_birth);
                            $('#date_of_birth').val(data.date_of_birth);
                            $('#gender').val(data.gender).trigger('change');
                            $('#religion').val(data.religion);
                            $('#username').val(data.username);
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

                $(document).on('click', '.detail', function() {
                    var id = $(this).data('id');
                    let loader = $(this);
                    $.ajax({
                        url: "{{ route('account_admin.detail') }}",
                        data: {
                            id
                        },
                        beforeSend: function() {
                            $(loader).html('<i class="fa fa-spin fa-sync"></i>');
                            $(loader).attr("disabled", true);
                        },
                        success: function(data) {
                            $('#modal-title_detail').html("Detail {{ session('title') }}");
                            var script_html = ` <div class="d-flex align-items-center">`;
                            script_html += `<img src="` + data.file +
                                `" alt="" height="150" class="rounded mr-2">`;
                            script_html += `<div class="w-100">
                                                <div class="form-group row m-0">
                                                    <label class="col-md-4 col-form-label">Nama</label>
                                                    <div class="col-md-8">
                                                        <p class="form-control-plaintext text-capitalize">` + data
                                .name + `</p>
                                                    </div>
                                                </div>
                                                <div class="form-group row m-0">
                                                    <label class="col-md-4 col-form-label">Email</label>
                                                    <div class="col-md-8">
                                                        <p class="form-control-plaintext text-capitalize">` + data
                                .email + `</p>
                                                    </div>
                                                </div>
                                                <div class="form-group row m-0">
                                                    <label class="col-md-4 col-form-label">Tempat, Tgl Lahir</label>
                                                    <div class="col-md-8">
                                                        <p class="form-control-plaintext text-capitalize">` + data
                                .place_of_birth + `, ` + data
                                .date_of_birth + `</p>
                                                    </div>
                                                </div>
                                                <div class="form-group row m-0">
                                                    <label class="col-md-4 col-form-label">Jenis Kelamin</label>
                                                    <div class="col-md-8">
                                                        <p class="form-control-plaintext text-capitalize">` + data
                                .gender + `</p>
                                                    </div>
                                                </div>
                                                <div class="form-group row m-0">
                                                    <label class="col-md-4 col-form-label">Agama</label>
                                                    <div class="col-md-8">
                                                        <p class="form-control-plaintext text-capitalize">` + data
                                .religion + `</p>
                                                    </div>
                                                </div>
                                                <div class="form-group row m-0">
                                                    <label class="col-md-4 col-form-label">Alamat</label>
                                                    <div class="col-md-8">
                                                        <p class="form-control-plaintext text-capitalize">` + data
                                .address + `</p>
                                                    </div>
                                                </div>
                                            </div>`;
                            $('#content-mod_detail').html(script_html);
                            $('#modalDetail').modal('show');
                            $(loader).html(
                                '<i class="material-icons list-icon md-18">info</i>');
                            $(loader).attr("disabled", false);

                        }
                    });
                });

                $(document).on('click', '.status_check', function() {
                    let id = $(this).data('id');
                    let value = $(this).is(':checked') ? 1 : 2;
                    $.ajax({
                        url: "{{ route('account_admin.update_status') }}",
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
