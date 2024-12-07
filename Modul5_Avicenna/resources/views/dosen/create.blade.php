@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4 align-items-center">
        <div class="col-auto">
            <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary shadow-sm me-2">
                <i class="material-symbols-rounded align-middle">arrow_back</i>
            </a>
        </div>
        <div class="col">
            <h1 class="h3 text-gray-800 mb-1">Tambah Dosen Baru</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dosen.index') }}">Daftar Dosen</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Dosen</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-xl-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('dosen.store') }}" method="post" id="dosenForm" novalidate>
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" 
                                           class="form-control @error('kode_dosen') is-invalid @enderror" 
                                           id="kode_dosen" 
                                           name="kode_dosen" 
                                           placeholder="Kode Dosen" 
                                           maxlength="3" 
                                           value="{{ old('kode_dosen') }}"
                                           required
                                           pattern="[A-Z]{3}"
                                           data-bs-toggle="tooltip"
                                           title="Gunakan 3 huruf kapital (contoh: DSN)">
                                    <label for="kode_dosen">Kode Dosen</label>
                                    @error('kode_dosen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" 
                                           class="form-control @error('nama_dosen') is-invalid @enderror" 
                                           id="nama_dosen" 
                                           name="nama_dosen" 
                                           placeholder="Nama Dosen" 
                                           value="{{ old('nama_dosen') }}"
                                           required>
                                    <label for="nama_dosen">Nama Lengkap</label>
                                    @error('nama_dosen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" 
                                           class="form-control @error('nip') is-invalid @enderror" 
                                           id="nip" 
                                           name="nip" 
                                           placeholder="NIP" 
                                           value="{{ old('nip') }}"
                                           required
                                           pattern="\d{18}"
                                           data-bs-toggle="tooltip"
                                           title="Gunakan 18 digit angka NIP">
                                    <label for="nip">Nomor Induk Pegawai (NIP)</label>
                                    @error('nip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           placeholder="Email" 
                                           value="{{ old('email') }}"
                                           required>
                                    <label for="email">Alamat Email</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="tel" 
                                           class="form-control @error('no_telepon') is-invalid @enderror" 
                                           id="no_telepon" 
                                           name="no_telepon" 
                                           placeholder="Nomor Telepon" 
                                           value="{{ old('no_telepon') }}"
                                           required
                                           pattern="\+?[0-9]{10,13}"
                                           data-bs-toggle="tooltip"
                                           title="Gunakan 10-13 digit angka">
                                    <label for="no_telepon">Nomor Telepon</label>
                                    @error('no_telepon')
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
                            Kode Dosen harus 3 huruf kapital
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="material-symbols-rounded text-primary me-2 small">check_circle</i>
                            NIP terdiri dari 18 digit
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="material-symbols-rounded text-primary me-2 small">check_circle</i>
                            Gunakan email institusi jika memungkinkan
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="material-symbols-rounded text-primary me-2 small">check_circle</i>
                            Pastikan data yang dimasukkan akurat
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

    const form = document.getElementById('dosenForm');
    
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        form.classList.add('was-validated');
    }, false);

    const nipInput = document.getElementById('nip');
    const kodeDosenInput = document.getElementById('kode_dosen');
    const noTeleponInput = document.getElementById('no_telepon');

    nipInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 18);
    });

    kodeDosenInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^A-Z]/g, '').slice(0, 3).toUpperCase();
    });

    noTeleponInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9+]/g, '').slice(0, 13);
    });

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
});
</script>
@endpush