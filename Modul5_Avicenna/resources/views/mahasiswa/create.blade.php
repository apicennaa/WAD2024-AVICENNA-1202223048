@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4 align-items-center">
        <div class="col-auto">
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary shadow-sm me-2">
                <i class="material-symbols-rounded align-middle">arrow_back</i>
            </a>
        </div>
        <div class="col">
            <h1 class="h3 text-gray-800 mb-1">Tambah Mahasiswa Baru</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('mahasiswa.index') }}">Daftar Mahasiswa</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Mahasiswa</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-xl-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('mahasiswa.store') }}" method="post" id="mahasiswaForm" novalidate>
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" 
                                           class="form-control @error('nim') is-invalid @enderror" 
                                           id="nim" 
                                           name="nim" 
                                           placeholder="NIM" 
                                           value="{{ old('nim') }}"
                                           required
                                           pattern="\d{10}"
                                           data-bs-toggle="tooltip"
                                           title="Gunakan 10 digit angka NIM">
                                    <label for="nim">NIM</label>
                                    @error('nim')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" 
                                           class="form-control @error('nama_mahasiswa') is-invalid @enderror" 
                                           id="nama_mahasiswa" 
                                           name="nama_mahasiswa" 
                                           placeholder="Nama Mahasiswa" 
                                           value="{{ old('nama_mahasiswa') }}"
                                           required>
                                    <label for="nama_mahasiswa">Nama Lengkap</label>
                                    @error('nama_mahasiswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           placeholder="Email" 
                                           value="{{ old('email') }}"
                                           required>
                                    <label for="email">Alamat Email Mahasiswa</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" 
                                           class="form-control @error('jurusan') is-invalid @enderror" 
                                           id="jurusan" 
                                           name="jurusan" 
                                           placeholder="Jurusan" 
                                           value="{{ old('jurusan') }}"
                                           required
                                           data-bs-toggle="tooltip"
                                           title="Pilih/Tulis Jurusan">
                                    <label for="jurusan">Program Studi</label>
                                    @error('jurusan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('dosen_id') is-invalid @enderror" 
                                            id="dosen_id" 
                                            name="dosen_id" 
                                            required
                                            data-bs-toggle="tooltip"
                                            title="Pilih Dosen Pengampu">
                                        <option value="" disabled selected>Pilih Dosen Pengampu</option>
                                        @foreach ($dosens as $dosen)
                                            <option value="{{ $dosen->id }}" 
                                                {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                                {{ $dosen->nama_dosen }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="dosen_id">Dosen Wali</label>
                                    @error('dosen_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="reset" class="btn btn-outline-secondary me-2">
                                <i class="material-symbols-rounded align-middle me-1">restart_alt</i>
                                Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="material-symbols-rounded align-middle me-1">save</i>
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Informasi Tambahan --}}
        <div class="col-lg-4 col-xl-6 d-none d-lg-block">
            <div class="card shadow-sm border-0 bg-soft-primary">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="material-symbols-rounded fs-2 text-primary me-3">info</i>
                        <h5 class="mb-0">Informasi Penting</h5>
                    </div>
                    <ul class="list-unstyled">
                        <li class="mb-2 d-flex align-items-center">
                            <i class="material-symbols-rounded text-primary me-2 small">check_circle</i>
                            NIM harus 10 digit angka
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="material-symbols-rounded text-primary me-2 small">check_circle</i>
                            Gunakan email institusi jika memungkinkan
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="material-symbols-rounded text-primary me-2 small">check_circle</i>
                            Pastikan memilih dosen wali yang sesuai
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="material-symbols-rounded text-primary me-2 small">check_circle</i>
                            Periksa kembali data sebelum disimpan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form Validation
    const form = document.getElementById('mahasiswaForm');
    
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        form.classList.add('was-validated');
    }, false);

    const nimInput = document.getElementById('nim');

    nimInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
    });

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
});
</script>
@endpush