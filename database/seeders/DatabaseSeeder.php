<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Employee;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::create([
        'name' => 'Super Admin',
        'username' => 'admin',     // Pastikan pakai username
        'password' => bcrypt('admin123'),
        'email' => 'admin@example.com' // (Opsional, isi sembarang agar tidak error jika kolom email masih ada)
    ]);
    
    // Data dummy pegawai (Opsional)
    \App\Models\Employee::create(['name' => 'Contoh Pegawai', 'position' => 'Staff']);
    }
}
