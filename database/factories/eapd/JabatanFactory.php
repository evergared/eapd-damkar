<?php

namespace Database\Factories\Eapd;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jabatan>
 */
class JabatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            ['id_jabatan' => 'L001', 'nama_jabatan' => 'PJLP Damkar', 'tipe_jabatan' => 'Personil', 'keterangan' => null],
            ['id_jabatan' => 'L002', 'nama_jabatan' => 'ASN Damkar', 'tipe_jabatan' => 'Personil', 'keterangan' => null],
            ['id_jabatan' => 'L003', 'nama_jabatan' => 'Kepala Regu', 'tipe_jabatan' => 'Personil', 'keterangan' => null],
            ['id_jabatan' => 'L004', 'nama_jabatan' => 'Kepala Pleton', 'tipe_jabatan' => 'Danton', 'keterangan' => null],
            ['id_jabatan' => 'K001', 'nama_jabatan' => 'Kepala Sektor', 'tipe_jabatan' => 'Eselon 4', 'keterangan' => 'Admin Sektor'],
            ['id_jabatan' => 'K002', 'nama_jabatan' => 'Kasie Dalkarmat', 'tipe_jabatan' => 'Eselon 4', 'keterangan' => 'Admin Sektor'],
            ['id_jabatan' => 'K003', 'nama_jabatan' => 'Kasie Sarana', 'tipe_jabatan' => 'Eselon 4', 'keterangan' => 'Admin Sudin'],
            ['id_jabatan' => 'K004', 'nama_jabatan' => 'Kepala Sudin', 'tipe_jabatan' => 'Eselon 4', 'keterangan' => null],
            ['id_jabatan' => 'K005', 'nama_jabatan' => 'Kepala Bidang Sarpras', 'tipe_jabatan' => 'Eselon 4', 'keterangan' => 'Admin Sarana'],
            ['id_jabatan' => 'S001', 'nama_jabatan' => 'Staff Sektor', 'tipe_jabatan' => 'Staff', 'keterangan' => null],
            ['id_jabatan' => 'S002', 'nama_jabatan' => 'Staff Tata Usaha', 'tipe_jabatan' => 'Staff', 'keterangan' => null],

        ];
    }
}
