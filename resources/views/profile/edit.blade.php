@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="card">
        <!-- Header Card -->
        <div class="card-header">
            <h3 class="card-title">Edit Profile</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update', $user->nip) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label for="name">Name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ $user->name }}"
                                class="form-control"
                                required
                            />
                        </div>

                        <div class="form-group">
                            <label for="photo" class="form-label">Photo</label>
                            <input
                                type="file"
                                id="photo"
                                name="photo"
                                class="form-control"
                                accept="image/*"
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

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label for="password">New Password</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="kosongkan jika tidak ingin merubah password"
                            />
                        </div>

                        <div class="form-group form-group-default">
                            <label for="password_confirmation">Confirm Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control"
                                placeholder="kosongkan jika tidak ingin merubah password"
                            />
                        </div>
                    </div>
                </div>
        </div>

        <!-- Footer Card -->
        <div class="card-footer text-first">
            <button type="submit" class="btn btn-success">Ubah</button>
            <!-- Tombol Cancel, kembali ke halaman profil sesuai NIP -->
            <a href="{{ route('profile.show', ['nip' => $user->nip]) }}" class="btn btn-danger">Cancel</a>
        </div>


        </form>
    </div>
</div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photo-preview');

    photoInput.addEventListener('change', function (event) {
        const file = event.target.files[0]; // Ambil file yang diunggah

        // Validasi tipe file
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function (e) {
                // Set preview image src ke hasil pembacaan file
                photoPreview.src = e.target.result;
            };

            reader.readAsDataURL(file); // Membaca file sebagai URL data
        } else {
            alert('Please upload a valid image file (e.g., .jpg, .png, .jpeg).');
            photoInput.value = ''; // Reset input file
            photoPreview.src = "{{ $user->photo ? asset('assets/img/profil/' . $user->photo) : asset('assets/img/profil/default.png') }}"; // Kembali ke gambar default
        }
    });
});

</script>
@endsection
