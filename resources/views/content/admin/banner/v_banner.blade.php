@extends('layout.admin.main')
@section('content')
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
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-heading clearfix">
                        <form id="formSubmit">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="id" id="id_banner"
                                        value="{{ $banner ? $banner['id'] : '' }}">
                                    <div class="form-group">
                                        <label for="">Judul</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            value="{{ $banner ? $banner['title'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Gambar</label>
                                        <input type="file" name="file" class="form-control-file" accept="image/*"
                                            onchange="readURL(this);">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group text-center">
                                        @php
                                            $img = asset('asset/image/default.jpg');
                                            if ($banner && $banner['file'] != null) {
                                                $img = Helper::showImage('thumb/' . $banner['file']);
                                            }
                                        @endphp
                                        <img id="image-preview" src="{{ $img }}" alt="Preview" height="150px">
                                        <p class="text-muted">Direkomendasikan ukuran 1500 x 500 untuk hasil yang terbaik
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Isi</label>
                                <textarea name="description" id="description" class="editor" rows="3">{{ $banner ? $banner['description'] : '' }}</textarea>
                            </div>
                            <div class="btn-list">
                                <button type="submit" id="btnSubmit" class="btn btn-info">
                                    <i class="fas fa-save"></i>
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        @include('plugins.sweetalert.sweetalert_js')
        @include('plugins.tinymce.tinymce_js')
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
                        url: "{{ route('banner.send') }}",
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

            function readURL(input, id) {
                id = id || '#image-preview';
                if (input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(id).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                    $('#image-preview').removeClass('hidden');
                }
            }
        </script>
    @endpush
@endsection
