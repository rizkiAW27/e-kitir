<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;
class UserTest extends TestCase
{
    public function test_login_form(){
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_insert_karyawans(){
        $response = Karyawan::make([
            'id_karyawan' => '100001',
            'nama' => 'Rizki',
            'bagian' => 'hrd',
            'jabatan' => 'admin hrd',
            'status_karyawan' => 'ojt',
            'status_ptkp' => 'tk0',
            'tgl_bergabung' => '2023-02-08',
            'gaji_pokok' => '100001',
            'nama_bank' => 'bni',
            'norek' => '100001',
            'namaPem_bank' => 'rizki',
        ]);
        $response->assertStatus(200);
    }

    public function test_insert_user(){
        $response = User::make([
            'name' => 'Rizki',
            'email' => 'rizki@gmail.com',
            'hak_akses' => 'hrd',
            'id_karyawan' => '100001',
            'password' => Hash::make('Rizki100001'),
        ]);
        $response->assertStatus(200);
    }
}
