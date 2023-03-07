<!DOCTYPE html>
<html>

<head>
    <title>{{ session('title') }}</title>
    <style type="text/css">
        body {
            font-family: arial;
            font-size: 12pt;
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
</head>

<body>
    <table style="width: 100%;" border="0">
        <thead>
            <tr>
                @if ($setting_form['4']['initial'] == 'logo1' && $setting_form['4']['active'] == '1')
                    <td rowspan="4" style="vertical-align: middle">
                        @if ($form[4]['initial'] == 'logo1')
                            <img src="{{ $form[4]['value'] }}" style="max-height:100px; min-width: 100px;">
                        @endif
                    </td>
                @endif
                @if ($setting_form['0']['initial'] == 'head1' && $setting_form['0']['active'] == '1')
                    <td style="text-align: center">
                        @if ($form[0]['initial'] == 'head1')
                            <b>{{ $form[0]['value'] }}</b>
                        @endif
                    </td>
                @endif
                @if ($setting_form['5']['initial'] == 'logo2' && $setting_form['5']['active'] == '1')
                    <td rowspan="4" style="vertical-align: middle">
                        @if ($form[5]['initial'] == 'logo2')
                            <img src="{{ $form[5]['value'] }}" style="max-height:100px; min-width: 100px;">
                        @endif
                    </td>
                @endif
            </tr>
            @if ($setting_form['1']['initial'] == 'head2' && $setting_form['1']['active'] == '1')
                <tr>
                    <td style="text-align: center">
                        @if ($form[1]['initial'] == 'head2')
                            <h5 style="margin: 0"> <b>{{ $form[1]['value'] }}</b></h5>
                        @endif
                    </td>
                </tr>
            @endif
            @if ($setting_form['2']['initial'] == 'head3' && $setting_form['2']['active'] == '1')
                <tr>
                    <td style="text-align: center">
                        @if ($form[2]['initial'] == 'head3')
                            <b>{{ $form[2]['value'] }}</b></h2>
                        @endif
                    </td>
                </tr>
            @endif
            @if ($setting_form['3']['initial'] == 'alamat' && $setting_form['3']['active'] == '1')
                <tr>
                    <td style="text-align: center;font-size:12pt">
                        @if ($form[3]['initial'] == 'alamat')
                            <b>{{ $form[3]['value'] }}</b>
                        @endif
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
                <td colspan="3" style="text-align: center; font-weight: bold; font-size: 14pt">
                    <u> Hasil Pengumuman </u>
                </td>
            </tr>
            <tr>
                <td style="height: 10px; text-align: center;" colspan="3">
                    @if ($setting_form['6']['initial'] == 'prolog' && $setting_form['6']['active'] == '1')
                        @if ($form[6]['initial'] == 'prolog')
                            <b>{{ $form[6]['value'] }}</b>
                        @endif
                    @endif

                    @if ($form[15]['initial'] == 'nama' && $setting_form['15']['active'] == '1')
                        <b>{{ $form[15]['value'] }}</b>
                    @endif
                    <br>
                    @if ($form[16]['initial'] == 'nisn' && $setting_form['16']['active'] == '1')
                        <b> NISN : {{ $form[16]['value'] }}</b>
                    @endif
                    <br>
                    @if ($form[19]['initial'] == 'no_pendaftaran' && $setting_form['19']['active'] == '1')
                        <b> No Pendaftaran : {{ $form[19]['value'] }}</b>
                    @endif
                    <br>
                    @if ($form[21]['initial'] == 'jalur_pendaftaran' && $setting_form['21']['active'] == '1')
                        <b> Jalur Pendaftaran : {{ $form[21]['value'] }}</b>
                    @endif
                    <br>
                    @if ($form[20]['initial'] == 'asal_sekolah' && $setting_form['20']['active'] == '1')
                        <b> Asal Sekolah : {{ $form[20]['value'] }}</b>
                    @endif

                    @if ($setting_form['17']['initial'] == 'keputusan' && $setting_form['17']['active'] == '1')
                        @if ($form[17]['initial'] == 'keputusan')
                            <h1><b>{{ $form[17]['value'] }}</b></h1>
                        @endif
                    @endif

                    @if ($setting_form['18']['initial'] == 'keterangan_keputusan' && $setting_form['18']['active'] == '1')
                        @if ($form[18]['initial'] == 'keterangan_keputusan')
                            <b> catatan : {{ $form[18]['value'] ?? '-' }}</b>
                        @endif
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right; font-weight: bold; font-size: 14pt">
                    @if ($setting_form['12']['initial'] == 'tempat_keputusan' && $setting_form['12']['active'] == '1')
                        @if ($form[12]['initial'] == 'tempat_keputusan')
                            <small><b>{{ $form[12]['value'] }}</b></small>,
                        @endif
                    @endif
                    @if ($setting_form['13']['initial'] == 'tgl_keputusan' && $setting_form['13']['active'] == '1')
                        @if ($form[13]['initial'] == 'tgl_keputusan')
                            <small>{{ Carbon\Carbon::parse($form[13]['value'])->formatLocalized('%d %B %Y') }}</small>
                        @endif
                    @endif
                    <h5>Kepala Sekolah</h5>
                </td>
            </tr>
            <tr>
                @if ($setting_form['8']['initial'] == 'ttd_kepsek' && $setting_form['8']['active'] == '1')
                @php
                    $img_bg = '';
                    if ($form[8]['initial'] == 'ttd_kepsek') {
                        $img_bg = $form[8]['value'];
                    }
                @endphp
                <td colspan="3"
                    style="text-align: right; font-weight: bold; font-size: 14pt; position: relative; height:120px; width: 125px;">
                    <div
                        style="text-align: right; height:138px; width: 125px; float:right; background-image: url('{{ $img_bg }}'); background-position: center center;
                    background-repeat: no-repeat;
                    background-size: auto 138px; ">
                    </div>
                    @if ($setting_form[10]['initial'] == 'stempel' && $setting_form['10']['active'] == '1')
                        <img src="{{ $form[10]['value'] }}" width="150px" height="150px" style="position: absolute; right: 100px">
                    @endif

                </td>
            @endif
            </tr>
            <tr>
                <td colspan="3" style="text-align: right; font-weight: bold; font-size: 14pt">
                    @if ($setting_form['9']['initial'] == 'nama_kepsek' && $setting_form['9']['active'] == '1')
                        @if ($form[9]['initial'] == 'nama_kepsek')
                            <small><u><b>{{ $form[9]['value'] }}</b></u></small><br>
                        @endif
                    @endif
                    @if ($setting_form['11']['initial'] == 'nip_kepsek' && $setting_form['11']['active'] == '1')
                        @if ($form[11]['initial'] == 'nip_kepsek')
                            <small><b>{{ $form[11]['value'] }}</b></small>
                        @endif
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
