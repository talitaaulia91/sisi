@extends('layouts.admin')
@section('content')
       <!-- Page Heading -->
       <h1 class="h3 mb-2 text-gray-800">Menu Level</h1>

       <!-- DataTales Example -->
       <div class="card shadow mb-4">
           <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
               <a href="{{ route('menu.level.create') }}" class="btn btn-primary"> + &nbspTambah</a>
           </div>
           <div class="card-body">
               <div class="table-responsive">
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                       <thead>
                           <tr>
                               <th style="width: 1%;">No</th>
                               <th>Level</th>
                               <th style="width:20%">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($levels as $key => $level)
                           <tr>
                               <td class="text-wrap text-center">{{ $key + 1 }}</td>
                               <td>{{ $level->level ?? '-'}}</td>    
                               <td>
                                   <a class="btn btn-icon btn-warning btn-sm btn-active-light-primary w-auto px-3 h-30px me-3" href="{{route('menu.level.edit', ['id' => $level->id])}}">
                                   Edit
                                   </a>
                                   <a class="btn btn-icon btn-danger btn-sm btn-active-light-primary w-auto px-3 h-30px cls-btn-delete" id="{{ $level->id }}">
                                   Hapus
                                   </a>
                               </td>                               
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
               </div>
           </div>
       </div>

   </div>
@endsection

@section('addafterjs')
<script>
    $(document).ready(function(){
        const $body = $(document.body)
        const urlDelete = "{{route('menu.level.delete')}}";

        $body.on('click', '.cls-btn-delete', handleDeleteClick);

        function handleDeleteClick() {
            const $button = $(this);
            swal.fire({
                title: 'Pemberitahuan',
                text: 'Yakin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus data',
                cancelButtonText: 'Tidak',
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: urlDelete,
                        data: {
                            'id': $button.attr('id'),
                            '_token': '{{ csrf_token() }}'
                        },
                        type: 'post',
                        dataType: 'json',
                        beforeSend: function() {
                            loading();
                        },
                        success: function(data) {
                            $.unblockUI();

                            swal.fire({
                                title: data.title,
                                html: data.msg,
                                icon: data.flag,
                                buttonsStyling: true,
                                confirmButtonText: '<i class=\'flaticon2-checkmark\'></i> OK',
                            });

                            if (data.flag == 'success') {
                                location.href = '{{ route('menu.level.index') }}';
                            }
                        },
                        error: ajaxErrorHandler,
                    });
                }
            });
        }
    })
</script>
    
@endsection