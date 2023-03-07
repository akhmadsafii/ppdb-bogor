@extends('layout.participant.main')
@section('content')
    @push('styles')
        <style>
            #profile-message {
                width: 30px;
                height: 30px;
                background-position: center center;
                background-repeat: no-repeat;
                background-size: auto 30px;
            }
        </style>
    @endpush
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5">{{ session('title') }}</h5>
        </div>
        <div class="page-title-right d-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Pesan</a>
                </li>
                <li class="breadcrumb-item active">{{ session('title') }}</li>
            </ol>
        </div>
    </div>
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <a href="{{ route('participant.message') }}"><i class="fas fa-chevron-left"></i> Kembali ke Pesan</a>
        </div>
        <div class="page-title-right d-inline-flex">

        </div>
    </div>

    <div class="widget-list">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 widget-holder">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-white p-0 widget-holder">
                            <a class="col-sm-12 media clearfix p-0" href="javascript:void(0);">
                                <figure class="media-left media-middle thumb-sm mr-2 my-auto">
                                    @php
                                        $img = asset('asset/image/user.png');
                                        if ($message->participants->file != 'user.png') {
                                            $img = Helper::showImage($message->participants->file);
                                        }
                                    @endphp
                                    <div id="profile-message" class="rounded-circle"
                                        style="background-image: url('{{ $img }}')">
                                    </div>
                                </figure>
                                <div class="media-body hide-menu">
                                    <h5 class="media-heading text-capitalize my-0">{{ $message->participants->name }}
                                    </h5>
                                    <span class="user-type fs-12 text-muted">Tinggal di
                                        {{ $message->participants->address }} .
                                        {{ $message->created_at->diffForHumans() }}</span>
                                </div>
                            </a>
                        </div>
                        <div class="row widget-holder">
                            <div class="col-md-12">
                                <h5 class="media-heading mr-b-5 my-0">{{ $message->name }}</h5>
                                @if ($message->file != null)
                                    <img src="{{ Helper::showImage($message->file) }}" class="m-2 w-100" alt="">
                                @endif
                                <p>{!! $message['content'] !!}</p>
                            </div>
                        </div>
                    </div>
                    @if ($message['closed'] == 0)
                        <form class="formSubmit">
                            <div class="w-100 p-2" style="background: #f2f4f8;">
                                @php
                                    $img_response = asset('asset/image/user.png');
                                    if (Auth::guard('participant')->user()->file != 'user.png') {
                                        $img_response = Helper::showImage(Auth::guard('participant')->user()->file);
                                    }
                                @endphp
                                <div class="d-flex">
                                    <div class="my-auto">
                                        <div id="profile-message" class="rounded-circle"
                                            style="background-image: url('{{ $img_response }}')">
                                        </div>
                                    </div>
                                    <div class="mx-1" style="width:-webkit-fill-available; position: relative">
                                        <input type="hidden" name="id_message" value="{{ $message->id }}">
                                        <textarea name="content" rows="1" class="form-control" style="border-radius: 1.25rem"></textarea>
                                        <a href="javascript:void(0)" class="btn btn-default btn-sm btn-rounded btn-add"
                                            style="position: absolute; right: 5px; top: 5px"><i
                                                class="fas fa-paperclip"></i></a>
                                    </div>
                                    <div class="mx-1">
                                        <button class="btn btn-rounded btn-info saveBtn" type="submit"> <i
                                                class="fas fa-paper-plane"></i><span
                                                class="d-none d-sm-inline-block ml-1">Tambahkan Komentar</span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="w-100 p-2" style="background: #f2f4f8;"></div>
                    @endif
                    <div class="card-body d-none" id="reloadPage">
                        <center>
                            <i class="fa fa-spin fa-sync fa-7x"></i>
                        </center>
                    </div>
                    @if (!$response->isEmpty())
                        @foreach ($response as $res)
                            <div class="card-body" style="border-bottom: 1px solid #eee3e3;">
                                <div class="bg-white p-0">
                                    <a class="col-sm-12 media clearfix p-0 text-muted" href="javascript:void(0);">
                                        <figure class="media-left media-middle thumb-sm mr-2">
                                            @php
                                                $img_res = asset('asset/image/user.png');
                                                $file = $res['role'] == 'admin' ? $res->admins->file : $res->participants->file;
                                                if ($file != 'user.png') {
                                                    $img_res = $res['role'] == 'admin' ? Helper::showImage($res->admins->file) : Helper::showImage($res->participants->file);
                                                }
                                            @endphp
                                            <div id="profile-message" class="rounded-circle"
                                                style="background-image: url('{{ $img_res }}')">
                                            </div>
                                        </figure>
                                        <div class="media-body hide-menu">
                                            <h5 class="mr-b-5 text-capitalize my-0">
                                                <b>{{ $res['role'] == 'admin' ? $res->admins->name : $res->participants->name }}</b>
                                                <span class="user-type fs-12 text-muted">&nbsp; .
                                                    {{ $res->created_at->diffForHumans() }}</span>
                                            </h5>
                                            <p class="my-0 text-muted">{!! $res['content'] !!}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
    @push('modal')
        <div class="modal modal-info fade bs-modal-lg-primary" role="dialog" id="modalForm" aria-hidden="true"
            style="display: none">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-inverse">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="modal-title"></h5>
                    </div>
                    <form class="formSubmit">
                        <input type="hidden" name="id_message" value="{{ $message->id }}">
                        <div class="modal-body">
                            <div class="form-group">
                                <textarea name="content" id="content" rows="5" class="form-control editor"
                                    placeholder="Masukan deskripsi Pengumuman"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-rounded ripple text-left"
                                data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-info btn-rounded ripple text-left saveBtn"><i
                                    class="fas fa-paper-plane"></i><span class="d-none d-sm-inline-block ml-1">Tambahkan
                                    Komentar</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('plugins.component.modal_detail')
    @endpush

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

                $(document).on('click', '.btn-add', function() {
                    $('.formSubmit').trigger("reset");
                    $('#modal-title').html("Tanggapi Pesan");
                    $('#modalForm').modal('show');
                });

                $('.formSubmit').on('submit', function(event) {
                    event.preventDefault();
                    $(".saveBtn").html(
                        '<i class="fa fa-spin fa-sync"></i> Menambahkan komentar..');
                    $(".saveBtn").attr("disabled", true);
                    $('#reloadPage').removeClass('d-none');
                    $.ajax({
                        url: "{{ route('participant.response-message.send') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",

                        success: function(data) {
                            window.location.reload();
                        },
                        error: function(data) {
                            $('#reloadPage').addClass('d-none');
                            const res = data.responseJSON;
                            swal('GAGAL', res.message, 'error')
                            console.log(data);
                            $(".saveBtn").html(
                                '<i class="fas fa-paper-plane"></i><span class="d-none d-sm-inline-block ml-1">Tambahkan Komentar</span>'
                            );
                            $(".saveBtn").attr("disabled", false);
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
