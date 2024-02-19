@extends('layouts.admin')
@section('content')
       <!-- Page Heading -->
       <h1 class="h3 mb-4 text-gray-800">Edit Menu</h1>
       <form method="POST" id="form-edit-menu">
        @csrf
       <div class="row">
        <div class="col-lg-6">
            <input type="hidden" name="id" id="id" value="{{ $menu?->id }}">
            <div class="mb-3">
                <label for="level_id">Menu Level</label>
                <select name="level_id" id="level_id" class="form-select">
                    @foreach($levels as $level)
                                <option value="{{ $level->id }}"
                                @if($level->id === $menu->level_id)
                                selected
                                @endif    
                                >{{ $level->level }}
                                </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="menu_name">Nama Menu</label>
                <input class="form-control" type="text" id="menu_name" name="menu_name" value="{{ $menu?->menu_name }}" placeholder="Nama Menu"/>
            </div>
            <div class="mb-3">
                <label for="menu_link">Link Menu</label>
                <input class="form-control" type="text" id="menu_link" name="menu_link" value="{{ $menu?->menu_name }}" placeholder="Link Menu"/>
            </div>
            <div class="mb-3">
                <label for="menu_icon">Icon Menu</label>
                <input class="form-control" type="text" id="menu_icon" name="menu_icon" value="{{ $menu?->menu_name }}" placeholder="Icon Menu"/>
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
        var urlStore = '{{route('menu.update')}}';
        var $form = $('#form-edit-menu');

        setFormValidate();

        function setFormValidate() {
            $.fn.resetForm = $.noop;

            $form.validate({
                ignore: '',
                rules: {
                    menu_name: 'required',
                },
                messages: {
                    menu_name: 'Nama menu wajib dipilih',
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