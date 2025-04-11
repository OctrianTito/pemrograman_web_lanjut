<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Pengguna</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap/css/bootstrap.min.css') }}">
    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-outline card-indigo shadow-lg">
                    <div class="card-header bg-indigo text-center">
                        <a href="{{ url('/register') }}" class="h1 text-white"><b>Admin</b>LTE</a>
                    </div>
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4">Pendaftaran Akun Baru</h4>
                        <form action="{{ url('register') }}" method="POST" id="form-register">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-indigo"><i class="fas fa-user text-white"></i></span>
                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Enter your full name" required>
                                </div>
                                <div id="error-nama" class="text-danger small"></div>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-indigo"><i class="fas fa-user-circle text-white"></i></span>
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                                </div>
                                <div id="error-username" class="text-danger small"></div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-indigo"><i class="fas fa-lock text-white"></i></span>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                                </div>
                                <div id="error-password" class="text-danger small"></div>
                            </div>
                            <div class="mb-4">
                                <label for="level_id" class="form-label">Level User</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-indigo"><i class="fas fa-users-cog text-white"></i></span>
                                    <select name="level_id" id="level_id" class="form-select text-secondary" required>
                                        <option value="">- Pilih Level -</option>
                                        @foreach ($level as $l)
                                            <option value="{{ $l->level_id }}">{{ $l->level_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="error-level_id" class="text-danger small"></div>
                            </div>
                            <div class="text-center mb-3">
                                <button type="submit" class="btn bg-indigo text-white btn-lg px-5 hover-dark">Register</button>
                            </div>
                        </form>
                        <div class="text-center mt-4">
                            <p>Sudah Punya Akun?<a href="{{ url('login') }}" class="text-indigo"> Login Disini!</a></p>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3 text-muted">
                    <small>&copy; 2025 AdminLTE</small>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 5 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.getElementById('level_id');
            if (!dropdown.value) {
                dropdown.classList.add('text-secondary');
            }

            dropdown.addEventListener('change', function() {
                if (dropdown.value) {
                    dropdown.classList.remove('text-secondary');
                    dropdown.style.color = 'black';
                } else {
                    dropdown.classList.add('text-secondary');
                    dropdown.style.color = '';
                }
            });
        });

        $(document).ready(function() {
            $("#form-register").validate({
                rules: {
                    nama: {
                        required: true,
                        minlength: 3
                    },
                    username: {
                        required: true,
                        minlength: 4,
                        maxlength: 20
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        maxlength: 20
                    },
                    level_id: {
                        required: true,
                        number: true
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: "Register Berhasil",
                                    text: response.message,
                                }).then(function() {
                                    window.location = response.redirect;
                                });
                            } else {
                                $('.text-danger').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $("#error-" + prefix).text(val[0]);
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
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass('text-danger small mt-1');
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element.closest(".input-group"));
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                }
            });
        });
    </script>
</body>
</html>