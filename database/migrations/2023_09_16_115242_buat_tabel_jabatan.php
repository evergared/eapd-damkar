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
        if (!Schema::hasTable('jabatan')) {
            Schema::create('jabatan', function (Blueprint $t) {
                $t->string('id_jabatan')->primary();
                $t->string('nama_jabatan');
                $t->text('keterangan')->nullable();
            });
        }

        if(Schema::hasTable('pegawai'))
        {
            Schema::table('pegawai', function(Blueprint $t){
                $t->foreign('id_jabatan')->references('id_jabatan')->on('jabatan');
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
        if(Schema::hasTable('pegawai')){
            Schema::table('pegawai',function (Blueprint $t){
                $t->dropForeign('pegawai_id_jabatan_foreign');
            });
        }
        Schema::dropIfExists('jabatan');
    }
};
