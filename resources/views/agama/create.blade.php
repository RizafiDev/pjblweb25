@extends('adminlte::page')

@section('title', 'Tambah Agama')

@section('content_header')
<h1>Tambah Agama</h1>
@stop

@section('content')
<form action="{{ route('agama.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nama Agama</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Kode Agama</label>
        <input type="text" name="kode_agama" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('agama.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@stop