<?php

use App\Http\Controllers\LatihanController;
use App\Http\Controllers\Modul1Controller;
use App\Http\Controllers\Modul2Controller;
use App\Http\Controllers\Modul3Controller;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('modul')->name('modul.')->group(function () {
    Route::get('/1', Modul1Controller::class)->name('1');

    // modul 2
    Route::prefix('2')->name('2.')->controller(Modul2Controller::class)->group(function () {
        // select all
        Route::get('/', 'index')->name('index');

        // sks & semester criteria
        Route::prefix('sks/{sks}')->name('criteria.')->group(function () {
            Route::get('/', 'criteria')->name('sks')->where('sks', '[0-9]+');
            Route::get('/semester/{semester}/{arithmetic?}', 'criteria')
            ->name('semester')
            ->where([
                'sks' => '[0-9+]',
                'semester' => '[0-9]+',
                'arithmetic' => 'gt|gte|lt|lte',
            ]);
        });

        // now
        Route::get('/now', 'now')->name('now');

        // like
        Route::get('like/{like}/{position?}', 'like')->where('position', 'awal|akhir|both')->name('like');

        // order
        Route::get('order/{column}/{order?}', 'order')->name('order')
        ->where([
            'column' => implode('|', (new Matakuliah)->getFillable()),
            'order' => 'asc|desc',
        ]);

        // insert
        Route::get('/insert', 'insert')->name('insert');

        // update (note: untuk update, yang benar seharusnya Route::put atau Route::patch, di bawah for education purpose only. Jangan diterapkan di live!)
        Route::prefix('update')->name('update.')->group(function () {
            Route::get('/', 'update')->name('normal');
            Route::get('/{jurusan}', 'bindUpdate')->name('bind');
        });
        // Route::put('{jurusan}', 'update')->name('update');

        // delete (note: untuk update, yang benar seharusnya Route::delete, di bawah for education purpose only. Jangan diterapkan di live!)
        Route::prefix('delete')->name('delete.')->group(function () {
            Route::get('/', 'delete')->name('normal');
            Route::get('/{jurusan}', 'bindDelete')->name('bind'); // lebih mudah ini langsung detect id nya secara otomatis, tanpa buat query manual
        });
        // Route::delete('/{jurusan}', 'destroy')->name('destroy');
    });
    // end modul 2

    // modul 3
    Route::prefix('3')->name('3.')->controller(Modul3Controller::class)->group(function () {
        Route::get('distinct', 'distinct')->name('distinct');
        Route::get('count', 'count')->name('count');
        Route::get('sum', 'sum')->name('sum');
        Route::get('average', 'average')->name('average');
        Route::get('min', 'min')->name('min');
        Route::get('max', 'max')->name('max');

        Route::get('group/{semester?}', 'group')->name('group')->where('semester', '[0-9]+');
    });
    // end modul 3

    // even proper: -- pakai ini ya tapi langsung nyambung sama model. Misal JurusanController. Cara buat: php artisan make:model Jurusan -a / php artisan make:controller JurusanController -rR
    // Route::resource(Modul2Controller::class);
});

Route::get('latihan', LatihanController::class);
