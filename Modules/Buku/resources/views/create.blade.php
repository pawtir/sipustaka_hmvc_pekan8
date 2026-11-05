@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
<div class="card" style="max-width: 600px;">
    <div class="card-header">Tambah Buku</div>
    <div class="card-body">
        <form action="{{ route('buku.store') }}" method="POST">
            @csrf
            @include('buku::partials.form', ['buku' => null])

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('buku.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
