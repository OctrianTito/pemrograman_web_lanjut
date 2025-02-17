<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title> <!-- Menentukan judul halaman -->
</head>
<body>
    <h1>Edit Item</h1> <!-- Menampilkan judul utama halaman -->

    <form action="{{ route('items.update', $item) }}" method="POST"> <!-- Form untuk mengedit item -->
        @csrf <!-- Token CSRF untuk keamanan agar tidak terkena serangan CSRF -->
        @method('PUT') <!-- Mengubah metode HTTP menjadi PUT untuk update data -->

        <label for="name">Name:</label> <!-- Label untuk input nama -->
        <input type="text" name="name" value="{{ $item->name }}" required> <!-- Input teks untuk nama item, nilai default diambil dari data lama -->
        <br>

        <label for="description">Description:</label> <!-- Label untuk input deskripsi -->
        <textarea name="description" required>{{ $item->description }}</textarea> <!-- Input textarea untuk deskripsi, nilai default diambil dari data lama -->
        <br>

        <button type="submit">Update Item</button> <!-- Tombol untuk mengirim form dan memperbarui item -->
    </form>

    <a href="{{ route('items.index') }}">Back to List</a> <!-- Link untuk kembali ke daftar item -->
</body>
</html>
