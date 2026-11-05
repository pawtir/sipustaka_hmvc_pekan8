@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="card" style="max-width: 600px;">
    <div class="card-header">Edit User</div>
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            @include('usermanagement::partials.form', ['user' => $user])

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
