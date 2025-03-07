NAMA    : OCTRIAN ADILUHUNG TITO PUTRA <br>
KELAS   : TI-2A <br>
NO      : 24 <br>
NIM     : 2341720078 <br>

### JAWABAN PERTANYAAN PRAKTIKUM 3 - MIGRATION
1. Pada Praktikum 1 - Tahap 5, apakah fungsi dari APP_KEY pada file setting .env Laravel? 
    - APP_KEY digunakan untuk kunci enkripsi di laravel. Fungsinya adalah untuk mengenkripsi data sensitif, seperti session pengguna dan token API, serta memastikan keamanan aplikasi.

2. Pada Praktikum 1, bagaimana kita men-generate nilai untuk APP_KEY?
    - Menggunakan perintah php artisan key:generate 

3. Pada Praktikum 2.1 - Tahap 1, secara default Laravel memiliki berapa file migrasi? dan untuk apa saja file migrasi tersebut?  
    - Saat membuat proyek Laravel baru, Laravel secara default memiliki 3 file migrasi, yaitu : 
        - create_users_table.php yang berfungsi untuk membuat tabel users untuk menyimpan data pengguna. 
        - create_password_resets_table.php yang berfungsi untuk menyimpan token reset password. 
        - create_failed_jobs_table.php yang berfungsi untuk ,enyimpan informasi tentang job yang gagal dijalankan di queue system. 

4. Secara default, file migrasi terdapat kode $table->timestamps();, apa tujuan/output dari fungsi tersebut?  
    - $table->timestamps(); digunakan untuk otomatis membuat 2 kolom di tabel database : 
        - created_at yang digunakan untuk menyimpan waktu saat data dibuat. 
        - updated_at yang digunakan untuk menyimpan waktu saat data diperbarui. 

5. Pada File Migrasi, terdapat fungsi $table->id(); Tipe data apa yang dihasilkan dari fungsi tersebut?  
    - $table->id(); digunakan untuk membuat kolom primary key dengan tipe data BIGINT UNSIGNED

6. Apa bedanya hasil migrasi pada table m_level, antara menggunakan $table->id(); dengan menggunakan $table->id('level_id'); ?  
    - $table->id(); secara default akan membuat kolom id sebagai primary key. <br>
    $table->id('level_id'); akan membuat kolom level_id sebagai primary key, bukan id. 

7. Pada migration, Fungsi ->unique() digunakan untuk apa?  
    - ->unique() digunakan untuk memastikan nilai dalam kolom tersebut tidak duplikat. 

8. Pada Praktikum 2.2 - Tahap 2, kenapa kolom level_id pada tabel m_user menggunakan $tabel->unsignedBigInteger('level_id'), sedangkan kolom level_id pada tabel m_level menggunakan $tabel->id('level_id') ?  
    - Di m_level, level_id dibuat menggunakan $table->id('level_id'), yang otomatis menjadi primary key dengan tipe BIGINT UNSIGNED AUTO_INCREMENT. <br>
    Di m_user, level_id harus sama tipe datanya dengan level_id di m_level, yaitu BIGINT UNSIGNED, jadi digunakan $table->unsignedBigInteger('level_id'). 

9. Pada Praktikum 3 - Tahap 6, apa tujuan dari Class Hash? dan apa maksud dari kode program Hash::make('1234');?  
    - Class Hash digunakan untuk mengenkripsi password agar tidak tersimpan dalam bentuk teks biasa di database. Hash::make('1234'); akan mengubah '1234' menjadi format hash 

10. Pada Praktikum 4 - Tahap 3/5/7, pada query builder terdapat tanda tanya (?), apa kegunaan dari tanda tanya (?) tersebut?  
    - Tanda tanya ? digunakan sebagai pengganti dalam query, yang mencegah SQL Injection. 

11. Pada Praktikum 6 - Tahap 3, apa tujuan penulisan kode protected $table = ‘m_user’; dan protected $primaryKey = ‘user_id’; ?  
    - protected $table = 'm_user';  memberitahu laravel bahwa model ini terkait dengan tabel m_user, bukan users (default laravel). <br>
    protected $primaryKey = 'user_id'; menentukan bahwa primary key tabel ini adalah user_id, bukan id (default laravel). 

12. Menurut kalian, lebih mudah menggunakan mana dalam melakukan operasi CRUD ke database (DB Façade / Query Builder / Eloquent ORM) ? Jelaskan 
    - Menurut saya lebih mudah menggunakan Query Builder karena kita tidak perlu menuliskan sintaks sql nya secara langsung. Hal ini memudahkan saya dalam hal efisiensi waktu pengerjaan 