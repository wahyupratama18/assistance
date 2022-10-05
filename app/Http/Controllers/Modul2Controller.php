<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Matakuliah;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Modul2Controller extends Controller
{
    /**
     * Select all records.
     *
     * @param  Request  $request
     * @return void
     */
    public function index(Request $request): void
    {
        dd(Jurusan::query()->select('id', 'nama')->get());
    }

    /**
     * Select with criteria.
     *
     * @param  int  $sks
     * @param  int|null  $semester
     * @param  string|null  $arithmetic
     * @return void
     */
    public function criteria(int $sks, int $semester = null, string $arithmetic = null): void
    {
        $query = Matakuliah::query()
        ->where('sks', $sks)
        ->when($semester, fn (Builder $query) => $query->where('semester', $this->arithmetic($arithmetic), $semester));

        dd($query->toSql(), $query->get());
    }

    /**
     * Search for the proper arithmetic operation based on what the client want to use
     *
     * @param  string|null  $arithmetic
     * @return string
     */
    private function arithmetic(string $arithmetic = null): string
    {
        return match ($arithmetic) {
            'gt' => '>',
            'gte' => '>=',
            'lt' => '<',
            'lte' => '<=',
            default => '=',
        };
    }

    /**
     * Search with where like
     *
     * @param  string  $like
     * @param  string|null  $position
     * @return void
     */
    public function like(string $like, string $position = null): void
    {
        $query = Matakuliah::query()
        ->where('nama_mk', 'like', $this->appendPercent('akhir', $position).$like.$this->appendPercent('awal', $position));

        dd($query->toSql(), $query->get());
    }

    /**
     * Append percentage to like
     *
     * @param  string  $location
     * @param  string|null  $position
     * @return string
     */
    private function appendPercent(string $location, string $position = null): string
    {
        return in_array($position, [null, 'both', $location]) ? '%' : '';
    }

    public function order(string $column, string $order = null): void
    {
        $query = Matakuliah::query()
        ->when(
            in_array($order, [null, 'asc']),
            fn (Builder $query) => $query->orderBy($column),
            fn (Builder $query) => $query->orderByDesc($column),
        );

        dd($query->toSql(), $query->get());
    }

    /**
     * Practicing now() query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function now(Request $request): void
    {
        $query = DB::query()->selectRaw('now()');

        dd($query->toSql(), $query->first());
    }

    /**
     * Insert new record to jurusan
     *
     * @return void
     */
    public function insert(): void
    {
        DB::enableQueryLog();

        Jurusan::query()->create([
            'nama' => 'Teknik Informatika',
        ]);

        dd(DB::getQueryLog());
    }

    /**
     * Update manually
     *
     * @param  Request  $request
     * @return void
     */
    public function update(Request $request): void
    {
        DB::enableQueryLog();

        Jurusan::query()->find(1)->update(['nama' => 'Teknik Informatika']);

        Jurusan::query()->where('id', 1)->update(['nama' => 'Teknik Informatika']);

        dd(DB::getQueryLog());
    }

    /**
     * Update record to jurusan
     *
     * @param  Jurusan  $jurusan
     * @return void
     */
    public function bindUpdate(Jurusan $jurusan): void
    {
        DB::enableQueryLog();

        $jurusan->update(['nama' => 'Teknik Informatika']);

        dd(DB::getQueryLog(), $jurusan);
    }

    /**
     * Delete manually
     *
     * @param  Request  $request
     * @return void
     */
    public function delete(Request $request): void
    {
        DB::enableQueryLog();

        Jurusan::query()->find(1)?->delete();

        Jurusan::query()->where('id', 1)->delete();

        dd(DB::getQueryLog());
    }

    /**
     * Delete record from jurusan
     *
     * @param  Jurusan  $jurusan
     * @return void
     */
    public function bindDelete(Jurusan $jurusan): void
    {
        DB::enableQueryLog();

        $jurusan->delete();

        dd(DB::getQueryLog(), $jurusan);
    }
}
