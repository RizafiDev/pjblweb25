<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = ['nama_jurusan', 'kode_jurusan'];

    /**
     * Get the siswa records associated with the jurusan.
     */
    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
}
