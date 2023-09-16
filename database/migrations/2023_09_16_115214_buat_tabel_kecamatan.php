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
        if (!Schema::hasTable('kecamatan')) {
            Schema::create('kecamatan', function (Blueprint $t) {
                $t->string('id_kecamatan')->primary();
                $t->string('nama_kecamatan');
                $t->text('keterangan')->nullable();
            });
        }

        if(Schema::hasTable('penempatan'))
        {
            Schema::table('penempatan', function(Blueprint $t){
                $t->foreign('id_kecamatan')->references('id_kecamatan')->on('kecamatan')->nullOnDelete();
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
        Schema::dropIfExists('kecamatan');
    }
};
