@extends('layout.admin.main')
@section('content')
    @push('styles')
        @include('plugins.tags.tags_css')
        @include('plugins.datetime.datetime_css')
        @if (env('SETTING_LEAFLET_PREMIUM') == 1)
            @include('plugins.leaflet.leaflet_css')
        @endif
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
                                        <input type="text" name="name_school" id="name_school" class="form-control" value="{{ $setting ? $setting['name_school'] : '' }}">
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
                                                    <input type="checkbox" class="mx-2" name="status_open" {{ $setting && $setting['status_open'] == 0 ? 'checked' :'' }}>
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
                                    @if (env('SETTING_LEAFLET_PREMIUM') == 1)
                                        <div class="form-group">
                                            <label for="">Alamat</label>
                                            <div class="input-group">
                                                <textarea name="address" id="address" class="form-control"></textarea>
                                                <div class="input-group-addon">
                                                    <a href="javascript:void(0)" onclick="addr_search();"><i
                                                            class="material-icons list-icon search text-dark">search</i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div id="results"></div>
                                        </div>
                                        <div class="form-group w-100" id="map" style="height: 150px"></div>
                                    @else
                                        <div class="form-group">
                                            <label for="">Alamat</label>
                                            <div class="input-group">
                                                <textarea name="address" id="address" rows="3" class="form-control">{{ $setting ? $setting['address'] : '' }}</textarea>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="">Koordinat Latitude <span class="text-danger">*</span></label>
                                        <input type="text" name="latitude" id="lat"
                                            value="{{ $setting ? $setting['latitude'] : '' }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Koordinat Longtitude <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="longitude" id="lon"
                                            value="{{ $setting ? $setting['longitude'] : '' }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jarak Maksimal Zonasi</label>
                                        <input type="text" name="max_distance" id="max_distance"
                                            onkeypress="return onlyNumber(event)"
                                            value="{{ $setting ? $setting['max_distance'] : '' }}" class="form-control">
                                    </div>
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nama Program</label>
                                        <input type="text" name="name_program" id="name_program" class="form-control"  value="{{ $setting ? $setting['name_program'] : '' }}">
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
                                        <label for="">Gelar Kepsek <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="degree" id="degree"
                                            value="{{ $setting ? $setting['degree'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">NIP Kepsek <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nip_headmaster"
                                            value="{{ $setting ? $setting['nip_headmaster'] : '' }}" id="nip_headmaster">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Logo Sekolah</label>
                                                <input type="file" name="logo_school" class="form-control-file"
                                                    onchange="readURL(this, 'preview-logo');">
                                                <div class="m-1">
                                                    @php
                                                        $image = 'https://via.placeholder.com/150';
                                                        $logo_school = $image;
                                                        if ($setting && $setting['logo_school']) {
                                                            $logo_school = Helper::showImage('thumb/' . $setting['logo_school']);
                                                        }
                                                    @endphp
                                                    <img id="preview-logo" src="{{ $logo_school }}" alt="Preview"
                                                        class="form-group mb-1 w-100">
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
                                                            $logo1 = Helper::showImage('thumb/' . $setting['logo1']);
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
                                                            $logo2 = Helper::showImage('thumb/' . $setting['logo2']);
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
                                                            $stamp = Helper::showImage('thumb/' . $setting['stamp']);
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
                                                <input type="file" name="signature_headmaster" class="form-control-file"
                                                    onchange="readURL(this, 'preview-signature');">
                                                <div class="m-1">
                                                    @php
                                                        $signature = $image;
                                                        if ($setting && $setting['signature_headmaster']) {
                                                            $signature = Helper::showImage('thumb/' . $setting['signature_headmaster']);
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
        @include('plugins.datetime.datetime_js')
        @if (env('SETTING_LEAFLET_PREMIUM') == 1)
            @include('plugins.leaflet.leaflet_js')
            <script>
                var startlat = '-6.991576';
                var startlon = '109.122923';

                var options = {
                    center: [startlat, startlon],
                    zoom: 9
                }

                var map = L.map('map', options);
                window.geolocation();
                $("map").css('width', '267mm');
                $("map").css('height', '210mm');
                map.invalidateSize();
                var nzoom = 12;

                L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key={{ env('SETTING_TOKEN_LEAFLET') }}', {
                    attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>'
                }).addTo(map)

                var myMarker = L.marker([startlat, startlon], {
                    title: "Coordinates",
                    alt: "Coordinates",
                    draggable: true
                }).addTo(map).on('dragend', function() {
                    var lat = myMarker.getLatLng().lat.toFixed(8);
                    var lon = myMarker.getLatLng().lng.toFixed(8);
                    var czoom = map.getZoom();
                    if (czoom < 18) {
                        nzoom = czoom + 2;
                    }
                    if (nzoom > 18) {
                        nzoom = 18;
                    }
                    if (czoom != 18) {
                        map.setView([lat, lon], nzoom);
                    } else {
                        map.setView([lat, lon]);
                    }
                    document.getElementById('lat').value = lat;
                    document.getElementById('lon').value = lon;
                    getAddressMaker(lat, lon);
                });

                $('body').on('cllick', '.address', function() {
                    $('input[name="address"]').val($(this).data('address'));
                });

                $('body').on('keyup', 'input[name="address"]', function() {
                    addr_search();
                });

                function geolocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(getData);
                    } else {
                        alert('Geolocation is not supported by this browser.');
                    }
                }

                function getData(x) {
                    var latxg = x.coords.latitude;
                    var longx = x.coords.longitude;
                    setLokasiMap(latxg, longx);
                }

                function setLokasiMap(startlat, startlon) {
                    var container = L.DomUtil.get('map');
                    if (container != null) {
                        container._leaflet_id = null;
                    }
                    map.invalidateSize();
                    optionsx = {
                        center: [startlat, startlon],
                        zoom: 9
                    }
                    map = L.map('map', optionsx);
                    document.getElementById('lat').value = startlat;
                    document.getElementById('lon').value = startlon;
                    getAddressMaker(startlat, startlon);
                }

                function getAddressMaker(latx, lonx) {
                    $.ajax({
                        url: "https://nominatim.openstreetmap.org/reverse",
                        data: {
                            lat: latx,
                            lon: lonx,
                            format: "json"
                        },
                        beforeSend: function(xhr) {},
                        dataType: "json",
                        type: "GET",
                        async: true,
                        crossDomain: true
                    }).done(function(res) {
                        var addressx = res.display_name;
                        $('input[name="address"]').val(addressx);
                        myMarker.bindPopup("Lat: " + latx + "<br />Lon:" + lonx + "<br />" +
                            addressx).openPopup();
                    }).fail(function(error) {
                        document.getElementById('results').innerHTML = "Sorry, no results...";
                    });
                }

                function chooseAddr(lat1, lng1) {
                    myMarker.closePopup();
                    map.setView([lat1, lng1], 18);
                    myMarker.setLatLng([lat1, lng1]);
                    lat = lat1.toFixed(8);
                    lon = lng1.toFixed(8);
                    document.getElementById('lat').value = lat;
                    document.getElementById('lon').value = lon;
                    getAddressMaker(lat1, lng1);
                }

                function myFunction(arr) {
                    var out = "<br />";
                    var i;
                    if (arr.length > 0) {
                        for (i = 0; i < arr.length; i++) {
                            out +=
                                "<div class='address' title='Show Location and Coordinates' onclick='chooseAddr(" +
                                arr[i].lat + ", " + arr[i].lon + ");return false;' data-address='" + arr[i]
                                .display_name + "'>" + arr[i].display_name +
                                "</div>";
                        }
                        document.getElementById('results').innerHTML = out;
                    } else {
                        document.getElementById('results').innerHTML = "Sorry, no results...";
                    }
                }

                function addr_search() {
                    var inp = document.getElementById("address");
                    var xmlhttp = new XMLHttpRequest();
                    var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + inp
                        .value;
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var myArr = JSON.parse(this.responseText);
                            myFunction(myArr);
                        }
                    };
                    xmlhttp.open("GET", url, true);
                    xmlhttp.send();
                }
            </script>
        @endif
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
