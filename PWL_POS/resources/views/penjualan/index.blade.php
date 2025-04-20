@extends('layouts.template')
 
 @section('content')
     <div class="card card-outline card-primary">
         <div class="card-header">
             <h3 class="card-title">{{ $page->title }}</h3>
             <div class="card-tools">
                 <a href="{{ url('/penjualan/export_pdf') }}" class="btn btn-sm btn-warning"><i class="fa fa-file-pdf"></i> Export Penjualan</a>
                 <button onclick="modalAction('{{ url('/penjualan/import') }}')" class="btn btn-sm btn-info">Import Penjualan</button>
                 <a href="{{ url('/penjualan/export_excel') }}" class="btn btn-sm btn-primary"><i class="fa fa-file-excel"></i> Export Penjualan</a>
                 <button onclick="modalAction('{{ url('penjualan/create_ajax') }}')" class="btn btn-sm btn-success">Tambah Penjualan</button>
             </div>
         </div>
         <div class="card-body">
              <!-- untuk Filter data --> 
             <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
                 <div class="row">
                     <div class="col-md-12">
                         <div class="form-group row">
                             <label class="col-1 control-label col-form-label">Filter:</label>
                             <div class="col-3">
                                 <select class="form-control" id="user_id" name="user_id" required>
                                     <option value="">- Semua -</option>
                                     @foreach ($user as $item)
                                         <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                                     @endforeach
                                 </select>
                                 <small class="form-text text-muted">Nama User</small>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             @if (session('success'))
                 <div class="alert alert-success">{{ session('success') }}</div>
             @endif
             @if (session('error'))
                 <div class="alert alert-danger">{{ session('error') }}</div>
             @endif
             <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Nama Staff</th>
                         <th>Kode Penjualan</th>
                         <th>Nama Pembeli</th>
                         <th>Tanggal Penjualan</th>
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
 
         var tablePenjualan;
         $(document).ready(function() {
             tablePenjualan = $('#table_penjualan').DataTable({
                 serverSide: true,
                 ajax: {
                     "url": "{{ url('penjualan/list') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data": function(d) {
                         d.user_id = $('#user_id').val();
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
                         data: "user.username",
                         className: "",
                         width: "15%",
                         orderable: true,
                         searchable: true
                        },
                        {
                            data: "penjualan_kode",
                            className: "",
                            width: "15%",
                            orderable: true,
                            searchable: true
                        },
                        {
                         data: "pembeli",
                         className: "",
                         width: "10%",
                         orderable: true,
                         searchable: true
                     },
                     {
                         data: "penjualan_tanggal",
                         className: "",
                         width: "20%",
                         orderable: true,
                         searchable: true,
                         render: function(data, type, row) {
                            const date = new Date(data);
                            return new Intl.DateTimeFormat('id').format(date);
                        }
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
 
             $('#table-penjualan_filter input').unbind().bind().on('keyup', function(e){ 
                 if(e.keyCode == 13){ // enter key 
                     tablePenjualan.search(this.value).draw(); 
                 } 
             }); 
 
             $('#user_id').on('change', function() {
                 tablePenjualan.ajax.reload();
             });
         });
         
     </script>
 @endpush