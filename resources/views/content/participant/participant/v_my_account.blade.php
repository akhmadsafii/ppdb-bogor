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
                <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">{{ session('title') }}</li>
            </ol>
        </div>
    </div>

    <div class="widget-list">
        <div class="row">
            <div class="col-md-7 widget-holder">
                <div class="widget-bg">
                    <div class="widget-heading clearfix">
                        <h3 class="box-title">Update Informasi</h3>
                        <hr>
                        <form id="formAdmin">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="l30">Nama <span class="text-red">*</span></label>
                                        <input class="form-control" id="name" placeholder="Nama Admin" name="name"
                                            type="text" value="{{ $participant['name'] }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="l30">Agama</label>
                                        <input class="form-control" id="religion" placeholder="Agama Admin" name="religion"
                                            type="text" value="{{ $participant['religion'] }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="l30">Alamat <span class="text-red">*</span></label>
                                        <textarea name="address" id="address" class="form-control" rows="3">{{ $participant['address'] }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="l30">Telepon <span class="text-red">*</span></label>
                                        <input class="form-control" id="phone" placeholder="Telepon Admin"
                                            name="phone" type="text" value="{{ $participant['phone'] }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="l30">Jenis Kelamin <span class="text-red">*</span></label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="male" {{ $participant['gender'] == 'male' ? 'selected' : '' }}>
                                                Laki -
                                                laki</option>
                                            <option value="female"
                                                {{ $participant['gender'] == 'female' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="l30">Tempat Lahir <span class="text-red">*</span></label>
                                        <input type="text" name="place_of_birth" id="place_of_birth" class="form-control"
                                            value="{{ $participant['place_of_birth'] }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="l30">Tanggal Lahir <span class="text-red">*</span></label>
                                        <input type="text" name="date_of_birth" id="date_of_birth" class="form-control datepicker"
                                            value="{{ $participant['date_of_birth'] }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="l30">Email <span class="text-red">*</span></label>
                                        <input class="form-control" id="email" placeholder="Email Admin" name="email"
                                            type="text" value="{{ $participant['email'] }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="l30">Gambar</label>
                                        <input class="form-control-file" name="file" type="file"
                                            onchange="readURL(this);">
                                        @php
                                            $img = Helper::showImage('thumb/' . $participant['file']);
                                            if ($participant['file'] == 'user.png') {
                                                $img = asset('asset/image/user.png');
                                            }
                                        @endphp
                                        <img id="image-preview" src="{{ $img }}" alt="Preview"
                                            class="form-group my-1" width="150px">
                                        <br>
                                        <span>*Silahkan gunakan ukuran 150 x 150 untuk hasil yang terbaik</span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-actions btn-list">
                                        <button class="btn btn-outline-default" type="button">Cancel</button>
                                        <button class="btn btn-info" type="submit" id="btnSubmit">Simpan</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5 widget-holder">
                <div class="widget-bg">
                    <div class="widget-heading clearfix">
                        <h3 class="box-title">Perbarui Password</h3>
                        <hr>
                        <form id="formPassword">
                            <div class="form-group">
                            <label for="">Password Lama</label>
                                <div class="input-group">
                                    <input class="form-control input-lg" id="password"
                                        placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" name="password" type="password"
                                        value="">
                                    <span class="input-group-addon showPass" style="cursor: pointer"><i
                                            class="material-icons list-icon eye">remove_red_eye</i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Password Baru</label>
                                <div class="input-group">
                                    <input class="form-control input-lg" id="current_password"
                                        placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" name="current_password"
                                        type="password" value="">
                                    <span class="input-group-addon showPassCurrent" style="cursor: pointer"><i
                                            class="material-icons list-icon eye">remove_red_eye</i></span>
                                    <span class="input-group-addon generatePass" style="cursor: pointer"><i
                                            class="material-icons list-icon">shuffle</i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" name="confirm_password"
                                    placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;">
                            </div>
                            <div class="form-actions btn-list">
                                <button class="btn btn-outline-default" type="button">Cancel</button>
                                <button class="btn btn-info" type="submit" id="btnSubmitPass">Simpan</button>
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

                $('body').on('submit', '#formAdmin', function(e) {
                    $("#btnSubmit").html(
                        '<i class="fa fa-spin fa-sync"></i> Menyimpan..');
                    $("#btnSubmit").attr("disabled", true);
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('participant.account_participant.update_profile') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            window.location.reload();
                            $('#btnSubmit').html('Simpan');
                            $("#btnSubmit").attr("disabled", false);
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

                $('.showPass').mousedown(function() {
                    $('#password').attr('type', 'text');
                });
                $('.showPass').mouseup(function() {
                    $('#password').attr('type', 'password');
                });

                $('.showPassCurrent').mousedown(function() {
                    $('#current_password').attr('type', 'text');
                });
                $('.showPassCurrent').mouseup(function() {
                    $('#current_password').attr('type', 'password');
                });

                $(document).on('click', '.generatePass', function() {
                    var length = 8,
                        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
                        retVal = "";
                    for (var i = 0, n = charset.length; i < length; ++i) {
                        retVal += charset.charAt(Math.floor(Math.random() * n));
                    }
                    $('#current_password').val(retVal);
                });

                $('#formPassword').on('submit', function(event) {
                    event.preventDefault();
                    $("#btnSubmitPass").html(
                        '<i class="fa fa-spin fa-sync"></i> Memproses..');
                    $("#btnSubmitPass").attr("disabled", true);
                    $.ajax({
                        url: "{{ route('participant.account_participant.update_password') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",

                        success: function(data) {
                            if (data.status == false) {
                                swal('GAGAL!', data.message, 'error');
                            } else {
                                swal('SELAMAT!', data.message, 'success');
                            }
                            $('#btnSubmitPass').html('Simpan');
                            $('#btnSubmitPass').attr("disabled", false);
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            swal('GAGAL', res.message, 'error')
                            console.log(data);
                            $('#btnSubmitPass').html('Simpan');
                            $('#btnSubmitPass').attr("disabled", false);
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
