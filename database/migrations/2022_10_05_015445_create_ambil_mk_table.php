<?php

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambil_mk', function (Blueprint $table) {
            $table->string('nim', 12);

            $table->foreign('nim')
            ->references((new Mahasiswa)->getKeyName())
            ->on((new Mahasiswa)->getTable())
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table->string('kode_mk', 6);

            $table->foreign('kode_mk')
            ->references((new Matakuliah)->getKeyName())
            ->on((new Matakuliah)->getTable())
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ambil_mk');
    }
};
