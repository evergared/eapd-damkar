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
        if (!Schema::hasTable('admin')) {
            Schema::create('admin', function (Blueprint $table) {
                $table->string('id_admin')->primary();
                $table->string('password');
                $table->rememberToken()->nullable();
            });
        }

        if(Schema::hasTable('admin_list'))
        {
            Schema::table('admin', function(Blueprint $t){
                $t->foreign('id_admin')->references('id_admin')->on('admin_list');
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
        Schema::dropIfExists('admin');
    }
};
