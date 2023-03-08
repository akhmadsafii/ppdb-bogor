@extends('layout.public.main')
@section('content')
    @push('styles')
        <style>
            .shadow-lg {
                box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
                border-radius: 20px
            }

            .border-line {
                display: flex;
                flex-direction: row;
            }

            .border-line:before,
            .border-line:after {
                content: "";
                flex: 1 1;
                border-bottom: 2px solid #868e96;
                margin: auto;
            }
        </style>
    @endpush
    <main class="main-wrapper clearfix">
        <div class="widget-list">
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <div class="card shadow-lg">
                            <div class="row d-flex">
                                <div class="col-lg-6 my-auto">
                                    <img src="{{ asset('asset/image/register.jpg') }}" class="image"
                                        style="border-radius: 20px 20px 0 0">
                                </div>
                                <div class="col-lg-6">
                                    <div class="card-body">
                                        <h5 class="box-title mr-b-0">Halaman Pendaftaran Akun</h5>
                                        <small class="text-muted">Buat Akun Anda Untuk Melakukan Pendaftaran</small>
                                        <hr>
                                        <form action="{{ route('auth.verify_register') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Nama</label>
                                                        <input type="text" id="name" name="name"
                                                            class="form-control" value="{{ old('name') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">NISN</label>
                                                        <input type="text" id="nisn" name="nisn"
                                                            class="form-control" value="{{ old('nisn') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Jenis Kelamin</label>
                                                        <select name="gender" id="gender" class="form-control">
                                                            <option value="" disabled selected>-- Pilih Jenkel --
                                                            </option>
                                                            <option value="male">Laki - laki</option>
                                                            <option value="female">Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Nomor Telepon</label>
                                                        <input type="text" name="phone" id="phone"
                                                            class="form-control" value="{{ old('phone') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="email" name="email" id="email"
                                                            class="form-control" value="{{ old('email') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Password</label>
                                                        <div class="input-group">
                                                            <input id="password" type="password" name="password"
                                                                class="form-control password"
                                                                placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;"
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
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Alamat</label>
                                                        <textarea name="address" id="address" rows="3" class="form-control">{{ old('address') }}</textarea>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Koordinat Latitude</label>
                                                        <input type="text" name="latitude" id="latitude"
                                                            class="form-control" value="{{ old('latitude') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Koordinat Longtidude</label>
                                                        <input type="text" name="longitude" id="longitude"
                                                            class="form-control" value="{{ old('longitude') }}">
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Alamat</label>
                                                        <textarea name="address" id="address" rows="4" class="form-control"></textarea>
                                                    </div>
                                                </div> --}}
                                                <div class="col-md-12 ml-md-auto btn-list text-center">
                                                    <button class="btn btn-info btn-block" type="submit">Buat
                                                        Akun</button>
                                                    <small class="border-line font-weight-bold text-muted">ATAU</small>
                                                    <small class="font-weight-bold">Sudah punya Akun? <a class="text-info"
                                                            href="{{ route('auth.login') }}">Masuk</a></small>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @push('scripts')
        @if ($errors->any())
            <script>
                alert('{{ $errors->first() }}')
            </script>
        @endif
        @if (session('success'))
            @include('plugins.sweetalert.sweetalert_js')
            <script>
                swal('Pendaftaran Berhasil', "{{ session('success') }}", 'success')
            </script>
        @endif
        <script>
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
        </script>
    @endpush
@endsection
