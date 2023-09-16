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
        if (!Schema::hasTable('apd_kondisi')) {
            Schema::create('apd_kondisi', function (Blueprint $t) {
                $t->id('id_kondisi')->autoIncrement();
                $t->string('nama_kondisi');
                $t->longText('opsi')->comment('json untuk opsi dropdown');
            });
        }
        if(Schema::hasTable('apd_list'))
        {
            Schema::table('apd_list', function(Blueprint $t){
                $t->foreign('id_kondisi')->references('id_kondisi')->on('apd_kondisi');
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
        Schema::dropIfExists('apd_kondisi');
    }
};
