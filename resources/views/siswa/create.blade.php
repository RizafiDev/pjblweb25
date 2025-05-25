@extends('adminlte::page')

@section('title', 'Tambah Siswa')

@section('content_header')
<h1>Tambah Siswa</h1>
@stop

@section('content')
<form action="{{ route('siswa.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="form-group">
        <label>NIS</label>
        <input type="text" name="nis" class="form-control" required>
    </div>

    <div class="form-group">
        <label>NISN</label>
        <input type="text" name="nisn" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Kelas</label>
        <input type="text" name="kelas" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Agama</label>
        <select name="agama_id" class="form-control" required>
            <option value="">-- Pilih Agama --</option>
            @foreach($agamas as $agama)
                <option value="{{ $agama->id }}">{{ $agama->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Jurusan</label>
        <select name="jurusan_id" class="form-control" required>
            <option value="">-- Pilih Jurusan --</option>
            @foreach($jurusans as $jurusan)
                <option value="{{ $jurusan->id }}">{{ $jurusan->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label>No Telepon</label>
        <input type="text" name="no_telepon" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control" required>
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
    </div>

    <div class="form-group">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@stop