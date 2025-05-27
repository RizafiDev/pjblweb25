@extends('adminlte::page')

@section('title', 'Data Agama')

@section('content_header')
<h1>Data Agama</h1>
@stop

@section('css')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@stop

@section('content')
@role('admin')
<!-- Create Button with Modal Trigger -->
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">
    Tambah Agama
</button>
@endrole

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Kode Agama</th>
            <th>Nama</th>
            @role('admin')
            <th width="120px">Aksi</th>
            @endrole
        </tr>
    </thead>
    <tbody>
        @foreach ($agamas as $agama)
            <tr>
                <td>{{ $agama->id }}</td>
                <td>{{ $agama->nama_agama }}</td>
                @role('admin')
                <td>
                    <!-- Edit Button with Modal Trigger -->
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                        data-target="#editModal{{ $agama->id }}">
                        <i class="fas fa-edit text-white"></i>
                    </button>

                    <!-- Delete Button -->
                    <form action="{{ route('agama.destroy', $agama->id) }}" method="POST" class="delete-form d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm delete-btn" data-id="{{ $agama->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $agama->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="editModalLabel{{ $agama->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-warning text-white">
                                    <h5 class="modal-title" id="editModalLabel{{ $agama->id }}">Edit Agama</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('agama.update', $agama->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama_agama_edit_{{ $agama->id }}">Nama Agama</label>
                                            <input type="text" class="form-control" id="nama_agama_edit_{{ $agama->id }}" name="nama_agama"
                                                value="{{ $agama->nama_agama }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
                @endrole
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createModalLabel">Tambah Agama Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('agama.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_agama_create">Nama Agama</label>
                        <input type="text" class="form-control" id="nama_agama_create" name="nama_agama" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
    $(document).ready(function () {
        // Delete confirmation with SweetAlert
        $('.delete-btn').click(function (e) {
            e.preventDefault();
            var form = $(this).closest('form');
            var agamaId = $(this).data('id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data agama akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                    
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
                confirmButtonText: 'OK'
            });
        @endif

        // Show error message if exists
        @if($errors->any())
            Swal.fire({
                title: 'Error!',
                html: '<ul style="text-align: left;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>
@stop