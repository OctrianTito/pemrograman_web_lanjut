@extends('layout.app')

@section('subtitle', 'User')
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Edit')

@section('content_body')
<div class="container">
    <div class="card">
        <div class="card-header">Edit User</div>
        <div class="card-body">
            <form action="{{ route('user.update', $user->user_id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="level_id">Level ID</label>
                    <input type="text" name="level_id" id="level_id" class="form-control" value="{{ $user->level_id }}" required>
                </div>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" required>
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $user->nama }}" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="{{ $user->password }}" required>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="../user" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection