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
        if (!Schema::hasTable('input_apd_reupload')) {
            Schema::create('input_apd_reupload', function (Blueprint $t) {
                $t->string('id_inputan');
                $t->string('id_apd')->nullable();
                $t->string('size')->nullable();
                $t->string('kondisi')->nullable();
                $t->longText('image')->nullable();
                $t->text('komentar_pengupload')->nullable();
                $t->string('data_diupdate')->nullable();
            });
        }

        if(Schema::hasTable('input_apd'))
        {
            Schema::table('input_apd_reupload', function(Blueprint $t){
                $t->foreign('id_inputan')->references('id_inputan')->on('input_apd');
            });
        }

        if(Schema::hasTable('apd_list'))
        {
            Schema::table('input_apd_reupload', function(Blueprint $t){
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
        if(Schema::hasTable('input_apd')){
            Schema::table('input_apd_reupload',function (Blueprint $t){
                $t->dropForeign('input_apd_reupload_id_inputan_foreign');
            });
        }

        if(Schema::hasTable('apd_list')){
            Schema::table('input_apd_reupload',function (Blueprint $t){
                $t->dropForeign('input_apd_reupload_id_apd_foreign');
            });
        }

        Schema::dropIfExists('input_apd_reupload');
    }
};
