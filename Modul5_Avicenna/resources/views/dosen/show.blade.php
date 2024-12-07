@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #3498db;
        --secondary-color: #2ecc71;
        --bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    body {
        background: var(--bg-gradient);
        font-family: 'Poppins', sans-serif;
    }

    .dosen-detail-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 30px;
    }

    .dosen-card {
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .dosen-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }

    .dosen-header {
        background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
        color: white;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .dosen-header-content {
        display: flex;
        align-items: center;
    }

    .dosen-header-content i {
        margin-right: 15px;
        font-size: 2.5rem;
    }

    .dosen-body {
        padding: 30px;
        background: white;
    }

    .form-group-custom {
        margin-bottom: 20px;
        position: relative;
    }

    .form-label-custom {
        display: flex;
        align-items: center;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 10px;
    }

    .form-label-custom i {
        margin-right: 10px;
        color: var(--primary-color);
    }

    .input-custom {
        border: none;
        border-bottom: 2px solid #e9ecef;
        padding: 10px 0;
        transition: border-color 0.3s ease;
    }

    .input-custom:focus {
        outline: none;
        border-bottom-color: var(--primary-color);
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .btn-custom {
        display: flex;
        align-items: center;
        gap: 10px;
        border-radius: 50px;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }

    .btn-custom i {
        transition: transform 0.3s ease;
    }

    .btn-custom:hover i {
        transform: translateX(-5px);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animated-entry {
        animation: fadeIn 0.6s ease forwards;
        opacity: 0;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

<div class="dosen-detail-container">
    {{-- Action Buttons --}}
    <div class="action-buttons animated-entry" style="animation-delay: 0.2s;">
        <a href="{{ route('dosen.index') }}" class="btn btn-custom btn-outline-primary">
            <i class="ri-arrow-left-line"></i> Daftar Dosen
        </a>
        <a href="{{ route('dosen.edit', $dosen->id) }}" class="btn btn-custom btn-outline-primary">
            <i class="ri-edit-line"></i> Edit
        </a>
        <form action="{{ route('dosen.destroy', $dosen->id) }}" method="post" class="d-inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-custom btn-outline-danger">
                <i class="ri-delete-bin-line"></i> Hapus
            </button>
        </form>
    </div>

    {{-- Dosen Detail Card --}}
    <div class="card dosen-card animated-entry" style="animation-delay: 0.4s;">
        <div class="dosen-header">
            <div class="dosen-header-content">
                <i class="ri-user-teacher-line"></i>
                <h4 class="mb-0">Detail Informasi Dosen</h4>
            </div>
        </div>
        <div class="dosen-body">
            <div class="form-group-custom">
                <label for="kode_dosen" class="form-label-custom">
                    <i class="ri-key-line"></i> Kode Dosen
                </label>
                <input type="text" class="form-control input-custom" id="kode_dosen" 
                       value="{{ $dosen->kode_dosen }}" disabled>
            </div>

            <div class="form-group-custom">
                <label for="nama_dosen" class="form-label-custom">
                    <i class="ri-user-line"></i> Nama Dosen
                </label>
                <input type="text" class="form-control input-custom" id="nama_dosen" 
                       value="{{ $dosen->nama_dosen }}" disabled>
            </div>

            <div class="form-group-custom">
                <label for="nip" class="form-label-custom">
                    <i class="ri-id-card-line"></i> NIP
                </label>
                <input type="text" class="form-control input-custom" id="nip" 
                       value="{{ $dosen->nip }}" disabled>
            </div>

            <div class="form-group-custom">
                <label for="email" class="form-label-custom">
                    <i class="ri-mail-line"></i> Email
                </label>
                <input type="email" class="form-control input-custom" id="email" 
                       value="{{ $dosen->email }}" disabled>
            </div>

            <div class="form-group-custom">
                <label for="no_telepon" class="form-label-custom">
                    <i class="ri-phone-line"></i> Nomor Telepon
                </label>
                <input type="text" class="form-control input-custom" id="no_telepon" 
                       value="{{ $dosen->no_telepon }}" disabled>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Optional: Add sweet alert for delete confirmation
        const deleteForm = document.querySelector('form[action^="{{ route('dosen.destroy', $dosen->id) }}"]');
        deleteForm.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data dosen akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endpush
@endsection