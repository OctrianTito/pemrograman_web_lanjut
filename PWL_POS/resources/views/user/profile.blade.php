@extends('layouts.template')
 @section('content')
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-3">
                     <div class="card card-primary card-outline">
                         <div class="card-body box-profile">
                             <div class="text-center">
                                 @if ($user->profile_picture)
                                 <img class="profile-user-img img-fluid img-circle"
                                      src="{{ $user->profile_picture }}"
                                      alt="User profile picture">
                                 @else
                                     <img class="profile-user-img img-fluid img-circle" src="{{ asset('adminlte\dist\img\user8-128x128.jpg') }}" alt="User profile picture default">
                                 @endif
                             </div>
 
                             <h3 class="profile-username text-center">{{ $user->nama }}</h3>
                             <p class="text-muted text-center">{{ $user->username }}</p>
 
                             <a href="{{ url('/profile/edit/' . Auth::user()->user_id) }}" class="btn btn-primary btn-block">
                                 <b>Edit Profil</b>
                             </a>
                         </div>
                     </div>
                 </div>
 
                 <div class="col-md-9">
                     <div class="card card-outline card-info">
                         <div class="card-body">
                             <div class="tab-content">
                                 <div class="active tab-pane" id="about">
                                     <div class="form-group row">
                                         <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                                         <div class="col-sm-10">
                                             <input type="text" class="form-control" value="{{ $user->nama }}" readonly>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label class="col-sm-2 col-form-label">Username</label>
                                         <div class="col-sm-10">
                                             <input type="text" class="form-control" value="{{ $user->username }}"
                                                 readonly>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label class="col-sm-2 col-form-label">Password</label>
                                         <div class="col-sm-10">
                                             <input type="text" class="form-control" value="{{ $user->password }}" readonly>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label class="col-sm-2 col-form-label">Level</label>
                                         <div class="col-sm-10">
                                             <input type="text" class="form-control"
                                                 value="{{ $user->level->level_nama }}" readonly>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
 @endsection