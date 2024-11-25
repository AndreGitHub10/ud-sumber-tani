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
    <style>
        fw-bold {
            font-weight: 900 !important;
        }
        fs-custom {
            font-size: 20px !important;
        }
    </style>
</head>
<body class="section-bg-one">
    
    <main class="container receipt-wrapper" id="download-section">
        <div class="receipt-top">
            <div class="company-name fw-bold fs-custom">UD. SUMBER TANI</div>
            <div class="company-address fw-bold fs-custom">Alamat: Jl. Tamiajeng, Kali Jaten, Selotapak, Kec. Trawas, Kabupaten Mojokerto, Jawa Timur 61375</div>
            <div class="company-mobile fw-bold fs-custom">Telp: 081111111111</div>
        </div>
        <div class="receipt-body">
            <div class="receipt-heading fw-bold fs-custom"><span>Struk Belanja</span></div>
            <ul class="text-list text-style1">
                <li>
                    <div class="text-list-title fw-bold">Date:</div>
                    <div class="text-list-desc fw-bold">{{date('d-m-Y',strtotime($penjualan->tanggal))}}</div>
                </li>
                <li class="text-right">
                    <div class="text-list-title fw-bold">Time:</div>
                    <div class="text-list-desc fw-bold">{{date('H:i:s',strtotime($penjualan->created_at))}}</div>
                </li>
                <li>
                    <div class="text-list-title fw-bold">Kasir:</div>
                    <div class="text-list-desc fw-bold">{{$penjualan->user?$penjualan->user->username:'-'}}</div>
                </li>
                <li class="text-right">
                    <div class="text-list-title fw-bold">Invoice:</div>
                    <div class="text-list-desc fw-bold">{{$penjualan->nomor_kwitansi}}</div>
                </li>
            </ul>
            <table class="receipt-table">
                <thead>
                    <tr>
                        <th class="fw-bold fw-custom">Nama</th>
                        <th class="fw-bold fw-custom">Hrg</th>
                        <th class="fw-bold fw-custom">Jml</th>
                        <th class="fw-bold fw-custom">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan->penjualan_detail ?? [] as $item)
                        <tr>
                            <td class="fw-bold fs-custom">{{$item->pembelian_detail ? $item->pembelian_detail->data_produk ? $item->pembelian_detail->data_produk->nama_produk:'-':'-'}}</td>
                            <td class="fw-bold fs-custom">{{number_format($item->harga_jual,0,',','.')}}</td>
                            <td class="fw-bold fs-custom">{{number_format($item->jumlah,0,',','.')}}</td>
                            <td class="fw-bold fs-custom">{{number_format($item->total_harga_jual_murni,0,',','.')}}</td>
                        </tr>
                        @if ($item->diskon)
                            <tr>
                                <td class="fw-bold fs-custom"></td>
                                <td class="fw-bold fs-custom"></td>
                                <td class="fw-bold fs-custom">Disc</td>
                                <td class="fw-bold fs-custom">{{number_format($item->diskon,0,',','.')}}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="text-bill-list mb-15">
                <div class="text-bill-list-in">
                    <div class="text-bill-title fw-bold fs-custom">Sub-Total:</div>
                    <div class="text-bill-value fw-bold fs-custom">{{number_format($penjualan->total_penjualan_murni,0,',','.')}}</div>
                </div>
                <div class="text-bill-list-in">
                    <div class="text-bill-title fw-bold fs-custom">Discount: </div>
                    <div class="text-bill-value fw-bold fs-custom">{{number_format($penjualan->total_penjualan_murni-$penjualan->total_penjualan_diskon,0,',','.')}}</div>
                </div>
                <div class="text-receipt-seperator"></div>
                <div class="text-bill-list-in">
                    <div class="text-bill-title fw-bold fs-custom text-bill-focus">Total</div>
                    <div class="text-bill-value fw-bold fs-custom text-bill-focus"><div class="text-bill-value">{{number_format($penjualan->total_penjualan_diskon,0,',','.')}}</div></div>
                </div>
            </div>
            {{-- <div class="tm_pos_sample_text mb-15">
                <img src="assets/images/bar-code.png" alt="img">
            </div> --}}
            <!-- Return Policy -->
            <div class="mb-10">
                <h4 class="mb-2 text-title font-700 text-border fw-bold fs-custom"> Policy : </h4>
                <p class="fw-bold fs-custom">Barang yang sudah dibeli tidak dapat ditukar atau dikembalikan. </p>
            </div>
        </div>
    </main>

    <script>
        window.print()
    </script>
</body></html>