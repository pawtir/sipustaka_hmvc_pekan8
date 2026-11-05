@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
<div class="card" style="max-width: 600px;">
    <div class="card-header">Edit Buku</div>
    <div class="card-body">
        <form action="{{ route('buku.update', $buku) }}" method="POST">
            @csrf
            @method('PUT')
            @include('buku::partials.form', ['buku' => $buku])

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('buku.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
