@extends('layout.public.main')
@section('content')
    @push('styles')
        <style>
            .bg-custom {
                background-color: {{ env('SETTING_BACKGROUND') }};
            }

            .shadow-lg {
                box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
                border-radius: 20px
            }

            .absolute-date {
                position: absolute;
                background-color: rgba(250, 250, 250, 0.9);
                width: 120px;
                height: 80px;
                text-align: center;
                padding: 15px 0px;
                border-radius: 10px;
                right: 20px;
                top: 20px;
            }


            @media (max-width: 960px) {

                img.card-img-top {
                    height: auto !important
                }
            }
        </style>
    @endpush
    @include('plugins.component.banner')
    <main class="main-wrapper clearfix">
        <div class="widget-list">
            <div class="row">
                @if ($page)
                    <div class="col-md-12">
                        <div class="container">
                            <div class="card shadow-lg">
                                <div class="position-relative">
                                    <div class="absolute-date">
                                        <h6 class="my-0">
                                            {{ Helper::formatMonthYear($page['created_at']) }}
                                        </h6>
                                        <h3 class="my-1">
                                            {{ date('d', strtotime($page['created_at'])) }}</h3>
                                    </div>
                                    <img class="card-img-top" style="border-radius: 20px 20px 0 0"
                                        src="{{ Helper::showImage('thumb/' . $page['file']) }}"
                                        alt="Card image cap" width="1000" height="750">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">{{ $page['title'] }}</h3>
                                    <p class="card-text">{{ session('title') }}</p>
                                    <hr>
                                    <p>{!! $page['content'] !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
