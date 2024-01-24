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
                $t->ulid('id_inputan')->primary();
                $t->string('id_pegawai');
                $t->unsignedBigInteger('id_periode');
                $t->string('id_jenis')->nullable();
                $t->smallInteger('index_duplikat')->nullable()->comment('Pada template, jika jenis apd ada lebih dr satu; gunakan ini sbg workaround identifikasi');
                $t->string('id_apd')->nullable();
                $t->string('size')->nullable();
                $t->string('kondisi')->nullable();
                $t->string('no_seri')->nullable();
                $t->longText('image')->nullable();
                $t->text('komentar_pengupload')->nullable();
                $t->string('data_diupdate')->nullable();
                $t->string('verifikasi_diupdate')->nullable();
                $t->text('verifikasi_oleh')->nullable();
                $t->text('jabatan_verifikator')->nullable();
                $t->text('komentar_verifikator')->nullable();
                $t->string('verifikasi_status')->nullable();
                $t->string('keterangan_jenis_apd_template')->nullable()->comment('jika duplikat, gunakan ini untuk dapat nama jenis dan merk apd di detail progress');
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
