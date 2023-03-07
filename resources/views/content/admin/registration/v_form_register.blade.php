@extends('layout.admin.main')
@section('content')
    @push('styles')
        @include('plugins.datetime.datetime_css')
    @endpush
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5">{{ session('title') }}</h5>
        </div>
        <div class="page-title-right d-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Peserta</a>
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
                        <form id="formSubmit">

                            <div class="row">
                                @php
                                    $no = 1;
                                @endphp
                                @if (!empty($form))
                                    <input type="hidden" name="total" value="{{ count($form) }}">
                                    @foreach ($form as $fr)
                                        @switch($fr['type'])
                                            @case('option')
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="hidden" name="id_form_{{ $no }}"
                                                            value="{{ $fr['id'] }}">
                                                        <label for="">{{ $fr['name'] }}</label>
                                                        <select name="value_form_{{ $no }}" class="form-control">
                                                            <option value="">-- Pilih {{ $fr['name'] }} --</option>
                                                            @if ($fr['initial'] == 'jenkel')
                                                                <option value="male">Laki - laki</option>
                                                                <option value="female">Perempuan</option>
                                                            @elseif ($fr['initial'] == 'jurusan' ||
                                                                $fr['initial'] == 'jurusan2' ||
                                                                $fr['initial'] == 'jurusan3' ||
                                                                $fr['initial'] == 'jurusan_diterima')
                                                                @foreach (explode(',', $fr['value']) as $info)
                                                                    <option value="{{ $info }}">{{ $info }}
                                                                    </option>
                                                                @endforeach
                                                            @elseif($fr['initial'] == 'gelombang')
                                                                <option value="1">Gelombang 1</option>
                                                                <option value="2">Gelombang 2</option>
                                                                <option value="3">Gelombang 3</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            @break

                                            @case('date')
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="hidden" name="id_form_{{ $no }}"
                                                            value="{{ $fr['id'] }}">
                                                        <label for="">{{ $fr['name'] }}</label>
                                                        <div class="input-group input-has-value">
                                                            <input type="text" name="value_form_{{ $no }}"
                                                                value="{{ $fr['value'] }}" readonly="readonly"
                                                                class="form-control datepicker">
                                                            <span class="input-group-addon"><i
                                                                    class="list-icon material-icons">date_range</i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @break

                                            @case('text')
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="hidden" name="id_form_{{ $no }}"
                                                            value="{{ $fr['id'] }}">
                                                        <label for="">{{ $fr['name'] }}</label>
                                                        @if ($fr['initial'] == 'jalur_pendaftaran')
                                                            <select class="form-control" name="value_form_{{ $no }}">
                                                                <option value="" disabled="disabled">-- Pilih
                                                                    {{ $fr['name'] }}
                                                                    ---
                                                                </option>
                                                                @foreach (explode(',', $fr['value']) as $info)
                                                                    <option value="{{ $info }}">{{ $info }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <div class="input-group">
                                                                <input type="text" name="value_form_{{ $no }}"
                                                                    autocomplete="off" class="form-control"
                                                                    value="{{ $fr['value'] }}"
                                                                    title="Format harus berisi angka saja "
                                                                    placeholder="{{ $fr['name'] }}">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @break

                                            @case('textarea')
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">{{ $fr['name'] }}</label>
                                                        <textarea name="value_form_{{ $no }}" rows="3" class="form-control" placeholder="{{ $fr['name'] }}">{{ $fr['value'] }}</textarea>
                                                    </div>
                                                </div>
                                            @break
                                        @endswitch
                                        @php
                                            $no++;
                                        @endphp
                                    @endforeach
                                @else
                                    <div class="col-md-12">
                                        <p>Peserta terdeteksi belum melakukan registrasi.</p>
                                    </div>
                                @endif

                                <div class="col-md-12">
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
        @include('plugins.datetime.datetime_js')
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
                    $.ajax({
                        url: "{{ route('master_registration.send') }}",
                        method: "POST",
                        data: $(this).serialize() + "&code={{ $_GET['code'] }}",
                        dataType: "json",
                        success: function(data) {
                            window.location.href =
                                "{{ route('master_registration', ['based' => 'all-account']) }}"

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
        </script>
    @endpush
@endsection
