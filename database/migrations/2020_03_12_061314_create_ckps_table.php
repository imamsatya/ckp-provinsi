<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCkpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ckps', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kegiatan');
            $table->string('uraian_kegiatan');
            $table->string('satuan');
            $table->string('target_kuantitas');
            $table->string('realisasi')->nullable();
            $table->double('kualitas')->nullable();
            $table->string('kode_butir_kegiatan')->nullable();
            $table->string('angka_kredit')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('bulan')->nullable();
            $table->timestamps();
        });

        Schema::table('ckps', function (Blueprint $table){
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ckps');
    }
}
