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
        if (!Schema::hasTable('apd_size')) {
            Schema::create('apd_size', function (Blueprint $t) {
                $t->id('id_size')->autoIncrement();
                $t->string('nama_size');
                $t->longText('opsi')->comment('json untuk opsi dropdown');
            });
        }
        if(Schema::hasTable('apd_list'))
        {
            Schema::table('apd_list', function(Blueprint $t){
                $t->foreign('id_size')->references('id_size')->on('apd_size');
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
        Schema::dropIfExists('apd_size');
    }
};
