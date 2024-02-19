@extends('layouts.admin')
@section('content')
       <!-- Page Heading -->
       <h1 class="h3 mb-2 text-gray-800">Menu</h1>

       <!-- DataTales Example -->
       <div class="card shadow mb-4">
           <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
               <a href="/pelanggan/create" class="btn btn-primary"> + &nbspTambah</a>
           </div>
           <div class="card-body">
               <div class="table-responsive">
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                       <thead>
                           <tr>
                               <th style="width: 1%;">No</th>
                               <th>ID Pelanggan</th>
                               <th>Nama</th>
                               <th>Alamat</th>
                               <th>Daya</th>
                               <th style="width:20%">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($menus as $menu => $key)
                           <tr>
                               <td class="text-wrap text-center">{{ $dataPelanggan + 1 }}</td>
                               <td>{{ $p -> id_pelanggan ?? '-'}}</td>
                               <td>{{ $p -> nama ?? '-' }}</td>
                               <td>{{ $p -> alamat ?? '-' }}</td>
                               <td>{{ $p -> daya ?? '-' }}</td>      
                               <td>
                                   <a class="btn btn-icon btn-success btn-sm btn-active-light-primary w-30px h-30px me-3" href="/pelanggan-{{ $p->id }}-detail-{{$yearNow}}">
                                   Detail
                                   </a>
                                   <a class="btn btn-icon btn-warning btn-sm btn-active-light-primary w-30px h-30px me-3" href="/pelanggan/edit/{{ $p->id }}">
                                   Edit
                                   </a>
                                   <a class="btn btn-icon btn-danger btn-sm btn-active-light-primary w-30px h-30px" href="/pelanggan/destroy/{{ $p->id }}" onclick="return confirm('Yakin menghapus data ini? Seluruh data tagihan pelanggan dengan ID {{ $p->id_pelanggan }} - {{ $p->nama }} akan terhapus!')">
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