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
        if (!Schema::hasTable('pegawai')) {
            Schema::create('pegawai', function (Blueprint $t) {
                $t->ulid('id_pegawai')->primary();
                $t->string('nrk', 10)->unique()->nullable()->comment('no pjlp');
                $t->string('nip', 20)->unique()->nullable()->comment('nik pjlp');
                $t->text('nama');
                $t->text('profile_img')->nullable();
                $t->string('no_telp', 20)->nullable();
                $t->text('email')->nullable();
                $t->string('id_jabatan')->nullable();
                $t->string('id_penempatan')->nullable();
                $t->string('grup')->nullable();
                // $t->string('id_atasan')->nullable()->comment('id dari atasan langsung pegawai ini');
                $t->boolean('aktif')->default(true);
                $t->timestamps();
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
        if(Schema::hasTable('user')){
            Schema::table('user',function (Blueprint $t){
                $t->dropForeign('user_id_pegawai_foreign');
            });
        }

        if (Schema::hasTable('admin_list')) {
            Schema::table('admin_list', function (Blueprint $t) {

                $t->dropForeign('admin_list_id_pegawai_foreign');
                $t->dropForeign('admin_list_id_pegawai_plt_foreign');
            });
        }

        if(Schema::hasTable('jabatan')){
            Schema::table('pegawai',function (Blueprint $t){
                $t->dropForeign('pegawai_id_jabatan_foreign');
            });
        }

        if(Schema::hasTable('input_apd')){
            Schema::table('input_apd',function (Blueprint $t){
                $t->dropForeign('input_apd_id_pegawai_foreign');
            });
        }

        if (Schema::hasTable('keluhan')) {
            Schema::table('keluhan', function (Blueprint $t) {

                $t->dropForeign('keluhan_id_pegawai_pelapor_foreign');
                $t->dropForeign('keluhan_id_pegawai_pengirim_foreign');
                $t->dropForeign('keluhan_id_pegawai_penerima_foreign');
            });
        }

        if(Schema::hasTable('keluhan_reply')){
            Schema::table('keluhan_reply',function (Blueprint $t){
                $t->dropForeign('keluhan_reply_id_pegawai_foreign');
            });
        }

        if(Schema::hasTable('ukuran_pegawai')){
            Schema::table('ukuran_pegawai',function (Blueprint $t){
                $t->dropForeign('ukuran_pegawai_id_pegawai_foreign');
            });
        }
        Schema::dropIfExists('pegawai');
    }
};
