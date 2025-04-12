@extends('layouts.template')
 @section('content')
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-12">
                     <div class="card card-primary">
                         <form method="POST" action="{{ url('/profile/update/' . $user->user_id) }}"
                             enctype="multipart/form-data">
                             @csrf
                             @method('PUT')
                             {!! method_field('PUT') !!}
                             <div class="card-body">
                                 <div class="form-group">
                                     <label for="nama">Nama Lengkap</label>
                                     <input type="text" class="form-control" id="nama" name="nama"
                                         value="{{ old('nama', $user->nama) }}" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="username">Username</label>
                                     <input type="text" class="form-control" id="username" name="username"
                                         value="{{ old('username', $user->username) }}" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="id_user">Password</label>
                                     <input type="text" class="form-control" id="id_user" name="id_user"
                                         value="{{ old('password', $user->password) }}" readonly>
                                 </div>
                                 <div class="form-group">
                                     <label for="profile_picture">Profile Picture</label>
                                     <div class="input-group">
                                         <div class="custom-file">
                                             <input type="file" class="custom-file-input" id="profile_picture"
                                                 name="profile_picture">
                                             <label class="custom-file-label" for="profile_picture">Pilih file</label>
                                         </div>
                                     </div>
                                     @if ($user->profile_picture)
                                         <div class="mt-2">
                                             <img class="profile-user-img img-fluid img-circle"
                                             src="{{ $user->profile_picture }}"
                                             alt="User profile picture">
 
                                         </div>
                                     @endif
                                 </div>
 
                             <div class="card-footer">
                                 <button type="submit" class="btn btn-primary">Save</button>
                                 <a href="{{ url('/profile/' . Auth::user()->user_id) }}" class="btn btn-default">Cancel</a>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </section>
 @endsection
 
 @push('js')
     <script>
         $(document).ready(function() {
             if (typeof bsCustomFileInput !== 'undefined') {
                 bsCustomFileInput.init();
             } else {
                 console.error('bsCustomFileInput is not defined. Ensure the library is loaded.');
             }
             // Show confirmation popup using SweetAlert2
             $('form').on('submit', function(e) {
                 e.preventDefault(); // Prevent form submission for confirmation
 
                 // Check file size for profile image
                 const fileInput = $('#profile_picture')[0];
                 if (fileInput.files.length > 0) {
                     const fileSize = fileInput.files[0].size / 1024 / 1024; // Convert to MB
                     if (fileSize > 2) {
                         Swal.fire({
                             icon: 'error',
                             title: 'File terlalu besar',
                             text: 'Gambar Profile Tidak Boleh Melebihi 2MB.',
                         });
                         return; // Stop form submission
                     }
                 }
 
                 Swal.fire({
                     title: 'Apakah kamu yakin?',
                     text: "Apakah kamu ingin menyimpan perubahan?",
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'Ya!'
                 }).then((result) => {
                     if (result.isConfirmed) {
                         // Submit the form normally after confirmation
                         this.submit();
                     }
                 });
             });
 
             // Display error message if username is already taken
             @if ($errors->has('username'))
                 Swal.fire({
                     icon: 'error',
                     title: 'Oops...',
                     text: '{{ $errors->first('username') }}',
                 });
             @endif
 
             $('#profile_picture').on('change', function() {
                 var fileName = $(this).val().split('\\').pop();
                 $(this).next('.custom-file-label').html(fileName || 'Choose file');
             });
         });
     </script>
 @endpush