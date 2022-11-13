<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\Constraint\Constraint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /**
         * Daftar isi : 
         * - user
         * - pegawai
         * - penempatan
         * - grup
         * - jabatan
         * - wilayah
         * - apd_list
         * - apd_jenis
         * - apd_size
         * - apd_kondisi
         * - input_apd
         * - input_apd_ongoing
         * - periode_input_apd
         * - input_apd_template
         * - input_sewaktu_waktu
         * - input_sewaktu_waktu_ongoing
         * 
         * - pembuatan foreign keys
         */

        if (!Schema::hasTable('user')) {
            Schema::create('user', function (Blueprint $table) {
                $table->id();
                $table->string('nrk', 10);
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }


        if (!Schema::hasTable('pegawai')) {
            Schema::create('pegawai', function (Blueprint $t) {
                $t->id('id')->comment('dari laravel, dibutuhkan untuk serialization');
                $t->string('nrk', 10)->unique()->comment('no pjlp');
                $t->string('nip', 20)->unique()->nullable()->comment('nik pjlp');
                $t->text('nama');
                $t->text('profile_img')->nullable();
                $t->string('no_telp', 20)->nullable();
                $t->text('email')->nullable();
                $t->string('id_jabatan', 6)->nullable();
                $t->string('id_wilayah', 3)->nullable();
                $t->string('id_penempatan', 12)->nullable();
                $t->string('id_grup', 2);
                $t->boolean('aktif')->default(true);
                $t->text('plt')->nullable();
                $t->integer('kurang', 2)->autoIncrement(false)->nullable()->default(0)->comment('berapa apd yang belum diinput');
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('penempatan')) {
            Schema::create('penempatan', function (Blueprint $t) {
                $t->id()->comment('dari laravel, dibutuhkan untuk serialization');
                $t->string('id_penempatan', 12)->unique();
                $t->text('nama_penempatan');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('grup')) {
            Schema::create('grup', function (Blueprint $t) {
                $t->id()->comment('dari laravel, dibutuhkan untuk serialization');
                $t->string('id_grup', 2)->unique();
                $t->text('nama_grup');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('jabatan')) {
            Schema::create('jabatan', function (Blueprint $t) {
                $t->id()->comment('dari laravel, dibutuhkan untuk serialization');
                $t->string('id_jabatan', 6)->unique();
                $t->text('nama_jabatan');
                $t->text('tipe_jabatan');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('wilayah')) {
            Schema::create('wilayah', function (Blueprint $t) {
                $t->id()->comment('dari laravel, dibutuhkan untuk serialization');
                $t->string('id_wilayah', 3)->unique();
                $t->text('nama_wilayah');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }


        if (!Schema::hasTable('apd_list')) {
            Schema::create('apd_list', function (Blueprint $t) {
                $t->id()->comment('dari laravel, dibutuhkan untuk serialization');
                $t->string('id_apd', 10)->unique();
                $t->text('nama_apd');
                $t->text('merk');
                $t->string('id_jenis', 6)->nullable();
                $t->foreignId('id_size')->nullable()->comment('apa list ukurannya');
                $t->foreignId('id_kondisi')->nullable()->comment('apa list kondisinya');
                $t->longText('image')->nullable();
                $t->boolean('ingub')->default(false);
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('apd_jenis')) {
            Schema::create('apd_jenis', function (Blueprint $t) {
                $t->id()->comment('dari laravel, dibutuhkan untuk serialization');
                $t->string('id_jenis', 6)->unique();
                $t->text('nama_jenis');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('apd_size')) {
            Schema::create('apd_size', function (Blueprint $t) {
                $t->id()->comment('dari laravel, dibutuhkan untuk serialization');
                $t->text('nama_size');
                $t->longText('opsi')->default(new Expression('(JSON_ARRAY())'))->comment('json');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('apd_kondisi')) {
            Schema::create('apd_kondisi', function (Blueprint $t) {
                $t->id()->comment('dari laravel, dibutuhkan untuk serialization');
                $t->text('nama_kondisi');
                $t->json('opsi')->comment('json');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('input_apd')) {
            Schema::create('input_apd', function (Blueprint $t) {

                // butuh tabel baru verified tipe boolean ? atau pakai enum ?

                $t->uuid('id')->primary()->comment('dari laravel, dibutuhkan untuk serialization');
                $t->string('nrk', 10);
                $t->string('id_apd', 10)->nullable();
                $t->text('size')->nullable();
                $t->text('status_barang')->nullable();
                $t->text('kondisi')->nullable();
                $t->longText('image')->nullable();
                $t->text('keterangan')->nullable();
                $t->timestamps();
                $t->foreignId('id_periode', 8)->nullable();
                $t->text('verified_by')->nullable();
            });
        }

        if (!Schema::hasTable('input_apd_ongoing')) {
            Schema::create('input_apd_ongoing', function (Blueprint $t) {
                $t->foreignUuid('id_input_apd')->nullable();
                $t->longText('cache')->comment('json value dari input');
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('periode_input_apd')) {
            Schema::create('periode_input_apd', function (Blueprint $t) {
                $t->id('id', 8);
                $t->text('nama_periode');
                $t->date('tgl_awal')->nullable();
                $t->date('tgl_akhir')->nullable();
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('input_apd_template')) {
            Schema::create('input_apd_template', function (Blueprint $t) {
                // mungkin tabel ini tidak dibutuhkan
                $t->uuid('id', 8)->comment('dari laravel, dibutuhkan untuk serialization');
                $t->text('tipe_jabatan');
                $t->string('id_apd', 10)->nullable();
                $t->foreignId('id_periode', 8)->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('input_sewaktu_waktu')) {
            Schema::create('input_sewaktu_waktu', function (Blueprint $t) {
                $t->uuid('id')->primary()->comment('dari laravel, dibutuhkan untuk serialization');
                $t->string('nrk', 10);
                $t->string('id_apd', 10)->nullable();
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
                $t->foreignUuid('id_input_sewaktu_waktu');
                $t->longText('cache')->comment('json value dari input');
                $t->timestamps();
            });
        }





        // pembuatan relasi foreign key

        /**
         * aturan : 
         * - tipe kolom harus sama
         * - jika kolom asli bukan primary key, buat jadi unique
         * - jika foreign key mendukung constraint null spt nullondelete, kolom asli harus nullable 
         */

        error_log('now setting foreign keys');

        if (Schema::hasTable('pegawai')) {
            Schema::table('pegawai', function (Blueprint $t) {

                $t->foreign('id_jabatan')->references('id_jabatan')->on('jabatan');
                $t->foreign('id_wilayah')->references('id_wilayah')->on('wilayah')->cascadeOnUpdate()->cascadeOnDelete();
                $t->foreign('id_penempatan')->references('id_penempatan')->on('penempatan')->cascadeOnUpdate()->cascadeOnDelete();
                $t->foreign('id_grup')->references('id_grup')->on('grup')->cascadeOnUpdate()->cascadeOnDelete();
            });
        }


        if (Schema::hasTable('apd_list')) {
            Schema::table('apd_list', function (Blueprint $t) {

                $t->foreign('id_jenis')->references('id_jenis')->on('apd_jenis')->cascadeOnUpdate()->nullOnDelete();
                $t->foreign('id_size')->references('id')->on('apd_size')->cascadeOnUpdate()->nullOnDelete();
                $t->foreign('id_kondisi')->references('id')->on('apd_kondisi')->cascadeOnUpdate()->nullOnDelete();
            });
        }



        if (Schema::hasTable('input_apd')) {
            Schema::table('input_apd', function (Blueprint $t) {

                $t->foreign('nrk')->references('nrk')->on('pegawai')->cascadeOnUpdate();
                $t->foreign('id_apd')->references('id_apd')->on('apd_list')->cascadeOnUpdate()->nullOnDelete();
                $t->foreign('id_periode')->references('id')->on('periode_input_apd')->cascadeOnUpdate()->nullOnDelete();
            });
        }

        if (Schema::hasTable('input_apd_ongoing')) {
            Schema::table('input_apd_ongoing', function (Blueprint $t) {

                $t->foreign('id_input_apd')->references('id')->on('input_apd')->cascadeOnDelete()->cascadeOnUpdate();
            });
        }



        if (Schema::hasTable('input_apd_template')) {
            Schema::table('input_apd_template', function (Blueprint $t) {

                $t->foreign('id_apd')->references('id_apd')->on('apd_list')->cascadeOnDelete()->cascadeOnUpdate();
                $t->foreign('id_periode')->references('id')->on('periode_input_apd')->cascadeOnDelete()->cascadeOnUpdate();
            });
        }

        if (Schema::hasTable('input_sewaktu_waktu')) {
            Schema::table('input_sewaktu_waktu', function (Blueprint $t) {

                $t->foreign('nrk')->references('nrk')->on('pegawai')->cascadeOnUpdate();
                // $t->foreign('verified_by')->references('nrk')->on('pegawai')->cascadeOnUpdate();
                $t->foreign('id_apd')->references('id_apd')->on('apd_list')->cascadeOnUpdate()->nullOnDelete();
            });
        }

        if (Schema::hasTable('input_sewaktu_waktu_ongoing')) {
            Schema::table('input_sewaktu_waktu_ongoing', function (Blueprint $t) {

                $t->foreign('id_input_sewaktu_waktu')->references('id')->on('input_sewaktu_waktu')->cascadeOnDelete()->cascadeOnUpdate();
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

        /**
         * untuk dropForeign, gunakan nama constraint dari laravel
         * tabel_kolom_foreign
         */

        if (Schema::hasTable('pegawai')) {
            Schema::table('pegawai', function (Blueprint $t) {

                $t->dropForeign('pegawai_id_jabatan_foreign');
                $t->dropForeign('pegawai_id_wilayah_foreign');
                $t->dropForeign('pegawai_id_penempatan_foreign');
                $t->dropForeign('pegawai_id_grup_foreign');
            });
        }


        if (Schema::hasTable('apd_list')) {
            Schema::table('apd_list', function (Blueprint $t) {

                $t->dropForeign('apd_list_id_jenis_foreign');
                $t->dropForeign('apd_list_id_size_foreign');
            });
        }


        if (Schema::hasTable('input_apd')) {
            Schema::table('input_apd', function (Blueprint $t) {

                $t->dropForeign('input_apd_nrk_foreign');
                $t->dropForeign('input_apd_id_periode_foreign');
                $t->dropForeign('input_apd_id_apd_foreign');
            });
        }

        if (Schema::hasTable('input_apd_ongoing')) {
            Schema::table('input_apd_ongoing', function (Blueprint $t) {

                $t->dropForeign('input_apd_ongoing_id_input_apd_foreign');
            });
        }



        if (Schema::hasTable('input_apd_template')) {
            Schema::table('input_apd_template', function (Blueprint $t) {

                $t->dropForeign('input_apd_template_id_periode_foreign');
                $t->dropForeign('input_apd_template_id_apd_foreign');
            });
        }

        if (Schema::hasTable('input_sewaktu_waktu')) {
            Schema::table('input_sewaktu_waktu', function (Blueprint $t) {

                $t->dropForeign('input_sewaktu_waktu_nrk_foreign');
                $t->dropForeign('input_sewaktu_waktu_id_apd_foreign');
            });
        }

        if (Schema::hasTable('input_sewaktu_waktu_ongoing')) {
            Schema::table('input_sewaktu_waktu_ongoing', function (Blueprint $t) {

                $t->dropForeign('input_sewaktu_waktu_ongoing_id_input_sewaktu_waktu_foreign');
            });
        }

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
    }
};
