@extends('layouts.dashboard')

@section('title', 'Tambah Tempat')

@section('content')
<div class="container">
    <div class="card">
        <!-- Header Card -->
        <div class="card-header">
            <h3 class="card-title">Tambah Tempat</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body">
            <form action="{{ route('tempat.store') }}" method="POST">
                @csrf
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
                            />
                        </div>

                        <div class="form-group form-group-default">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="tersedia">Tersedia</option>
                                <option value="sedang digunakan">Sedang Digunakan</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer text-first">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('tempat.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
