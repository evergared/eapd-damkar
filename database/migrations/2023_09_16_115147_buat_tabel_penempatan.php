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
        if (!Schema::hasTable('penempatan')) {
            Schema::create('penempatan', function (Blueprint $t) {
                $t->string('id_penempatan')->primary();
                $t->string('nama_penempatan')->nullable();
                $t->string('id_wilayah')->nullable();
                $t->string('id_kecamatan')->nullable();
                $t->string('id_kelurahan')->nullable();
                $t->string('tipe')->nullable();
                $t->text('keterangan')->nullable();
            });
        }

        if(Schema::hasTable('pegawai'))
        {
            Schema::table('pegawai', function(Blueprint $t){
                $t->foreign('id_penempatan')->references('id_penempatan')->on('penempatan')->nullOnDelete();
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
        if(Schema::hasTable('wilayah')){
            Schema::table('penempatan',function (Blueprint $t){
                $t->dropForeign('penempatan_id_wilayah_foreign');
            });
        }
        if(Schema::hasTable('kecamatan')){
            Schema::table('penempatan',function (Blueprint $t){
                $t->dropForeign('penempatan_id_kecamatan_foreign');
            });
        }   
        if(Schema::hasTable('kelurahan')){
            Schema::table('penempatan',function (Blueprint $t){
                $t->dropForeign('penempatan_id_kelurahan_foreign');
            });
        }      
        Schema::dropIfExists('penempatan');
    }
};
