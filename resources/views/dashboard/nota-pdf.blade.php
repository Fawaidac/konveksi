<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Pembayaran</title>

    <?php
    $style = '
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <style>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    * {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        font-family: "Poppins", sans-serif;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    p {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        display: block;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        margin: 3px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        font-size: 10pt;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    table td {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        font-size: 9pt;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    .text-center {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        text-align: center;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    .text-right {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        text-align: right;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @media print {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        @page {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            margin: 0;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            size: 75mm 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ';
    ?>
    <?php
    $style .= !empty($_COOKIE['innerHeight']) ? $_COOKIE['innerHeight'] . 'mm; }' : '}';
    ?>
    <?php
    $style .= '
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        html, body {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            width: 70mm;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        .btn-print {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            display: none;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </style>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ';
    ?>

    {!! $style !!}
</head>

<body onload="window.print()">
    <div class="header" style="margin-bottom: 5px; text-align: center;">
        <h2>Sentral Konveksi Jember</h2>
        <small>JL. Brigjen Katamso No.67 Kel. Wirolegi, Kec. Sumbersari, Kab. Jember</small>
    </div>
    <p class="text-center">-----------------------------------</p>
    <br>
    <div>
        <p style="float: left;">Nama Pelanggan: {{ $pesanan->user->name }}</p>
        <p style="float: right">{{ date('j F Y') }}/Sentral/{{ $pesanan->id }}</p>
    </div>
    <div class="clear-both" style="clear: both;"></div>
    <p>{{ $pesanan->user->name }}</p>
    <p class="text-center">-----------------------------------</p>



    <table width="100%" style="border: 0;">
        <tr>
            <td colspan="3">Pesanan</td>
        </tr>
        <tr>
            <td>{{ $pesanan->produk->nama }}</td>
            <td>{{ $pesanan->qty }}</td>
            <td class="text-right">Rp. {{ number_format($pesanan->produk->harga, 0, ',', '.') }}</td>
        </tr>
        <p class="text-right">-----------------</p>
        <tr>
            <td></td>
            <td></td>
            <td class="text-right">Total : Rp. {{ number_format($pesanan->produk->harga, 0, ',', '.') }}</td>
        </tr>
    </table>
    <p class="text-center">-----------------------------------</p>

    {{-- <p class="text-center">===================================</p> --}}
    <br>
    <p class="text-center">-- TERIMA KASIH --</p>
    <p class="text-center">Kami sangat menghargai kepercayaan Anda kepada kami. Semoga pesanan Anda memenuhi ekspektasi,
        dan kami harap dapat melayani Anda kembali di masa depan.</p>

    <script>
        let body = document.body;
        let html = document.documentElement;
        let height = Math.max(
            body.scrollHeight, body.offsetHeight,
            html.clientHeight, html.scrollHeight, html.offsetHeight
        );

        document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "innerHeight=" + ((height + 50) * 0.264583);
    </script>
</body>

</html>
