<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class Modul1Controller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $mahasiswa = Mahasiswa::query()->with('matakuliah')->first();

        $matkul = Matakuliah::query()->first();

        // dd($mahasiswa->matakuliah()->attach($matkul));

        // dd($mahasiswa);

        // dd($mahasiswa, $matkul);
    }
}
