<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode</title>
    <style>
        .nama-produk {
            font-size: 12pt;
            margin: 0;
            font-weight: bold;
            /* width: calc(3*44px); */
            height:23px;
            /* line-height:20px; Height / no. of lines to display */
            overflow:hidden;
            text-align: center;
        }
        .barcode {
            /* width: calc(3*44px);
            height: 80px; */
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
            /* padding: 5px !important; */
        }
        .paging {
            width: auto;
            padding: 3px !important;
            /* margin: auto; */
            /* margin: auto 0px auto 5px !important; */
            margin: 0px 1px;
            /* width: 53%; */
        }
        .ml-3{
            margin-left: 1rem !important;
        }
        .gapp {
            /* width: 10%; */
        }
        html{
            width: 100%;
        }
        body {
            /* margin: auto -1px auto 5px !important; */
            /* padding: 0 0px !important; */
            display: flex;
            justify-content: space-between !important;
        }
    </style>
</head>
<body>
    @isset($harga)
    @else
    <?php $harga=0 ?>
    @endisset
    @foreach([0,1] as $da)
    <div class="paging {{$da == 1 ? 'ml-3' : ''}}">
        @if ($produk)
            <p class="nama-produk">{{$produk->nama_produk}}</p>
            <img class="barcode" src="data:image/png;base64,{{DNS1D::getBarcodePNG($barcode, 'C39', 1, 22, array(0,0,0), false)}}" alt="barcode" />
            <p class="nama-produk" style="font-size: 16pt;">Rp {{number_format($harga,0,',','.')}}</p>
        @endif
    </div>
    {{-- @if($da==0)
    <div class="gapp"></div>
    @endif --}}
    @endforeach
    <script>
        window.print()
    </script>
</body>
</html>
