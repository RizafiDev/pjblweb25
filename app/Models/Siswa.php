<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
    'nisn',
    'nis',
    'nama',
    'kelas',
    'alamat',
    'no_telepon',
    'jenis_kelamin',
    'tanggal_lahir',
    'agama_id',
    'jurusan_id',
    ];

    /**
     * Get the agama associated with the siswa.
     */
    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }

    /**
     * Get the jurusan associated with the siswa.
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
