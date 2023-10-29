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
        if (!Schema::hasTable('user')) {
            Schema::create('user', function (Blueprint $table) {
                $table->foreignUlid('id_pegawai')->primary();
                $table->string('password');
                $table->rememberToken()->nullable();
                $table->softDeletes();
            });
        }

        if(Schema::hasTable('pegawai'))
        {
            Schema::table('user', function(Blueprint $t){
                $t->foreign('id_pegawai')->references('id_pegawai')->on('pegawai');
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
        Schema::dropIfExists('user');
    }
};
