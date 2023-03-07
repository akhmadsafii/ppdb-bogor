@extends('layout.admin.main')
@section('content')
    @push('styles')
        <style>
            li.nav-item {
                width: 250px !important
            }
        </style>
    @endpush
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5">Pengaturan {{ session('title') }}</h5>
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
    <div class="page-title clearfix">
        <a href="{{ route('form.sort_number') }}" class="mx-3"><i class="fas fa-sort"></i> Urutkan Form</a> |<a
            href="{{ route('form') }}" class="mx-3"><i class="fas fa-tasks"></i> Form</a> | <a
            href="{{ route('type_form') }}" class="mx-3"><i class="fas fa-th-list"></i>
            Kategori Form</a>
    </div>
    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-heading clearfix">
                        <form id="formSubmit">
                            <div class="table-responsive">
                                <div class="w-100">
                                    <div class="tabs tabs-vertical">
                                        <ul class="nav nav-tabs flex-column">
                                            @foreach ($type as $tp)
                                                <li class="nav-item" aria-expanded="false"><a
                                                        class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                        href="#{{ $tp['initial'] }}" data-toggle="tab"
                                                        aria-expanded="true">{{ $tp['name'] ?? '' }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            @php
                                                $no_type = 1;
                                            @endphp
                                            @foreach ($type as $typ)
                                                <input type="hidden" name="total_type" value="{{ count($type) }}">
                                                <input type="hidden" name="id_type_{{ $no_type }}"
                                                    value="{{ $typ['id'] }}">
                                                <div class="tab-pane {{ $loop->first ? 'active' : '' }}"
                                                    id="{{ $typ['initial'] }}" aria-expanded="true">
                                                    <div class="card border-0" style="min-width: 300px">
                                                        <div class="card-header">
                                                            <h3 class="box-title mr-b-0">
                                                                {{ $typ['name'] ?? '' }}</h3>

                                                        </div>
                                                        <div class="card-body">
                                                            <div class="checkbox">
                                                                <label class="checkbox-checked">
                                                                    <input type="checkbox" name="select-all" id="select-all"
                                                                        class="select-all" onchange="selectBox(this, {{ $typ['id'] }})"> <span
                                                                        class="label-text">Select/Desellect
                                                                        All</span>
                                                                </label>
                                                            </div>
                                                            @php
                                                                $no_form = 1;
                                                            @endphp
                                                            @foreach ($typ->forms as $child)
                                                                <div class="checkbox ml-4">
                                                                    <label>
                                                                        <input type="hidden"
                                                                            name="total_form_type_{{ $typ->id }}"
                                                                            value="{{ count($typ->forms) }}">
                                                                        <input type="hidden"
                                                                            name="id_form_type_{{ $typ['id'] }}_number_{{ $no_form }}"
                                                                            value="{{ $child['id'] }}">
                                                                        <input type="checkbox" id="option_check"
                                                                            class="option_check{{ $child['id'] }} check_auto_{{ $typ['id'] }}"
                                                                            name="form_type_{{ $typ['id'] }}_number_{{ $no_form }}"
                                                                            value="1"
                                                                            @if ($child['status_form'] == 1) checked="checked" @endif>
                                                                        <span
                                                                            class="label-text">{{ $child['name'] ?? '' }}</span>
                                                                    </label>

                                                                </div>
                                                                @php
                                                                    $no_form++;
                                                                @endphp
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-actions modal-footer">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 btn-list">
                                            <button type="submit" class="btn btn-info" id="btnSubmit">
                                                <i class="material-icons list-icon">save</i>
                                                Simpan
                                            </button>
                                        </div>
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


                $('body').on('submit', '#formSubmit', function(e) {
                    $("#btnSubmit").html(
                        '<i class="fa fa-spin fa-sync"></i> Memproses');
                    $("#btnSubmit").attr("disabled", true);
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('form.update_checked') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
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

            function selectBox(element, type) {
                $(".check_auto_" + type).prop('checked', $(element).prop("checked"));
            }
        </script>
    @endpush
@endsection
