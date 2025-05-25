<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $fillable = ['nama_agama', 'kode_agama'];

    /**
     * Get the siswa records associated with the agama.
     */
    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
}
