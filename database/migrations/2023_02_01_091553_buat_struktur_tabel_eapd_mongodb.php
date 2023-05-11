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
                $t->index('id_penempatan')->nullable();
                $t->index('id_grup');
                $t->string('id_atasan')->nullable()->comment('id dari atasan langsung pegawai ini');
                $t->boolean('aktif')->default(true);
                $t->text('override_level_user')->nullable(); // jaga-jaga perlu override level user untuk pegawai tertentu, kosongkan jika tidak perlu
                $t->timestamps();
            }); 
        }

        if (!Schema::hasTable('penempatan')) {
            Schema::create('penempatan', function (Blueprint $t) {
                $t->text('nama_penempatan');
                $t->text('keterangan')->nullable();
                $t->text('id_wilayah')->nullable();
                $t->text('id_kecamatan')->nullable()->comment('kosongkan jika keterangan sudin');
                $t->text('id_kelurahan')->nullable()->comment('kosongkan jika keterangan sudin atau sektor');
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
                $t->text('nama_jabatan'); // untuk ditampilkan di tabel dan web
                $t->text('nama_jabatan_di_dokumen')->nullable(); // untuk ditampilkan di surat atau dokumen
                $t->text('nama_jabatan_lengkap')->nullable(); // nama asli / lengkap dari jabatan si pegawai, belum termasuk grade pegawai
                $t->text('tipe_jabatan');
                $t->text('level_user');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('grade_pegawai')) {
            Schema::create('grade_pegawai', function (Blueprint $t) {

                $t->comment('tabel yang menampung list grade pegawai, dengan skema [tabel pegawai] <-- [tabel grade_pegawai]');

                $t->text('nama_grade');
                $t->string('kode_grade'); // disini isi IIa, IIIb, IVc dst 
                $t->text('prefix_nama_jabatan')->nullable(); // untuk menambah imbuhan nama sebelum nama jabatan, cth Pengendali Muda Staff Sektor
                $t->text('sufix_nama_jabatan')->nullable(); // untuk menambah imbuhan nama setelah nama jabatan, cth Staff Sektor Pengendali Muda
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('provinsi')) {
            Schema::create('provinsi', function (Blueprint $t) {
                $t->text('nama_provinsi');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('wilayah')) {
            Schema::create('wilayah', function (Blueprint $t) {
                $t->text('nama_wilayah');
                $t->text('id_provinsi');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('kecamatan')) {
            Schema::create('kecamatan', function (Blueprint $t) {
                $t->text('nama_kecamatan');                
                $t->text('id_wilayah');
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('kelurahan')) {
            Schema::create('kelurahan', function (Blueprint $t) {
                $t->text('nama_kelurahan');                
                $t->text('id_kecamatan');
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
                $t->boolean('boleh_dihapus')->default(true);
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('apd_kondisi')) {
            Schema::create('apd_kondisi', function (Blueprint $t) {
                $t->text('nama_kondisi');
                $t->json('opsi')->comment('json');
                $t->text('keterangan')->nullable();
                $t->boolean('boleh_dihapus')->default(true);
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
                $t->text('data_diupdate')->nullable();
                $t->text('verifikasi_oleh')->nullable();
                $t->string('verifikasi_status', 2)->nullable();
                $t->text('komentar_verifikator')->nullable();
            });
        }

        if (!Schema::hasTable('input_apd_ongoing')) {
            Schema::create('input_apd_ongoing', function (Blueprint $t) {
                $t->index('id_input_apd');
                $t->longText('cache')->comment('value langsung dari collection input_apd yang diembed');
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('periode_input_apd')) {
            Schema::create('periode_input_apd', function (Blueprint $t) {
                $t->text('nama_periode');
                $t->date('tgl_awal')->nullable();
                $t->date('tgl_akhir')->nullable();
                $t->boolean('aktif')->nullable();
                $t->text('pesan_berjalan')->nullable();
                $t->text('keterangan')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('input_apd_template')) {
            Schema::create('input_apd_template', function (Blueprint $t) {
                $t->text('nama')->nullable()->default('Template EAPD')->comment('nama dari template');
                $t->string('id_periode')->nullable()->comment('diisi id dari collection periode_input_apd');
                $t->longText('template')->comment('diisi array yang akan digunakan oleh aplikasi untuk template');
                $t->timestamps();

                /**
                 * struktur tempate :
                 * $template = 
                 * [
                 *      [id_jabatan] => [
                 *                          [id_jenis_apd] =>   [
                 *                                                  - id_apd,
                 *                                                  - id_apd,
                 *                                                  - id_apd,
                 *                                              ],
                 *                           [id_jenis_apd] =>   [
                 *                                                  - id_apd,
                 *                                                  - id_apd,
                 *                                                  - id_apd,
                 *                                              ]
                 *                      ],
                 *      [id_jabatan] => [
                 *                          [id_jenis_apd] =>   [
                 *                                                  - id_apd,
                 *                                                  - id_apd,
                 *                                                  - id_apd,
                 *                                              ],
                 *                           [id_jenis_apd] =>   [
                 *                                                  - id_apd,
                 *                                                  - id_apd,
                 *                                                  - id_apd,
                 *                                              ]
                 *                      ],
                 * ];
                 * 
                 * - id_jabatan = pegawai dengan jabatan apa yang harus mengisi
                 * - id_jenis_apd = tipe apd apa yang harus diisi oleh pegawai saat menginput
                 * - id_apd = apd apa saja yang disediakan sebagai opsi
                 */
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
                $t->longText('cache')->comment('value langsung dari collection input_sewaktu_waktu yang diembed');
                $t->timestamps();
            });
        }


        // tabel history untuk menunjukan perubahan data ke admin tingkat atas

        // if(!Schema::hasTable('history_tabel_pegawai')){
        //     Schema::create('history_tabel_pegawai',function(Blueprint $t){
        //         $t->string('id_pegawai')->primary();
        //         $t->longText('sebelumnya')->nullable();
        //         $t->longText('perubahan')->nullable();
        //         $t->text('keterangan_perubahan')->nullable();
        //         $t->string('id_pengubah')->nullable();
        //         $t->boolean('dilihat_admin_sektor')->default(false);
        //         $t->boolean('dilihat_admin_sudin')->default(false);
        //         $t->boolean('dilihat_admin_dinas')->default(false);
        //         $t->timestamps();
        //         $t->comment('tabel agar admin tingkat atas tau jika ada perubahan data pegawai');
        //     });
        // }
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
        Schema::dropIfExists('provinsi');
        Schema::dropIfExists('wilayah');
        Schema::dropIfExists('kecamatan');
        Schema::dropIfExists('kelurahan');
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
