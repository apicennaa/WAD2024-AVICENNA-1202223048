@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1 class="h3 text-gray-800">Daftar Mahasiswa</h1>
            <p class="text-muted mb-0">Kelola informasi data mahasiswa</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary shadow-sm">
                <i class="material-symbols-rounded align-middle me-2">add</i>
                <span>Tambah Mahasiswa Baru</span>
            </a>
        </div>
    </div>

    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="material-symbols-rounded me-3">check_circle</i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    {{-- Mahasiswa Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th class="fw-bold ps-4">No</th>
                            <th class="fw-bold">NIM</th>
                            <th class="fw-bold">Nama Mahasiswa</th>
                            <th class="fw-bold">Email</th>
                            <th class="fw-bold">Jurusan</th>
                            <th class="fw-bold">Dosen Pengampu</th>
                            <th class="fw-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswas as $mahasiswa)
                            <tr class="align-middle">
                                <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                                <td>{{ $mahasiswa->nim }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary text-white me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            {{ substr($mahasiswa->nama_mahasiswa, 0, 1) }}
                                        </div>
                                        {{ $mahasiswa->nama_mahasiswa }}
                                    </div>
                                </td>
                                <td>{{ $mahasiswa->email }}</td>
                                <td>
                                    <span class="badge bg-soft-primary text-primary">
                                        {{ $mahasiswa->jurusan }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswa->dosen)
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-success text-white me-2 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                                {{ substr($mahasiswa->dosen->nama_dosen, 0, 1) }}
                                            </div>
                                            {{ $mahasiswa->dosen->nama_dosen }}
                                        </div>
                                    @else
                                        <span class="badge bg-soft-warning text-warning">Belum Ada</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip" title="Lihat Detail">
                                            <i class="material-symbols-rounded fs-6">visibility</i>
                                        </a>
                                        <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="Edit">
                                            <i class="material-symbols-rounded fs-6">edit</i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-mahasiswa" data-id="{{ $mahasiswa->id }}" data-bs-toggle="tooltip" title="Hapus">
                                            <i class="material-symbols-rounded fs-6">delete</i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="material-symbols-rounded fs-2 d-block mb-2">info</i>
                                    Tidak ada data mahasiswa
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteMahasiswaModal" tabindex="-1" aria-labelledby="deleteMahasiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMahasiswaModalLabel">Konfirmasi Hapus Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data mahasiswa ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteMahasiswaForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete Mahasiswa Confirmation
    const deleteButtons = document.querySelectorAll('.delete-mahasiswa');
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteMahasiswaModal'));
    const deleteForm = document.getElementById('deleteMahasiswaForm');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const mahasiswaId = this.dataset.id;
            deleteForm.action = `/mahasiswa/${mahasiswaId}`;
            deleteModal.show();
        });
    });

    // Tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
});
</script>
@endpush