<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting_templates')->insert([
            // kartu
            [
                'type' => 'card',
                'initial' => 'kartu1',
                'name' => 'Normal'
            ],
            [
                'type' => 'card',
                'initial' => 'kartu2',
                'name' => '1/4 Kertas A4'
            ],
            [
                'type' => 'card',
                'initial' => 'kartu3',
                'name' => '1/2 Kertas A4'
            ],
            [
                'type' => 'card',
                'initial' => 'kartu4',
                'name' => 'Full Kertas A4'
            ],
            [
                'type' => 'card',
                'initial' => 'jadwal_ppdb',
                'name' => 'Kartu Jadwal PPDB'
            ],
            [
                'type' => 'card',
                'initial' => 'foto1',
                'name' => 'Ukuran Foto 2x3'
            ],
            [
                'type' => 'card',
                'initial' => 'foto2',
                'name' => 'Ukuran Foto 3x4'
            ],
            [
                'type' => 'card',
                'initial' => 'tampil_foto',
                'name' => 'Tampilkan Foto'
            ],

            // surat
            [
                'type' => 'letter',
                'initial' => 'head1',
                'name' => 'Head 1'
            ],
            [
                'type' => 'letter',
                'initial' => 'head2',
                'name' => 'Head 2'
            ],
            [
                'type' => 'letter',
                'initial' => 'head3',
                'name' => 'Head 3'
            ],
            [
                'type' => 'letter',
                'initial' => 'alamat',
                'name' => 'Alamat Sekolah'
            ],
            [
                'type' => 'letter',
                'initial' => 'logo1',
                'name' => 'Logo 1'
            ],
            [
                'type' => 'letter',
                'initial' => 'logo2',
                'name' => 'Logo 2'
            ],
            [
                'type' => 'letter',
                'initial' => 'prolog',
                'name' => 'Prolog'
            ],
            [
                'type' => 'letter',
                'initial' => 'penutup',
                'name' => 'Penutup'
            ],
            [
                'type' => 'letter',
                'initial' => 'ttd_kepsek',
                'name' => 'TTD Kepsek'
            ],
            [
                'type' => 'letter',
                'initial' => 'nama_kepsek',
                'name' => 'Nama Kepsek'
            ],
            [
                'type' => 'letter',
                'initial' => 'stempel',
                'name' => 'Stempel'
            ],
            [
                'type' => 'letter',
                'initial' => 'nip_kepsek',
                'name' => 'NIP Kepsek'
            ],
            [
                'type' => 'letter',
                'initial' => 'tempat_keputusan',
                'name' => 'Tempat Keputusan'
            ],
            [
                'type' => 'letter',
                'initial' => 'tgl_keputusan',
                'name' => 'Tanggal Keputusan'
            ],
            [
                'type' => 'letter',
                'initial' => 'tahun_ajaran',
                'name' => 'Tahun Ajaran'
            ],
            [
                'type' => 'participant-letter',
                'initial' => 'nama',
                'name' => 'Nama Peserta'
            ],
            [
                'type' => 'participant-letter',
                'initial' => 'nisn',
                'name' => 'NISN'
            ],
            [
                'type' => 'participant-letter',
                'initial' => 'keputusan',
                'name' => 'Keputusan'
            ],
            [
                'type' => 'participant-letter',
                'initial' => 'keterangan_keputusan',
                'name' => 'Keterangan Keputusan'
            ],
            [
                'type' => 'participant-letter',
                'initial' => 'no_pendaftaran',
                'name' => 'Nomor Pendaftaran'
            ],
            [
                'type' => 'participant-letter',
                'initial' => 'asal_sekolah',
                'name' => 'Asal Sekolah'
            ],
            [
                'type' => 'participant-letter',
                'initial' => 'jalur_pendaftaran',
                'name' => 'Jalur Pendaftaran'
            ],
        ]);
    }
}
