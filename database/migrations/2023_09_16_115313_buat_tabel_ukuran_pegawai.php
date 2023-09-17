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
        if (!Schema::hasTable('ukuran_pegawai')) {
            Schema::create('ukuran_pegawai', function (Blueprint $t) {
                $t->foreignUlid('id_pegawai');
                $t->foreignUlid('id_template');
                $t->longText('list_ukuran')->comment('berupa json');
            });
        }

        if(Schema::hasTable('pegawai'))
        {
            Schema::table('ukuran_pegawai', function(Blueprint $t){
                $t->foreign('id_pegawai')->references('id_pegawai')->on('pegawai')->cascadeOnDelete()->cascadeOnUpdate();
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
        
        Schema::table('ukuran_pegawai',function (Blueprint $t){
            $t->dropForeign('ukuran_pegawai_id_pegawai_foreign');
        });
        Schema::dropIfExists('ukuran_pegawai');
    }
};
