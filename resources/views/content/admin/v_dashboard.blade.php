@extends('layout.admin.main')
@section('content')
    @push('styles')
        <link rel="preload" href="{{ asset('asset/custom/countdown.css') }}" as="style"
            onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="{{ asset('asset/custom/countdown.css') }}">
        </noscript>
        @include('plugins.datatable.datatable_css')
    @endpush
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5">{{ session('title') }}</h5>
        </div>
        <div class="page-title-right d-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="widget-list">
        @if ($setting && $setting['status_open'] == 1)
        @php
            if($setting && $setting['open_date'] < date('Y-m-d H:i:s') && $setting['closing_date'] .' '.$setting['closing_hour'] > date('Y-m-d H:i:s')){
                $date = date('Y-m-d H:i:s', strtotime($setting['closing_date'] . ' ' . $setting['closing_hour']));
                $title_register = 'WAKTU TUTUP PENDAFTARAN';
            }else{
                $date = date('Y-m-d H:i:s', strtotime($setting['open_date']));
                // dd($date);
                $title_register = 'WAKTU BUKA PENDAFTARAN';
            }
        @endphp
        {{-- {{ $date }} --}}
            <div class="row widget-holder d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="table-responsive">
                        <span class="text text-white">{{ $title_register }}</span>
                        <div class="timer d-flex justify-content-around">
                            <div class="box">
                                <span class="num" id="day-box" data-days></span>
                                <span class="text text-white">Hari</span>
                            </div>
                            <div class="box">
                                <span class="num" id="hr-box" data-hours>00</span>
                                <span class="text text-white">Jam</span>
                            </div>
                            <div class="box">
                                <span class="num" id="min-box" data-minutes>00</span>
                                <span class="text text-white">Menit</span>
                            </div>
                            <div class="box">
                                <span class="num" id="sec-box" data-seconds>00</span>
                                <span class="text text-white">Detik</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @php
                $date = date('Y-m-d H:i:s');
            @endphp
        @endif
        <div class="row widget-holder">
            <div class="col-md-4 col-sm-6 widget-holder widget-full-height">
                <div class="widget-bg bg-primary text-inverse">
                    <div class="widget-body">
                        <div class="widget-counter">
                            <h6>Total Payment</h6>
                            <h3 class="h1">Rp.<span
                                    class="counter conter1">{{ number_format($payment_result['all_payment'], 0) }}</span>
                            </h3><i class="material-icons list-icon">add_shopping_cart</i>
                            <hr>
                            <p>Total Payment Terkonfirm</p>
                            <p>Rp.<span
                                    class="counter conter0">{{ number_format($payment_result['payment_confirm'], 0) }}</span>
                            </p>
                            <a href="{{ route('payment.confirm', ['status' => 'confirmation']) }}"> Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 widget-holder widget-full-height">
                <div class="widget-bg bg-color-scheme text-inverse">
                    <div class="widget-body clearfix">
                        <div class="widget-counter">
                            <a href="{{ route('master_registration', ['based' => 'all-account']) }}">
                                <h6>Peserta Registrasi</h6>
                                <h3 class="h1"><span class="counter conter2">{{ $participant_approved['total'] }}</span>
                                </h3>
                                <i class="material-icons list-icon">event_available</i>
                            </a>
                        </div>
                        <hr>
                        <div class="widget-counter">
                            <a href="{{ route('account_participant') }}">
                                <h6>Peserta Belum Diputusan </h6>
                                <h3 class="h1"><span
                                        class="counter conter conter5">{{ $participant_approved['not_decided'] }}</span>
                                </h3><i class="material-icons list-icon">show_chart</i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 widget-holder widget-full-height">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        <div class="widget-counter">
                            <a href="{{ route('master_registration', ['based' => 'approved']) }}">
                                <h6>Peserta Diterima</h6>
                                <h3 class="h1"><span
                                        class="counter conter3">{{ $participant_approved['approved'] }}</span>
                                </h3><i class="material-icons list-icon">public</i>
                            </a>
                        </div>
                        <hr>
                        <div class="widget-counter">
                            <a href="{{ route('master_registration', ['based' => 'rejected']) }}">
                                <h6>Peserta Ditolak </h6>
                                <h3 class="h1"><span
                                        class="counter counter4">{{ $participant_approved['canceled'] }}</span>
                                </h3><i class="material-icons list-icon">show_chart</i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row widget-holder">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="box-title">Pesan Informasi</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-stripped table-hover">
                                <thead>
                                    <tr>
                                        <th>Dari</th>
                                        <th>Subject</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$message->isEmpty())
                                        @foreach ($message as $mg)
                                            <tr>
                                                <td>{{ $mg->participants->name }}</td>
                                                <td><a
                                                        href="{{ route('message.preview', ['message' => encrypt($mg['id'])]) }}">
                                                        {{ $mg->name }}</a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2" class="text-center">Tidak ada pesan yang tesedia</td>
                                        </tr>
                                    @endif

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="box-title">Konfirmasi Pembayaran</h5>
                        <hr>
                        <table class="table table-striped" id="data-tabel">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Metode</th>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
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
    @push('scripts')
        <script src="{{ asset('asset/custom/ribuan.js') }}"></script>
        @include('plugins.countdown.countdown_js')
        @include('plugins.datatable.datatable_js')
        <script type="text/javascript">
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var table = $('#data-tabel').DataTable({
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
                            data: 'name_participant',
                            name: 'name_participant',
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                        },
                        {
                            data: 'payment_method',
                            name: 'payment_method',
                            className: 'align-middle'
                        },
                        {
                            data: 'pay_date',
                            name: 'pay_date',
                            className: 'align-middle'
                        },
                        {
                            data: 'nominal',
                            name: 'nominal',
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
                            // console.log(data);
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

                timezz(document.querySelector('.timer'), {
                    date: new Date("{{ $date }}"),
                    pause: false,
                    stopOnZero: true,
                    beforeCreate() {},
                    beforeUpdate() {},
                    update(event) {},
                });
            });
        </script>
    @endpush
@endsection
