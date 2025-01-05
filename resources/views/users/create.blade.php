@extends('layouts.dashboard')

@section('title', 'Create User')

@section('content')
<div class="container">
    <div class="card">
        <!-- Header Card -->
        <div class="card-header">
            <h3 class="card-title">Tambah User</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label for="name">Nama Lengkap</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                placeholder="isi nama lengkap"
                                required
                            />
                        </div>

                        <div class="form-group form-group-default">
                            <label for="nip">NIP/NIK</label>
                            <input
                                type="text"
                                id="nip"
                                name="nip"
                                class="form-control"
                                placeholder="isi NIP/NIK"
                                required
                            />
                        </div>

                        <div class="form-group form-group-default">
                            <label for="password">Password</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="isi password"
                                required
                            />
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label for="group_id">Group</label>
                            <select
                                class="form-select"
                                id="group_id"
                                name="group_id"
                                required
                            >
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="photo" class="form-label">Photo</label>
                            <input
                                type="file"
                                id="photo"
                                name="photo"
                                class="form-control"
                                accept="image/*"
                                onchange="previewPhoto(event)"
                            />
                            <small class="form-text text-muted">Unggah file dengan format jpeg,png,jpg,gif|max:2 MB</small>
                        </div>

                        <!-- Tempat Preview Foto -->
                        <div class="form-group mt-3">
                            <label for="preview" class="form-label">Preview Photo:</label>
                            <img
                                id="photo-preview"
                                src="#"
                                alt="Preview Photo"
                                class="rounded"
                                style="display: none; width: 100px; height: 100px; object-fit: cover; border: 1px solid #ddd;"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-footer text-first">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('users.index') }}" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Fungsi untuk menampilkan preview foto
    function previewPhoto(event) {
        const photoInput = event.target;
        const photoPreview = document.getElementById('photo-preview');
        const file = photoInput.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                photoPreview.src = e.target.result;
                photoPreview.style.display = 'block'; // Tampilkan preview
            };

            reader.readAsDataURL(file);
        } else {
            photoPreview.style.display = 'none'; // Sembunyikan preview
        }
    }
</script>
@endsection
