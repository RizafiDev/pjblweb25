<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use Carbon\Carbon;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $jurusans = [
            1 => 'Rekayasa Perangkat Lunak',
            2 => 'Desain Komunikasi Visual',
            3 => 'Akuntansi Keuangan Lembaga',
            4 => 'Usaha Layanan Pariwisata',
            5 => 'Bisnis Digital',
            6 => 'Broadcasting dan Perfilman',
            7 => 'Manajemen Perkantoran dan Layanan Bisnis',
        ];

        $agamas = [1, 2, 3, 4, 5, 6];
        $tahunSekarang = now()->year;

        for ($tahun = $tahunSekarang; $tahun >= $tahunSekarang - 4; $tahun--) {
            foreach ($jurusans as $jurusan_id => $nama_jurusan) {
                for ($i = 1; $i <= 30; $i++) {
                    $createdAt = Carbon::create($tahun, rand(1, 12), rand(1, 28));
                    Siswa::create([
                        'nisn' => $jurusan_id . $tahun . str_pad($i, 4, '0', STR_PAD_LEFT),
                        'nis' => $tahun . $jurusan_id . str_pad($i, 3, '0', STR_PAD_LEFT),
                        'nama' => 'Siswa ' . $nama_jurusan . ' ' . $i . ' (' . $tahun . ')',
                        'kelas' => ['X', 'XI', 'XII'][array_rand(['X', 'XI', 'XII'])],
                        'alamat' => 'Jl. Tahun ' . $tahun . ' No. ' . $i,
                        'no_telepon' => '08' . rand(111111111, 999999999),
                        'jenis_kelamin' => rand(0, 1) ? 'l' : 'p',
                        'tanggal_lahir' => now()->subYears(rand(15, 18))->subDays(rand(0, 365)),
                        'agama_id' => $agamas[array_rand($agamas)],
                        'jurusan_id' => $jurusan_id,
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt,
                    ]);
                }
            }
        }
    }
}
