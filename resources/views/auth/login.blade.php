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
            <h2>Login</h2>
            <form method="POST" id="form-login">
                @csrf
                <div class="mb-3">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" id="username" name="username" placeholder="username"/>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password" placeholder="password"/>
                </div>
                <button type="submit" class="btn btn-primary" data-kt-stepper-action="submit" > Login </button>
                <p>Belum punya akun? <span><a href="{{ route('register.index') }}" style="color:#000000">Daftar</a></span></p>
            </form>
        </div>
    </section>
@endsection

@section('addafterjs')
<script type="text/javascript">
    $(document).ready(function() {
        var urlLogin = '{{route('login.store')}}';
        var $form = $('#form-login');

        setFormValidate();

        function setFormValidate() {
            $.fn.resetForm = $.noop;

            $form.validate({
                ignore: '',
                rules: {
                    username: 'required',
                    password: 'required',
                },
                messages: {
                    username: 'Username wajib dipilih',
                    password: 'Password wajib diisi',
                },
                showErrors: function(errorMap, errorList) {
                    $form.find('.invalid-feedback').remove();
                    this.defaultShowErrors();
                },
                submitHandler: function(form) {
                    $(form).ajaxSubmit({
                        type: 'post',
                        url: urlLogin,
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
                                    location.href = '{{ route('menu.index') }}';
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