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
        if (!Schema::hasTable('apd_list')) {
            Schema::create('apd_list', function (Blueprint $t) {
                $t->string('id_apd')->primary();
                $t->string('nama_apd');
                $t->string('id_jenis');
                $t->string('merk')->nullable();
                $t->foreignId('id_size')->nullable();
                $t->foreignId('id_kondisi')->nullable();
                $t->text('image')->nullable();
            });
        }
        if(Schema::hasTable('apd_jenis'))
        {
            Schema::table('apd_list', function(Blueprint $t){
                $t->foreign('id_jenis')->references('id_jenis')->on('apd_jenis');
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
        
        Schema::table('apd_list',function (Blueprint $t){
            $t->dropForeign('apd_list_id_jenis_foreign');
        });
        
        if(Schema::hasTable('input_apd')){
            Schema::table('input_apd',function (Blueprint $t){
                $t->dropForeign('input_apd_id_apd_foreign');
            });
        }
        Schema::dropIfExists('apd_list');

    }
};
