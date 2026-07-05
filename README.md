# AUTHENTICATION-TRANSAKSI-PEMINJAMAN
Mengimplementasikan autentikasi login dan registrasi menggunakan Laravel Breeze, melindungi halaman dengan middleware, serta membangun fitur transaksi peminjaman yang terhubung dengan tabel buku, anggota, dan transaksi. Sistem secara otomatis mengurangi stok buku dan mencatat identitas peminjam setiap kali transaksi dilakukan.

## Tugas Pertemuan 14

**Nama** : Muhammad Fatkhunihadh
**NIM** : 60324085

---

# Tugas 1 - Fitur Pengembalian Buku (40%)

## Instruksi
Mengimplementasikan fitur pengembalian buku secara lengkap beserta perhitungan denda keterlambatan.

## Spesifikasi

- Menambahkan tombol **Kembalikan Buku** pada halaman detail transaksi.
- Mengimplementasikan method `kembalikan()` pada controller.
- Menghitung denda keterlambatan sebesar **Rp5.000 per hari**.
- Denda hanya dikenakan apabila melewati batas tanggal pengembalian.
- Menampilkan total denda pada detail transaksi.
- Menambahkan kembali stok buku sebanyak **1** ketika buku dikembalikan.

### Hasil Implementasi

#### 1. Detail Transaksi dengan tombol **Kembalikan Buku** dan informasi **Denda**

<img width="1920" height="1548" alt="FireShot Capture 025 - Perpustakaan -  localhost" src="https://github.com/user-attachments/assets/342ee57e-ba36-4f05-b33a-2f260d98014a" />

#### 2. Stok buku otomatis berkurang setelah dipinjam

<img width="1913" height="398" alt="image" src="https://github.com/user-attachments/assets/f83b211d-b1ce-4452-be7c-f8f84bcdacb2" />

#### 3. Stok buku kembali normal setelah buku dikembalikan

<img width="1919" height="398" alt="image" src="https://github.com/user-attachments/assets/d838523d-453e-4874-b488-64cbc78b662e" />

---

# Tugas 2 - Laporan Transaksi (30%)

## Instruksi

Membuat halaman laporan transaksi yang dilengkapi fitur filter dan export PDF.

## Spesifikasi

### Filter

- Range tanggal (Dari - Sampai)
- Status Transaksi
  - Semua
  - Dipinjam
  - Dikembalikan
- Filter berdasarkan Anggota

### Tampilan

- Tabel daftar transaksi
- Total transaksi
- Total denda

### Export

- Export laporan transaksi ke format PDF

### Hasil Implementasi

#### 1. Halaman Laporan Transaksi dengan Filter dan Export PDF

<img width="1920" height="1359" alt="FireShot Capture 026 - Perpustakaan -  localhost" src="https://github.com/user-attachments/assets/3052da74-2c35-4774-9293-fdaf23dbb5fe" />

#### 2. Hasil Export PDF

<img width="732" height="543" alt="image" src="https://github.com/user-attachments/assets/73eb1028-3f9c-4990-879e-f03368d85ab9" />

---

# Tugas 3 - Notifikasi Terlambat (30%)

## Instruksi

Menambahkan fitur notifikasi untuk transaksi yang melewati batas waktu pengembalian.

## Spesifikasi

### Dashboard Widget

- Card **Buku Terlambat**
- Jumlah transaksi yang terlambat
- Daftar anggota yang terlambat

### Badge Terlambat

- Menampilkan badge berwarna merah pada halaman daftar transaksi.
- Menampilkan jumlah hari keterlambatan.

### Reminder

- Menampilkan peringatan pada halaman detail transaksi apabila telah melewati tanggal pengembalian.

### Hasil Implementasi

#### 1. Dashboard Widget Buku Terlambat


<img width="1915" height="822" alt="image" src="https://github.com/user-attachments/assets/c07125f8-fcba-49fa-8d72-7ed0f09afd09" />

#### 2. Badge Terlambat pada Halaman Transaksi


<img width="1918" height="931" alt="image" src="https://github.com/user-attachments/assets/a01bd913-494a-475a-b443-590765369c7c" />

#### 3. Reminder Keterlambatan pada Detail Transaksi

<img width="1920" height="1548" alt="FireShot Capture 027 - Perpustakaan -  localhost" src="https://github.com/user-attachments/assets/adc018d7-093b-4275-8434-1c142148e93e" />

---
