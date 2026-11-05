<?php

namespace Modules\Peminjaman\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Peminjaman\Http\Requests\PeminjamanRequest;
use Modules\Peminjaman\Models\Peminjaman;

class PeminjamanController extends Controller
{
    public function index()
    {
        return view('peminjaman::index');
    }

    public function data()
    {
        return response()->json(Peminjaman::latest()->get());
    }

    public function store(PeminjamanRequest $request)
    {
        $data = $request->safe()->except('bukti');

        $file = $request->file('bukti');
        $data['bukti'] = $file->store('bukti_peminjaman', 'public');
        $data['nama_bukti'] = $file->getClientOriginalName();

        Peminjaman::create($data);

        return response()->json(['success' => 'Data peminjaman berhasil disimpan.']);
    }

    public function edit(Peminjaman $peminjaman)
    {
        return response()->json($peminjaman);
    }

    public function update(PeminjamanRequest $request, Peminjaman $peminjaman)
    {
        $data = $request->safe()->except('bukti');

        if ($request->hasFile('bukti')) {
            if ($peminjaman->bukti) {
                Storage::disk('public')->delete($peminjaman->bukti);
            }

            $file = $request->file('bukti');
            $data['bukti'] = $file->store('bukti_peminjaman', 'public');
            $data['nama_bukti'] = $file->getClientOriginalName();
        }

        $peminjaman->update($data);

        return response()->json(['success' => 'Data peminjaman berhasil diperbarui.']);
    }

    public function destroy(Peminjaman $peminjaman)
    {
        if ($peminjaman->bukti) {
            Storage::disk('public')->delete($peminjaman->bukti);
        }

        $peminjaman->delete();

        return response()->json(['success' => 'Data peminjaman berhasil dihapus.']);
    }
}
