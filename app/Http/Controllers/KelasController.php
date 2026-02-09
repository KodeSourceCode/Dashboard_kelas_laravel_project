<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $kelas = Kelas::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('nama_kelas', 'LIKE', "%{$query}%");
        })->get();
        return view('kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'wali_kelas' => 'required|string|max:255',
            'ketua_kelas' => 'required|string|max:255',
            'kursi' => 'required|integer|min:1',
            'meja' => 'required|integer|min:1',
            'gambar_kelas' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $namaFile = null;
        if ($request->hasFile('gambar_kelas')) {
            $file = $request->file('gambar_kelas');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $namaFile);
        }
        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'wali_kelas' => $request->wali_kelas,
            'ketua_kelas' => $request->ketua_kelas,
            'kursi' => $request->kursi,
            'meja' => $request->meja,
            'gambar_kelas' => $namaFile,
        ]);
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'wali_kelas' => 'required|string|max:255',
            'ketua_kelas' => 'required|string|max:255',
            'kursi' => 'required|integer|min:1',
            'meja' => 'required|integer|min:1',
            'gambar_kelas' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $namaFile = $kelas->gambar_kelas;
        if ($request->hasFile('gambar_kelas')) {
            if ($kelas->gambar_kelas && file_exists(public_path('images/' . $kelas->gambar_kelas))) {
                $filePath = public_path('images/' . $kelas->gambar_kelas);
                unlink($filePath);
            }

            $file = $request->file('gambar_kelas');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $namaFile);
        }
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'wali_kelas' => $request->wali_kelas,
            'ketua_kelas' => $request->ketua_kelas,
            'kursi' => $request->kursi,
            'meja' => $request->meja,
            'gambar_kelas' => $namaFile,
        ]);
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        if ($kelas->gambar_kelas && file_exists(public_path('images/' . $kelas->gambar_kelas))) {
            $filePath = public_path('images/' . $kelas->gambar_kelas);
            unlink($filePath);
        }
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus!');
    }
}
