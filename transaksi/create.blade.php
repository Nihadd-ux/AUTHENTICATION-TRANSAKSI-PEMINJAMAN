<x-app-layout>
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg border border-gray-200 overflow-hidden">
                <div class="bg-blue-600 text-white px-6 py-4">
                    <h4 class="text-lg font-bold flex items-center gap-2 mb-0">
                        <i class="bi bi-plus-circle"></i>
                        Form Peminjaman Buku
                    </h4>
                </div>
                <div class="p-6">
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf

                        {{-- Pilih Anggota --}}
                        <div class="mb-4">
                            <label for="anggota_id" class="block text-sm font-bold text-gray-700 mb-1">
                                Pilih Anggota <span class="text-red-500">*</span>
                            </label>
                            <select name="anggota_id" id="anggota_id"
                                class="w-full rounded-md shadow-sm text-sm p-2.5 border {{ $errors->has('anggota_id') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500' }}">
                                <option value="">-- Pilih Anggota --</option>
                                @foreach($anggotas as $anggota)
                                    <option value="{{ $anggota->id }}" {{ (old('anggota_id') == $anggota->id || request('anggota_id') == $anggota->id) ? 'selected' : '' }}>
                                        {{ $anggota->kode_anggota }} - {{ $anggota->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('anggota_id')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                            <small class="text-xs text-gray-400 mt-1 block">
                                <i class="bi bi-info-circle"></i> Hanya anggota dengan status Aktif yang dapat meminjam
                            </small>
                        </div>

                        {{-- Pilih Buku --}}
                        <div class="mb-4">
                            <label for="buku_id" class="block text-sm font-bold text-gray-700 mb-1">
                                Pilih Buku <span class="text-red-500">*</span>
                            </label>
                            <select name="buku_id" id="buku_id"
                                class="w-full rounded-md shadow-sm text-sm p-2.5 border {{ $errors->has('buku_id') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500' }}">
                                <option value="">-- Pilih Buku --</option>
                                @foreach($bukus as $buku)
                                    <option value="{{ $buku->id }}" {{ (old('buku_id') == $buku->id || request('buku_id') == $buku->id) ? 'selected' : '' }}>
                                        {{ $buku->judul }} - (Stok: {{ $buku->stok }})
                                    </option>
                                @endforeach
                            </select>
                            @error('buku_id')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                            <small class="text-xs text-gray-400 mt-1 block">
                                <i class="bi bi-info-circle"></i> Hanya buku dengan stok tersedia yang dapat dipinjam
                            </small>
                        </div>

                        {{-- Tanggal Pinjam --}}
                        <div class="mb-4">
                            <label for="tanggal_pinjam" class="block text-sm font-bold text-gray-700 mb-1">
                                Tanggal Pinjam <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                                class="w-full rounded-md shadow-sm text-sm p-2.5 border {{ $errors->has('tanggal_pinjam') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500' }}"
                                value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}">
                            @error('tanggal_pinjam')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                            <small class="text-xs text-gray-400 mt-1 block">
                                <i class="bi bi-info-circle"></i> Tanggal kembali otomatis 7 hari dari tanggal pinjam
                            </small>
                        </div>

                        {{-- Keterangan --}}
                        <div class="mb-4">
                            <label for="keterangan" class="block text-sm font-bold text-gray-700 mb-1">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="3"
                                class="w-full rounded-md shadow-sm text-sm p-2.5 border {{ $errors->has('keterangan') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500' }}"
                                placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Info Box --}}
                        <div class="p-4 rounded-lg bg-blue-50 border border-blue-200 text-sm text-blue-800 mb-6 shadow-sm">
                            <div class="flex items-center gap-1.5 font-bold mb-2">
                                <i class="bi bi-info-circle"></i>
                                Informasi Peminjaman:
                            </div>
                            <ul class="list-disc pl-5 space-y-1">
                                <li>Durasi peminjaman: <strong>7 hari</strong></li>
                                <li>Denda keterlambatan: <strong>Rp 5.000/hari</strong></li>
                                <li>Stok buku akan berkurang otomatis setelah peminjaman</li>
                            </ul>
                        </div>

                        <hr class="border-gray-200 my-6">

                        {{-- Buttons --}}
                        <div class="flex justify-between items-center">
                            <a href="{{ route('transaksi.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md text-sm hover:bg-gray-300 transition shadow-sm">
                                <i class="bi bi-arrow-left"></i> Batal
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md text-sm hover:bg-blue-700 transition shadow-sm">
                                <i class="bi bi-save"></i> Konfirmasi Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>