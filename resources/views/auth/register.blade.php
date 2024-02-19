@extends('layouts.index')

@section('addbeforecss')
<style>
    .card{
        background-color: #ffff;
        border-radius:20px;
        padding:20px;
        margin:auto;
        display: inline-block;
    }
</style>
@endsection

@section('content')
    <section>
        <div class="card w-50">
            <h2>Register</h2>
            <form method="POST" id="form-register">
                @csrf
                <div class="mb-3">
                    <label for="nama_user">Nama</label>
                    <input class="form-control" type="text" id="nama_user" name="nama_user" placeholder="nama"/>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" placeholder="email"/>
                </div>
                <div class="mb-3">
                    <label for="no_hp">Nomor Telepon</label>
                    <input class="form-control" type="no_hp" id="no_hp" name="no_hp" placeholder="nomor Telepon"/>
                </div>
                <div class="mb-3">
                    <label for="wa">Nomor WhatsApp</label>
                    <input class="form-control" type="wa" id="wa" name="wa" placeholder="nomor WhatsApp"/>
                </div>
                <div class="mb-3">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" id="username" name="username" placeholder="username"/>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password" placeholder="password"/>
                </div>
                <button type="submit" class="btn btn-primary" data-kt-stepper-action="submit" > Daftar </button>
                <p>Sudah punya akun? <span><a href="{{ route('login.index') }}" style="color:#000000">Login</a></span></p>
            </form>
        </div>
    </section>
@endsection

@section('addafterjs')
<script type="text/javascript">
    $(document).ready(function() {
        var urlRegister = '{{route('register.store')}}';
        var $form = $('#form-register');

        setFormValidate();

        function setFormValidate() {
            $.fn.resetForm = $.noop;

            $form.validate({
                ignore: '',
                rules: {
                    nama_user: 'required',
                    username: 'required',
                    password: 'required',
                    email: 'required',
                    no_hp: 'required',
                    wa: 'required',
                },
                messages: {
                    username: 'Username wajib dipilih',
                    password: 'Password wajib diisi',
                    email: 'Email wajib diisi',
                    no_hp: 'Nomor telepon wajib diisi',
                    wa: 'Nomor whatsApp wajib diisi',
                    nama_user: 'Nama wajib diisi',
                },
                showErrors: function(errorMap, errorList) {
                    $form.find('.invalid-feedback').remove();
                    this.defaultShowErrors();
                },
                submitHandler: function(form) {
                    $(form).ajaxSubmit({
                        type: 'post',
                        url: urlRegister,
                        dataType: 'json',
                        beforeSend: function() {
                            loading();
                        },
                        success: function(data) {
                            swal.fire({
                                title: data.title,
                                html: data.msg,
                                icon: data.flag,
                                buttonsStyling: true,
                                confirmButtonText: '<i class=\'flaticon2-checkmark\'></i> OK',
                            }).then(() => {
                                if (data.flag == 'success') {
                                        location.href = '{{ route('login.index') }}';
                                }
                            });
                        },
                        error: ajaxErrorHandler,
                        complete: $.unblockUI,
                    });
                },
            });
        }
    })
</script>
@endsection