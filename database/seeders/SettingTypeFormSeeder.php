<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTypeFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting_type_forms')->insert([
            [
                'initial' => 'form_setting',
                'name' => 'Setting Form Pendaftaran',
            ],
            [
                'initial' => 'biodata',
                'name' => 'Biodata',
            ],
            [
                'initial' => 'sakit',
                'name' => 'Riwayat Sakit',
            ],
            [
                'initial' => 'alamat',
                'name' => 'Alamat',
            ],
            [
                'initial' => 'keluarga',
                'name' => 'Keluarga',
            ],
            [
                'initial' => 'riwayat_sekolah',
                'name' => 'Riwayat Sekolah',
            ],
            [
                'initial' => 'bantuan',
                'name' => 'Bantuan',
            ],
            [
                'initial' => 'prestasi_kelas',
                'name' => 'Prestasi Kelas',
            ],
            [
                'initial' => 'ortu',
                'name' => 'Orang Tua',
            ],
            [
                'initial' => 'prestasi',
                'name' => 'Prestasi',
            ],
            [
                'initial' => 'un',
                'name' => 'Ujian Nasional',
            ],
            [
                'initial' => 'rata_raport',
                'name' => 'Nilai Rata-rata Raport',
            ],
            [
                'initial' => 'nilai_mapel_raport',
                'name' => 'Nilai Raport per Mapel',
            ],
            [
                'initial' => 'pekerjaan_ortu',
                'name' => 'Pekerjaan Orang Tua',
            ],
            [
                'initial' => 'badan',
                'name' => 'Badan',
            ],
        ]);
    }
}
