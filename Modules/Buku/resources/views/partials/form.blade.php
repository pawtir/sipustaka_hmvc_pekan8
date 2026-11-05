<div class="mb-3">
    <label for="judul" class="form-label">Judul</label>
    <input type="text" id="judul" name="judul" value="{{ old('judul', $buku?->judul) }}"
           class="form-control @error('judul') is-invalid @enderror">
    @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="penulis" class="form-label">Penulis</label>
    <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $buku?->penulis) }}"
           class="form-control @error('penulis') is-invalid @enderror">
    @error('penulis') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="penerbit" class="form-label">Penerbit</label>
    <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit', $buku?->penerbit) }}"
           class="form-control @error('penerbit') is-invalid @enderror">
    @error('penerbit') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
    <input type="number" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', $buku?->tahun_terbit) }}"
           class="form-control @error('tahun_terbit') is-invalid @enderror">
    @error('tahun_terbit') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="stok" class="form-label">Stok</label>
    <input type="number" id="stok" name="stok" value="{{ old('stok', $buku?->stok) }}"
           class="form-control @error('stok') is-invalid @enderror">
    @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
