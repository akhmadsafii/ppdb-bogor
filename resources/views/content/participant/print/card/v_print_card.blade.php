<!DOCTYPE html>
<html>

<head>
    <title>{{ session('title') }}</title>
    <style type="text/css">
        html,
        body {
            height: 100%;
            overflow: hidden;
        }

        body {
            font-family: arial;
            font-size: 12pt;
            width: 8.5in;
            /* height: 12.5in; */
            padding: 30px 10px;
            margin-right: 150px;
            margin-left: 20px;
        }

        #wrapper {
            position: absolute;
            overflow: auto;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            border: 5px solid red;
        }

        .table {
            border-collapse: collapse;
            border: solid 1px #999;
            width: 100%;
        }


        .table tr td,
        .table tr th {
            border: solid 1px #999;
            padding: 3px;
            font-size: 12px;
        }

        .rgt {
            text-align: right;
        }

        .ctr {
            text-align: center;
        }

        table tr td {
            vertical-align: top
        }

        @media print {
            .pagebreak {
                clear: both;
                page-break-after: always;
            }

            @page {
                size: auto;
                margin: 0mm;
            }

            thead {
                display: table-row-group;
            }
        }
    </style>
    <script type="text/javascript">
        function PrintWindow() {
            window.print();
            CheckWindowState();
        }

        function CheckWindowState() {
            if (document.readyState == "complete") {
                window.close();
            } else {
                setTimeout("CheckWindowState()", 1000)
            }
        }
        PrintWindow();
    </script>
</head>

<body>
    <div id="wrapper">
        <table style="width:100%;">
            <thead>
                <tr>
                    <td rowspan="4" style="vertical-align: middle">
                        @if ($kop['logo'] != null)
                            <img src="{{ $kop['logo'] }}" style="max-height:138px; min-width: 125px;">
                        @endif
                    </td>
                    <td style="text-align: center">
                        <b>{{ $kop['header1'] }}</b>
                    </td>
                    <td rowspan="4" style="vertical-align: middle">
                        @if ($kop['logo2'] != null)
                            <img src="{{ $kop['logo2'] }}" style="max-height:138px; min-width: 125px;">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        <h2 style="margin: 0"><b>{{ $kop['header2'] }}</b></h2>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        <b>{{ $kop['header3'] }}</b>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        <b>{{ $kop['address'] }}</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <hr style="border: solid 2px #000">
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" style="text-align: center; font-weight: bold; font-size: 14pt"><u>Kartu
                            Peserta</u>
                    </td>
                </tr>
                <tr>
                    <td style="height: 10px;" colspan="2">
                        @foreach ($setting as $formx => $list)
                            @if ($formx == 0)
                                <table style="width:50%;">
                                    <tbody>
                                        @foreach ($form as $key => $val)
                                            <tr>
                                                <td style="30%;">{{ $val['name'] }}</td>
                                                <td width="1%">:</td>
                                                <td class="tbl">
                                                    @isset($val['value'])
                                                        @switch($val['value'])
                                                            @case('l')
                                                                <small> laki -laki </small>
                                                            @break

                                                            @case('p')
                                                                <small> Perempuan </small>
                                                            @break

                                                            @default
                                                                <small>{{ $val['value'] }}</small>
                                                        @endswitch
                                                    @else
                                                        <small class="text-muted">-</small>
                                                    @endisset
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($setting as $formx => $list)
                            @if ($list['initial'] == 'tampil_foto' && $list['active'] == 1)
                                @php
                                    $img = asset('asset/image/user.png');
                                    if (Auth::guard('participant')->user()->file != 'user.png') {
                                        $img = Helper::showImage(Auth::guard('participant')->user()->file);
                                    }
                                @endphp
                                <img id="modal-preview" class=" float-right" src="{{ $img }}" alt="Preview"
                                    width="150px" height="150px">
                            @endif
                        @endforeach
                    </td>
                </tr>
                @foreach ($setting as $formx => $list)
                    @if ($list['initial'] == 'jadwal_ppdb' && $list['active'] == 1)
                        <tr>
                            <td colspan="3" style="text-align: center; font-weight: bold; font-size: 14pt">
                                <u>Jadwal</u>
                            </td>
                        </tr>
                        <tr>
                            <table id="table_jadwal" class="table table-striped table-responsive">
                                <thead>
                                    <tr class="bg-info text-inverse">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal Mulai </th>
                                        <th>Tanggal Berakhir </th>
                                        <th>Keterangan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedule as $key => $val)
                                        <tr>
                                            <td>#</td>
                                            <td>{{ $val['name'] }}</td>
                                            <td>{{ Carbon\Carbon::parse($val['start_date'])->formatLocalized('%A %d %B %Y') }}
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($val['end_date'])->formatLocalized('%A %d %B %Y') }}
                                            </td>
                                            <td>{{ $val['description'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
