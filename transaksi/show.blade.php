<x-app-layout>
    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="flex items-center gap-2 text-sm text-gray-500 font-medium">
                    <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">Dashboard</a></li>
                    <li class="text-gray-400">/</li>
                    <li><a href="{{ route('transaksi.index') }}" class="hover:text-blue-600 transition">Transaksi</a></li>
                    <li class="text-gray-400">/</li>
                    <li class="text-gray-900 font-bold truncate max-w-[200px]" aria-current="page">{{ $transaksi->kode_transaksi }}</li>
                </ol>
            </nav>

            {{-- Reminder Terlambat --}}
            @if ($transaksi->status == 'Dipinjam' && $transaksi->terlambat > 0)
                <div class="p-4 mb-6 rounded-lg bg-red-50 border border-red-200 text-red-800 shadow-sm">
                    <h5 class="text-base font-bold flex items-center gap-2 mb-2">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        Peringatan Keterlambatan
                    </h5>
                    <p class="text-sm mb-2">
                        Buku ini telah melewati batas waktu pengembalian.
                    </p>
                    <p class="text-sm font-extrabold mb-3">
                        Terlambat {{ (int) $transaksi->terlambat }} hari.
                    </p>
                    <hr class="border-red-200 my-2">
                    <small class="text-xs text-red-700">
                        Segera lakukan proses pengembalian agar denda tidak terus bertambah.
                    </small>
                </div>
            @endif

            <div class="bg-white shadow rounded-lg border border-gray-200 overflow-hidden">
                <div class="bg-blue-600 text-white px-6 py-4">
                    <h5 class="text-base font-bold flex items-center gap-2 mb-0">
                        <i class="bi bi-info-circle"></i>
                        Informasi Transaksi
                    </h5>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100 text-sm">
                            <tbody class="divide-y divide-gray-100">
                                <tr class="bg-white">
                                    <td class="px-4 py-3 font-bold text-gray-700 w-1/3 flex items-center gap-2">Kode Transaksi</td>
                                    <td class="px-4 py-3 text-gray-900">: <code class="font-mono text-xs text-blue-600 bg-blue-50 py-0.5 px-1.5 rounded">{{ $transaksi->kode_transaksi }}</code></td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="px-4 py-3 font-bold text-gray-700 flex items-center gap-2">Nama Anggota</td>
                                    <td class="px-4 py-3 text-gray-900">: {{ $transaksi->anggota->nama }}</td>
                                </tr>
                                <tr class="bg-white">
                                    <td class="px-4 py-3 font-bold text-gray-700 flex items-center gap-2">Kode Anggota</td>
                                    <td class="px-4 py-3 text-gray-900">: <code class="font-mono text-xs text-green-600 bg-green-50 py-0.5 px-1.5 rounded">{{ $transaksi->anggota->kode_anggota }}</code></td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="px-4 py-3 font-bold text-gray-700 flex items-center gap-2">Judul Buku</td>
                                    <td class="px-4 py-3 text-gray-900">: {{ $transaksi->buku->judul }}</td>
                                </tr>
                                <tr class="bg-white">
                                    <td class="px-4 py-3 font-bold text-gray-700 flex items-center gap-2">Kode Buku</td>
                                    <td class="px-4 py-3 text-gray-900">: <code class="font-mono text-xs text-yellow-600 bg-yellow-50 py-0.5 px-1.5 rounded">{{ $transaksi->buku->kode_buku }}</code></td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="px-4 py-3 font-bold text-gray-700 flex items-center gap-2">Tanggal Pinjam</td>
                                    <td class="px-4 py-3 text-gray-900">: {{ $transaksi->tanggal_pinjam->format('d M Y') }}</td>
                                </tr>
                                <tr class="bg-white">
                                    <td class="px-4 py-3 font-bold text-gray-700 flex items-center gap-2">Tanggal Kembali</td>
                                    <td class="px-4 py-3 text-gray-900">: {{ $transaksi->tanggal_kembali->format('d M Y') }}</td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="px-4 py-3 font-bold text-gray-700 flex items-center gap-2">Tanggal Dikembalikan</td>
                                    <td class="px-4 py-3 text-gray-900">
                                        : @if ($transaksi->tanggal_dikembalikan)
                                            {{ $transaksi->tanggal_dikembalikan->format('d M Y') }}
                                        @else
                                            <span class="text-gray-400 italic">Belum dikembalikan</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <td class="px-4 py-3 font-bold text-gray-700 flex items-center gap-2">Status</td>
                                    <td class="px-4 py-3 text-gray-900">
                                        : @if ($transaksi->status == 'Dipinjam')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                                Dipinjam
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                Dikembalikan
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="px-4 py-3 font-bold text-gray-700 flex items-center gap-2">Denda</td>
                                    <td class="px-4 py-3 text-gray-900">
                                        : <strong class="text-red-650 font-extrabold">Rp {{ number_format($transaksi->denda_berjalan, 0, ',', '.') }}</strong>
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <td class="px-4 py-3 font-bold text-gray-700 flex items-center gap-2">Keterangan</td>
                                    <td class="px-4 py-3 text-gray-900">: {{ $transaksi->keterangan ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr class="border-gray-200 my-6">

                    <div class="flex justify-between items-center">
                        <a href="{{ route('transaksi.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md text-sm hover:bg-gray-300 transition shadow-sm">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>

                        @if ($transaksi->status == 'Dipinjam')
                            <form action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="flex items-center justify-center gap-1.5 px-4 py-2 bg-green-600 text-white font-semibold rounded-md text-sm hover:bg-green-700 transition shadow-sm"
                                    onclick="return confirm('Yakin buku akan dikembalikan?')">
                                    <i class="bi bi-check-circle"></i>
                                    Kembalikan Buku
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>