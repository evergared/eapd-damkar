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
        if (!Schema::hasTable('keluhan')) {
            Schema::create('keluhan', function (Blueprint $t) {
                $t->ulid('id_keluhan')->primary();
                $t->unsignedBigInteger('id_kategori');
                $t->string('id_pegawai_pelapor');
                $t->string('id_pegawai_pengirim');
                $t->string('id_pegawai_penerima');
                $t->string('perihal');
                $t->text('isi');
                $t->longText('image');
                $t->string('flag_pelapor',2);
                $t->string('flag_penerima',2);
                $t->timestamps();
            });
        }

        if(Schema::hasTable('pegawai'))
        {
            Schema::table('keluhan', function(Blueprint $t){
                $t->foreign('id_pegawai_pelapor')->references('id_pegawai')->on('pegawai');
                $t->foreign('id_pegawai_pengirim')->references('id_pegawai')->on('pegawai');
                $t->foreign('id_pegawai_penerima')->references('id_pegawai')->on('pegawai');
            });
        }

        if(Schema::hasTable('keluhan_kategori'))
        {
            Schema::table('keluhan', function(Blueprint $t){
                $t->foreign('id_ketegori')->references('id_kategori')->on('keluhan_kategori');
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
        if(Schema::hasTable('keluhan_reply')){
            Schema::table('keluhan_reply',function (Blueprint $t){
                $t->dropForeign('keluhan_reply_id_keluhan_foreign');
            });
        }

        if(Schema::hasTable('keluhan_kategori')){
            Schema::table('keluhan_kategori',function (Blueprint $t){
                $t->dropForeign('keluhan_id_kategori_foreign');
            });
        }

        Schema::dropIfExists('keluhan');

    }
};
