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
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h3 class="box-title">Hasil Seleksi PPDB</h3>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="table-secondary">
                                            <th>Siswa</th>
                                            <th class="text-center">Semester</th>
                                            @foreach ($course as $cs)
                                                <th class="text-center">{{ $cs }}</th>
                                            @endforeach
                                            <th class="text-center">Jumlah Per Semester</th>
                                            <th class="text-center">Total Akhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registration as $key => $reg)
                                            <tr>
                                                @if ($key == 0 || $key % $reg['amount_smt'] == 0)
                                                    <td rowspan="{{ $reg['amount_smt'] }}" class="align-middle">
                                                        {{ $reg['participant'] }}</td>
                                                @endif
                                                <td>{{ $reg['semester'] }}</td>
                                                @foreach ($reg['score'] as $score)
                                                    <td class="text-center">{{ $score['score'] }}</td>
                                                @endforeach
                                                <td>{{ $reg['score_smt'] }}</td>
                                                @if ($key == 0 || $key % $reg['amount_smt'] == 0)
                                                    <td rowspan="{{ $reg['amount_smt'] }}" class="align-middle text-center">
                                                        {{ $temp[$reg['id_participant']] }}
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
