@extends('layout.participant.main')
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
                <li class="breadcrumb-item"><a href="{{ route('participant.dashboard-participant') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Pendaftaran</a>
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
                        @if (!empty($result['form']))
                            @if (!empty($quota['quota']) >= !empty($quota['registration']) && !empty($quota['quota']) != 0)
                                <p class="text-red"> Maaf Kouta Pendaftaran PPDB Telah Terpenuhi!</p>
                            @else
                                <form id="formSubmit">
                                    <input type="hidden" name="total" value="{{ count($result['form']) }}">
                                    <div class="row">
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($result['form'] as $val)
                                            @switch($val['type'])
                                                @case('option')
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">{{ $val['name'] }}</label>
                                                            <input type="hidden" name="id_registration_{{ $no }}"
                                                                value="{{ $val['id'] }}">
                                                            <select class="form-control" name="val_registration_{{ $no }}"
                                                                class="form-control">
                                                                @if ($val['initial'] == 'jenkel')
                                                                    <option value="" disabled="disabled">-- Pilih
                                                                        {{ $val['name'] }}
                                                                        ---
                                                                    </option>
                                                                    <option value="l"
                                                                        {{ $val['value'] == 'l' ? 'selected' : '' }}>
                                                                        Laki - laki</option>
                                                                    <option value="p"
                                                                        {{ $val['value'] == 'p' ? 'selected' : '' }}>
                                                                        Perempuan</option>
                                                                @elseif ($val['initial'] == 'jurusan' ||
                                                                    $val['initial'] == 'jurusan2' ||
                                                                    $val['initial'] == 'jurusan3' ||
                                                                    $val['initial'] == 'jurusan_diterima')
                                                                    <option value="" disabled="disabled">-- Pilih
                                                                        {{ $val['name'] }}
                                                                        ---
                                                                    </option>
                                                                    @foreach (explode(',', $val['value']) as $info)
                                                                        <option value="{{ $info }}">{{ $info }}
                                                                        </option>
                                                                    @endforeach
                                                                @elseif($val['initial'] == 'gelombang')
                                                                    <option value="1"> Gelombang 1
                                                                    </option>
                                                                    <option value="2"> Gelombang 2
                                                                    </option>
                                                                    <option value="3"> Gelombang 3
                                                                    </option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                @break

                                                @case('date')
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="hidden" name="id_registration_{{ $no }}"
                                                                value="{{ $val['id'] }}">
                                                            <label for="">{{ $val['name'] }}</label>
                                                            <div class="input-group input-has-value">
                                                                <input type="text" name="val_registration_{{ $no }}"
                                                                    value="{{ old('value') ?? ($val['value'] ?? \Carbon\Carbon::now()->format('Y-m-d')) }}"
                                                                    class="form-control datepicker" readonly="readonly"
                                                                    data-date-format="yyyy-mm-dd"
                                                                    data-plugin-options='{"autoclose": true}'>
                                                                <span class="input-group-addon"><i
                                                                        class="list-icon material-icons">date_range</i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @break

                                                @case('text')
                                                    @if ($val['initial'] == 'jalur_pendaftaran')
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="hidden" name="id_registration_{{ $no }}"
                                                                    value="{{ $val['id'] }}">
                                                                <label for="">{{ $val['name'] }}</label>
                                                                <select class="form-control"
                                                                    name="val_registration_{{ $no }}">
                                                                    <option value="" disabled="disabled">-- Pilih
                                                                        {{ $val['name'] }}
                                                                        ---
                                                                    </option>
                                                                    @foreach (explode(',', $val['value']) as $info)
                                                                        <option value="{{ $info }}">{{ $info }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="hidden" name="id_registration_{{ $no }}"
                                                                    value="{{ $val['id'] }}">
                                                                <label for="">{{ $val['name'] }}</label>
                                                                <input type="text" name="val_registration_{{ $no }}"
                                                                    autocomplete="off" class="form-control"
                                                                    value="{{ old('value') ?? ($val['value'] ?? '') }}"
                                                                    {{ $val['initial'] == 'nomor_pendaftaran' ? 'readonly' : '' }}
                                                                    title=" " placeholder="{{ $val['name'] }}">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @break

                                                @case('textarea')
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="hidden" name="id_registration_{{ $no }}"
                                                                value="{{ $val['id'] }}">
                                                            <label for="">{{ $val['name'] }}</label>
                                                            <textarea name="val_registration_{{ $no }}" rows="5" cols="5"
                                                                class="form-control text-left textareax" placeholder="{{ $val['name'] }}">{{ old('value') ?? ($val['value'] ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                @break
                                            @endswitch
                                            @php
                                                $no++;
                                            @endphp
                                        @endforeach
                                        <div class="col-md-12">
                                            <div class="form-actions btn-list">
                                                <button class="btn btn-info" id="saveBtn" type="submit">Simpan</button>
                                                <button class="btn btn-outline-default" type="button">Kembali</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        @else
                            <p class="text-red"> Maaf Formulir pendaftaran belum disetting , Hubungi Administrator
                                PPdb !</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        @include('plugins.datetime.datetime_js')
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
                    $("#saveBtn").html(
                        '<i class="fa fa-spin fa-sync"></i> Memproses');
                    $("#saveBtn").attr("disabled", true);
                    $.ajax({
                        url: "{{ route('participant.register.save_formulir') }}",
                        method: 'POST',
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            window.location.href = "{{ route('participant.print.registration') }}"
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
