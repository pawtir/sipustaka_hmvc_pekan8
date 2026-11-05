@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="card" style="max-width: 600px;">
    <div class="card-header">Tambah User</div>
    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            @include('usermanagement::partials.form', ['user' => null])

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
