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
        if (!Schema::hasTable('periode_ukuran')) {
            Schema::create('periode_ukuran', function (Blueprint $t) {
                $t->id()->autoIncrement();
                $t->string('nama')->default('periode input ukuran');
                $t->date('tgl_awal');
                $t->date('tgl_akhir');
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
        Schema::dropIfExists('periode_ukuran');
    }
};
