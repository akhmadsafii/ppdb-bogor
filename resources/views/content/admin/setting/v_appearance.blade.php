@extends('layout.admin.main')
@section('content')
    @push('styles')
        @include('plugins.tags.tags_css')
    @endpush
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5">{{ session('title') }}</h5>
        </div>
        <div class="page-title-right d-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Pengaturan</a>
                </li>
                <li class="breadcrumb-item active">Tampilan</li>
            </ol>
        </div>
    </div>
    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-heading clearfix">
                        <form id="formSubmit">
                            <div class="row mr-b-50">
                                <div class="col-md-4 mb-3 input-has-value">
                                    <label for="validationServer01">Background Utama</label>
                                    <input type="color" id="favcolor" name="background" class="w-100"
                                        style="height: 40px" value="{{ $setting['background'] }}">
                                </div>
                                <div class="col-md-4 mb-3 input-has-value">
                                    <label for="validationServer01">Warna Menu</label>
                                    <input type="color" id="favcolor" name="color" class="w-100" style="height: 40px"
                                        value="{{ $setting['color'] }}">
                                </div>
                                <div class="col-md-4 mb-3 input-has-value">
                                    <label for="validationServer01">Background Aktif</label>
                                    <input type="color" id="favcolor" name="background_active" class="w-100"
                                        style="height: 40px" value="{{ $setting['background_active'] }}">
                                </div>
                                <div class="col-md-6 mb-3 input-has-value">
                                    <label for="validationServer01">Format Inputan Gambar yang diijinkan <small
                                            class="text-danger ml-2">*Gunakan enter untuk pilihan multiple</small></label>
                                    <input type="text" class="form-control" data-role="tagsinput" name="format_image"
                                        value="{{ str_replace('|', ',', $setting['format_image']) }}">

                                </div>
                                <div class="col-md-6 mb-3 input-has-value">
                                    <label for="validationServer01">Format Inputan File yang diijinkan <small
                                            class="text-danger ml-2">*Gunakan enter untuk pilihan multiple</small></label>
                                    <input type="text" class="form-control" data-role="tagsinput" name="format_file"
                                        value="{{ str_replace('|', ',', $setting['format_file']) }}">
                                </div>
                                <div class="col-md-6 mb-3 input-has-value">
                                    <label for="validationServer01">Maksimal Ukuran Upload (KB)</label>
                                    <input type="text" name="max_upload" class="form-control"
                                        value="{{ $setting['max_upload'] }}">
                                </div>
                                {{-- <div class="col-md-6 mb-3 input-has-value">
                                    <label for="validationServer01">Gunakan Maps Untuk mendapatkan koordinat? <small
                                            class="ml-2 text-danger">*Akan dikenakan biaya tambahan</small></label>
                                    <select name="leaflet_premium" id="leaflet_premium" class="form-control"
                                        onchange="changeLeaflet(this.value)">
                                        <option value="1" {{ $setting['leaflet_premium'] == 1 ? 'selected' : '' }}>Ya
                                        </option>
                                        <option value="0" {{ $setting['leaflet_premium'] == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                    <small>Jika ingin manampilkan maps, silahkan hubungi <a href="">MYSCH</a> untuk
                                        mendapatkan token leaflet premium. syarat dan
                                        ketentuan berlaku</small>
                                </div> --}}
                                {{-- <div class="col-md-6 mb-3 input-has-value d-none" id="token-premium">
                                    <label for="validationServer01">Token Maps <small class="ml-2 text-danger">*Masukan
                                            token leaflet anda</small></label>
                                    <input type="text" class="form-control" name="token_leaflet" id="token_leaflet"
                                        value="{{ $setting['token_leaflet'] }}">
                                </div> --}}
                                <div class="col-md-6 mb-3 input-has-value">
                                    <label for="validationServer01">Resolusi Gambar Thumbnail (Pixels)</label>
                                    @php
                                        $res = explode('|', $setting['resolution']);
                                    @endphp
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="resolution[]"
                                            value="{{ $res[0] }}" placeholder="Width Pixels">
                                        <input type="text" class="form-control" name="resolution[]"
                                            value="{{ $res[1] }}" placeholder="Height Pixels">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 input-has-value">
                                    <label for="validationServer01">Footer</label>
                                    <input type="text" name="footer" class="form-control"
                                        value="{{ $setting['footer'] }}">
                                </div>
                                <div class="col-md-12 btn-list">
                                    <button type="submit" class="btn btn-primary" id="saveBtn">Submit</button>
                                    <button type="button" class="btn btn-default">Cancel</button>
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
        @include('plugins.tags.tags_js')
        <script type="text/javascript">
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                changeLeaflet($('#leaflet_premium').val());

                $('#formSubmit').on('submit', function(event) {
                    event.preventDefault();
                    $("#saveBtn").html(
                        '<i class="fa fa-spin fa-sync"></i> Memproses..');
                    $("#saveBtn").attr("disabled", true);
                    $.ajax({
                        url: "{{ route('setting.appearance.update') }}",
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
                            $("#save-btn").removeClass('disabled btn-progress');
                        }
                    });
                });
            });

            function changeLeaflet(point) {
                if (point == 1) {
                    $('#token-premium').removeClass('d-none');
                } else {
                    $('#token-premium').addClass('d-none');
                }
            }
        </script>
    @endpush
@endsection
