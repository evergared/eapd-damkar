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
        if (!Schema::hasTable('input_apd_template')) {
            Schema::create('input_apd_template', function (Blueprint $t) {
                $t->string('id_template')->primary();
                $t->string('id_jabatan');
                $t->unsignedBigInteger('id_periode');
                $t->text('nama')->nullable();
                $t->longText('template')->comment('json untuk apa saja jenis apd yang harus diinput beserta pilihan apdnya')->nullable();
            });
        }

        if(Schema::hasTable('ukuran_pegawai'))
        {
            Schema::table('ukuran_pegawai', function(Blueprint $t){
                $t->foreign('id_template')->references('id_template')->on('input_apd_template');
            });
        }

        if(Schema::hasTable('jabatan'))
        {
            Schema::table('input_apd_template', function(Blueprint $t){
                $t->foreign('id_jabatan')->references('id_jabatan')->on('jabatan');
            });
        }

        if(Schema::hasTable('periode_input_apd'))
        {
            Schema::table('input_apd_template', function(Blueprint $t){
                $t->foreign('id_periode')->references('id_periode')->on('periode_input_apd');
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
        Schema::dropIfExists('input_apd_template');
    }
};
