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
        if (!Schema::hasTable('admin_list')) {
            Schema::create('admin_list', function (Blueprint $t) {
                $t->string('id_admin')->primary();
                $t->string('nama_akun');
                $t->foreignUlid('id_pegawai')->nullable();
                $t->foreignUlid('id_pegawai_plt')->nullable();
                $t->string('id_penempatan')->nullable();
            });
        }

        if(Schema::hasTable('pegawai'))
        {
            Schema::table('admin_list', function(Blueprint $t){
                $t->foreign('id_pegawai')->references('id_pegawai')->on('pegawai')->nullOnDelete();
                $t->foreign('id_pegawai_plt')->references('id_pegawai')->on('pegawai')->nullOnDelete();
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
        if(Schema::hasTable('admin')){
            Schema::table('admin',function (Blueprint $t){
                $t->dropForeign('admin_id_admin_foreign');
            });
        }
          
        Schema::dropIfExists('admin_list');
    }
};
