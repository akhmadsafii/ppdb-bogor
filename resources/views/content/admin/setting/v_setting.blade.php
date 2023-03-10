@extends('layout.admin.main')
@section('content')
    @push('styles')
        @include('plugins.tags.tags_css')
        @include('plugins.select2.select2_css')
        @include('plugins.datetime.datetime_css')
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
    <div class="row page-title clearfix">
        <div class="page-title-left">
        </div>
        <div class="page-title-right d-inline-flex">
            <p class="text-danger "> <i class="material-icons list-icon">warning</i> Tanda (*) Form harus disi!.</p>
        </div>
    </div>
    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-heading clearfix">
                        <form id="formSubmit">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nama Sekolah</label>
                                        <input type="text" name="name_school" id="name_school" class="form-control"
                                            value="{{ $setting ? $setting['name_school'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Buka PPDB <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="open_date" id="open_date"
                                                    placeholder="Silahkan pilih Tanggal" class="datetimepicker form-control"
                                                    value="{{ $setting ? date('d-m-Y H:i', strtotime($setting->open_date)) : date('d-m-Y H:i') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="custom-control custom-checkbox mt-1 mb-0 mr-sm-2 w-100">
                                                    <input type="checkbox" class="mx-2" name="status_open"
                                                        {{ $setting && $setting['status_open'] == 0 ? 'checked' : '' }}>
                                                    <label class="custom-control-label mb-0" for="customControlInline">Tutup
                                                        Pendaftaran</label>
                                                </div>
                                                <small class="text-danger">Beri Centang untuk menutup pendaftaran</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="id" id="id_setting"
                                            value="{{ $setting ? $setting['id'] : '' }}">
                                        <label for="">Header 1 <span class="text-danger">*</span></label>
                                        <input type="text" name="head1" id="head1"
                                            value="{{ $setting ? $setting['head1'] : '' }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Header 2 <span class="text-danger">*</span></label>
                                        <input type="text" name="head2" value="{{ $setting ? $setting['head2'] : '' }}"
                                            id="head2" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Header 3 <span class="text-danger">*</span></label>
                                        <input type="text" name="head3" id="head3"
                                            value="{{ $setting ? $setting['head3'] : '' }}" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <div class="input-group">
                                            <textarea name="address" id="address" rows="3" class="form-control">{{ $setting ? $setting['address'] : '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">NIP Kepsek <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nip_headmaster"
                                            value="{{ $setting ? $setting['nip_headmaster'] : '' }}" id="nip_headmaster">
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="">Koordinat Latitude <span class="text-danger">*</span></label>
                                        <input type="text" name="latitude" id="lat"
                                            value="{{ $setting ? $setting['latitude'] : '' }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Koordinat Longtitude <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="longitude" id="lon"
                                            value="{{ $setting ? $setting['longitude'] : '' }}" class="form-control">
                                    </div> --}}
                                    {{-- <div class="form-group">
                                        <label for="">Jarak Maksimal Zonasi</label>
                                        <input type="text" name="max_distance" id="max_distance"
                                            onkeypress="return onlyNumber(event)"
                                            value="{{ $setting ? $setting['max_distance'] : '' }}" class="form-control">
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="">Prolog <span class="text-danger">*</span></label>
                                        <textarea name="prologue" id="prologue" class="form-control" rows="3">{{ $setting ? $setting['prologue'] : '' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Penutup <span class="text-danger">*</span></label>
                                        <textarea name="closing" id="closing" class="form-control" rows="3">{{ $setting ? $setting['closing'] : '' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Kepsek <span class="text-danger">*</span></label>
                                        <input type="text" name="name_headmaster" id="name_headmaster"
                                            class="form-control"
                                            value="{{ $setting ? $setting['name_headmaster'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Login PPDB Menggunakan ? <span
                                                class="text-danger">*Kosongkan
                                                jika tidak perlu</span></label>
                                        <input type="text" name="login_requirement" id="login_requirement"
                                            class="form-control"
                                            value="{{ $setting ? $setting['login_requirement'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Gelar Kepsek <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="degree" id="degree"
                                            value="{{ $setting ? $setting['degree'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nama Program</label>
                                        <input type="text" name="name_program" id="name_program" class="form-control"
                                            value="{{ $setting ? $setting['name_program'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tempat Keputusan <span class="text-danger">*</span></label>
                                        <input type="text" name="decision_place" id="decision_place"
                                            class="form-control"
                                            value="{{ $setting ? $setting['decision_place'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Keputusan <span class="text-danger">*</span></label>
                                        <input type="text" name="decision_date" id="decision_date"
                                            class="form-control datepicker"
                                            value="{{ $setting ? $setting['decision_date'] : date('d-m-Y') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tahun Ajaran <span class="text-danger">*</span></label>
                                        <input type="text" name="school_year" id="school_year" class="form-control"
                                            value="{{ $setting ? $setting['school_year'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Tutup <span class="text-danger">*</span></label>
                                        <input type="text" name="closing_date" id="closing_date"
                                            placeholder="Silahkan pilih Tanggal" class="datepicker form-control"
                                            value="{{ $setting ? $setting['closing_date'] : date('Y-m-d') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jam Tutup <span class="text-danger">*</span></label>
                                        <input type="text" name="closing_hour" id="closing_hour"
                                            placeholder="Silahkan pilih jam tutup" class="timepicker form-control"
                                            value="{{ $setting ? $setting['closing_hour'] : date('H:i') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jurusan <span class="text-danger">*</span></label>
                                        <input type="text" id="major" name="major"
                                            value="{{ $setting ? $setting['major'] : '' }}" class="form-control"
                                            data-role="tagsinput" placeholder="Tambah Jurusan">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jalur PPDB <span class="text-danger">*</span></label>
                                        <input type="text" name="track_ppdb" id="track_ppdb" class="form-control"
                                            value="{{ $setting ? $setting['track_ppdb'] : '' }}" data-role="tagsinput"
                                            placeholder="Tambah Jalur">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Ubah Copyright <span class="text-danger">*</span></label>
                                        <input type="text" name="copyright" id="copyright" class="form-control"
                                            value="{{ $setting ? $setting['copyright'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kuota <span class="text-danger">*Isi jika sekolah
                                                menggunakan sistem kuota</span></label>
                                        <input type="text" name="quota" id="quota" class="form-control"
                                            onkeypress="return onlyNumber(event)"
                                            value="{{ $setting ? $setting['quota'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Gunakan Penomoran Otomatis</label>
                                        <select name="auto_number" id="auto_number" class="form-control">
                                            <option value="1"
                                                {{ $setting && $setting['auto_number'] == 1 ? 'selected' : '' }}>Ya
                                            </option>
                                            <option value="2"
                                                {{ $setting && $setting['auto_number'] == 2 ? 'selected' : '' }}>Tidak
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kontak Whatsapp <span class="text-danger">*</span></label>
                                        <input type="text" name="whatsapp" id="whatsapp" class="form-control"
                                            value="{{ $setting ? $setting['whatsapp'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kontak Telepon <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" id="phone" class="form-control"
                                            value="{{ $setting ? $setting['phone'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Semester yang ingin ditampilkan <span
                                                class="text-danger">*</span></label>
                                        @php
                                            $semester = [];
                                            if ($setting && $setting['semester']) {
                                                $semester = explode(',', $setting['semester']);
                                            }
                                            $arrayData = [];
                                        @endphp

                                        @foreach ($semester as $sms)
                                            @php $arrayData[$sms] = $sms @endphp
                                        @endforeach
                                        <select multiple="multiple" class="select2" name="semester[]" id="semester">
                                            <option value="1" @if (in_array(1, $arrayData)) selected @endif>
                                                Semester 1</option>
                                            <option value="2" @if (in_array(2, $arrayData)) selected @endif>Semester 2</option>
                                            <option value="3" @if (in_array(3, $arrayData)) selected @endif>Semester 3</option>
                                            <option value="4" @if (in_array(4, $arrayData)) selected @endif>Semester 4</option>
                                            <option value="5" @if (in_array(5, $arrayData)) selected @endif>Semester 5</option>
                                            <option value="6" @if (in_array(6, $arrayData)) selected @endif>Semester 6</option>
                                        </select>
                                    </div>


                                </div>
                                <div class="col-md-12">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Logo Sekolah</label>
                                                <input type="file" name="logo_school" class="form-control-file"
                                                    onchange="readURL(this, 'preview-logo_school');">
                                                <div class="m-1">
                                                    @php
                                                        $image = 'https://via.placeholder.com/150';
                                                        $logo_school = $image;
                                                        if ($setting && $setting['logo_school']) {
                                                            $logo_school = asset($setting['logo_school']);
                                                        }
                                                    @endphp
                                                    <img id="preview-logo_school" src="{{ $logo_school }}"
                                                        alt="Preview" class="form-group mb-1 w-100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Logo 1</label>
                                                <input type="file" name="logo1" class="form-control-file"
                                                    onchange="readURL(this, 'preview-logo');">
                                                <div class="m-1">
                                                    @php
                                                        $logo1 = $image;
                                                        if ($setting && $setting['logo1']) {
                                                            $logo1 = asset($setting['logo1']);
                                                        }
                                                    @endphp
                                                    <img id="preview-logo" src="{{ $logo1 }}" alt="Preview"
                                                        class="form-group mb-1 w-100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Logo 2</label>
                                                <input type="file" name="logo2" class="form-control-file"
                                                    onchange="readURL(this, 'preview-logo2');">
                                                <div class="m-1">
                                                    @php
                                                        $logo2 = $image;
                                                        if ($setting && $setting['logo2']) {
                                                            $logo2 = asset($setting['logo2']);
                                                        }
                                                    @endphp
                                                    <img id="preview-logo2" src="{{ $logo2 }}" alt="Preview"
                                                        class="form-group mb-1 w-100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Stempel</label>
                                                <input type="file" name="stamp" class="form-control-file"
                                                    onchange="readURL(this, 'preview-stamp');">
                                                <div class="m-1">
                                                    @php
                                                        $stamp = $image;
                                                        if ($setting && $setting['stamp']) {
                                                            $stamp = asset($setting['stamp']);
                                                        }
                                                    @endphp
                                                    <img id="preview-stamp" src="{{ $stamp }}" alt="Preview"
                                                        class="form-group mb-1 w-100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">TTD Kepsek</label>
                                                <input type="file" name="signature_headmaster"
                                                    class="form-control-file"
                                                    onchange="readURL(this, 'preview-signature');">
                                                <div class="m-1">
                                                    @php
                                                        $signature = $image;
                                                        if ($setting && $setting['signature_headmaster']) {
                                                            $signature = asset($setting['signature_headmaster']);
                                                        }
                                                    @endphp
                                                    <img id="preview-signature" src="{{ $signature }}" alt="Preview"
                                                        class="form-group mb-1 w-100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        <script src="{{ asset('asset/custom/onlyNumber.js') }}"></script>
        @include('plugins.sweetalert.sweetalert_js')
        @include('plugins.tags.tags_js')
        @include('plugins.select2.select2_js')
        @include('plugins.datetime.datetime_js')
        <script type="text/javascript">
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('body').on('submit', '#formSubmit', function(e) {
                    // $("#btnSubmit").html(
                    //     '<i class="fa fa-spin fa-sync"></i> Memproses');
                    // $("#btnSubmit").attr("disabled", true);
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('setting.general.update') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            swal('BERHASIL', data.message, 'success')
                            window.location.reload();
                            // $('#btnSubmit').html('<i class="fas fa-save"></i> Simpan');
                            // $("#btnSubmit").attr("disabled", false);
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

            function readURL(input, id) {
                if (input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#' + id).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                    $('#' + id).removeClass('hidden');
                }
            }
        </script>
    @endpush
@endsection
