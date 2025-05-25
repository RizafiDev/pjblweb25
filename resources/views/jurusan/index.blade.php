@extends('adminlte::page')

@section('title', 'Data Jurusan')

@section('content_header')
<h1>Data Jurusan</h1>
@stop

@section('content')
<a href="{{ route('jurusan.create') }}" class="btn btn-primary mb-3">Tambah Jurusan</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kode Jurusan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jurusans as $jurusan)
            <tr>
                <td>{{ $jurusan->name }}</td>
                <td>{{ $jurusan->kode_jurusan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop