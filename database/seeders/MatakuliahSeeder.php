<?php

namespace Database\Seeders;

use App\Models\Matakuliah;
use Illuminate\Database\Seeder;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Matakuliah::factory(5)->create();
        $matkuls = collect()
        ->push($this->generator('PTI447', 'Praktikum Basis Data', 1, 3))
        ->push($this->generator('TIK342', 'Praktikum Basis Data', 1, 3))
        ->push($this->generator('PTI333', 'Basis Data Terdistribusi', 3, 5))
        ->push($this->generator('TIK123', 'Jaringan Komputer', 2, 5))
        ->push($this->generator('TIK333', 'Sistem Operasi', 3, 5))
        ->push($this->generator('PTI123', 'Grafika Multimedia', 3, 5))
        ->push($this->generator('PTI777', 'Sistem Informasi', 2, 3))
        ->toArray();

        Matakuliah::query()->insert($matkuls);
    }

    private function generator(string $kode, string $nama, int $sks, int $semester): array
    {
        return [
            'kode_mk' => $kode,
            'nama_mk' => $nama,
            'sks' => $sks,
            'semester' => $semester,
        ];
    }
}
