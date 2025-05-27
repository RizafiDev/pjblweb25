@extends('adminlte::page')

@section('title', 'Data Jurusan')

@section('content_header')
<h1>Data Jurusan</h1>
@stop

@section('css')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@stop

@section('content')
<!-- Success/Error Messages -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@role('admin')
<!-- Create Button with Modal Trigger -->
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">
    <i class="fas fa-plus"></i> Tambah Jurusan
</button>
@endrole

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="150px" >Kode Jurusan</th>
                    <th>Nama Jurusan</th>
                    @role('admin')
                    <th width="120px">Aksi</th>
                    @endrole
                </tr>
            </thead>
            <tbody>
                @forelse ($jurusans as $jurusan)
                    <tr>
                        <td>{{ $jurusan->id }}</td>
                        <td>{{ $jurusan->nama_jurusan }}</td>
                        @role('admin')
                        <td>
                            <!-- Edit Button with Modal Trigger -->
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" 
                                data-target="#editModal{{ $jurusan->id }}" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            
                            <!-- Delete Button -->
                            <form action="{{ route('jurusan.destroy', $jurusan->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn" 
                                        data-id="{{ $jurusan->id }}" 
                                        data-name="{{ $jurusan->nama_jurusan }}" 
                                        title="Hapus">
                                    <i class="fas fa-trash text-white"></i>
                                </button>
                            </form>
                        </td>
                        @endrole
                    </tr>

                    <!-- Edit Modal untuk setiap jurusan -->
                    <div class="modal fade" id="editModal{{ $jurusan->id }}" tabindex="-1" role="dialog" 
                        aria-labelledby="editModalLabel{{ $jurusan->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title text-white" id="editModalLabel{{ $jurusan->id }}">
                                        <i class="fas fa-edit"></i> Edit Jurusan
                                    </h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama_jurusan_edit_{{ $jurusan->id }}">Nama Jurusan</label>
                                            <input type="text" class="form-control" 
                                                id="nama_jurusan_edit_{{ $jurusan->id }}" 
                                                name="nama_jurusan" 
                                                value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}" 
                                                required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            <i class="fas fa-times"></i> Batal
                                        </button>
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fas fa-save"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data jurusan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="createModalLabel">
                    <i class="fas fa-plus"></i> Tambah Jurusan Baru
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('jurusan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_jurusan_create">Nama Jurusan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_jurusan_create" 
                               name="nama_jurusan" value="{{ old('nama_jurusan') }}" 
                               placeholder="Masukkan nama jurusan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Auto hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);

        // Delete confirmation with SweetAlert
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            var jurusan_name = $(this).data('name');
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: `Data jurusan <strong>"${jurusan_name}"</strong> akan dihapus permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '<i class="fas fa-trash"></i> Ya, hapus!',
                cancelButtonText: '<i class="fas fa-times"></i> Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Menghapus data...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                    
                    // Submit form
                    form.submit();
                }
            });
        });

        // Show success message if exists
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                timer: 3000
            });
        @endif

        // Show error message if exists  
        @if(session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif

        // Show validation errors
        @if($errors->any())
            Swal.fire({
                title: 'Validation Error!',
                html: '<ul style="text-align: left; margin: 0; padding-left: 20px;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif

        // Clear form when create modal is closed
        $('#createModal').on('hidden.bs.modal', function () {
            $(this).find('form')[0].reset();
        });
    });
</script>
@stop