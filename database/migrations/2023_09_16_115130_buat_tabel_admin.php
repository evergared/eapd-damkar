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
                $table->string('id')->primary()->comment('id untuk login');
                $table->string('nama_akun');
                $table->foreignUlid('id_pegawai')->nullable();
                $table->foreignUlid('id_pegawai_plt')->nullable();
                $table->string('id_penempatan')->nullable();
                $table->string('tipe')->nullable();
                $table->string('password');
                $table->rememberToken()->nullable();
            });
        }

        if (Schema::hasTable('pegawai')) {
            Schema::table('admin', function (Blueprint $t) {
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
        if (Schema::hasTable('penempatan')) {
            Schema::table('admin', function (Blueprint $t) {
                $t->dropForeign('admin_id_penempatan_foreign');
            });
        }
        if (Schema::hasTable('pegawai')) {
            Schema::table('admin', function (Blueprint $t) {
                $t->dropForeign('admin_id_pegawai_foreign');
                $t->dropForeign('admin_id_pegawai_plt_foreign');
            });
        }
        Schema::dropIfExists('admin');
    }
};
