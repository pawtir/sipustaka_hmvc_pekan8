<div class="mb-3">
    <label for="name" class="form-label">Nama</label>
    <input type="text" id="name" name="name" value="{{ old('name', $user?->name) }}"
           class="form-control @error('name') is-invalid @enderror">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email', $user?->email) }}"
           class="form-control @error('email') is-invalid @enderror">
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="role" class="form-label">Role</label>
    <select id="role" name="role" class="form-select @error('role') is-invalid @enderror">
        <option value="user" @selected(old('role', $user?->role) === 'user')>User</option>
        <option value="admin" @selected(old('role', $user?->role) === 'admin')>Admin</option>
    </select>
    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">
        Password {{ $user ? '(kosongkan jika tidak diganti)' : '' }}
    </label>
    <input type="password" id="password" name="password"
           class="form-control @error('password') is-invalid @enderror">
    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
</div>
