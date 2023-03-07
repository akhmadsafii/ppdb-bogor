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
                            <a href="{{ route('payment.confirm', ['status' => 'confirmation']) }}"><i
                                    class="fas fa-list-ol"></i> Konfirmasi</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="{{ route('payment.confirm', ['status' => 'approved']) }}"><i class="fas fa-tasks"></i>
                                Diterima</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="{{ route('payment.confirm', ['status' => 'canceled']) }}"><i class="fas fa-times"></i>
                                Ditolak</a>
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
                                    <th>Bukti</th>
                                    <th>NISN</th>
                                    <th>Peserta</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Metode</th>
                                    <th>Nominal</th>
                                    <th>Nama Pengirim</th>
                                    <th>Catatan</th>
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
                                <label class="col-md-3 col-form-label">Status <span class="text-danger">*</span></label>
                                <div class="col-md-9 my-auto">
                                    <select name="payment_status" class="form-control">
                                        <option value="" selected disabled>-- Pilih Status --</option>
                                        <option value="3">Ditolak</option>
                                        <option value="1">Diterima</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mx-0 my-2">
                                <label class="col-md-3 col-form-label">Deskripsi <span class="text-danger">*</span></label>
                                <div class="col-md-9 my-auto">
                                    <textarea name="description" rows="3" class="form-control"></textarea>
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
                                            <h3 class="box-title my-0 text-white text-capitalize">Bukti
                                                Transfer</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="id" id="id_payment">
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
                                        <label class="col-md-3 col-form-label">Nominal</label>
                                        <div class="col-md-9 my-auto">
                                            <p class="form-control-plaintext text-capitalize detail-nominal"></p>
                                        </div>
                                    </div>
                                    <div class="form-group row m-0">
                                        <label class="col-md-3 col-form-label">Bank Tujuan</label>
                                        <div class="col-md-9 my-auto">
                                            <p class="form-control-plaintext text-capitalize detail-bank_destination"></p>
                                        </div>
                                    </div>
                                    <div class="form-group row m-0">
                                        <label class="col-md-3 col-form-label">Status <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9 my-auto">
                                            <select name="status_payment" id="status_payment" class="form-control">
                                                <option value="" selected disabled>-- Pilih Keputusan --</option>
                                                <option value="2">Ditolak</option>
                                                <option value="1">Diterima</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mx-0 my-2">
                                        <label class="col-md-3 col-form-label">Catatan <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9 my-auto">
                                            <textarea name="description" id="description" rows="3" class="form-control"></textarea>
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
        <script src="{{ asset('asset/custom/ribuan.js') }}"></script>
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
                        url: "{{ route('payment.detail') }}",
                        data: {
                            id
                        },
                        beforeSend: function() {
                            $(loader).html('<i class="fa fa-spin fa-sync"></i>');
                            $(loader).attr("disabled", true);
                        },
                        success: function(data) {
                            $('.modal-title').html("Edit {{ session('title') }}");
                            $('#id_payment').val(data.id);
                            $('.detail-name').html(data.participants.name);
                            $('.detail-nisn').html(data.participants.nisn);
                            $('.detail-nominal').html(rubahRibuan(data.nominal));
                            $('.detail-bank_destination').html(data.destination_bank);
                            if (data.payment_status != 0) {
                                $('#status_payment').val(data.payment_status);
                            }
                            $('#description').val(data.description);
                            $('#image-preview').attr('src', data.proof ??
                                "{{ asset('asset/image/empty.png') }}");
                            $('#modalForm').modal('show');
                            $(loader).html(
                                '<i class="material-icons list-icon md-18">edit</i>');
                            $(loader).attr("disabled", false);

                        }
                    });
                });



                $(document).on('click', '.btn-edit', function() {
                    $('#titleAtOnce').html("Keputusan Massal");
                    $('#formAtOnce').trigger("reset");
                    $('#modalAtOnce').modal('show');
                });

                $(document).on('click', '.detail', function() {
                    var id = $(this).data('id');
                    let loader = $(this);
                    $.ajax({
                        url: "{{ route('payment.detail') }}",
                        data: {
                            id
                        },
                        beforeSend: function() {
                            $(loader).html('<i class="fa fa-spin fa-sync"></i>');
                            $(loader).attr("disabled", true);
                        },
                        success: function(data) {
                            $('#modal-title_detail').html("Detail {{ session('title') }}");
                            var print_html = `<div class="w-100">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="align-middle">NISN</th>
                                                <th class="align-middle">: ` + data.participants.nisn + `</th>
                                                <th class="align-middle" width="50"></th>
                                                <th class="align-middle">Nama Pengirim</th>
                                                <th class="align-middle">: ` + data.on_behalf + `</th>
                                                <th class="align-middle" rowspan="5">
                                                    <div class="p-2">`;
                            if (data.proof != null) {
                                print_html += `<img src="` + data.proof + `"
                                                            alt="" class="rounded" width="200">`;
                            } else {
                                print_html += `<img src="{{ asset('asset/image/empty.png') }}"
                                                            alt="" class="rounded" width="200">`;
                            }
                            print_html += `
                            <p class="text-center">Bukti Pembayaran</p>
                            </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="align-middle">Peserta</th>
                                                <td class="align-middle">: ` + data.participants.name + `</td>
                                                <td class="align-middle" width="50"></td>
                                                <th class="align-middle">Asal Bank Pengirim</th>
                                                <td class="align-middle">: ` + data.home_bank + `</td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle">Metode Bayar</th>
                                                <td class="align-middle">: ` + data.payment_method + `</td>
                                                <td class="align-middle" width="50"></td>
                                                <th class="align-middle">Tujuan Bank Transfer</th>
                                                <td class="align-middle">: ` + data.destination_bank + `</td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle">Nominal</th>
                                                <td class="align-middle">: ` + rubahRibuan(data.nominal) + `</td>
                                                <td class="align-middle" width="50"></td>
                                                <th class="align-middle">Nomor Rekening Tujuan</th>
                                                <td class="align-middle">: ` + data.account_number + `</td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle">Tanggal Bayar</th>
                                                <td class="align-middle">: ` + data.pay_date + `</td>
                                                <td class="align-middle" width="50"></td>
                                                <th class="align-middle">Status</th>
                                                <td class="align-middle">: ` + data.status_payment + `</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>`;

                            $('#content-mod_detail').html(print_html);
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
                    var id_payment = [];
                    $("input:checkbox[class=single-check]:checked").each(function() {
                        id_payment.push($(this).val());
                    });
                    if (id_payment.length > 0) {
                        let moveConfirm = confirm('Apa anda yakin ingin mengupdate sekaligus yang terpilih?');
                        if (moveConfirm == true) {
                            $.ajax({
                                url: "{{ route('payment.update_status_at_time') }}",
                                type: "POST",
                                data: $(this).serialize() + "&id_payment=" + JSON.stringify(
                                    id_payment),
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
                        url: "{{ route('payment.update_payment') }}",
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
                            className: 'btn btn-edit d-none'
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
                            data: 'nisn',
                            name: 'nisn',
                            className: 'align-middle'
                        },
                        {
                            data: 'name_participant',
                            name: 'name_participant',
                            defaultContent: '-',
                            className: 'align-middle'
                        },
                        {
                            data: 'pay_date',
                            name: 'pay_date',
                            defaultContent: '-',
                            className: 'align-middle'
                        },
                        {
                            data: 'payment_method',
                            name: 'payment_method',
                            className: 'align-middle'
                        },
                        {
                            data: 'nominal',
                            name: 'nominal',
                            className: 'align-middle text-left'
                        },
                        {
                            data: 'on_behalf',
                            name: 'on_behalf',
                            className: 'align-middle'
                        },
                        {
                            data: 'description',
                            name: 'description',
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
