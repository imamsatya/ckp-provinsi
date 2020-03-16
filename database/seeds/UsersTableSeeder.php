<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'  => 'Imam Satya Wedhatama',
                'email' => 'imam.satya@bps.go.id',
                'password' => bcrypt('12341234'),
                'jabatan_id' => '4'
            ],
            [
                'name'  => 'Hudi Javariawan',
                'email' => 'hudijavariawan@bps.go.id',
                'password' => bcrypt('12341234'),
                'jabatan_id' => '4'
            ],
          
        ]);
    }
}
