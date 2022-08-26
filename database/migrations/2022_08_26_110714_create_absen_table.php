<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen', function (Blueprint $table) {
            $table->id();
            $table->integer('jadwal_id');
            $table->integer('guru_id')->nullable();
            $table->integer('siswa_id')->nullable();
            $table->string('parent')->nullable();
            $table->string('status')->nullable();
            $table->string('pertemuan');
            $table->string('rangkuman')->nullable();
            $table->string('berita_acara')->nullable();
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
        Schema::dropIfExists('absen');
    }
}
