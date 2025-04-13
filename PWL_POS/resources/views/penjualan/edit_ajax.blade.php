@empty($penjualan)
 <div id="modal-master" class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title">Kesalahan</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <div class="modal-body">
             <div class="alert alert-danger">
                 <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                 Data yang anda cari tidak ditemukan
             </div>
             <a href="{{ url('/penjualan') }}" class="btn btn-warning">Kembali</a>
         </div>
     </div>
 </div>
 @else
 <form action="{{ url('/penjualan/' . $penjualan->penjualan_id . '/update_ajax') }}" method="POST" id="form-edit">
     @csrf
     @method('PUT')
     <div id="modal-master" class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Edit Data Penjualan</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                <div class="form-group">
                     <label>User</label>
                     <div class="col-10">
                         <select class="form-control" id="user_id" name="user_id" required>
                             <option value="">- Pilih User -</option>
                             @foreach($user as $item)
                                 <option value="{{ $item->user_id }}" {{ old('user_id', $pernjualan->user_id) == $item->user_id ? 'selected' : '' }}>{{ $item->username }}</option>
                             @endforeach
                         </select>
                         <small id="error-user_id" class="error-text form-text text-danger"></small>
                     </div>
                 </div>
                 <div class="form-group row">
                     <label value="{{ $penjualan->penjualan_kode }}" class="col-sm-3 col-form-label text-right">Kode Penjualan</label>
                     <div class="col-sm-9">
                         <input type="text" name="penjualan_kode" id="penjualan_kode" class="form-control" required>
                         <small id="error-penjualan_kode" class="error-text text-danger"></small>
                     </div>
                 </div>
 
                 <div class="form-group row">
                     <label value="{{ $penjualan->pembeli }}" class="col-sm-3 col-form-label text-right">Nama Pembeli</label>
                     <div class="col-sm-9">
                         <input type="text" name="pembeli" id="pembeli" class="form-control" required>
                         <small id="error-pembeli" class="error-text text-danger"></small>
                     </div>
                 </div>
 
                 <div class="form-group row">
                     <label value="{{ $penjualan->penjualan_tanggal}}" type="datetime-local" name="stok_tanggal" id="stok_tanggal" class="form-control" required">Tanggal Penjualan</label>
                     <div class="col-sm-9">
                         <input type="date" name="penjualan_tanggal" id="penjualan_tanggal" class="form-control" required>
                         <small id="error-penjualan_tanggal" class="error-text text-danger"></small>
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="penjualan_tanggal" class="col-sm-3 col-form-label text-right">Jumlah Penjualan</label>
                     <div class="col-sm-9">
                         <input type="number" name="penjualan_jumlah" id="penjualan_jumlah" class="form-control" required>
                         <small id="error-penjualan_jumlah" class="error-text text-danger"></small>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                 <button type="submit" class="btn btn-primary">Simpan</button>
             </div>
         </div>
     </div>
 </form>
 
 <script>
     $(document).ready(function () {
         $("#form-edit").validate({
             rules: {
             user_id: {required: true},
             penjualan_kode: {required: true, minlength: 5, maxlength: 20},
             penjualan_jumlah: {required: true},
             pembeli: {required: true, maxlength: 100},
             penjualan_tanggal: {required: true, date: true
             },
             submitHandler: function (form) {
                 $.ajax({
                     url: form.action,
                     type: form.method,
                     data: $(form).serialize(),
                     success: function (response) {
                         if (response.status) {
                             $('#myModal').modal('hide');
                             Swal.fire({
                                 icon: 'success',
                                 title: 'Berhasil',
                                 text: response.message
                             });
                             tablePenjualan.ajax.reload();
                         } else {
                             $('.error-text').text('');
                             $.each(response.msgField, function (prefix, val) {
                                 $('#error-' + prefix).text(val[0]);
                             });
                             Swal.fire({
                                 icon: 'error',
                                 title: 'Terjadi Kesalahan',
                                 text: response.message
                             });
                         }
                     }
                 });
                 return false;
             },
             errorElement: 'span',
             errorPlacement: function (error, element) {
                 error.addClass('invalid-feedback');
                 element.closest('.form-group').append(error);
             },
             highlight: function (element) {
                 $(element).addClass('is-invalid');
             },
             unhighlight: function (element) {
                 $(element).removeClass('is-invalid');
             }
         });
     });
 </script>
 @endempty