<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'hak_akses' => 'super_admin',
            'id_karyawan' => '10000',
            'password' => Hash::make('admin10000'),
        ]);

        DB::table('users')->insert([
            'id' => '2',
            'name' => 'Admin Finance',
            'email' => 'admin_finance@gmail.com',
            'hak_akses' => 'admin_finance',
            'id_karyawan' => '100001',
            'password' => Hash::make('admin100001'),
        ]);

        DB::table('periode_tanggals')->insert([
            'id' => '1',
            'tgl_periode1' => date('Y-m-d'),
            'tgl_periode2' => date('Y-m-d'),
        ]);
    }
}
