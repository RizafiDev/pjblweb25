@extends('adminlte::page')

@section('title', 'Data Siswa')

@section('content_header')
<h1>Data Siswa</h1>
@stop

@section('content')
@role('admin')
<a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">
    <i class="fas fa-plus"></i> Tambah Siswa
</a>
@endrole

{{-- Filter and Search Section --}}
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Filter & Pencarian Data</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <form id="filterForm" action="{{ route('siswa.index') }}" method="GET">
            <div class="row">
                {{-- Search Input --}}
                <div class="col-lg-3 col-md-6 mb-3">
                    <label for="search">Pencarian</label>
                    <input type="text" name="query" id="search" class="form-control" 
                           placeholder="Cari nama, NIS, NISN..." 
                           value="{{ request('query') }}" autocomplete="off">
                </div>
                
                {{-- Class Filter --}}
                <div class="col-lg-2 col-md-6 mb-3">
                    <label for="kelas_filter">Kelas</label>
                    <select name="kelas_filter" id="kelas_filter" class="form-control">
                        <option value="">Semua Kelas</option>
                        <option value="X" {{ request('kelas_filter') == 'X' ? 'selected' : '' }}>X</option>
                        <option value="XI" {{ request('kelas_filter') == 'XI' ? 'selected' : '' }}>XI</option>
                        <option value="XII" {{ request('kelas_filter') == 'XII' ? 'selected' : '' }}>XII</option>
                    </select>
                </div>
                
                {{-- Major Filter --}}
                <div class="col-lg-2 col-md-6 mb-3">
                    <label for="jurusan_filter">Jurusan</label>
                    <select name="jurusan_filter" id="jurusan_filter" class="form-control">
                        <option value="">Semua Jurusan</option>
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ request('jurusan_filter') == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                {{-- Religion Filter --}}
                <div class="col-lg-2 col-md-6 mb-3">
                    <label for="agama_filter">Agama</label>
                    <select name="agama_filter" id="agama_filter" class="form-control">
                        <option value="">Semua Agama</option>
                        @foreach($agamas as $agama)
                            <option value="{{ $agama->id }}" {{ request('agama_filter') == $agama->id ? 'selected' : '' }}>
                                {{ $agama->nama_agama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                {{-- Gender Filter --}}
                <div class="col-lg-2 col-md-6 mb-3">
                    <label for="gender_filter">Jenis Kelamin</label>
                    <select name="gender_filter" id="gender_filter" class="form-control">
                        <option value="">Semua</option>
                        <option value="l" {{ request('gender_filter') == 'l' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="p" {{ request('gender_filter') == 'p' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                
                {{-- Per Page Filter --}}
                <div class="col-lg-1 col-md-6 mb-3">
                    <label for="per_page">Show</label>
                    <select name="per_page" id="per_page" class="form-control">
                        <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100</option>
                        <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>All</option>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                        <i class="fas fa-undo"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Loading indicator --}}
<div id="loading" style="display: none;" class="text-center mb-3">
    <i class="fas fa-spinner fa-spin fa-2x"></i>
    <p>Memproses data...</p>
</div>

{{-- Data Info --}}
<div class="row mb-3">
    <div class="col-12">
        <div class="info-box bg-info">
            <span class="info-box-icon"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Siswa</span>
                <span id="total-count" class="info-box-number">
                    {{ is_a($siswas, 'Illuminate\Pagination\AbstractPaginator') ? $siswas->total() : count($siswas) }}
                </span>
            </div>
        </div>
    </div>
</div>

{{-- Data Table --}}
<div id="table-container">
    @include('siswa.partials.table')
</div>

{{-- Pagination --}}
<div id="pagination-container">
    @include('siswa.partials.pagination')
</div>

<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('siswa.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="createModalLabel">Tambah Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIS</label>
                                <input type="text" name="nis" class="form-control" maxlength="20" 
                                       placeholder="Masukkan NIS" required>
                            </div>

                            <div class="form-group">
                                <label>NISN</label>
                                <input type="text" name="nisn" class="form-control" maxlength="20"
                                       placeholder="Masukkan NISN" required>
                            </div>

                            <div class="form-group">
                                <label>Nama Lengkap</label>
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
                        </div>
                        <div class="col-md-6">
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
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="l">Laki-laki</option>
                                    <option value="p">Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" rows="2" required></textarea>
                            </div>

                            <div class="form-group">
                                <label>No Telepon</label>
                                <input type="text" name="no_telepon" class="form-control" maxlength="20" required>
                            </div>
                        </div>
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
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Hapus event realtime search/filter
        // $('#search').on('input', performSearch);
        // $('#kelas_filter, #jurusan_filter, #agama_filter, #gender_filter').on('change', performSearch);

        // Per page change tetap submit form
        $('#per_page').on('change', function() {
            $('#filterForm').submit();
        });

        // Submit form saat tekan enter di search field
        $('#search').keypress(function(e) {
            if(e.which == 13) {
                $('#filterForm').submit();
            }
        });

        // Confirm delete function
        window.confirmDelete = function(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
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
    });
</script>
@stop