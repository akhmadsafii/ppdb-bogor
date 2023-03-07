@extends('layout.admin.main')
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5">Pengaturan Template {{ session('title') }}</h5>
        </div>
        <div class="page-title-right d-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Pengaturan</a>
                </li>
                <li class="breadcrumb-item active">Template {{ session('title') }}</li>
            </ol>
        </div>
    </div>
    <div class="page-title clearfix">
        <a class="mx-3"><i class="fas fa-wrench"></i> Pengaturan Template {{ session('title') }}</a>
        @if (session('title') != 'Surat')
            |<a href="{{ route('setting.template.card.output_form') }}" class="mx-3"><i class="fas fa-tasks"></i>
                Pengaturan Form
                Kartu</a>
        @endif
    </div>
    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-heading clearfix">
                        <form id="formSubmit">
                            <div class="row">
                                <div class="row">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($setting as $st)
                                        <div class="form-group">
                                            <div class="checkbox ml-4">
                                                <label>
                                                    <input type="hidden" name="id_setting_template_{{ $no }}"
                                                        value="{{ $st['id'] }}">
                                                    <input type="checkbox" id="option_check" class="option_check_tes"
                                                        name="c_{{ $no }}" value="1"
                                                        @if ($st['active'] == 1) checked @endif>
                                                    <span class="label-text">{{ $st['name'] }}</span>
                                                </label>
                                            </div>
                                        </div>
                                        @php
                                            $no++;
                                        @endphp
                                    @endforeach
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="jumlah" value="{{ count($setting) }}">
                                    <div class="btn-list">
                                        <button type="submit" id="btnSubmit" class="btn btn-info">
                                            <i class="fas fa-save"></i>
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        @include('plugins.sweetalert.sweetalert_js')
        <script type="text/javascript">
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#formSubmit').on('submit', function(event) {
                    event.preventDefault();
                    $("#btnSubmit").html(
                        '<i class="fa fa-spin fa-sync"></i> Memproses..');
                    $("#btnSubmit").attr("disabled", true);
                    $.ajax({
                        url: "{{ route('setting.template.update') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            swal('BERHASIL', data.message, 'success')
                            $('#btnSubmit').html('<i class="fas fa-save"></i> Simpan');
                            $("#btnSubmit").attr("disabled", false);
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            swal('GAGAL', res.message, 'error')
                            console.log(data);
                            $('#btnSubmit').html('<i class="fas fa-save"></i> Simpan');
                            $("#btnSubmit").attr("disabled", false);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
