@extends('adminlte::page')

@section('title', 'Data Siswa')

@section('content_header')
    <h1>Data Siswa</h1>
@stop

@section('content')
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>NIS</th>
                <th>NISN</th>
                <th>NAMA</th>
                <th>KELAS</th>
                <th>JURUSAN</th>
                <th>AGAMA</th>
                <th>ALAMAT</th>
                <th>TELEPON</th>
                <th>JENIS KELAMIN</th>
                <th>TANGGAL LAHIR</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswas as $siswa)
                <tr>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->kelas }}</td>
                    <td>{{ $siswa->jurusan->name }}</td>
                    <td>{{ $siswa->agama->name }}</td>
                    <td>{{ $siswa->alamat }}</td>
                    <td>{{ $siswa->no_telepon }}</td>
                    <td>{{ $siswa->jenis_kelamin }}</td>
                    <td>{{ $siswa->tanggal_lahir }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
