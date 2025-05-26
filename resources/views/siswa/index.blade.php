@extends('adminlte::page')

@section('title', 'Data Siswa')

@section('content_header')
<h1>Data Siswa</h1>
@stop

@section('content')
<a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">
    <i class="fas fa-plus"></i> Tambah Siswa
</a>

{{-- Form Search dengan ID yang benar --}}
<form action="{{ route('siswa.search') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="query" id="search" class="form-control" placeholder="Cari siswa..." autocomplete="off">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </div>
</form>

{{-- Loading indicator --}}
<div id="loading" style="display: none;" class="text-center mb-3">
    <i class="fas fa-spinner fa-spin"></i> Mencari...
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>NIS</th>
            <th>NISN</th>
            <th>NAMA</th>
            <th>KELAS</th>
            <th>JURUSAN</th>
            <th>AGAMA</th>
            <th>JENIS KELAMIN</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="siswa-table-body">
        @foreach($siswas as $siswa)
            <tr>
                <td>{{ $siswa->id }}</td>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->nisn }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->kelas }}</td>
                <td>{{ $siswa->jurusan->nama_jurusan }}</td>
                <td>{{ $siswa->agama->nama_agama }}</td>
                <td>{{ $siswa->jenis_kelamin == 'l' ? 'Laki - Laki' : 'Perempuan' }}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                        data-target="#viewModal{{ $siswa->id }}"><i class="fas fa-eye"></i></button>

                    @if($siswa->id)
                        <a href="#" class="btn btn-sm btn-warning text-white" data-toggle="modal"
                            data-target="#editModal{{ $siswa->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                    @endif

                    @if($siswa->id)
                        <form id="delete-form-{{ $siswa->id }}" action="{{ route('siswa.destroy', $siswa->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $siswa->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    @else
                        <span class="text-danger">ID siswa tidak tersedia</span>
                    @endif

                    <!-- Modal Lihat -->
                    <div class="modal fade" id="viewModal{{ $siswa->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="viewModalLabel{{ $siswa->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewModalLabel{{ $siswa->id }}">Detail Siswa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
                                    <p><strong>NISN:</strong> {{ $siswa->nisn }}</p>
                                    <p><strong>Nama:</strong> {{ $siswa->nama }}</p>
                                    <p><strong>Kelas:</strong> {{ $siswa->kelas }}</p>
                                    <p><strong>Jurusan:</strong> {{ $siswa->jurusan->nama_jurusan }}</p>
                                    <p><strong>Agama:</strong> {{ $siswa->agama->nama_agama }}</p>
                                    <p><strong>Jenis Kelamin:</strong>
                                        {{ $siswa->jenis_kelamin == 'l' ? 'Laki - Laki' : 'Perempuan' }}</p>
                                    <p><strong>Alamat:</strong> {{ $siswa->alamat }}</p>
                                    <p><strong>No Telepon:</strong> {{ $siswa->no_telepon ?? '-' }}</p>
                                    <p><strong>Tanggal Lahir:</strong>
                                        {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal{{ $siswa->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="editModalLabel{{ $siswa->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Siswa</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>NIS</label>
                                            <input type="text" name="nis" class="form-control" value="{{ $siswa->nis }}"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label>NISN</label>
                                            <input type="text" name="nisn" class="form-control" value="{{ $siswa->nisn }}"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="nama" class="form-control" value="{{ $siswa->nama }}"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label>Kelas</label>
                                            <select name="kelas" class="form-control" required>
                                                <option value="">-- Pilih Kelas --</option>
                                                <option value="X" {{ $siswa->kelas == 'X' ? 'selected' : '' }}>X</option>
                                                <option value="XI" {{ $siswa->kelas == 'XI' ? 'selected' : '' }}>XI</option>
                                                <option value="XII" {{ $siswa->kelas == 'XII' ? 'selected' : '' }}>XII
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Jurusan</label>
                                            <select name="jurusan_id" class="form-control" required>
                                                <option value="">-- Pilih Jurusan --</option>
                                                @foreach($jurusans as $jurusan)
                                                    <option value="{{ $jurusan->id }}" {{ $siswa->jurusan_id == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Agama</label>
                                            <select name="agama_id" class="form-control" required>
                                                <option value="">-- Pilih Agama --</option>
                                                @foreach($agamas as $agama)
                                                    <option value="{{ $agama->id }}" {{ $siswa->agama_id == $agama->id ? 'selected' : '' }}>{{ $agama->nama_agama }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea name="alamat" class="form-control"
                                                required>{{ $siswa->alamat }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>No Telepon</label>
                                            <input type="text" name="no_telepon" class="form-control"
                                                value="{{ $siswa->no_telepon }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-control" required>
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="l" {{ $siswa->jenis_kelamin == 'l' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="p" {{ $siswa->jenis_kelamin == 'p' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="form-control"
                                                value="{{ $siswa->tanggal_lahir }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- Pagination jika diperlukan --}}
{{-- {{ $siswas->links() }} --}}
@stop

<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('siswa.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" name="nis" class="form-control" maxlength="5" minlength="5" placeholder="Masukkan NIS (Minimal 5 digit)" required>
                    </div>

                    <div class="form-group">
                        <label>NISN</label>
                        <input type="text" name="nisn" class="form-control" maxlength="10"minlength="5" placeholder="Masukkan NISN (Minimal 10 digit)" required>
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" maxlength="100" required>
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="kelas" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jurusan</label>
                        <select name="jurusan_id" class="form-control" required>
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Agama</label>
                        <select name="agama_id" class="form-control" required>
                            <option value="">-- Pilih Agama --</option>
                            @foreach($agamas as $agama)
                                <option value="{{ $agama->id }}">{{ $agama->nama_agama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" placeholder="Isi alamat sesuai domisili KK" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>No Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" placeholder="Isi nomor telepon dengan awalan +62" required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="l">Laki-laki</option>
                            <option value="p">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" placeholder="Isi tanggal lahir sesuai KK"required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@section('js')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin?',
            text: "Data akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

{{-- Real-time Search Script --}}
<script>
    $(document).ready(function () {
        // AJAX search
        $('#search').on('input', function () {
            let query = $(this).val();
            $('#loading').show();

            $.ajax({
                url: "{{ route('siswa.search') }}",
                type: "GET",
                data: {
                    query: query,
                    ajax: true
                },
                success: function (data) {
                    $('tbody').html(data);
                    $('#loading').hide();
                },
                error: function () {
                    $('#loading').hide();
                    alert('Error occurred during search');
                }
            });
        });
    });
</script>
@stop