@extends('layout.participant.main')
@section('content')
    @push('styles')
        @include('plugins.datetime.datetime_css')
        <style>
            .absolute-date {
                position: absolute;
                background-color: rgba(250, 250, 250, 0.9);
                width: 120px;
                height: 80px;
                text-align: center;
                padding: 15px 0px;
                border-radius: 10px;
                right: 20px;
                top: 20px;
            }

            .shadow-lg {
                box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
                border-radius: 20px
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
                <li class="breadcrumb-item"><a href="{{ route('participant.payment.history') }}">Tagihan</a>
                </li>
                <li class="breadcrumb-item active">{{ session('title') }}</li>
            </ol>
        </div>
    </div>
    <div class="row page-title clearfix">
        <div class="page-title-left">
        </div>
        <div class="page-title-right d-inline-flex">
            <p class="text-danger "> <i class="material-icons list-icon">warning</i> Tanda (*) Form harus disi!.
            </p>
        </div>
    </div>

    <div class="widget-list">
        <form id="formSubmit">
            <div class="row">
                <div class="col-md-7">
                    <div class="widget-bg">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="l0">Nama</label>
                            <div class="col-md-8">
                                <input type="hidden" name="id_participant" value="{{ $data['id_participant'] }}">
                                <input class="form-control" id="name" type="text" name="name"
                                    value="{{ $data['name'] }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="l0">NISN</label>
                            <div class="col-md-8">
                                <input class="form-control" id="nisn" type="text" name="nisn"
                                    value="{{ $data['nisn'] }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="l0">Tahun Ajaran</label>
                            <div class="col-md-8">
                                <input class="form-control" id="school_year" type="text" name="school_year"
                                    value="{{ $data['school_year'] }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="l0">Nama Pengirim</label>
                            <div class="col-md-8">
                                <input class="form-control" id="on_behalf" type="text" name="on_behalf"
                                    value="{{ $data['on_behalf'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="l0">Bank Asal Pengirim</label>
                            <div class="col-md-8">
                                <input class="form-control" id="home_bank" type="text" name="home_bank"
                                    value="{{ $data['home_bank'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="l0">Nomor Rekening Tujuan</label>
                            <div class="col-md-8">
                                <input class="form-control" id="account_number" type="text" name="account_number"
                                    value="{{ $data['account_number'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="l0">Bank Tujuan</label>
                            <div class="col-md-8">
                                <input class="form-control" id="destination_bank" type="text" name="destination_bank"
                                    value="{{ $data['destination_bank'] }}">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-5">
                    <div class="widget-bg">
                        <div class="form-group">
                            <label for="">Tanggal Kirim</label>
                            <input type="text" name="pay_date" class="form-control datepicker" id="pay_date"
                                value="{{ $data['pay_date'] != null ? $data['pay_date'] : date('d-m-Y') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Nominal Transfer</label>
                            <input type="text" name="nominal" class="form-control ribuan" id="nominal"
                                value="{{ str_replace(',', '.', number_format($data['registration_fee'])) }}">
                        </div>
                        <div class="form-group">
                            <label for="">Bukti Pembayaran</label>
                            <input type="file" name="proof" class="form-control-file" onchange="readURL(this);">
                        </div>
                        <div class="form-group">
                            <img id="image-preview"
                                src="{{ $data['proof'] != null ? Helper::showImage($data['proof']) : 'https://via.placeholder.com/150' }}"
                                alt="Preview" width="150">
                        </div>
                        <div class="form-actions btn-list">
                            <a class="btn btn-outline-default"
                                href="{{ route('participant.payment.history') }}">Kembali</a>
                            <button class="btn btn-info" type="submit" id="btnSubmit">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        @include('plugins.datetime.datetime_js')
        <script src="{{ asset('asset/custom/ribuan.js') }}"></script>
        @include('plugins.sweetalert.sweetalert_js')
        <script type="text/javascript">
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('body').on('submit', '#formSubmit', function(e) {
                    $("#btnSubmit").html(
                        '<i class="fa fa-spin fa-sync"></i> Memproses');
                    $("#btnSubmit").attr("disabled", true);
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('participant.payment.save_billing') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            // $('#formSubmit').trigger("reset");
                            window.location.href = "{{ route('participant.payment.history') }}"
                            // $('#btnSubmit').html('Simpan');
                            // $("#btnSubmit").attr("disabled", false);
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
