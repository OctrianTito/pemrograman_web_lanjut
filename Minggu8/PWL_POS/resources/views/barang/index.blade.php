@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a href="{{ url('/barang/export_pdf') }}" class="btn btn-sm btn-warning mt-1"><i class="fa fa-file-pdf"></i> Export Barang</a> 
                <button onclick="modalAction('{{ url('barang/import') }}')" class="btn btn-sm btn-info mt-1">Import Barang</button>
                <a href="{{ url('/barang/export_excel') }}" class="btn btn-sm btn-primary mt-1"><i class="fa fa-file-excel"></i> Export Barang</a> 
                <button onclick="modalAction('{{ url('barang/create_ajax') }}')" class="btn btn-sm btn-success mt-1">
                    Tambah Data (Ajax)
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
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="kategori_id" name="kategori_id" required>
                                <option value="">- Semua -</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Kategori Barang</small>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success')) 
                <div class="alert alert-success">{{ session('success') }}</div> 
            @endif 
            @if(session('error')) 
                <div class="alert alert-danger">{{ session('error') }}</div> 
            @endif
            
            <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Barang</th>
                        <th>Kategori</th>
                        <th>Nama Barang</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
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

        var tableBarang;
        $(document).ready(function() {
            tableBarang = $('#table_barang').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ url('barang/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.kategori_id = $('#kategori_id').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        width: "5%",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "barang_kode",
                        className: "",
                        width: "10%",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "kategori.kategori_nama",
                        className: "",
                        width: "14%",
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: "barang_nama",
                        className: "",
                        width: "37%",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "harga_beli",
                        className: "",
                        width: "10%",
                        orderable: true,
                        searchable: false,
                        render: function(data, type,row) {
                            return new Intl.NumberFormat('id').format(data);
                        }

                    },
                    {
                        data: "harga_jual",
                        className: "",
                        width: "10%",
                        orderable: true,
                        searchable: false,
                        render: function(data, type, row){ 
                            return new Intl.NumberFormat('id').format(data); 
                        }
                    },
                    {
                        data: "aksi",
                        className: "",
                        width: "14%",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#table-barang_filter input').unbind().bind().on('keyup', function(e){ 
                if(e.keyCode == 13){ // enter key 
                    tableBarang.search(this.value).draw(); 
                } 
            }); 
        
            // $('.filter_kategori').change(function(){ 
            //     tableBarang.draw(); 
            // });

            $('#kategori_id').on('change', function() {
                tableBarang.ajax.reload();
            });
        });
    </script>
@endpush