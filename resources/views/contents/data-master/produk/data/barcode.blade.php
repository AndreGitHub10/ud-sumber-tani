<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode</title>
    <style>
        .nama-produk {
            font-size: 8pt;
            margin: 0;
            width: calc(3*44px);
            height:23px;
            /* line-height:20px; Height / no. of lines to display */
            overflow:hidden;
            text-align: center;
        }
        .barcode {
            width: calc(3*44px);
            height: 80px;
        }
    </style>
</head>
<body>
    @if ($produk)
        <p class="nama-produk">{{$produk->nama_produk}}</p>
    @endif
    <img class="barcode" src="data:image/png;base64,{{DNS1D::getBarcodePNG($barcode, 'C39', 3, 80, array(0,0,0), true)}}" alt="barcode" />
    <script>
        window.print()
    </script>
</body>
</html>