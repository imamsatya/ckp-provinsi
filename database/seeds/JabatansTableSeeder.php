<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class JabatansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
    
 // 1 admin
        // 2 kepala bps
        // 3 kepala bps kabupaten
        // 4 kabid
        // 5 kasie
        // 6 staf
      DB::table('jabatans')->insert([
        [
            'jabatan_kantor'  => 'Kepala BPS Provinsi',
            'role' => '2',           
        ],
        [
            'jabatan_kantor'  => 'Kepala Bidang IPDS',
            'role' => '4',
        ],
        [
            'jabatan_kantor'  => 'Kepala Seksi Integrasi Pengolahan Data',
            'role' => '5', 
        ],
        [
            'jabatan_kantor'  => 'Staf Seksi Integrasi Pengolahan Data',
            'role' => '6', 
        ]
    ]);
    }
}
