@extends('layouts.admin')
@section('content')
       <!-- Page Heading -->
       <h1 class="h3 mb-2 text-gray-800">Menu</h1>

       <!-- DataTales Example -->
       <div class="card shadow mb-4">
           <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
               <a href="{{ route('menu.create') }}" class="btn btn-primary"> + &nbspTambah</a>
           </div>
           <div class="card-body">
               <div class="table-responsive">
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                       <thead>
                           <tr>
                               <th style="width: 1%;">No</th>
                               <th>Menu</th>
                               <th>Level</th>
                               <th>Link</th>
                               <th style="width:20%">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($menus as $key => $menu)
                           <tr>
                               <td class="text-wrap text-center">{{ $key + 1 }}</td>
                               <td>{{ $menu->menu_name ?? '-'}}</td>
                               <td>{{ $menu->level ?? '-' }}</td>
                               <td>{{ $menu->menu_link ?? '-' }}</td>   
                               <td>
                                   <a class="btn btn-icon btn-warning btn-sm btn-active-light-primary px-3 w-auto h-30px me-3" href="{{route('menu.edit', ['id' => $menu->id])}}">
                                   Edit
                                   </a>
                                   <a class="btn btn-icon btn-danger btn-sm btn-active-light-primary px-3 w-auto h-30px cls-btn-delete" id="{{ $menu->id }}">
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
        const urlDelete = "{{route('menu.delete')}}";

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
                                location.href = '{{ route('menu.index') }}';
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