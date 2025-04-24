<div id="modal-master" class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Data Penjualan Barang</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <div class="modal-body">
             <table class="table table-bordered table-striped table-hover table-sm">
                 <tr>
                     <th>ID</th>
                     <td>{{ $penjualan->penjualan_id }}</td>
                 </tr>
                 <tr>
                    <th>Nama Staff</th>
                    <td>{{ $penjualan->user->username }} ({{ $penjualan->user->level->level_nama }})</td>
                </tr>
                 <tr>
                     <th>Kode Penjualan</th>
                     <td>{{ $penjualan->penjualan_kode }}
                 </tr>
                 <tr>
                     <th>Nama Pembeli</th>
                     <td>{{ $penjualan->pembeli }}</td>
                 </tr>
                 <tr>
                     <th>Tanggal Penjualan</th>
                     <td>{{ $penjualan->penjualan_tanggal }}</td>
                 </tr>
             </table>
     </div>
 </div>