<?php

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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_karyawan');
            $table->string('nama');
            $table->string('bagian');
            $table->string('jabatan');
            $table->string('status_karyawan');
            $table->string('status_ptkp');
            $table->date('tgl_bergabung');
            $table->integer('gaji_pokok');
            $table->string('nama_bank');
            $table->string('norek');
            $table->string('namaPem_bank');
            $table->string('status_ttd')->default('belum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
};
