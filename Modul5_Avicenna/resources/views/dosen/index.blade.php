@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1 class="h3 text-gray-800">Daftar Dosen</h1>
            <p class="text-muted mb-0">Kelola informasi data dosen</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('dosen.create') }}" class="btn btn-primary shadow-sm">
                <i class="material-symbols-rounded align-middle me-2">add</i>
                <span>Tambah Dosen Baru</span>
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

    {{-- Dosen Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th class="fw-bold ps-4">No</th>
                            <th class="fw-bold">Kode Dosen</th>
                            <th class="fw-bold">Nama Dosen</th>
                            <th class="fw-bold">NIP</th>
                            <th class="fw-bold">Email</th>
                            <th class="fw-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dosens as $dosen)
                            <tr class="align-middle">
                                <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                                <td>{{ $dosen->kode_dosen }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary text-white me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            {{ substr($dosen->nama_dosen, 0, 1) }}
                                        </div>
                                        {{ $dosen->nama_dosen }}
                                    </div>
                                </td>
                                <td>{{ $dosen->nip }}</td>
                                <td>{{ $dosen->email }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('dosen.show', $dosen->id) }}" class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip" title="Lihat Detail">
                                            <i class="material-symbols-rounded fs-6">visibility</i>
                                        </a>
                                        <a href="{{ route('dosen.edit', $dosen->id) }}" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="Edit">
                                            <i class="material-symbols-rounded fs-6">edit</i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-dosen" data-id="{{ $dosen->id }}" data-bs-toggle="tooltip" title="Hapus">
                                            <i class="material-symbols-rounded fs-6">delete</i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="material-symbols-rounded fs-2 d-block mb-2">info</i>
                                    Tidak ada data dosen
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
<div class="modal fade" id="deleteDosenModal" tabindex="-1" aria-labelledby="deleteDosenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteDosenModalLabel">Konfirmasi Hapus Dosen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data dosen ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteDosenForm" method="POST">
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
    // Delete Dosen Confirmation
    const deleteButtons = document.querySelectorAll('.delete-dosen');
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteDosenModal'));
    const deleteForm = document.getElementById('deleteDosenForm');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const dosenId = this.dataset.id;
            deleteForm.action = `/dosen/${dosenId}`;
            deleteModal.show();
        });
    });

    // Tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
});
</script>
@endpush