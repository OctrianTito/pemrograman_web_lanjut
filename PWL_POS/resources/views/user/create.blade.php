@extends('layout.app')

{{-- Customize layout section --}}
@section('subtitle', 'User')
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Create')

{{-- Content Body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah user baru</h3>
            </div>

            <form method="post" action="../user">
            <div class="card-body">
                <div class="form-group">
                    <label for="level_id">Level ID</label>
                    <input type="text" class="form-control" id="level_id" name="level_id" value="1 = Admin, 2 = Manager, 3 = Staff, 4 = Customer" placeholder="" onfocus="if (this.value === '1 = Admin, 2 = Manager, 3 = Staff, 4 = Customer') this.value = '';" 
                    onblur="if (this.value === '') this.value = '1 = Admin, 2 = Manager, 3 = Staff, 4 = Customer';">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="Admin/staff/manager/customer" placeholder="" onfocus="if (this.value === 'Admin/staff/manager/customer') this.value = '';" 
                    onblur="if (this.value === '') this.value = 'Admin/staff/manager/customer';">
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="nama user" placeholder="" onfocus="if (this.value === 'nama user') this.value = '';" 
                    onblur="if (this.value === '') this.value = 'nama user';">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="">
                </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        </div>
    </div>
@endsection