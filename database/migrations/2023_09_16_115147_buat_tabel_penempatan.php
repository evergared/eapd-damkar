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

        if(Schema::hasTable('admin_list'))
        {
            Schema::table('admin_list', function(Blueprint $t){
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
        Schema::table('pegawai', function(Blueprint $t){
            $t->dropForeign('pegawai_id_penempatan_foreign');
        });
        Schema::table('admin_list', function(Blueprint $t){
            $t->dropForeign('admin_list_id_penempatan_foreign');
        });
        Schema::dropIfExists('penempatan');
    }
};
