@extends('adminlte::page')

@section('title', 'Data Agama')

@section('content_header')
<h1>Data Agama</h1>
@stop

@section('content')
<a href="{{ route('agama.create') }}" class="btn btn-primary mb-3">Tambah Agama</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kode Agama</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($agamas as $agama)
            <tr>
                <td>{{ $agama->name }}</td>
                <td>{{ $agama->kode_agama }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop