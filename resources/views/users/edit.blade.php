@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('content')
<div class="container">
    <div class="card">
        <!-- Header Card -->
        <div class="card-header">
            <h3 class="card-title">Edit User</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Error Validation -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label for="name">Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $user->name) }}"
                                required
                            />
                        </div>

                        <div class="form-group form-group-default">
                            <label for="nip">NIP</label>
                            <input
                                type="text"
                                id="nip"
                                name="nip"
                                class="form-control"
                                value="{{ old('nip', $user->nip) }}"
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
                                placeholder="kosongkan jika tidak ingin merubah password"
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
                                    <option value="{{ $group->id }}" {{ $group->id == $user->group_id ? 'selected' : '' }}>
                                        {{ $group->name }}
                                    </option>
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
                        <div class="mt-3">
                            <label class="form-label">Preview Photo:</label>
                            <img
                                id="photo-preview"
                                src="{{ $user->photo ? asset('assets/img/profil/' . $user->photo) : asset('assets/img/profil/default.png') }}"
                                alt="Preview Photo"
                                class="rounded"
                                style="display: ; width: 100px; height: 100px; object-fit: cover; border: 1px solid #ddd;"
                            />
                        </div>
                    </div>
                </div>
                <div class="card-footer text-first">
                    <button type="submit" class="btn btn-success">Ubah</button>
                    <a href="{{ route('users.index') }}" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Fungsi untuk menampilkan preview foto baru
    function previewPhoto(event) {
        const photoInput = event.target;
        const photoPreview = document.getElementById('photo-preview');
        const file = photoInput.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                photoPreview.src = e.target.result; // Tampilkan foto baru
            };

            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
