@extends('adminlte::page')

@section('title', 'Tambah Jurusan')

@section('content_header')
<h1>Tambah Jurusan</h1>
@stop

@section('content')
<form action="{{ route('jurusan.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nama Jurusan</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Kode Jurusan</label>
        <input type="text" name="kode_jurusan" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('jurusan.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@stop