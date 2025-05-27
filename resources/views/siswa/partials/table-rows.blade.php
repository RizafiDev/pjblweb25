
@forelse($siswas as $siswa)
    <tr>
        <td>{{ $siswa->id }}</td>
        <td>{{ $siswa->nis }}</td>
        <td>{{ $siswa->nisn }}</td>
        <td>{{ $siswa->nama }}</td>
        <td>{{ $siswa->kelas }}</td>
        <td>{{ $siswa->jurusan->nama_jurusan }}</td>
        <td>{{ $siswa->agama->nama_agama }}</td>
        <td>{{ $siswa->jenis_kelamin == 'l' ? 'Laki - Laki' : 'Perempuan' }}</td>
        @role('admin')
        <td>
            <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                data-target="#viewModal{{ $siswa->id }}" title="Lihat Detail">
                <i class="fas fa-eye"></i>
            </button>

            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                data-target="#editModal{{ $siswa->id }}" title="Edit">
                <i class="fas fa-edit"></i>
            </button>

            <form id="delete-form-{{ $siswa->id }}" action="{{ route('siswa.destroy', $siswa->id) }}" method="POST"
                style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $siswa->id }})" title="Hapus">
                <i class="fas fa-trash"></i>
            </button>

            <!-- View Modal -->
            <div class="modal fade" id="viewModal{{ $siswa->id }}" tabindex="-1" role="dialog"
                aria-labelledby="viewModalLabel{{ $siswa->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title text-white" id="viewModalLabel{{ $siswa->id }}">Detail Siswa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
                                    <p><strong>NISN:</strong> {{ $siswa->nisn }}</p>
                                    <p><strong>Nama:</strong> {{ $siswa->nama }}</p>
                                    <p><strong>Kelas:</strong> {{ $siswa->kelas }}</p>
                                    <p><strong>Jurusan:</strong> {{ $siswa->jurusan->nama_jurusan }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Agama:</strong> {{ $siswa->agama->nama_agama }}</p>
                                    <p><strong>Jenis Kelamin:</strong> {{ $siswa->jenis_kelamin == 'l' ? 'Laki-Laki' : 'Perempuan' }}</p>
                                    <p><strong>Alamat:</strong> {{ $siswa->alamat }}</p>
                                    <p><strong>No Telepon:</strong> {{ $siswa->no_telepon ?? '-' }}</p>
                                    <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</p>
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
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title" id="editModalLabel{{ $siswa->id }}">Edit Data Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIS</label>
                                            <input type="text" name="nis" class="form-control" value="{{ $siswa->nis }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>NISN</label>
                                            <input type="text" name="nisn" class="form-control" value="{{ $siswa->nisn }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" name="nama" class="form-control" value="{{ $siswa->nama }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kelas</label>
                                            <select name="kelas" class="form-control" required>
                                                <option value="">-- Pilih Kelas --</option>
                                                <option value="X" {{ $siswa->kelas == 'X' ? 'selected' : '' }}>X</option>
                                                <option value="XI" {{ $siswa->kelas == 'XI' ? 'selected' : '' }}>XI</option>
                                                <option value="XII" {{ $siswa->kelas == 'XII' ? 'selected' : '' }}>XII</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jurusan</label>
                                            <select name="jurusan_id" class="form-control" required>
                                                <option value="">-- Pilih Jurusan --</option>
                                                @foreach($jurusans as $jurusan)
                                                    <option value="{{ $jurusan->id }}" {{ $siswa->jurusan_id == $jurusan->id ? 'selected' : '' }}>
                                                        {{ $jurusan->nama_jurusan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <select name="agama_id" class="form-control" required>
                                                <option value="">-- Pilih Agama --</option>
                                                @foreach($agamas as $agama)
                                                    <option value="{{ $agama->id }}" {{ $siswa->agama_id == $agama->id ? 'selected' : '' }}>
                                                        {{ $agama->nama_agama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-control" required>
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="l" {{ $siswa->jenis_kelamin == 'l' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="p" {{ $siswa->jenis_kelamin == 'p' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $siswa->tanggal_lahir }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea name="alamat" class="form-control" rows="2" required>{{ $siswa->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No Telepon</label>
                                            <input type="text" name="no_telepon" class="form-control" value="{{ $siswa->no_telepon }}" required>
                                        </div>
                                    </div>
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
        @endrole
    </tr>
@empty
    <tr>
        <td colspan="9" class="text-center py-4">Tidak ada data siswa yang ditemukan</td>
    </tr>
@endforelse