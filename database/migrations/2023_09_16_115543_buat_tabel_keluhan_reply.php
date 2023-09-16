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
        if (!Schema::hasTable('keluhan_reply')) {
            Schema::create('keluhan_reply', function (Blueprint $t) {
                $t->ulid('id_reply')->primary();
                $t->string('id_parent_reply')->nullable();
                $t->string('id_keluhan');
                $t->string('id_pegawai');
                $t->text('isi');
                $t->longText('image');
                $t->timestamps();
            });

            Schema::table('keluhan_reply',function (Blueprint $t){
                $t->foreign('id_parent_reply')->references('id_reply')->on('keluhan_reply');
            });
        }

        if(Schema::hasTable('keluhan'))
        {
            Schema::table('keluhan_reply', function(Blueprint $t){
                $t->foreign('id_keluhan')->references('id_keluhan')->on('keluhan')->cascadeOnDelete()->cascadeOnUpdate();
            });
        }

        if(Schema::hasTable('pegawai'))
        {
            Schema::table('keluhan_reply', function(Blueprint $t){
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
        Schema::table('keluhan_reply',function (Blueprint $t){
            $t->dropForeign('id_parent_reply_keluhan_reply_foreign');
        });

        Schema::dropIfExists('keluhan_reply');
    }
};
