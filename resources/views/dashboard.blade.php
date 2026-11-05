@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h4>Dashboard</h4>
<p>Selamat datang, <strong>{{ auth()->user()->name }}</strong>. Anda login sebagai <strong>{{ auth()->user()->role }}</strong>.</p>

<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">Jumlah Buku</div>
                <h3>{{ $jumlahBuku }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">Total Peminjaman</div>
                <h3>{{ $jumlahPeminjaman }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">Masih Dipinjam</div>
                <h3>{{ $masihDipinjam }}</h3>
            </div>
        </div>
    </div>
    @if (auth()->user()->isAdmin())
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-muted">Jumlah User</div>
                    <h3>{{ $jumlahUser }}</h3>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
