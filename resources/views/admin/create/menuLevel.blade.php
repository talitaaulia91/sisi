@extends('layouts.admin')
@section('content')
       <!-- Page Heading -->
       <h1 class="h3 mb-4 text-gray-800">Tambah Menu Level</h1>
       <form method="POST" id="form-create-level">
        @csrf
       <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="level">Level</label>
                <input class="form-control" type="text" id="level" name="level" placeholder="Level"/>
            </div>
        </div>
       </div>
        <button type="submit" class="btn btn-primary" data-kt-stepper-action="submit" > Submit </button>
    </form>

   </div>
@endsection
@section('addafterjs')
<script type="text/javascript">
    $(document).ready(function() {
        var urlStore = '{{route('menu.level.store')}}';
        var $form = $('#form-create-level');

        setFormValidate();

        function setFormValidate() {
            $.fn.resetForm = $.noop;

            $form.validate({
                ignore: '',
                rules: {
                    level: 'required',
                },
                messages: {
                    level: 'Level wajib dipilih',
                },
                showErrors: function(errorMap, errorList) {
                    $form.find('.invalid-feedback').remove();
                    this.defaultShowErrors();
                },
                submitHandler: function(form) {
                    $(form).ajaxSubmit({
                        type: 'post',
                        url: urlStore,
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
                                        location.href = '{{ route('menu.level.index') }}';
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