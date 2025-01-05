@extends('layouts.dashboard')

@section('title', 'Group List')

@section('content')
<div class="container-fluid groups-page">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex align-items-center mb-3">
                <h4 class="card-title text-light">Daftar Group</h4>
                <a href="{{ route('groups.create') }}" class="btn btn-primary btn-round ms-auto">
                    <i class="fa fa-plus"></i> Tambah Group Baru
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($groups as $group)
            <div class="col-md-4">
                <div class="card group-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $group->name }}</h5>
                        <p class="card-text">
                            <strong>ID:</strong> {{ $group->id }} <br>
                            <strong>Tugas:</strong> {{ $group->tugas ?? '-' }}
                        </p>
                        <div class="justify-content-between">
                            <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $group->id }}">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Delete -->
            <div class="modal fade" id="deleteModal-{{ $group->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $group->id }}" aria-hidden="true">
                <div class="modal-dialog text-dark">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel-{{ $group->id }}">Konfirmasi Penghapusan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-dark">
                            Apa kamu yakin mau menghapus grup ini "{{ $group->name }}"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <form action="{{ route('groups.destroy', $group->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
