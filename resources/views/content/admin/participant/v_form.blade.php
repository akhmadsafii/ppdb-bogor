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
                                        <input type="hidden" name="id"
                                            value="{{ $participant ? $participant['id'] : '' }}">
                                        <label for="">Nama <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name"
                                            value="{{ $participant ? $participant['name'] : '' }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">NISN <span class="text-danger">*</span></label>
                                        <input type="text" name="nisn"
                                            value="{{ $participant ? $participant['nisn'] : '' }}" id="nisn"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Telepon <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" id="phone"
                                            value="{{ $participant ? $participant['phone'] : '' }}" class="form-control">
                                    </div>
                                    @if (env('SETTING_LEAFLET_PREMIUM') == 1)
                                        <div class="form-group">
                                            <label for="">Alamat</label>
                                            <div class="input-group">
                                                <textarea name="address" id="address" class="form-control">{{ $participant ? $participant['address'] : '' }}</textarea>
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
                                            <label for="">Alamat<span class="text-danger">*</span></label>
                                            <textarea name="address" id="address" rows="3" class="form-control">{{ $participant ? $participant['address'] : '' }}</textarea>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="">Koordinat Latitude <span class="text-danger">*</span></label>
                                        <input type="text" name="latitude" id="lat"
                                            value="{{ $participant ? $participant['latitude'] : '' }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Koordinat Longtitude <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="longitude" id="lon"
                                            value="{{ $participant ? $participant['longitude'] : '' }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email"
                                            value="{{ $participant ? $participant['email'] : '' }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="male"
                                                {{ $participant && $participant['gender'] == 'male' ? 'selectd' : '' }}>
                                                Laki - laki</option>
                                            <option value="female"
                                                {{ $participant && $participant['gender'] == 'female' ? 'selectd' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tempat Lahir <span class="text-danger">*</span></label>
                                        <input type="text" name="place_of_birth" id="place_of_birth"
                                            class="form-control"
                                            value="{{ $participant ? $participant['place_of_birth'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="text" name="date_of_birth" id="date_of_birth"
                                            value="{{ $participant ? $participant['date_of_birth'] : date('d-m-Y') }}"
                                            class="form-control datepicker">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Agama <span class="text-danger">*</span></label>
                                        <input type="text" name="religion" id="religion" class="form-control"
                                            value="{{ $participant ? $participant['religion'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Gambar</label>
                                        <input type="file" name="file" class="form-control-file"
                                            onchange="readURL(this);">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    @php
                                                        $image = 'https://via.placeholder.com/150';
                                                        if ($participant && $participant['file']) {
                                                            $image = Helper::showImage('thumb/' . $participant['file']);
                                                        }
                                                    @endphp
                                                    <img id="image-preview" src="{{ $image }}" alt="Preview"
                                                        class="form-group my-1">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="">Password<span class="text-red">*</span></label>
                                                    <div class="input-group">
                                                        <input id="password" type="password" name="password"
                                                            class="form-control password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;"
                                                            title="Harus berisi setidaknya satu angka dan satu huruf besar dan kecil, dan setidaknya 8 karakter atau lebih">
                                                        <span class="input-group-addon showPass"
                                                            style="cursor: pointer"><i
                                                                class="material-icons list-icon eye">remove_red_eye</i></span>
                                                        <span class="input-group-addon generatePass"
                                                            style="cursor: pointer"><i
                                                                class="material-icons list-icon">shuffle</i></span>
                                                    </div>
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
                        url: "{{ route('participant.send') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            window.location.href = "{{ route('account_participant') }}"
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

                $('.showPass').mousedown(function() {
                    $('#password').attr('type', 'text');
                });
                $('.showPass').mouseup(function() {
                    $('#password').attr('type', 'password');
                });

                $(document).on('click', '.generatePass', function() {
                    var length = 8,
                        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
                        retVal = "";
                    for (var i = 0, n = charset.length; i < length; ++i) {
                        retVal += charset.charAt(Math.floor(Math.random() * n));
                    }
                    $('#password').val(retVal);
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
