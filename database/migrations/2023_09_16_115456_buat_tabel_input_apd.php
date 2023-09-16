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
        if (!Schema::hasTable('input_apd')) {
            Schema::create('input_apd', function (Blueprint $t) {
                $t->ulid('id_inputan');
                $t->string('id_pegawai');
                $t->unsignedBigInteger('id_periode');
                $t->string('id_jenis');
                $t->string('id_apd');
                $t->string('size');
                $t->string('kondisi');
                $t->longText('image');
                $t->text('komentar_pengupload');
                $t->string('data_diupdate');
                $t->text('verifikasi_oleh');
                $t->text('jabatan_verifikator');
                $t->text('komentar_verifikator');
                $t->string('verifikasi_status');
            });
        }

        if(Schema::hasTable('pegawai'))
        {
            Schema::table('input_apd', function(Blueprint $t){
                $t->foreign('id_pegawai')->references('id_pegawai')->on('pegawai');
            });
        }

        if(Schema::hasTable('periode_input_apd'))
        {
            Schema::table('input_apd', function(Blueprint $t){
                $t->foreign('id_periode')->references('id_periode')->on('periode_input_apd');
            });
        }

        if(Schema::hasTable('apd_jenis'))
        {
            Schema::table('input_apd', function(Blueprint $t){
                $t->foreign('id_jenis')->references('id_jenis')->on('apd_jenis');
            });
        }

        if(Schema::hasTable('apd_list'))
        {
            Schema::table('input_apd', function(Blueprint $t){
                $t->foreign('id_apd')->references('id_apd')->on('apd_list');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('input_apd');
    }
};
