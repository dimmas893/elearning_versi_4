<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->integer('jadwal_id');
            $table->integer('guru_id');
            $table->integer('mata_pelajaran_id');
            $table->integer('siswa_id');
            $table->string('parent')->nullable();
            $table->string('judul')->nullable();
            $table->string('type');
            $table->string('file_or_link');
            $table->string('pertemuan')->nullable();
            $table->string('description')->nullable();
            $table->string('pengumpulan');
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
        Schema::dropIfExists('tugas');
    }
}
