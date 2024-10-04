<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('https://akcdn.detik.net.id/visual/2021/06/09/girlband-korea-twice-1_169.jpeg?w=650')">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">TRANSAKSI PENJUALAN</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('transaksi.create') }}" class="btn btn-md btn-success mb-3">ADD TRANSAKSI</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">TANGGAL TRANSAKSI</th>
                                    <th scope="col">NAMA KASIR</th>
                                    <th scope="col">NAMA PRODUK</th>
                                    <th scope="col">KATEGORI PRODUK</th>
                                    <th scope="col">HARGA</th>
                                    <th scope="col">TOTAL HARGA</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksis as $transaksiItem) <!-- Ganti 'transaksi' menjadi 'transaksiItem' -->
                                <tr>
                                    <td>{{ $transaksiItem->tanggal_transaksi }}</td>
                                    <td>{{ $transaksiItem->nama_kasir }}</td>
                                    <td>{{ $transaksiItem->nama_produk }}</td>
                                    <td>{{ $transaksiItem->kategori_produk }}</td>
                                    <td>{{ $transaksiItem->harga }}</td>
                                    <td>{{ $transaksiItem->total_harga }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?')" action="{{ route('transaksi.destroy', $transaksiItem->id) }}" method="POST">
                                            <a href="{{ route('transaksi.show', $transaksiItem->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                            <a href="{{ route('transaksi.edit', $transaksiItem->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div class="alert alert-danger">
                                                Data Transaksi belum Tersedia.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $transaksis->links() }} <!-- Pastikan menggunakan $transaksis -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'BERHASIL',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'GAGAL',
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

</body>
</html>
