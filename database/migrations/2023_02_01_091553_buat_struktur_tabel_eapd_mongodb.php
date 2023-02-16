<?php

use Illuminate\Database\Migrations\Migration;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
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
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }


        if (!Schema::hasTable('pegawai')) {
            Schema::create('pegawai', function (Blueprint $t) {
                $t->string('nrk', 10)->unique()->nullable()->comment('no pjlp');
                $t->string('nip', 20)->unique()->nullable()->comment('nik pjlp');
                $t->text('nama');
                $t->text('profile_img')->nullable();
                $t->string('no_telp', 20)->nullable();
                $t->text('email')->nullable();
                $t->index('id_jabatan')->nullable();
                $t->index('id_wilayah')->nullable();
                $t->index('id_penempatan')->nullable();
                $t->index('id_grup');
                $t->boolean('aktif')->default(true);
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('penempatan')) {
            Schema::create('penempatan', function (Blueprint $t) {
                $t->text('nama_penempatan');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('grup')) {
            Schema::create('grup', function (Blueprint $t) {
                $t->string('id_grup')->primary();
                $t->text('nama_grup');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('jabatan')) {
            Schema::create('jabatan', function (Blueprint $t) {
                $t->id();
                $t->text('nama_jabatan');
                $t->text('tipe_jabatan');
                $t->text('level_user');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('wilayah')) {
            Schema::create('wilayah', function (Blueprint $t) {
                $t->text('nama_wilayah');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('kecamatan')) {
            Schema::create('kecamatan', function (Blueprint $t) {
                $t->text('nama_kecamatan');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('kelurahan')) {
            Schema::create('kelurahan', function (Blueprint $t) {
                $t->text('nama_kelurahan');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }


        if (!Schema::hasTable('apd_list')) {
            Schema::create('apd_list', function (Blueprint $t) {
                $t->text('nama_apd');
                $t->text('merk');
                $t->index('id_jenis')->nullable();
                $t->index('id_size')->nullable()->comment('apa list ukurannya');
                $t->index('id_kondisi')->nullable()->comment('apa list kondisinya');
                $t->longText('image')->nullable();
                $t->boolean('ingub')->default(false);
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('apd_jenis')) {
            Schema::create('apd_jenis', function (Blueprint $t) {
                $t->text('nama_jenis');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('apd_size')) {
            Schema::create('apd_size', function (Blueprint $t) {
                $t->text('nama_size');
                $t->longText('opsi')->default(new Expression('(JSON_ARRAY())'))->comment('json');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('apd_kondisi')) {
            Schema::create('apd_kondisi', function (Blueprint $t) {
                $t->text('nama_kondisi');
                $t->json('opsi')->comment('json');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('input_apd')) {
            Schema::create('input_apd', function (Blueprint $t) {
                $t->index('id_pegawai');
                $t->index('id_jenis');
                $t->index('id_apd')->nullable();
                $t->text('size')->nullable();
                $t->text('keberadaan')->nullable();
                $t->text('kondisi')->nullable();
                $t->longText('image')->nullable();
                $t->text('komentar_pengupload')->nullable();
                $t->text('keterangan')->nullable();
                $t->timestamps();
                $t->index('id_periode')->nullable();
                $t->text('verifikasi_oleh')->nullable();
                $t->string('verifikasi_status', 2)->nullable();
                $t->text('komentar_verifikator')->nullable();
            });
        }

        if (!Schema::hasTable('input_apd_ongoing')) {
            Schema::create('input_apd_ongoing', function (Blueprint $t) {
                $t->index('id_input_apd');
                $t->longText('cache')->comment('json value dari input');
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('periode_input_apd')) {
            Schema::create('periode_input_apd', function (Blueprint $t) {
                $t->text('nama_periode');
                $t->date('tgl_awal')->nullable();
                $t->date('tgl_akhir')->nullable();
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('input_apd_template')) {
            Schema::create('input_apd_template', function (Blueprint $t) {
                $t->text('nama')->nullable()->default('Template EAPD')->comment('nama dari template');
                $t->longText('template')->comment('json');
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('input_sewaktu_waktu')) {
            Schema::create('input_sewaktu_waktu', function (Blueprint $t) {
                $t->index('id_pegawai');
                $t->index('id_apd')->nullable();
                $t->text('size')->nullable();
                $t->text('status_barang')->nullable();
                $t->text('kondisi')->nullable();
                $t->longText('image')->nullable();
                $t->smallInteger('kebutuhan')->nullable()->default(0);
                $t->text('keterangan')->nullable();
                $t->timestamps();
                $t->text('verified_by')->nullable();
            });
        }

        if (!Schema::hasTable('input_sewaktu_waktu_ongoing')) {
            Schema::create('input_sewaktu_waktu_ongoing', function (Blueprint $t) {
                $t->string('id_input_sewaktu_waktu')->primary();
                $t->longText('cache')->comment('json value dari input');
                $t->timestamps();
            });
        }

        // pivot table

        if (!Schema::hasTable('pivot_input_apd_template')) {
            Schema::create('pivot_input_apd_template', function (Blueprint $t) {
                $t->index('jabatan_id')->nullable();
                $t->index('input_apd_template_id')->nullable();
                $t->index('periode_input_apd_id')->nullable();
            });
        }



        // tabel history untuk menunjukan perubahan data ke admin tingkat atas

        if(!Schema::hasTable('history_tabel_pegawai')){
            Schema::create('history_tabel_pegawai',function(Blueprint $t){
                $t->string('id_pegawai')->primary();
                $t->longText('sebelumnya')->nullable();
                $t->longText('perubahan')->nullable();
                $t->text('keterangan_perubahan')->nullable();
                $t->string('id_pengubah')->nullable();
                $t->boolean('dilihat_admin_sektor')->default(false);
                $t->boolean('dilihat_admin_sudin')->default(false);
                $t->boolean('dilihat_admin_dinas')->default(false);
                $t->timestamps();
                $t->comment('tabel agar admin tingkat atas tau jika ada perubahan data pegawai');
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
        Schema::dropIfExists('pegawai');
        Schema::dropIfExists('grup');
        Schema::dropIfExists('jabatan');
        Schema::dropIfExists('wilayah');
        Schema::dropIfExists('penempatan');
        Schema::dropIfExists('apd_list');
        Schema::dropIfExists('apd_jenis');
        Schema::dropIfExists('apd_size');
        Schema::dropIfExists('apd_kondisi');
        Schema::dropIfExists('input_apd');
        Schema::dropIfExists('input_apd_ongoing');
        Schema::dropIfExists('periode_input_apd');
        Schema::dropIfExists('input_apd_template');
        Schema::dropIfExists('input_sewaktu_waktu');
        Schema::dropIfExists('input_sewaktu_waktu_ongoing');

        Schema::dropIfExists('pivot_input_apd_template');

    }
};
