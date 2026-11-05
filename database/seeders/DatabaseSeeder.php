<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Petugas Perpustakaan',
            'email' => 'admin@sipustaka.com',
            'role' => 'admin',
            'password' => 'password',
        ]);

        User::create([
            'name' => 'Anggota Perpustakaan',
            'email' => 'user@sipustaka.com',
            'role' => 'user',
            'password' => 'password',
        ]);

        $buku = [
            ['Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 5],
            ['Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, 3],
            ['Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia', 2009, 4],
            ['Pemrograman Web dengan Laravel', 'Budi Raharjo', 'Informatika', 2022, 6],
            ['Basis Data', 'Fathansyah', 'Informatika', 2018, 2],
            ['Algoritma dan Pemrograman', 'Rinaldi Munir', 'Informatika', 2016, 7],
            ['Sistem Informasi Manajemen', 'Jogiyanto', 'Andi', 2017, 3],
        ];

        foreach ($buku as $b) {
            DB::table('bukus')->insert([
                'judul' => $b[0],
                'penulis' => $b[1],
                'penerbit' => $b[2],
                'tahun_terbit' => $b[3],
                'stok' => $b[4],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
