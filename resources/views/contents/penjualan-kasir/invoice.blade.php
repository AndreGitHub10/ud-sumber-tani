<!DOCTYPE html>
<!-- saved from url=(0045)https://init-bill.vercel.app/receipt-two.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="different types of invoice/bill/tally designed with friendly and markup using modern technology, you can use it on any type of website invoice, fully responsive and w3 validated.">
    <meta name="keywords" content="bill , receipt, tally, invoice, cash memo, invoice html, invoice pdf, invoice print, invoice templates, multipurpose invoice, template, booking invoice, general invoice, clean invoice, catalog, estimate, proposal">
    <meta name="author" content="initTheme">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>invoice</title>
    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/invoice.css')}}">
</head>
<body class="section-bg-one">
    
    <main class="container receipt-wrapper" id="download-section">
        <div class="receipt-top">
            <div class="company-name">UD. SUMBER TANI</div>
            <div class="company-address">Alamat: Jl. Tamiajeng, Kali Jaten, Selotapak, Kec. Trawas, Kabupaten Mojokerto, Jawa Timur 61375</div>
            <div class="company-mobile">Telp: 081111111111</div>
        </div>
        <div class="receipt-body">
            <div class="receipt-heading"><span>Struk Belanja</span></div>
            <ul class="text-list text-style1">
                <li>
                    <div class="text-list-title">Date:</div>
                    <div class="text-list-desc">{{date('d-m-Y',strtotime($penjualan->tanggal))}}</div>
                </li>
                <li class="text-right">
                    <div class="text-list-title">Time:</div>
                    <div class="text-list-desc">{{date('H:i:s',strtotime($penjualan->created_at))}}</div>
                </li>
                <li>
                    <div class="text-list-title">Kasir:</div>
                    <div class="text-list-desc">{{$penjualan->user?$penjualan->user->username:'-'}}</div>
                </li>
                <li class="text-right">
                    <div class="text-list-title">Invoice:</div>
                    <div class="text-list-desc">{{$penjualan->nomor_kwitansi}}</div>
                </li>
            </ul>
            <table class="receipt-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Hrg</th>
                        <th>Jml</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan->penjualan_detail ?? [] as $item)
                        <tr>
                            <td>{{$item->pembelian_detail ? $item->pembelian_detail->data_produk ? $item->pembelian_detail->data_produk->nama_produk:'-':'-'}}</td>
                            <td>{{number_format($item->harga_jual,0,',','.')}}</td>
                            <td>{{number_format($item->jumlah,0,',','.')}}</td>
                            <td>{{number_format($item->total_harga_jual_murni,0,',','.')}}</td>
                        </tr>
                        @if ($item->diskon)
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Disc</td>
                                <td>{{number_format($item->diskon,0,',','.')}}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="text-bill-list mb-15">
                <div class="text-bill-list-in">
                    <div class="text-bill-title">Sub-Total:</div>
                    <div class="text-bill-value">{{number_format($penjualan->total_penjualan_murni,0,',','.')}}</div>
                </div>
                <div class="text-bill-list-in">
                    <div class="text-bill-title">Discount: </div>
                    <div class="text-bill-value">{{number_format($penjualan->total_penjualan_murni-$penjualan->total_penjualan_diskon,0,',','.')}}</div>
                </div>
                <div class="text-receipt-seperator"></div>
                <div class="text-bill-list-in">
                    <div class="text-bill-title text-bill-focus">Total</div>
                    <div class="text-bill-value text-bill-focus"><div class="text-bill-value">{{number_format($penjualan->total_penjualan_diskon,0,',','.')}}</div></div>
                </div>
            </div>
            {{-- <div class="tm_pos_sample_text mb-15">
                <img src="assets/images/bar-code.png" alt="img">
            </div> --}}
        </div>
    </main>

    <script>
        window.print()
    </script>
</body></html>