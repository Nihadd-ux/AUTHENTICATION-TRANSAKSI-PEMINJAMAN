<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <h2 class="font-bold text-xl text-gray-900 leading-tight flex items-center gap-2">
                <i class="bi bi-arrow-left-right text-blue-600"></i>
                Daftar Transaksi Peminjaman
            </h2>

            <div class="flex gap-2 w-full sm:w-auto">
                <a href="{{ route('transaksi.laporan') }}" class="flex-1 sm:flex-initial flex items-center justify-center gap-1.5 px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md text-sm hover:bg-gray-300 transition shadow-sm">
                    <i class="bi bi-file-earmark-text"></i> Laporan
                </a>

                <a href="{{ route('transaksi.create') }}" class="flex-1 sm:flex-initial flex items-center justify-center gap-1.5 px-4 py-2 bg-blue-600 text-white font-semibold rounded-md text-sm hover:bg-blue-700 transition shadow-sm">
                    <i class="bi bi-plus-circle"></i> Pinjam Buku
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white shadow rounded-lg border border-gray-200 p-6 flex items-center justify-between">
                    <div>
                        <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Total Transaksi</h6>
                        <h2 class="text-3xl font-extrabold text-gray-900">{{ $transaksis->count() }}</h2>
                    </div>
                    <div class="text-blue-500 bg-blue-50 rounded-full p-3">
                        <i class="bi bi-journal-album text-3xl"></i>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg border border-gray-200 p-6 flex items-center justify-between">
                    <div>
                        <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Sedang Dipinjam</h6>
                        <h2 class="text-3xl font-extrabold text-gray-950">{{ $transaksis->where('status', 'Dipinjam')->count() }}</h2>
                    </div>
                    <div class="text-yellow-500 bg-yellow-50 rounded-full p-3">
                        <i class="bi bi-journal-minus text-3xl"></i>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg border border-gray-200 p-6 flex items-center justify-between">
                    <div>
                        <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Sudah Dikembalikan</h6>
                        <h2 class="text-3xl font-extrabold text-gray-900">{{ $transaksis->where('status', 'Dikembalikan')->count() }}</h2>
                    </div>
                    <div class="text-green-500 bg-green-50 rounded-full p-3">
                        <i class="bi bi-journal-check text-3xl"></i>
                    </div>
                </div>
            </div>

            {{-- Tabel Transaksi --}}
            <div class="bg-white shadow rounded-lg border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-3 text-left">No</th>
                                <th class="px-6 py-3 text-left">Kode Transaksi</th>
                                <th class="px-6 py-3 text-left">Anggota</th>
                                <th class="px-6 py-3 text-left">Buku</th>
                                <th class="px-6 py-3 text-left">Tanggal Pinjam</th>
                                <th class="px-6 py-3 text-left">Tanggal Kembali</th>
                                <th class="px-6 py-3 text-left">Status</th>
                                <th class="px-6 py-3 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-900">
                            @forelse($transaksis as $transaksi)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-blue-600 bg-blue-50/50 rounded-md py-1 px-2.5 inline-block my-2">{{ $transaksi->kode_transaksi }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-950">{{ $transaksi->anggota->nama }}</td>
                                    <td class="px-6 py-4 text-gray-700 max-w-xs truncate">{{ $transaksi->buku->judul }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $transaksi->tanggal_pinjam->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $transaksi->tanggal_kembali->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($transaksi->status == 'Dipinjam')
                                            @if ($transaksi->terlambat > 0)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 animate-pulse">
                                                    <i class="bi bi-exclamation-triangle mr-1"></i> Terlambat {{ (int) $transaksi->terlambat }} Hari
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                                    <i class="bi bi-clock mr-1"></i> Dipinjam
                                                </span>
                                            @endif
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                <i class="bi bi-check-circle mr-1"></i> Dikembalikan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="inline-flex rounded-md shadow-sm gap-1" role="group">
                                            <a href="{{ route('transaksi.show', $transaksi->id) }}"
                                                class="flex items-center justify-center px-2.5 py-1.5 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition shadow-sm" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if ($transaksi->status == 'Dipinjam')
                                                <form action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="flex items-center justify-center px-2.5 py-1.5 bg-green-600 text-white rounded hover:bg-green-700 transition shadow-sm" title="Kembalikan Buku"
                                                        onclick="return confirm('Yakin buku akan dikembalikan?')">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-8 text-center text-gray-500 italic">
                                        <i class="bi bi-inbox text-2xl block mb-1"></i>
                                        Tidak ada data transaksi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>