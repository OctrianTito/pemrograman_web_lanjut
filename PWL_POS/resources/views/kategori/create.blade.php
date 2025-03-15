@extends('layout.app')

{{-- Customize layout section --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Create')

{{-- Content Body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat kategori baru</h3>
            </div>

            <form method="post" action="../kategori">
            <div class="card-body">
                <div class="form-group">
                    <label for="kodeKategori">Kode Kategori</label>
                    <input type="text" class="form-control" id="kategori_kode" name="kategori_kode" value="untuk makanan, contoh: MKN" placeholder="" onfocus="if (this.value === 'untuk makanan, contoh: MKN') this.value = '';" 
                    onblur="if (this.value === '') this.value = 'untuk makanan, contoh: MKN';">
                </div>
                <div class="form-group">
                    <label for="namaKategori">Nama Kategori</label>
                    <input type="text" class="form-control" id="kategori_nama" name="kategori_nama" value="nama" placeholder="" onfocus="if (this.value === 'nama') this.value = '';" 
                    onblur="if (this.value === '') this.value = 'nama';">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        </div>
    </div>
@endsection