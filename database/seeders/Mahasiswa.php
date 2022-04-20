<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Mahasiswa extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mhs = [
            [
                "nim" => "111",
                "nama" => "Aripin",
                "kelas_id" => 5,
                "jurusan" => "Teknik Informatika",
                "email" => "aripin@gmail.com",
                "alamat" => "Bangkalan",
                "tanggal" => "17 Agustus 2000"
            ],
            [
                "nim" => "222",
                "nama" => "Wazir",
                "kelas_id" => 6,
                "jurusan" => "Teknik Elektro",
                "email" => "wazir@gmail.com",
                "alamat" => "Lamongan",
                "tanggal" => "4 Mei 2003"
            ],
            [
                "nim" => "333",
                "nama" => "Adit",
                "kelas_id" => 2,
                "jurusan" => "Teknik Telekomunikasi",
                "email" => "adit@gmail.com",
                "alamat" => "Pandaan",
                "tanggal" => "23 Maret 2002"
            ],
        ];
        
        DB::table('mahasiswa')->insert($mhs);
    }
}
