@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a href="{{ url('/kategori/export_pdf') }}" class="btn btn-sm btn-warning mt-1"><i class="fa fa-file-pdf"></i> Export Barang</a>
                <button onclick="modalAction('{{ url('kategori/import') }}')" class="btn btn-sm btn-info mt-1">Import Kategori</button>
                <a href="{{ url('/kategori/export_excel') }}" class="btn btn-sm btn-primary mt-1"><i class="fa fa-file-excel"></i> Export Kategori</a> 
                <button onclick="modalAction('{{ url('kategori/create_ajax') }}')" class="btn btn-sm btn-success mt-1">
                    Tambah Ajax
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var tableKategori;
        $(document).ready(function() {
            tableKategori = $('#table_kategori').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ url('kategori/list') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        width: "5%",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "kategori_kode",
                        className: "",
                        width: "35%",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "kategori_nama",
                        className: "",
                        width: "35%",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        className: "",
                        width: "15%",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush