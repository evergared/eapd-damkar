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
        if (!Schema::hasTable('keluhan_kategori')) {
            Schema::create('keluhan_kategori', function (Blueprint $t) {
                $t->id('id_kategori');
                $t->text('nama_kategori');
                $t->text('keterangan');
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
        Schema::dropIfExists('keluhan_kategori');
    }
};
