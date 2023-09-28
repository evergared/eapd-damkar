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
        if (!Schema::hasTable('periode_input_apd')) {
            Schema::create('periode_input_apd', function (Blueprint $t) {
                $t->id('id_periode')->autoIncrement();
                $t->string('nama_periode');
                $t->date('tgl_awal')->nullable();
                $t->date('tgl_akhir')->nullable();
                $t->boolean('aktif')->default(false);
                $t->text('pesan_berjalan')->nullable();
                $t->text('keterangan')->nullable();
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
        if(Schema::hasTable('input_apd')){
            Schema::table('input_apd',function (Blueprint $t){
                $t->dropForeign('input_apd_id_periode_foreign');
            });
        }
        if(Schema::hasTable('input_apd_template')){
            Schema::table('input_apd_template',function (Blueprint $t){
                $t->dropForeign('input_apd_template_id_periode_foreign');
            });
        }
        Schema::dropIfExists('periode_input_apd');

    }
};
