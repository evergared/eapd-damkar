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
        if (!Schema::hasTable('apd_no_seri')) {
            Schema::create('apd_no_seri', function (Blueprint $t) {
                $t->string('id_apd')->primary();
                $t->longText('list_no_seri')->nullable();
            });
        }

        if(Schema::hasTable('apd_list'))
        {
            Schema::table('apd_no_seri', function(Blueprint $t){
                $t->foreign('id_apd')->references('id_apd')->on('apd_list');
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
        Schema::table('apd_no_seri',function (Blueprint $t){
            $t->dropForeign('apd_no_seri_id_apd_foreign');
        });

        Schema::dropDatabaseIfExists('apd_no_seri');
    }
};
