@extends('layout.admin.main')
@section('content')
    @push('styles')
        @include('plugins.tags.tags_css')
    @endpush
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5">{{ session('title') }}</h5>
        </div>
        <div class="page-title-right d-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Pengaturan</a>
                </li>
                <li class="breadcrumb-item active">{{ session('title') }}</li>
            </ol>
        </div>
    </div>
    <div class="widget-list">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 widget-holder">
                <div class="widget-bg">
                    <div class="widget-heading clearfix">
                        <form id="formSubmit">
                            <input type="hidden" name="id" id="id_setting"
                                value="{{ $setting ? $setting['id'] : '' }}">
                            <div class="form-group">
                                <label for="">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $setting ? $setting['name'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="">Biaya Pendaftaran <span class="text-danger">*</span></label>
                                <input type="text" id="registration_fee" name="registration_fee"
                                    class="form-control ribuan"
                                    value="{{ $setting ? str_replace(',', '.', number_format($setting['registration_fee'])) : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="">Verifikasi Pembayaran <span class="text-danger">*</span></label>
                                <select name="payment" id="payment" class="form-control">
                                    <option value="" selected disabled>--Pilih Verifikasi Pembayaran--</option>
                                    <option value="0" {{ $setting && $setting['payment'] == 0 ? 'selected' : '' }}>
                                        Tidak</option>
                                    <option value="1" {{ $setting && $setting['payment'] == 1 ? 'selected' : '' }}>Ya
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan <span class="text-danger">*</span></label>
                                <textarea name="information" id="information" rows="3" class="editor">{{ $setting ? $setting['information'] : '' }}</textarea>
                            </div>
                            <div class="btn-list">
                                <button type="submit" class="btn btn-info" id="saveBtn">Simpan</button>
                                <button type="button" class="btn btn-default">Cancel</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('asset/custom/ribuan.js') }}"></script>
        @include('plugins.sweetalert.sweetalert_js')
        @include('plugins.tinymce.tinymce_js')
        <script type="text/javascript">
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#formSubmit').on('submit', function(event) {
                    event.preventDefault();
                    $("#saveBtn").html(
                        '<i class="fa fa-spin fa-sync"></i> Memproses..');
                    $("#saveBtn").attr("disabled", true);
                    $.ajax({
                        url: "{{ route('setting.payment.update') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",

                        success: function(data) {
                            swal('BERHASIL !', data.message, 'success')
                            $('#saveBtn').html('Simpan');
                            $("#saveBtn").attr("disabled", false);
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            swal('GAGAL', res.message, 'error')
                            console.log(data);
                            $('#saveBtn').html('Simpan');
                            $("#saveBtn").attr("disabled", false);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
