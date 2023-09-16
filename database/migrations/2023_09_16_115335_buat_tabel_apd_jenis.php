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
        if (!Schema::hasTable('apd_jenis')) {
            Schema::create('apd_jenis', function (Blueprint $t) {
                $t->string('id_jenis')->primary();
                $t->string('nama_jenis');
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
        if(Schema::hasTable('apd_list')){
            Schema::table('apd_list',function (Blueprint $t){
                $t->dropForeign('apd_list_id_jenis_foreign');
            });
        }
        if(Schema::hasTable('input_apd')){
            Schema::table('input_apd',function (Blueprint $t){
                $t->dropForeign('input_apd_id_jenis_foreign');
            });
        }
        Schema::dropIfExists('apd_jenis');
    }
};
