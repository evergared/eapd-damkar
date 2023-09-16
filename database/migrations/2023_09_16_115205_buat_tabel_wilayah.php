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
        if (!Schema::hasTable('wilayah')) {
            Schema::create('wilayah', function (Blueprint $t) {
                $t->string('id_wilayah')->primary();
                $t->string('nama_wilayah');
                $t->text('keterangan')->nullable();
            });
        }

        if(Schema::hasTable('penempatan'))
        {
            Schema::table('penempatan', function(Blueprint $t){
                $t->foreign('id_wilayah')->references('id_wilayah')->on('wilayah')->nullOnDelete();
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
        Schema::dropIfExists('wilayah');
    }
};
