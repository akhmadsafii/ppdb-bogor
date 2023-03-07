<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting_forms')->insert([
            [
                // 1
                'id_type' => 1,
                'initial' => 'gelombang',
                'name' => 'Gelombang Pendaftaran',
                'type' => 'option',
                'status_card' => 0,
                'status_form' => 0,
            ],
            [
                // 2
                'id_type' => 1,
                'initial' => 'jurusan',
                'name' => 'Jurusan',
                'type' => 'option',
                'status_card' => 0,
                'status_form' => 1,
            ],
            [
                //3
                'id_type' => 1,
                'initial' => 'jurusan2',
                'name' => 'Jurusan 2',
                'type' => 'option',
                'status_card' => 0,
                'status_form' => 1,

            ],
            [
                // 4
                'id_type' => 1,
                'initial' => 'jurusan3',
                'name' => 'Jurusan 3',
                'type' => 'option',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 5
                'id_type' => 1,
                'initial' => 'jurusan_diterima',
                'name' => 'Jurusan Diterima',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 6
                'id_type' => 1,
                'initial' => 'jalur_pendaftaran',
                'name' => 'Jalur Pendaftaran',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 1,

            ],
            [
                // 7
                'id_type' => 1,
                'initial' => 'nomor_pendaftaran',
                'name' => 'Nomor Pendaftaran',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],

            // biodata
            [
                // 8
                'id_type' => 2,
                'initial' => 'nama',
                'name' => 'Nama Lengkap',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 1,

            ],
            [
                // 9
                'id_type' => 2,
                'initial' => 'nisn',
                'name' => 'NISN',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 1,

            ],
            [
                // 10
                'id_type' => 2,
                'initial' => 'email',
                'name' => 'Email',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 1,

            ],
            [
                // 11
                'id_type' => 2,
                'initial' => 'telepon',
                'name' => 'Telepon',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 1,

            ],
            [
                // 12
                'id_type' => 2,
                'initial' => 'agama',
                'name' => 'Agama',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 1,

            ],
            [
                // 13
                'id_type' => 2,
                'initial' => 'jenkel',
                'name' => 'Jenis Kelamin',
                'type' => 'option',
                'status_card' => 0,
                'status_form' => 1,

            ],
            [
                // 14
                'id_type' => 2,
                'initial' => 'tempat_lahir',
                'name' => 'Tempat Lahir',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 1,

            ],
            [
                // 15
                'id_type' => 2,
                'initial' => 'tgl_lahir',
                'name' => 'Tanggal Lahir',
                'type' => 'date',
                'status_card' => 0,
                'status_form' => 1,

            ],
            [
                // 16
                'id_type' => 2,
                'initial' => 'goldar',
                'name' => 'Golongan Darah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 17
                'id_type' => 2,
                'initial' => 'cita_cita',
                'name' => 'Cita-Cita',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 18
                'id_type' => 2,
                'initial' => 'hobi',
                'name' => 'Hobi',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 19
                'id_type' => 2,
                'initial' => 'jenis_tinggal',
                'name' => 'Jenis Tinggal',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 20
                'id_type' => 2,
                'initial' => 'no_akta_lahir',
                'name' => 'Nomor Akta Lahir',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 21
                'id_type' => 2,
                'initial' => 'nama_panggilan',
                'name' => 'Nama Panggilan',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 22
                'id_type' => 2,
                'initial' => 'kewarganegaraan',
                'name' => 'Kewarganegaraan',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 23
                'id_type' => 2,
                'initial' => 'bahasa',
                'name' => 'Bahasa',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 24
                'id_type' => 2,
                'initial' => 'nomor_kk',
                'name' => 'Nomor Kartu Keluarga',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 1,

            ],
            [
                // 25
                'id_type' => 2,
                'initial' => 'nik',
                'name' => 'Nomor Induk Keluarga',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 26
                'id_type' => 2,
                'initial' => 'domisili',
                'name' => 'Domisili',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],

            // sakit
            [
                // 27
                'id_type' => 3,
                'initial' => 'penyakit_bawaan',
                'name' => 'Penyakit Bawaan',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 28
                'id_type' => 3,
                'initial' => 'pernah_sakit',
                'name' => 'Pernah Sakit',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 29
                'id_type' => 3,
                'initial' => 'nama_penyakit',
                'name' => 'Nama Penyakit',
                'type' => 'option',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 30
                'id_type' => 3,
                'initial' => 'tgl_sakit',
                'name' => 'Tanggal Sakit',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 31
                'id_type' => 3,
                'initial' => 'lama_sakit',
                'name' => 'Lama Sakit',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            // alamat
            [
                // 32
                'id_type' => 4,
                'initial' => 'alamat',
                'name' => 'Alamat',
                'type' => 'textarea',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 33
                'id_type' => 4,
                'initial' => 'dusun',
                'name' => 'Dusun',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 34
                'id_type' => 4,
                'initial' => 'rt',
                'name' => 'RT',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 35
                'id_type' => 4,
                'initial' => 'rw',
                'name' => 'RW',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 36
                'id_type' => 4,
                'initial' => 'kelurahan',
                'name' => 'Kelurahan',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 37
                'id_type' => 4,
                'initial' => 'kecamatan',
                'name' => 'Kecamatan',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 38
                'id_type' => 4,
                'initial' => 'kota',
                'name' => 'Kota',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 39
                'id_type' => 4,
                'initial' => 'provinsi',
                'name' => 'Provinsi',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 40
                'id_type' => 4,
                'initial' => 'kode_pos',
                'name' => 'Kodepos',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 41
                'id_type' => 4,
                'initial' => 'bujur',
                'name' => 'Bujur',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 42
                'id_type' => 4,
                'initial' => 'lintang',
                'name' => 'Lintang',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            // keluarga
            [
                // 43
                'id_type' => 5,
                'initial' => 'status_anak',
                'name' => 'Status Anak',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 44
                'id_type' => 5,
                'initial' => 'anak_ke',
                'name' => 'Anak Ke',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 45
                'id_type' => 5,
                'initial' => 'jumlah_saudara',
                'name' => 'Jumlah Saudara',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 46
                'id_type' => 5,
                'initial' => 'jumlah_saudara_kandung',
                'name' => 'Jumlah Saudara Kandung',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 47
                'id_type' => 5,
                'initial' => 'jumlah_saudara_tiri',
                'name' => 'Jumlah Saudara Tiri',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 48
                'id_type' => 5,
                'initial' => 'jumlah_saudara_angkat',
                'name' => 'Jumlah Saudara Angkat',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            // riwayat sekolah
            [
                // 49
                'id_type' => 6,
                'initial' => 'asal_sekolah',
                'name' => 'Asal Sekolah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 50
                'id_type' => 6,
                'initial' => 'jarak_sekolah',
                'name' => 'Jarak Sekolah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 51
                'id_type' => 6,
                'initial' => 'transportasi_sekolah',
                'name' => 'Transportasi Sekolah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 52
                'id_type' => 6,
                'initial' => 'waktu_sekolah',
                'name' => 'Waktu Sekolah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 53
                'id_type' => 6,
                'initial' => 'nama_sekolah',
                'name' => 'Nama Sekolah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 54
                'id_type' => 6,
                'initial' => 'alamat_sekolah_asal',
                'name' => 'Alamat Sekolah Asal',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 55
                'id_type' => 6,
                'initial' => 'npsn',
                'name' => 'NPSN',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 56
                'id_type' => 6,
                'initial' => 'tahun_lulus',
                'name' => 'Tahun Lulus',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 57
                'id_type' => 6,
                'initial' => 'nomor_ijazah',
                'name' => 'Nomor Ijazah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 58
                'id_type' => 6,
                'initial' => 'nomor_skhu',
                'name' => 'Nomor SKHU',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 59
                'id_type' => 6,
                'initial' => 'jenjang',
                'name' => 'Jenjang',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 60
                'id_type' => 6,
                'initial' => 'pernah_paud',
                'name' => 'Pernah PAUD',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 61
                'id_type' => 6,
                'initial' => 'pernah_tk',
                'name' => 'Pernah TK',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 62
                'id_type' => 6,
                'initial' => 'referensi',
                'name' => 'Referensi',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            // bantuan
            [
                // 63
                'id_type' => 7,
                'initial' => 'penerima_pkh',
                'name' => 'Penerima PKH',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 64
                'id_type' => 7,
                'initial' => 'nomor_kps',
                'name' => 'Nomor KPS',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 65
                'id_type' => 7,
                'initial' => 'jenis_ktm',
                'name' => 'Jenis KTM',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 66
                'id_type' => 7,
                'initial' => 'nomor_sktm',
                'name' => 'Nomor SKTM',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 67
                'id_type' => 7,
                'initial' => 'nomor_kks',
                'name' => 'Nomor KKS',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 68
                'id_type' => 7,
                'initial' => 'nomor_pkh',
                'name' => 'Nomor PKH',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 69
                'id_type' => 7,
                'initial' => 'layak_pip',
                'name' => 'Layak PIP',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 70
                'id_type' => 7,
                'initial' => 'alasan_pip',
                'name' => 'Alasan PIP',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 71
                'id_type' => 7,
                'initial' => 'nama_kip',
                'name' => 'Nama KIP',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 72
                'id_type' => 7,
                'initial' => 'nomor_kip',
                'name' => 'Nomor KIP',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 73
                'id_type' => 7,
                'initial' => 'alasan_tolak_kip',
                'name' => 'Alasan Tolak KIP',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 74
                'id_type' => 7,
                'initial' => 'penerima_kip',
                'name' => 'Penerima KIP',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 75
                'id_type' => 7,
                'initial' => 'terima_fisik_kip',
                'name' => 'Terima Fisik KIP',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 76
                'id_type' => 7,
                'initial' => 'nomor_kis',
                'name' => 'Nomor KIS',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 77
                'id_type' => 7,
                'initial' => 'jenis_kesejahteraan',
                'name' => 'Jenis Kesejahteraan',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 78
                'id_type' => 7,
                'initial' => 'nomor_bpjs',
                'name' => 'Nomor BPJS',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 79
                'id_type' => 7,
                'initial' => 'keterangan_beasiswa',
                'name' => 'Keterangan Beasiswa',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 80
                'id_type' => 7,
                'initial' => 'tahun_mulai_beasiswa',
                'name' => 'Tahun Mulai Beasiswa',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 81
                'id_type' => 7,
                'initial' => 'tahun_selesai_beasiswa',
                'name' => 'Tahun Selesai Beasiswa',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 82
                'id_type' => 7,
                'initial' => 'penerima_kps',
                'name' => 'Penerima KPS',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 83
                'id_type' => 7,
                'initial' => 'beasiswa',
                'name' => 'Beasiswa',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            // prestasi sekolah
            [
                // 84
                'id_type' => 8,
                'initial' => 'rangking',
                'name' => 'Rangking',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 85
                'id_type' => 8,
                'initial' => 'peringkat_semester_1',
                'name' => 'Peringkat Semester 1',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 86
                'id_type' => 8,
                'initial' => 'peringkat_semester_2',
                'name' => 'Peringkat Semester 2',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 87
                'id_type' => 8,
                'initial' => 'peringkat_semester_3',
                'name' => 'Peringkat Semester 3',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 88
                'id_type' => 8,
                'initial' => 'peringkat_semester_4',
                'name' => 'Peringkat Semester 4',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 89
                'id_type' => 8,
                'initial' => 'peringkat_semester_5',
                'name' => 'Peringkat Semester 5',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 90
                'id_type' => 8,
                'initial' => 'peringkat_semester_6',
                'name' => 'Peringkat Semester 6',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            // orang tua
            [
                // 91
                'id_type' => 9,
                'initial' => 'email_ortu',
                'name' => 'Email Orang Tua',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 92
                'id_type' => 9,
                'initial' => 'telp_ortu',
                'name' => 'Telepon Orang Tua',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 93
                'id_type' => 9,
                'initial' => 'nama_ayah',
                'name' => 'Nama Ayah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 94
                'id_type' => 9,
                'initial' => 'nik_ayah',
                'name' => 'NIK Ayah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 95
                'id_type' => 9,
                'initial' => 'alamat_ayah',
                'name' => 'Alamat Ayah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 96
                'id_type' => 9,
                'initial' => 'tempat_lahir_ayah',
                'name' => 'Tempat Lahir Ayah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 97
                'id_type' => 9,
                'initial' => 'tgl_lahir_ayah',
                'name' => 'Tanggal Lahir Ayah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 98
                'id_type' => 9,
                'initial' => 'tahun_lahir_ayah',
                'name' => 'Tahun Lahir Ayah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 99
                'id_type' => 9,
                'initial' => 'usia_ayah',
                'name' => 'Usia Ayah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 100
                'id_type' => 9,
                'initial' => 'agama_ayah',
                'name' => 'Agama Ayah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 101
                'id_type' => 9,
                'initial' => 'pendidikan_ayah',
                'name' => 'Pendidikan Ayah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 102
                'id_type' => 9,
                'initial' => 'cacat_badan_ayah',
                'name' => 'Cacat Badan Ayah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 103
                'id_type' => 9,
                'initial' => 'telepon_ayah',
                'name' => 'Telepon Ayah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 104
                'id_type' => 9,
                'initial' => 'nama_ibu',
                'name' => 'Nama Ibu',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 105
                'id_type' => 9,
                'initial' => 'nik_ibu',
                'name' => 'NIK Ibu',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 106
                'id_type' => 9,
                'initial' => 'alamat_ibu',
                'name' => 'Alamat Ibu',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 107
                'id_type' => 9,
                'initial' => 'tempat_lahir_ibu',
                'name' => 'Tempat Lahir Ibu',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 108
                'id_type' => 9,
                'initial' => 'tgl_lahir_ibu',
                'name' => 'Tanggal Lahir Ibu',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 109
                'id_type' => 9,
                'initial' => 'tahun_lahir_ibu',
                'name' => 'Tahun Lahir Ibu',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 110
                'id_type' => 9,
                'initial' => 'usia_ibu',
                'name' => 'Usia Ibu',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 111
                'id_type' => 9,
                'initial' => 'agama_ibu',
                'name' => 'Agama Ibu',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 112
                'id_type' => 9,
                'initial' => 'pendidikan_ibu',
                'name' => 'Pendidikan Ibu',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 113
                'id_type' => 9,
                'initial' => 'cacat_badan_ibu',
                'name' => 'Cacat Badan Ibu',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 114
                'id_type' => 9,
                'initial' => 'telepon_ibu',
                'name' => 'Telepon Ibu',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 115
                'id_type' => 9,
                'initial' => 'nama_wali',
                'name' => 'Nama Wali',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 116
                'id_type' => 9,
                'initial' => 'nik_wali',
                'name' => 'NIK Wali',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 117
                'id_type' => 9,
                'initial' => 'alamat_wali',
                'name' => 'Alamat Wali',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 118
                'id_type' => 9,
                'initial' => 'tempat_lahir_wali',
                'name' => 'Tempat Lahir Wali',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 119
                'id_type' => 9,
                'initial' => 'tgl_lahir_wali',
                'name' => 'Tanggal Lahir Wali',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 120
                'id_type' => 9,
                'initial' => 'tahun_lahir_wali',
                'name' => 'Tahun Lahir Wali',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 121
                'id_type' => 9,
                'initial' => 'usia_wali',
                'name' => 'Usia Wali',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 122
                'id_type' => 9,
                'initial' => 'agama_wali',
                'name' => 'Agama Wali',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 123
                'id_type' => 9,
                'initial' => 'pendidikan_wali',
                'name' => 'Pendidikan Wali',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 124
                'id_type' => 9,
                'initial' => 'pekerjaan_wali',
                'name' => 'Pekerjaan Wali',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 125
                'id_type' => 9,
                'initial' => 'penghasilan_wali',
                'name' => 'Penghasilan Wali',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 126
                'id_type' => 9,
                'initial' => 'cacat_badan_wali',
                'name' => 'Cacat Badan Wali',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 127
                'id_type' => 9,
                'initial' => 'telepon_wali',
                'name' => 'Telepon Wali',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 128
                'id_type' => 9,
                'initial' => 'status_rumah_ayah',
                'name' => 'Status Rumah Ayah',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 129
                'id_type' => 9,
                'initial' => 'status_rumah_ibu',
                'name' => 'Status Rumah Ibu',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            // prestasi
            [
                // 130
                'id_type' => 10,
                'initial' => 'prestasi',
                'name' => 'Prestasi',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 131
                'id_type' => 10,
                'initial' => 'prestasi2',
                'name' => 'Prestasi 2',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 132
                'id_type' => 10,
                'initial' => 'tingkat_kec',
                'name' => 'Tingkat Kecamatan',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 133
                'id_type' => 10,
                'initial' => 'tingkat_kab',
                'name' => 'Tingkat Kabupaten',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 134
                'id_type' => 10,
                'initial' => 'tingkat_nas',
                'name' => 'Tingkat Nasional',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 135
                'id_type' => 10,
                'initial' => 'tingkat_inter',
                'name' => 'Tingkat Internasional',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 136
                'id_type' => 10,
                'initial' => 'prestasi_kec1',
                'name' => 'Prestasi Kecamatan 1',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 137
                'id_type' => 10,
                'initial' => 'prestasi_kec2',
                'name' => 'Prestasi Kecamatan 2',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 138
                'id_type' => 10,
                'initial' => 'prestasi_kec3',
                'name' => 'Prestasi Kecamatan 3',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 139
                'id_type' => 10,
                'initial' => 'prestasi_kab1',
                'name' => 'Prestasi Kabupaten 1',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 140
                'id_type' => 10,
                'initial' => 'prestasi_kab2',
                'name' => 'Prestasi Kabupaten 2',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 141
                'id_type' => 10,
                'initial' => 'prestasi_prov1',
                'name' => 'Prestasi Provinsi 1',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 142
                'id_type' => 10,
                'initial' => 'prestasi_nas1',
                'name' => 'Prestasi Nasional 1',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 143
                'id_type' => 10,
                'initial' => 'prestasi_inter1',
                'name' => 'Prestasi Internasional 2',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            // ujian nasional
            [
                // 144
                'id_type' => 11,
                'initial' => 'nilai_un3',
                'name' => 'Nilai UN 3',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 145
                'id_type' => 11,
                'initial' => 'nilai_un',
                'name' => 'Nilai UN',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 146
                'id_type' => 11,
                'initial' => 'nilai_us',
                'name' => 'Nilai US',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 147
                'id_type' => 11,
                'initial' => 'nilai_us_b_indo',
                'name' => 'Nilai US Bahasa Indonesia',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 148
                'id_type' => 11,
                'initial' => 'nilai_us_mtk',
                'name' => 'Nilai US Matematika',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 149
                'id_type' => 11,
                'initial' => 'nilai_us_b_ing',
                'name' => 'Nilai US Bahasa Inggris',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 150
                'id_type' => 11,
                'initial' => 'nilai_us_ipa',
                'name' => 'Nilai US IPA',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 151
                'id_type' => 11,
                'initial' => 'rata_rata_un',
                'name' => 'Rata-Rata UN',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 152
                'id_type' => 11,
                'initial' => 'rata_rata_us',
                'name' => 'Rata-Rata US',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 153
                'id_type' => 11,
                'initial' => 'jumlah_nilai_un',
                'name' => 'Jumlah Nilai UN',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            // rata-rata raport
            [
                // 154
                'id_type' => 12,
                'initial' => 'rata_rata_rapor_semester_1',
                'name' => 'Rata-Rata Raport Semester 1',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 155
                'id_type' => 12,
                'initial' => 'rata_rata_rapor_semester_2',
                'name' => 'Rata-Rata Raport Semester 2',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 156
                'id_type' => 12,
                'initial' => 'rata_rata_rapor_semester_3',
                'name' => 'Rata-Rata Raport Semester 3',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 157
                'id_type' => 12,
                'initial' => 'rata_rata_rapor_semester_4',
                'name' => 'Rata-Rata Raport Semester 4',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 158
                'id_type' => 12,
                'initial' => 'rata_rata_rapor_semester_5',
                'name' => 'Rata-Rata Raport Semester 5',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 159
                'id_type' => 12,
                'initial' => 'rata_rata_rapor_semester_6',
                'name' => 'Rata-Rata Raport Semester 6',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 160
                'id_type' => 12,
                'initial' => 'jumlah_rapor_semester_1',
                'name' => 'Jumlah Rapor Semester 1',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 161
                'id_type' => 12,
                'initial' => 'jumlah_rapor_semester_2',
                'name' => 'Jumlah Rapor Semester 2',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 162
                'id_type' => 12,
                'initial' => 'jumlah_rapor_semester_3',
                'name' => 'Jumlah Rapor Semester 3',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 163
                'id_type' => 12,
                'initial' => 'jumlah_rapor_semester_4',
                'name' => 'Jumlah Rapor Semester 4',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,

            ],
            [
                // 164
                'id_type' => 12,
                'initial' => 'jumlah_rapor_semester_5',
                'name' => 'Jumlah Rapor Semester 5',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,
            ],
            [
                // 165
                'id_type' => 12,
                'initial' => 'jumlah_rapor_semester_6',
                'name' => 'Jumlah Rapor Semester 6',
                'type' => 'text',
                'status_card' => 0,
                'status_form' => 0,
            ],
        ]);
    }
}
