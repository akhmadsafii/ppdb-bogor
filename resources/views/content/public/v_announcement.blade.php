@extends('layout.public.main')
@section('content')
    @push('styles')
        <style>
            .bg-custom {
                background-color: {{ env('SETTING_BACKGROUND') }};
            }

            .shadow-lg {
                box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
                border-radius: 5px
            }
        </style>
    @endpush
    @include('plugins.component.banner')
    <main class="main-wrapper clearfix">
        <div class="widget-list">
            <div class="row mx-3">
                @if ($announcement->isNotEmpty())
                    @foreach ($announcement as $an)
                        <div class="col-md-6 widget-holder">
                            <div class="card shadow-lg">
                                <a href="{{ route('public_announcement.preview', ['title' => str_slug($an['title'])]) }}">
                                    <div class="card-body p-2">
                                        <div class="row m-1">
                                            <div class="col-md-4 col-sm-3 col-xs-12">
                                                <div class="row">
                                                    <div class="bg-image rounded"
                                                        style="width: 220px; height: 250px; background-image: url({{ Helper::showImage('thumb/' . $an['file']) }});">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8" style="position: relative">
                                                <h5 class="my-1">{{ $an['title'] }}</h5>
                                                <p>{!! Str::limit($an['content'], 300, ' ... <span class="text-info">Selengkapnya</span>') !!}</p>
                                                <span class="text-muted"
                                                    style="position: absolute; bottom: 0">{{ Helper::formatDay($an['created_at']) }}
                                                    - Dilihat {{ $an['viewer'] }} kali</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12">
                        <center>
                            <img class="rounded" height="400" src="{{ asset('asset/image/empty.png') }}" alt="user">
                        </center>
                    </div>
                @endif

            </div>
        </div>
    </main>
@endsection
