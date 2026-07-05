<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <h2 class="font-bold text-xl text-gray-900 leading-tight flex items-center gap-2">
                <i class="bi bi-file-earmark-text text-blue-600"></i>
                Laporan Transaksi
            </h2>

            <a href="{{ route('transaksi.exportPdf', request()->query()) }}" class="flex items-center justify-center gap-1.5 px-4 py-2 bg-red-650 text-white font-semibold rounded-md text-sm hover:bg-red-700 transition shadow-sm bg-red-600">
                <i class="bi bi-file-earmark-pdf"></i>
                Export PDF
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white shadow rounded-lg border border-gray-200 p-6 flex items-center justify-between">
                    <div>
                        <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Total Transaksi</h6>
                        <h2 class="text-3xl font-extrabold text-gray-900">{{ $totalTransaksi }}</h2>
                    </div>
                    <div class="text-blue-500 bg-blue-50 rounded-full p-3">
                        <i class="bi bi-arrow-left-right text-3xl"></i>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg border border-gray-200 p-6 flex items-center justify-between">
                    <div>
                        <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Total Denda</h6>
                        <h2 class="text-3xl font-extrabold text-red-600">
                            Rp {{ number_format($totalDenda, 0, ',', '.') }}
                        </h2>
                    </div>
                    <div class="text-red-500 bg-red-50 rounded-full p-3">
                        <i class="bi bi-cash-stack text-3xl"></i>
                    </div>
                </div>
            </div>

            {{-- Filter --}}
            <div class="bg-white shadow rounded-lg border border-gray-200 p-6 mb-6">
                <form action="{{ route('transaksi.laporan') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                        <div class="col-span-1 md:col-span-3">
                            <label class="block text-xs font-bold text-gray-700 mb-1">
                                Tanggal Dari
                            </label>
                            <input type="date" name="tanggal_dari" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm p-2"
                                value="{{ request('tanggal_dari') }}">
                        </div>

                        <div class="col-span-1 md:col-span-3">
                            <label class="block text-xs font-bold text-gray-700 mb-1">
                                Tanggal Sampai
                            </label>
                            <input type="date" name="tanggal_sampai" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm p-2"
                                value="{{ request('tanggal_sampai') }}">
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-xs font-bold text-gray-700 mb-1">
                                Status
                            </label>
                            <select name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm p-2">
                                <option value="">Semua Status</option>
                                <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>
                                    Dipinjam
                                </option>
                                <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>
                                    Dikembalikan
                                </option>
                            </select>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-xs font-bold text-gray-700 mb-1">
                                Anggota
                            </label>
                            <select name="anggota_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm p-2">
                                <option value="">Semua Anggota</option>
                                @foreach ($anggotas as $anggota)
                                    <option value="{{ $anggota->id }}" {{ request('anggota_id') == $anggota->id ? 'selected' : '' }}>
                                        {{ $anggota->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-1 md:col-span-2 flex gap-2">
                            <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white font-bold rounded-md text-sm hover:bg-blue-700 transition shadow-sm text-center">
                                <i class="bi bi-search mr-1"></i> Cari
                            </button>

                            <a href="{{ route('transaksi.laporan') }}" class="px-4 py-2 bg-gray-200 text-gray-700 font-bold rounded-md text-sm hover:bg-gray-300 transition shadow-sm text-center">
                                <i class="bi bi-x mr-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Tabel --}}
            <div class="bg-white shadow rounded-lg border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-3 text-left">No</th>
                                <th class="px-6 py-3 text-left">Kode</th>
                                <th class="px-6 py-3 text-left">Anggota</th>
                                <th class="px-6 py-3 text-left">Buku</th>
                                <th class="px-6 py-3 text-left">Tanggal Pinjam</th>
                                <th class="px-6 py-3 text-left">Tanggal Kembali</th>
                                <th class="px-6 py-3 text-left">Status</th>
                                <th class="px-6 py-3 text-left">Denda</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-900">
                            @forelse ($transaksis as $transaksi)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>

                                    <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-blue-600 bg-blue-50/50 rounded-md py-1 px-2.5 inline-block my-2">
                                        {{ $transaksi->kode_transaksi }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-950">
                                        {{ $transaksi->anggota->nama }}
                                    </td>

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
                                        <span class="text-red-600 font-extrabold">
                                            Rp {{ number_format($transaksi->denda_berjalan, 0, ',', '.') }}
                                        </span>
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