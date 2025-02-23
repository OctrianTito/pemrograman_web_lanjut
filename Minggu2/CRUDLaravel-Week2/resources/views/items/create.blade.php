<!DOCTYPE html>
<html>
<head>
    <title>Add Item</title> <!-- Menentukan judul halaman -->
</head>
<body>
    <h1>Add Item</h1> <!-- Menampilkan judul h1 -->

    <form action="{{ route('items.store') }}" method="POST"> <!-- Form untuk menambahkan item baru -->
        @csrf <!-- Token CSRF untuk keamanan agar tidak terkena serangan CSRF -->

        <label for="name">Name:</label> <!-- Label untuk input nama -->
        <input type="text" name="name" required> <!-- Input teks untuk nama item yang wajib diisi -->
        <br>

        <label for="description">Description:</label> <!-- Label untuk input deskripsi -->
        <textarea name="description" required></textarea> <!-- Input textarea untuk deskripsi yang wajib diisi -->
        <br>

        <button type="submit">Add Item</button> <!-- Tombol untuk mengirim form -->
    </form>

    <a href="{{ route('items.index') }}">Back to List</a> <!-- Link untuk kembali ke daftar item -->
</body>
</html>
