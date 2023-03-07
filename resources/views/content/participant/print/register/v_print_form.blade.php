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
    <table style="width: 100%">
        <thead>
            <tr>
                @if ($form_setting['4']['initial'] == 'logo1' && $form_setting['4']['active'] == '1')
                    <td rowspan="4" style="vertical-align: middle">
                        @if ($data['kop']['logo'] != null)
                            <img src="{{ $data['kop']['logo'] }}" style="max-height:138px; min-width: 125px;">
                        @endif
                    </td>
                @endif
                @if ($form_setting['0']['initial'] == 'head1' && $form_setting['0']['active'] == '1')
                    <td style="text-align: center">
                        <b>{{ $data['kop']['header1'] }}</b>
                    </td>
                @endif
                @if ($form_setting['5']['initial'] == 'logo2' && $form_setting['5']['active'] == '1')
                    <td rowspan="4" style="vertical-align: middle">
                        @if ($data['kop']['logo2'] != null)
                            <img src="{{ $data['kop']['logo2'] }}" style="max-height:138px; min-width: 125px;">
                        @endif
                    </td>
                @endif
            </tr>
            @if ($form_setting['1']['initial'] == 'head2' && $form_setting['1']['active'] == '1')
                <tr>
                    <td style="text-align: center">
                        <h2 style="margin: 0"><b>{{ $data['kop']['header2'] }}</b></h2>
                    </td>
                </tr>
            @endif
            @if ($form_setting['2']['initial'] == 'head3' && $form_setting['2']['active'] == '1')
                <tr>
                    <td style="text-align: center">
                        <b>{{ $data['kop']['header3'] }}</b>
                    </td>
                </tr>
            @endif
            @if ($form_setting['3']['initial'] == 'alamat' && $form_setting['3']['active'] == '1')
                <tr>
                    <td style="text-align: center">
                        <b>{{ $data['kop']['address'] }}</b>
                    </td>
                </tr>
            @endif

            <tr>
                <td colspan="3">
                    <hr style="border: solid 2px #000">
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3" style="text-align: center; font-weight: bold; font-size: 14pt"><u>Form
                        Pendaftaran</u>
                </td>
            </tr>
            <tr>
                <td style="height: 10px"></td>
                <table style="width: 100%">
                    <tbody>
                        @foreach ($data['form'] as $key => $val)
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
