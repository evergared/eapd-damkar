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
        if (!Schema::hasTable('kelurahan')) {
            Schema::create('kelurahan', function (Blueprint $t) {
                $t->string('id_kelurahan')->primary();
                $t->string('nama_kelurahan');
                $t->text('keterangan')->nullable();
            });
        }

        if(Schema::hasTable('penempatan'))
        {
            Schema::table('penempatan', function(Blueprint $t){
                $t->foreign('id_kelurahan')->references('id_kelurahan')->on('kelurahan')->nullOnDelete();
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
        Schema::table('penempatan',function (Blueprint $t){
            $t->dropForeign('penempatan_id_kelurahan_foreign');
        });
        Schema::dropIfExists('kelurahan');
    }
};
