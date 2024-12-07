<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DosenController;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $mahasiswas = Mahasiswa::all();
        $nav = 'Daftar Mahasiswa';

        return view('mahasiswa.index', compact('mahasiswas', 'nav'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $dosens = Dosen::all(); // Mengambil semua data dosen
        return view('mahasiswa.create', compact('dosens'));
        $nav = 'Tambah Mahasiswa';
        return view('mahasiswa.create', compact('nav'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMahasiswaRequest $request)
    {
        //
        Mahasiswa::create($request->validated());

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data mahasiswa beserta dosen pembimbingnya
        $mahasiswa = Mahasiswa::with('dosen')->findOrFail($id);

        // Tambahkan variable $nav
        $nav = 'Detail Mahasiswa - ' . $mahasiswa->nama_mahasiswa;

        // Kirim data ke view
        return view('mahasiswa.show', compact('mahasiswa', 'nav'));
    }

    

    /**
     * Show the form for editing the specified resource.
     */
        public function edit($id)
    {
        $dosens = Dosen::all(); // Ambil semua data dosen untuk dropdown
        $mahasiswa = Mahasiswa::findOrFail($id); // Ambil data mahasiswa berdasarkan ID
        $nav = 'Edit Mahasiswa';

        return view('mahasiswa.edit', compact('mahasiswa', 'dosens', 'nav'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        // Validasi dan update data mahasiswa
        $mahasiswa->update($request->all());

        // Redirect setelah berhasil update
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
        $mahasiswa->delete();
        
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }
}
