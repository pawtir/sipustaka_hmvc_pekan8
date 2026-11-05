<?php

namespace Modules\Peminjaman\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    protected $fillable = [
        'nama_peminjam',
        'judul_buku',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'bukti',
        'nama_bukti',
    ];

    protected $appends = ['bukti_url'];

    public function getBuktiUrlAttribute()
    {
        return $this->bukti ? asset('storage/'.$this->bukti) : null;
    }
}
