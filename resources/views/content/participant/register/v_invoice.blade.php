<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>{{ $data['status'] == 'Lunas' ? 'Kwitansi' : 'Invoice'}}-{{ $data['nisn'] }}-{{ substr($data['school_year'], 0, 4) }}</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                {{ $data['status'] == 'Lunas' ? 'Kwitansi' : 'Invoice'}} : {{ $data['nisn'] }}-{{ substr($data['school_year'], 0, 4) }}<br />
                                Dibuat: {{ $data['pay_date'] }}<br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                {{ $data['name'] }}<br />
                                {{ $data['nisn'] }}<br />
                                {{ $data['status'] }}
                            </td>

                            <td>
                                {{ $data['email'] }}<br />
                                {{ $data['phone'] }}<br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Item</td>

                <td>Biaya</td>
            </tr>

            <tr class="item">
                <td>PPDB Tahun Ajaran {{ $data['school_year'] }}</td>

                <td>Rp. {{ str_replace(',', '.', number_format($data['nominal'])) }}</td>
            </tr>

            <tr class="total">
                <td></td>

                <td>Total: Rp. {{ str_replace(',', '.', number_format($data['nominal'])) }}</td>
            </tr>
        </table>

        <table>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            @if($data['status'] == 'Lunas')
                            <td style="text-align: justify">
                                <p style="font-weight: bold">Terima Kasih Sudah Melakukan Pembayaran.</p>
                                Sekarang kamu sudah bisa melanjutkan proses pendaftaran.
                            </td>
                            @else
                            <td style="text-align: justify">
                                <p style="font-weight: bold">Keterangan : </p>
                                {!! $data['information'] !!}
                            </td>
                            @endif
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </div>
</body>
</html>
