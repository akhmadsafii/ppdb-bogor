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
    @include('plugins.component.banner')
    <main class="main-wrapper clearfix">
        <div class="widget-list">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    @if ($download->isNotEmpty())
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <ul class="list-unstyled widget-user-list mb-0">
                                    @foreach ($download as $dw)
                                        @if (request()->segment(2) == 'file')
                                            <li class="media">
                                                <div class="media-body my-auto">
                                                    <a href="{{ Helper::showImage($dw['file']) }}"
                                                        target="_blank" class="btn btn-outline-info">Download</a>
                                                    <h5 class="media-heading"><a href="#">{{ $dw['name'] }}</a>
                                                        @php
                                                            $exs = explode('.', $dw['file']);
                                                            $icon = 'file-pdf';
                                                            if (last($exs) == 'xls') {
                                                                $icon = 'file-excel';
                                                            }
                                                        @endphp
                                                        <small><i class="fas fa-{{ $icon }} fa-2x"></i>
                                                            {{ $dw['name'] . '.' . last($exs) }}</small>
                                                    </h5>
                                                </div>
                                            </li>
                                        @else
                                            <li class="media">
                                                <div class="d-flex mr-3">
                                                    <a href="{{ Helper::showImage($dw['file']) }}"
                                                        target="_blank" class="thumb-xs">
                                                        <img src="{{ Helper::showImage('thumb/' . $dw['file']) }}"
                                                            class="rounded" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body my-auto"><a
                                                        href="{{ Helper::showImage($dw['file']) }}"
                                                        target="_blank" class="btn btn-outline-info">Download</a>
                                                    <h5 class="media-heading"><a href="#">{{ $dw['name'] }}</a>
                                                        <small>{{ $dw['description'] }}</small>
                                                    </h5>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <center>
                            <img class="rounded" height="400" src="{{ asset('asset/image/empty.png') }}" alt="user">
                        </center>
                    @endif
                </div>
            </div>
        </div>
    </main>
    @push('scripts')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>
    @endpush
@endsection
