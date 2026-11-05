@extends('layouts.app')

@section('title', 'Data Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Data Buku</h4>
    @if (auth()->user()->isAdmin())
        <a href="{{ route('buku.create') }}" class="btn btn-primary">+ Tambah Buku</a>
    @endif
</div>

<form action="{{ route('buku.index') }}" method="GET" class="mb-3">
    <div class="input-group" style="max-width: 400px;">
        <input type="text" name="cari" value="{{ $cari }}" class="form-control" placeholder="Cari judul, penulis, atau penerbit">
        <button type="submit" class="btn btn-secondary">Cari</button>
    </div>
</form>

<table class="table table-bordered bg-white">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Stok</th>
            @if (auth()->user()->isAdmin())
                <th>Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse ($bukus as $buku)
            <tr>
                <td>{{ $bukus->firstItem() + $loop->index }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ $buku->penerbit }}</td>
                <td>{{ $buku->tahun_terbit }}</td>
                <td>{{ $buku->stok }}</td>
                @if (auth()->user()->isAdmin())
                    <td>
                        <a href="{{ route('buku.edit', $buku) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</button>
                        </form>
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Data buku tidak ditemukan.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $bukus->links() }}
@endsection
