<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background: #eeeeee;
        }

        .summary {
            margin-top: 20px;
            width: 40%;
            float: right;
        }

        .summary td {
            border: none;
            padding: 4px;
        }
    </style>
</head>

<body>
    <h2>LAPORAN TRANSAKSI PERPUSTAKAAN</h2>
    <p>
        Tanggal Cetak :
        {{ now()->format('d M Y H:i') }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($transaksis as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaksi->kode_transaksi }}</td>
                    <td>{{ $transaksi->anggota->nama }}</td>
                    <td>{{ $transaksi->buku->judul }}</td>
                    <td>{{ $transaksi->tanggal_pinjam->format('d/m/Y') }}</td>
                    <td>{{ $transaksi->status }}</td>
                    <td>
                        Rp {{ number_format($transaksi->denda, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">
                        Tidak ada data transaksi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table class="summary">
        <tr>
            <td><strong>Total Transaksi</strong></td>
            <td>: {{ $totalTransaksi }}</td>
        </tr>

        <tr>
            <td><strong>Total Denda</strong></td>
            <td>: Rp {{ number_format($totalDenda, 0, ',', '.') }}</td>
        </tr>
    </table>
</body>

</html>