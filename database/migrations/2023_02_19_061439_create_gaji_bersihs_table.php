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
        Schema::create('gaji_bersihs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_karyawan');
            $table->string('nama');
            $table->string('nama_bank');
            $table->string('norek');
            $table->string('namaPem_bank');
            $table->integer('gaji_bersih');
            $table->integer('potongan');
            $table->date('tgl_gaji');
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
        Schema::dropIfExists('gaji_bersihs');
    }
};
