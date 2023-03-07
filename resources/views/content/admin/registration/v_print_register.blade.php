<!DOCTYPE html>
<html>

<head>
    <title>{{ session('title') }}</title>
    <style type="text/css">
        body {
            font-family: arial;
            font-size: 12pt;
            width: 8.5in;
            height: 12.5in;
            padding: 30px 10px;
            margin-right: 150px;
            margin-left: 20px;
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
    <table>
        <thead>
            <tr>
                <td rowspan="4" style="vertical-align: middle">
                    @if ($letterhead['logo'] != null)
                        <img src="{{ $letterhead['logo'] }}" style="max-height:138px; min-width: 125px;">
                    @endif
                </td>
                <td style="text-align: center">
                    <b>{{ $letterhead['header1'] }}</b>
                </td>
                <td rowspan="4" style="vertical-align: middle">
                    @if ($letterhead['logo2'] != null)
                        <img src="{{ $letterhead['logo2'] }}" style="max-height:138px; min-width: 125px;">
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <h2 style="margin: 0"><b>{{ $letterhead['header2'] }}</b></h2>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <b>{{ $letterhead['header3'] }}</b>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <b>{{ $letterhead['address'] }}</b>
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
                <td colspan="3" style="text-align: center; font-weight: bold; font-size: 14pt"><u>Detail Peserta
                        Register PPDB {{ $year }}</u>
                </td>
            </tr>
            <tr>
                <td style="height: 10px"></td>
                <table style="width: 100%">
                    <tbody>
                        @foreach ($main_form as $key => $val)
                            <tr>
                                <td width="20%">{{ $val['name'] }}</td>
                                <td width="1%">:</td>
                                <td width="39%" class="tbl">
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
            </tr>
        </tbody>
    </table>
</body>

</html>
