<?php

namespace App\Http\Controllers;

use App\Models\User;
use Modules\Buku\Models\Buku;
use Modules\Peminjaman\Models\Peminjaman;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            'jumlahBuku' => Buku::count(),
            'jumlahPeminjaman' => Peminjaman::count(),
            'masihDipinjam' => Peminjaman::where('status', 'Dipinjam')->count(),
            'jumlahUser' => User::count(),
        ]);
    }
}
