<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MahasiswaMatakuliah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa_matakuliah', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('mahasiswa_id')->constrained("mahasiswa", "nim");
            $table->string('mahasiswa_id', 10);
            $table->foreign('mahasiswa_id')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->unsignedBigInteger('matakuliah_id');
            $table->foreign('matakuliah_id')->references('id')->on('matakuliah')->onDelete('cascade');
            $table->string('nilai', 2);
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
        Schema::dropIfExists('mahasiswa_matakuliah');
    }
}
