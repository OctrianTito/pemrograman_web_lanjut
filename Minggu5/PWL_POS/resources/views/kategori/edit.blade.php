@extends('layout.app')

@section('subtitle', 'Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Edit')

@section('content_body')
<div class="container">
    <div class="card">
        <div class="card-header">Edit Kategori</div>
        <div class="card-body">
            <form action="{{ route('kategori.update', $kategori->kategori_id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="kategori_kode">Kode Kategori</label>
                    <input type="text" name="kategori_kode" id="kategori_kode" class="form-control" value="{{ $kategori->kategori_kode }}" required>
                </div>
                
                <div class="form-group">
                    <label for="kategori_nama">Nama Kategori</label>
                    <input type="text" name="kategori_nama" id="kategori_nama" class="form-control" value="{{ $kategori->kategori_nama }}" required>
                </div>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="../kategori" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection