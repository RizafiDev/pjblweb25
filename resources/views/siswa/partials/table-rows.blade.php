@foreach($siswas as $siswa)
    <tr>
        <td>{{ $siswa->id }}</td>
        <td>{{ $siswa->nis }}</td>
        <td>{{ $siswa->nisn }}</td>
        <td>{{ $siswa->nama }}</td>
        <td>{{ $siswa->kelas }}</td>
        <td>{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td>
        <td>{{ $siswa->agama->nama_agama ?? '-' }}</td>
        <td>{{ $siswa->jenis_kelamin == 'l' ? 'Laki - Laki' : 'Perempuan' }}</td>
        <td>
            <div class="btn-group" role="group">
                <!-- View Button -->
                <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                    data-target="#viewModal{{ $siswa->id }}" title="Lihat Detail">
                    <i class="fas fa-eye"></i>
                </button>

                <!-- Edit Button -->
                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                    data-target="#editModal{{ $siswa->id }}" title="Edit">
                    <i class="fas fa-edit"></i>
                </button>

                <!-- Delete Button -->
                <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger delete-btn" 
                        data-id="{{ $siswa->id }}" title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>

            <!-- View Modal -->
            <div class="modal fade" id="viewModal{{ $siswa->id }}" tabindex="-1" role="dialog" 
                aria-labelledby="viewModalLabel{{ $siswa->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="viewModalLabel{{ $siswa->id }}">Detail Siswa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
                                    <p><strong>NISN:</strong> {{ $siswa->nisn }}</p>
                                    <p><strong>Nama Lengkap:</strong> {{ $siswa->nama }}</p>
                                    <p><strong>Kelas:</strong> {{ $siswa->kelas }}</p>
                                    <p><strong>Jurusan:</strong> {{ $siswa->jurusan->nama_jurusan ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Agama:</strong> {{ $siswa->agama->nama_agama ?? '-' }}</p>
                                    <p><strong>Jenis Kelamin:</strong> {{ $siswa->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan' }}</p>
                                    <p><strong>Tanggal Lahir:</strong> {{ $siswa->tanggal_lahir->format('d/m/Y') }}</p>
                                    <p><strong>Alamat:</strong> {{ $siswa->alamat }}</p>
                                    <p><strong>No. Telepon:</strong> {{ $siswa->no_telepon ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal{{ $siswa->id }}" tabindex="-1" role="dialog" 
                aria-labelledby="editModalLabel{{ $siswa->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header bg-warning text-white">
                                <h5 class="modal-title" id="editModalLabel{{ $siswa->id }}">Edit Data Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nis">NIS</label>
                                            <input type="text" class="form-control" id="nis" name="nis" 
                                                value="{{ $siswa->nis }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nisn">NISN</label>
                                            <input type="text" class="form-control" id="nisn" name="nisn" 
                                                value="{{ $siswa->nisn }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" name="nama" 
                                                value="{{ $siswa->nama }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelas">Kelas</label>
                                            <select class="form-control" id="kelas" name="kelas" required>
                                                <option value="X" {{ $siswa->kelas == 'X' ? 'selected' : '' }}>X</option>
                                                <option value="XI" {{ $siswa->kelas == 'XI' ? 'selected' : '' }}>XI</option>
                                                <option value="XII" {{ $siswa->kelas == 'XII' ? 'selected' : '' }}>XII</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jurusan_id">Jurusan</label>
                                            <select class="form-control" id="jurusan_id" name="jurusan_id" required>
                                                @foreach($jurusans as $jurusan)
                                                    <option value="{{ $jurusan->id }}" 
                                                        {{ $siswa->jurusan_id == $jurusan->id ? 'selected' : '' }}>
                                                        {{ $jurusan->nama_jurusan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="agama_id">Agama</label>
                                            <select class="form-control" id="agama_id" name="agama_id" required>
                                                @foreach($agamas as $agama)
                                                    <option value="{{ $agama->id }}" 
                                                        {{ $siswa->agama_id == $agama->id ? 'selected' : '' }}>
                                                        {{ $agama->nama_agama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                                <option value="l" {{ $siswa->jenis_kelamin == 'l' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="p" {{ $siswa->jenis_kelamin == 'p' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" 
                                                value="{{ $siswa->tanggal_lahir->format('Y-m-d') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="2" required>{{ $siswa->alamat }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="no_telepon">No. Telepon</label>
                                    <input type="text" class="form-control" id="no_telepon" name="no_telepon" 
                                        value="{{ $siswa->no_telepon }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </td>
    </tr>
@endforeach

<script>
$(document).ready(function() {
    // Delete confirmation
    $('.delete-btn').click(function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var siswaId = $(this).data('id');
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data siswa akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>