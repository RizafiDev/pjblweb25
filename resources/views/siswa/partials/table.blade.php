
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>NIS</th>
            <th>NISN</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Agama</th>
            <th>GENDER</th>
            @role('admin')
            <th>Aksi</th>
            @endrole
        </tr>
    </thead>
    <tbody>
        @include('siswa.partials.table-rows')
    </tbody>
</table>