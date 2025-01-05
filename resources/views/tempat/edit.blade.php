@extends('layouts.dashboard')

@section('title', 'Edit Tempat')

@section('content')
<div class="container">
    <div class="card">
        <!-- Header Card -->
        <div class="card-header">
            <h3 class="card-title">Edit Tempat</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body">
            <form action="{{ route('tempat.update', $tempat->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label for="name">Nama Tempat</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                placeholder="Isi nama tempat"
                                value="{{ old('name', $tempat->name) }}"
                                required
                            />
                        </div>

                        <div class="form-group form-group-default">
                            <label for="alamat">Alamat</label>
                            <input
                                type="text"
                                id="alamat"
                                name="alamat"
                                class="form-control"
                                placeholder="Isi alamat tempat (opsional)"
                                value="{{ old('alamat', $tempat->alamat) }}"
                            />
                        </div>

                        <div class="form-group form-group-default">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="tersedia" {{ old('status', $tempat->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="sedang digunakan" {{ old('status', $tempat->status) == 'sedang digunakan' ? 'selected' : '' }}>Sedang Digunakan</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer text-first">
                        <button type="submit" class="btn btn-success">Ubah</button>
                        <a href="{{ route('tempat.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
