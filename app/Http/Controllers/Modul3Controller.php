<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Modul3Controller extends Controller
{
    /**
     * Get distinct value
     *
     * @param  Request  $request
     * @return void
     */
    public function distinct(Request $request): void
    {
        $query = Matakuliah::query()->select('nama_mk')->orderBy('nama_mk');
        $distinct = $query->clone()->distinct();

        dd(
            $query->toSql(),
            $query->get(),
            $distinct->toSql(),
            $distinct->get()
        );
    }

    /**
     * Count existing records
     *
     * @param  Request  $request
     * @return void
     */
    public function count(Request $request): void
    {
        DB::enableQueryLog();

        $query = Matakuliah::query()->selectRaw('count(*) as jumlah')->first();
        $count = Matakuliah::query()->count();

        dd(DB::getQueryLog(), $query, $count);
    }

    /**
     * Sum existing sks records
     *
     * @param  Request  $request
     * @return void
     */
    public function sum(Request $request): void
    {
        DB::enableQueryLog();

        $query = Matakuliah::query()->selectRaw('sum(sks) as total')->first();
        $sum = Matakuliah::query()->sum('sks');

        dd(DB::getQueryLog(), $query, $sum);
    }

    /**
     * Average existing sks records
     *
     * @param  Request  $request
     * @return void
     */
    public function average(Request $request): void
    {
        DB::enableQueryLog();

        $query = Matakuliah::query()->selectRaw('avg(sks) as rata_rata')->first();
        $avg = Matakuliah::query()->average('sks');

        dd(DB::getQueryLog(), $query, $avg);
    }

    /**
     * Minimum existing sks records
     *
     * @param  Request  $request
     * @return void
     */
    public function min(Request $request): void
    {
        DB::enableQueryLog();

        $query = Matakuliah::query()->selectRaw('min(sks) as min')->first();
        $min = Matakuliah::query()->min('sks');

        dd(DB::getQueryLog(), $query, $min);
    }

    /**
     * Maximum existing sks records
     *
     * @param  Request  $request
     * @return void
     */
    public function max(Request $request): void
    {
        DB::enableQueryLog();

        $query = Matakuliah::query()->selectRaw('max(sks) as max')->first();
        $max = Matakuliah::query()->min('sks');

        dd(DB::getQueryLog(), $query, $max);
    }

    /**
     * Group sks records
     *
     * @param  Request  $request
     * @param  int  $semester
     * @return void
     */
    public function group(Request $request, int $semester = null): void
    {
        DB::enableQueryLog();

        $query = Matakuliah::query()->select('semester')->selectRaw('count(semester) as jumlah')
        ->when($semester, fn (Builder $query) => $query->where('semester', '>', $semester))
        ->groupBy('semester')
        ->get();

        dd(DB::getQueryLog(), $query);
    }
}
