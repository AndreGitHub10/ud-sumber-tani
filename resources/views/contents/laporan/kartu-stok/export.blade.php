<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Satuan</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{$item->no}}</td>
                <td>{{$item->kode_produk}}</td>
                <td>{{$item->nama_produk}}</td>
                <td>{{$item->satuan}}</td>
                <td>{{$item->stok}}</td>
            </tr>
        @endforeach
    </tbody>
</table>