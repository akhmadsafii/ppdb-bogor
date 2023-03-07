@extends('layout.public.main')
@section('content')
    @push('styles')
        <style>
            .shadow-lg {
                box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
                border-radius: 20px
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
                                    <img src="{{ asset('asset/image/login.jpg') }}" class="image"
                                        style="border-radius: 20px 20px 0 0">
                                </div>
                                <div class="col-lg-6 my-auto">
                                    <div class="card-body">
                                        <div class="px-4">
                                            <h5 class="box-title mr-b-0">Halaman Masuk</h5>
                                            <small class="text-muted">Silahkan masuk untuk melanjutkan pendaftaran</small>
                                            <hr>
                                            <form method="POST" action="{{ route('auth.verify_login') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="">Username</label>
                                                    <input type="text" id="username" name="username"
                                                        placeholder="Username" class="form-control"
                                                        value="{{ old('username') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Password</label>
                                                    <div class="input-group">
                                                        <input id="password" type="password" name="password"
                                                            class="form-control password"
                                                            placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;"
                                                            title="Harus berisi setidaknya satu angka dan satu huruf besar dan kecil, dan setidaknya 8 karakter atau lebih">
                                                        <span class="input-group-addon showPass" style="cursor: pointer"><i
                                                                class="material-icons list-icon eye">remove_red_eye</i></span>
                                                    </div>
                                                    <a href="" class="float-right my-1"><small>Lupa Password?</small>
                                                    </a>
                                                </div>
                                                <div class="text-center">
                                                    <button class="btn btn-info btn-block" type="submit">Masuk</button>
                                                    @if ($setting && $setting['status_open'] == 1 && $setting['open_date'] < date('Y-m-d H:i:s') && $setting['closing_date'] .' '.$setting['closing_hour'] > date('Y-m-d H:i:s'))
                                                    <small class="font-weight-bold text-center">Belum punya Akun? <a
                                                            class="text-info" href="{{ route('auth.register') }}">Daftar
                                                            Disini</a></small>
                                                    @endif
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
        </div>
    </main>
    @push('scripts')
        @if ($errors->any())
            <script>
                alert('{{ $errors->first() }}')
            </script>
        @endif
        <script>
            $('.showPass').mousedown(function() {
                $('#password').attr('type', 'text');
            });

            // $(".showPass").keypress(function(event) {
            //     $('#password').attr('type', 'text');
            // });

            $('.showPass').mouseup(function() {
                $('#password').attr('type', 'password');
            });
        </script>
    @endpush
@endsection
