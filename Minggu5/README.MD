# Laporan Praktikum 5
<b>NAMA : Octrian Adiluhung TIto Putra<b><br>
<b>KELAS : TI-2A<b><br>
<b>ABSEN : 24<b><br>
<b>NIM : 2341720078<b><br>
<br>

## Praktikum 1 : Integrasi Laravel dengan AdminLte3
### OUTPUT
3. Buat file resources/views/layout/app.blade.php
<br>
<img src="img/1.3.png">
<br>

4. Edit resources/views/welcome.blade.php, kemudian replace seluruh kodenya dengan 
kode berikut 
<br>
<img src="img/1.4.png">
<br>

5. Kembali ke browser, menuju ke halaman awal. 
<br>
<img src="img/1.5.png">
<br>

## Praktikum 2 : Integrasi dengan DataTables
### OUTPUT
4. Edit file resources/js/app.js
<br>
<img src="img/2.4.png">
<br>

5. Buatlah file resources/saas/app.scss
<br>
<img src="img/2.5.png">
<br>

6. Jalankan dengan npm run dev
<br>
<img src="img/2.6.png">
<br>

7. Selanjutnya kita akan buat datatables untuk kategori 
<br>
<img src="img/2.7.png">
<br>

8. Kita edit KategoriDatable untuk mengatur kolom apasaja yang ingin ditampilkan. Sesuaikan dengan kode program berikut
<br>
<img src="img/2.8.png">
<br>

9. Ubah kategori model, sesuaikan seperti berikut
<br>
<img src="img/2.9.png">
<br>

10. Ubah Kategori Controller sesuaikan dengan skrip berikut:
<br>
<img src="img/2.10.png">
<br>

11. Buat folder kategori di dalam resources/view,  kemudian buat view blade index untuk kategori  resources/views/kategori/index.blade.php
<br>
<img src="img/2.11.png">
<br>

14. Menset ViteJs / script type defaults
<br>
<img src="img/2.14.png">
<br>

15. Isikan beberapa data ke table kategori
<br>
<img src="img/2.15.png">
<br>

16. Datatables sudah dapat di load di /kategori
<br>
<img src="img/2.16.png">
<br>

## Praktikum 3 : Membuat form kemudian menyimpan data dalam database 
### OUTPUT
1. Menyesuaikan routing, tambahkan dua routing berikut
<br>
<img src="img/3.1.png">
<br>

2. Tambahkan dua function berikut dalam KategoriController
<br>
<img src="img/3.2.png">
<br>

3. Dalam folder views/kategori, buatlah file dengan nama create.blade.php 
<br>
<img src="img/3.3.png">
<br>

4. Kita lakukan pengecualian proteksi CsrfToken. Karena kita belum melakukan otentikasi
<br>
<img src="img/3.4.png">
<br>

5. Akses kategori/create
<br>
<img src="img/3.5.png">
<br>

6. Menambahkan kategori baru
<br>
<img src="img/3.6.png">
<br>

7. Halaman kategori
<br>
<img src="img/3.7.png">
<br>

## Tugas Praktikum 
### OUTPUT
1. Tambahkan button Add di halaman manage kategori, yang mengarah ke create kategori baru 
<br>
<img src="img/4.1.png">
<br>

<br>
<img src="img/4.2.png">
<br>

<br>
<img src="img/4.3.png">
<br>
<br>
2. Tambahkan menu untuk halaman manage kategori, di daftar menu navbar
<br><br>
- Mengedit file adminlte pada config menjadi seperti kode dibawah ini
<br>
<img src="img/4.4.png">
<br>

<br>
<img src="img/4.5.png">
<br>
<br>
3. Tambahkan action edit di datatables dan buat halaman edit serta controllernya

<br><br>
- Datatables
<br>
<img src="img/4.6.png">
<br>

<br><br>
- Controller
<br>
<img src="img/4.7.png">
<br>

<br><br>
- Membuat view edit.blade.php
<br>
<img src="img/4.8.png">
<br>

<br><br>
- Route
<br>
<img src="img/4.9.png">
<br>

<br><br>
- Hasil
<br>
<img src="img/4.10.png">
<br>

<br><br>
- Masuk ke halaman edit
<br>
<img src="img/4.11.png">
<br>
<br>
4. Tambahkan action delete di datatables serta controllernya
<br><br>
- Datatables
<br>
<img src="img/4.6.png">
<br>

<br><br>
- Controller
<br>
<img src="img/4.12.png">
<br>

<br><br>
- Route
<br>
<img src="img/4.13.png">
<br>

<br><br>
- Akan muncul notifikasi jika melakukan klik pada button delete
<br>
<img src="img/4.14.png">
<br>

<br><br>
- Data dengan Kategori Nama sepatu berhasil dihapus
<br>
<img src="img/4.15.png">
<br>