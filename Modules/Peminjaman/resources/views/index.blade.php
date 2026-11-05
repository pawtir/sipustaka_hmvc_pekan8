@extends('layouts.app')

@section('title', 'Peminjaman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Data Peminjaman</h4>
    <button type="button" class="btn btn-primary" id="btnTambah">+ Tambah Peminjaman</button>
</div>

<div id="pesan"></div>

<table class="table table-bordered bg-white" id="tabel">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Bukti</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="8" class="text-center">Memuat data...</td>
        </tr>
    </tbody>
</table>

<div class="modal fade" id="modalPeminjaman" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Tambah Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formPeminjaman">
                    @csrf
                    <input type="hidden" id="id">

                    <div class="mb-3">
                        <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                        <input type="text" id="nama_peminjam" name="nama_peminjam" class="form-control">
                        <div class="invalid-feedback" id="error-nama_peminjam"></div>
                    </div>

                    <div class="mb-3">
                        <label for="judul_buku" class="form-label">Judul Buku</label>
                        <input type="text" id="judul_buku" name="judul_buku" class="form-control">
                        <div class="invalid-feedback" id="error-judul_buku"></div>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control">
                        <div class="invalid-feedback" id="error-tanggal_pinjam"></div>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                        <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control">
                        <div class="invalid-feedback" id="error-tanggal_kembali"></div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select">
                            <option value="Dipinjam">Dipinjam</option>
                            <option value="Dikembalikan">Dikembalikan</option>
                        </select>
                        <div class="invalid-feedback" id="error-status"></div>
                    </div>

                    <div class="mb-3">
                        <label for="bukti" class="form-label">Bukti Peminjaman (jpg, png, pdf, maks. 2 MB)</label>
                        <div class="small mb-1" id="buktiLama"></div>
                        <input type="file" id="bukti" name="bukti" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        <div class="invalid-feedback" id="error-bukti"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    const url = {
        data: "{{ route('peminjaman.data') }}",
        store: "{{ route('peminjaman.store') }}",
        edit: "{{ route('peminjaman.edit', ':id') }}",
        update: "{{ route('peminjaman.update', ':id') }}",
        destroy: "{{ route('peminjaman.destroy', ':id') }}"
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });

    const modal = new bootstrap.Modal(document.getElementById('modalPeminjaman'));

    function esc(teks) {
        return $('<div>').text(teks ?? '').html();
    }

    function tampilPesan(pesan, tipe = 'success') {
        $('#pesan').html('<div class="alert alert-' + tipe + '">' + esc(pesan) + '</div>');
        setTimeout(function () {
            $('#pesan').html('');
        }, 3000);
    }

    function hapusError() {
        $('#formPeminjaman .is-invalid').removeClass('is-invalid');
        $('#formPeminjaman .invalid-feedback').text('');
    }

    function linkBukti(item) {
        if (!item.bukti_url) {
            return '-';
        }
        return '<a href="' + item.bukti_url + '" target="_blank">' + esc(item.nama_bukti) + '</a>';
    }

    function muatData() {
        $.get(url.data, function (data) {
            if (data.length === 0) {
                $('#tabel tbody').html('<tr><td colspan="8" class="text-center">Belum ada data peminjaman.</td></tr>');
                return;
            }

            let baris = '';
            data.forEach(function (item, i) {
                baris += '<tr>'
                    + '<td>' + (i + 1) + '</td>'
                    + '<td>' + esc(item.nama_peminjam) + '</td>'
                    + '<td>' + esc(item.judul_buku) + '</td>'
                    + '<td>' + esc(item.tanggal_pinjam) + '</td>'
                    + '<td>' + esc(item.tanggal_kembali) + '</td>'
                    + '<td>' + esc(item.status) + '</td>'
                    + '<td>' + linkBukti(item) + '</td>'
                    + '<td>'
                    + '<button type="button" class="btn btn-warning btn-sm btn-edit" data-id="' + item.id + '">Edit</button> '
                    + '<button type="button" class="btn btn-danger btn-sm btn-hapus" data-id="' + item.id + '">Hapus</button>'
                    + '</td>'
                    + '</tr>';
            });

            $('#tabel tbody').html(baris);
        }).fail(function () {
            $('#tabel tbody').html('<tr><td colspan="8" class="text-center text-danger">Gagal memuat data.</td></tr>');
        });
    }

    muatData();

    $('#btnTambah').on('click', function () {
        $('#formPeminjaman')[0].reset();
        $('#id').val('');
        $('#buktiLama').html('');
        hapusError();
        $('#judulModal').text('Tambah Peminjaman');
        modal.show();
    });

    $('#formPeminjaman').on('submit', function (e) {
        e.preventDefault();
        $('#btnSimpan').trigger('click');
    });

    $('#btnSimpan').on('click', function () {
        const id = $('#id').val();

        const formData = new FormData($('#formPeminjaman')[0]);
        if (id) {
            formData.append('_method', 'PUT');
        }

        hapusError();
        $('#btnSimpan').prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: id ? url.update.replace(':id', id) : url.store,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                modal.hide();
                muatData();
                tampilPesan(res.success);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function (field, pesan) {
                        $('#' + field).addClass('is-invalid');
                        $('#error-' + field).text(pesan[0]);
                    });
                } else {
                    modal.hide();
                    tampilPesan('Terjadi kesalahan, silakan coba lagi.', 'danger');
                }
            },
            complete: function () {
                $('#btnSimpan').prop('disabled', false).text('Simpan');
            }
        });
    });

    $(document).on('click', '.btn-edit', function () {
        const id = $(this).data('id');

        $.get(url.edit.replace(':id', id), function (item) {
            $('#formPeminjaman')[0].reset();
            hapusError();
            $('#id').val(item.id);
            $('#nama_peminjam').val(item.nama_peminjam);
            $('#judul_buku').val(item.judul_buku);
            $('#tanggal_pinjam').val(item.tanggal_pinjam);
            $('#tanggal_kembali').val(item.tanggal_kembali);
            $('#status').val(item.status);
            $('#buktiLama').html(item.bukti_url
                ? 'Bukti saat ini: ' + linkBukti(item) + ' (kosongkan jika tidak diganti)'
                : '');
            $('#judulModal').text('Edit Peminjaman');
            modal.show();
        }).fail(function () {
            tampilPesan('Gagal mengambil data.', 'danger');
        });
    });

    $(document).on('click', '.btn-hapus', function () {
        if (!confirm('Yakin ingin menghapus data peminjaman ini?')) {
            return;
        }

        const id = $(this).data('id');

        $.ajax({
            url: url.destroy.replace(':id', id),
            type: 'DELETE',
            success: function (res) {
                muatData();
                tampilPesan(res.success);
            },
            error: function () {
                tampilPesan('Gagal menghapus data.', 'danger');
            }
        });
    });
});
</script>
@endpush
