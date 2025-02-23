<!DOCTYPE html>
<html>
<head>
    <title>Item List</title> <!-- Menentukan judul halaman -->
</head>
<body>
    <h1>Items</h1> <!-- Menampilkan judul h1 -->

    @if(session('success')) <!-- Mengecek apakah ada pesan sukses dalam session -->
        <p>{{ session('success') }}</p> <!-- Menampilkan pesan sukses jika ada -->
    @endif

    <a href="{{ route('items.create') }}">Add Item</a> <!-- Link untuk menambahkan item baru -->
    <ul>
        @foreach ($items as $item) <!-- Melakukan perulangan untuk setiap item dalam variabel $items -->
            <li>
                {{ $item->name }} - <!-- Menampilkan nama item -->
                <a href="{{ route('items.edit', $item) }}">Edit</a> <!-- Link untuk mengedit item -->
                <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;"> <!-- Form untuk menghapus item -->
                    @csrf <!-- Menambahkan token CSRF untuk keamanan -->
                    @method('DELETE') <!-- Mengubah metode form menjadi DELETE -->
                    <button type="submit">Delete</button> <!-- Tombol untuk menghapus item -->
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>