# Laporan Praktikum 5
<b>NAMA : Octrian Adiluhung TIto Putra<b><br>
<b>KELAS : TI-2A<b><br>
<b>ABSEN : 24<b><br>
<b>NIM : 2341720078<b><br>
<br>

## Praktikum 1 : $fillable:
### OUTPUT
Langkah 1 & 2
<br>
<img src="img/1.1.png">
<br>
- Data manager 2 berhasil ditambahkan pada tabel m_user <br>

Langkah 4 & 5
<br>
<img src="img/1.2.png">
<br>
- Data manager 3 berhasil ditambahkan pada tabel m_user <br>

## Praktikum 2.1 : Retrieving Single Models 
### OUTPUT
Langkah 1 & 2
<br>
<img src="img/2.1.1.png">
<br>
- Ditampilkan sebuah tabel yang  berisi 1 baris data, yaitu data user dengan id=1 

Langkah 4
<br>
<img src="img/2.1.2.png">
<br>
- Ditampilkan data user pertama yang memiliki level_id=1

Langkah 6
<br>
<img src="img/2.1.3.png">
<br>
- Hasil yang ditampilkan sama dengan yang sebelumnya

Langkah 8
<br>
<img src="img/2.1.4.png">
<br>
- Data username dan nama dari user dengan id=1 akan ditampilkan, jika data ditemukan maka fungsi abort(404) akan dijalankan

Langkah 10
<br>
<img src="img/2.1.5.png">
<br>
- Karena user dengan id=20 tidak ada maka fungsi abort(404) dijalankan

## Praktikum 2.2 : Not Found Exceptions 
### OUTPUT
Langkah 1
<br>
<img src="img/2.2.1.png">
<br>
- Data dengaan id=1 bisa ditampilkan karena data nya ada di dalam tabel

Langkah 3
<br>
<img src="img/2.2.2.png">
<br>
- Karena tidak ada data dengan username='manager9', maka muncul halaman error 404 Not Found.

## Praktikum 2.3 : Retreiving Aggregrates
### OUTPUT
Langkah 1
<br>
<img src="img/2.3.1.png">
<br>
- count() akan menghitung jumlah record dalam tabel

Buat agar jumlah script pada langkah 1  bisa tampil pada halaman browser
<br>
<img src="img/2.3.2.png">
<br>
- Hasil yang ditampilkan adalah jumlah pengguna yang ada, data diambil dari proses count(user_id); yang menghitung jumlah baris pada kolom user_id

## Praktikum 2.4 : Retreiving or Creating Models
### OUTPUT
Langkah 1 & 2
<br>
<img src="img/2.4.1.png">
<br>
- data user dengan username=manager dan nama=Manager berhaasil ditemukan sehingga data tersebut ditampilkan di browser

Langkah 4
<br>
<img src="img/2.4.2.png">
<br>
- Tidak ada data user dengan username=manager22 dan nama=Manager Dua Dua sehingga firstOrCreate() membuat record baru dengan nilai-nilai yang diberikan pada parameter 

Langkah 6
<br>
<img src="img/2.4.3.png">
<br>
- Data user dengan username=manager dan nama=Manager berhasil ditemukan sehingga data user langsung ditampilkan

Langkah 8
<br>
<img src="img/2.4.4.png">
<br>
- Data user pada parameter belum ada sehingga firsOrNew membuat record baru namun tidak langsung menyimpan ke databasem, melainkan akan dibuat objek baru di memori (tidak disimpan ke database) dengan nilai yang diberikan didalam parameter.

Langkah 9
<br>
<img src="img/2.4.5.png">
<br>
- Setelah dibuat objek baru didalam memori menggunakan firstOrNew, $user->save(); digunakan untuk menyimpan objek baru tersebut ke dalam database

## Praktikum 2.5 : Attribute Changes 
### OUTPUT
Langkah 1
<br>
<img src="">
<br>

Langkah 3
<br>
<img src="">
<br>

## Praktikum 2.6 : Create, Read, Update, Delete (CRUD)
### OUTPUT
Langkah 1 & 2
<br>
<img src="">
<br>

Langkah 4 s/d 6
<br>
<img src="">
<br>

Langkah 8 & 9
<br>
<img src="">
<br>

Langkah 11 s/d 13
<br>
<img src="">
<br>

Langkah 15 & 16
<br>
<img src="">
<br>

Langkah 18 & 19
<br>
<img src="">
<br>

## Praktikum 2.7 : Relationships
### OUTPUT
Langkah 2
<br>
<img src="">
<br>

Langkah 4 & 5
<br>
<img src="">
<br>