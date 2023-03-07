@extends('layout.admin.main')
@section('content')
    @push('styles')
        <link href="{{ asset('asset/css/switch-custom.css') }}" rel="stylesheet" type="text/css">
        @include('plugins.datatable.datatable_css')
        @include('plugins.select2.select2_css')
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
    <div class="page-title clearfix">
        <a href="{{ route('setting.type_form') }}" class="mx-3"><i class="fas fa-arrow-left"></i> Kembali</a>|<a
            href="{{ route('form') }}" class="mx-3"><i class="fas fa-tasks"></i> Form</a>|<a href="{{ route('type_form') }}"
            class="mx-3"><i class="fas fa-th-list"></i>
            Kategori Form</a>
    </div>

    <div class="widget-list">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 widget-holder">
                <div class="widget-bg">
                    <div class="widget-heading clearfix">
                        <form id="formSubmit">
                            @php
                                $no = 1;
                            @endphp
                            <input type="hidden" name="total_form" value="{{ count($form) }}">
                            @foreach ($form as $fr)
                                <div class="form-group row">
                                    <input type="hidden" name="id_form_{{ $no }}" value="{{ $fr['id'] }}">
                                    <label class="col-md-3 col-form-label" for="l0">{{ $fr['name'] }}</label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="sort_{{ $no }}"
                                            value="{{ $fr['order_form'] }}" onkeypress="return onlyNumber(event)" type="text">
                                    </div>
                                </div>
                                @php
                                    $no++;
                                @endphp
                            @endforeach
                            <div class="form-actions">
                                <div class="form-group row">
                                    <div class="col-md-9 ml-md-auto btn-list">
                                        <button class="btn btn-outline-default btn-rounded" type="button">Kembali</button>
                                        <button class="btn btn-info btn-rounded" id="btnSubmit"
                                            type="submit">Simpan</button>
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
        <script src="{{ asset('asset/custom/onlyNumber.js') }}"></script>
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
                        url: "{{ route('form.update_number') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            window.location.reload();
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
