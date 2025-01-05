@extends('layouts.auth')

@section('title', 'Register')

@section('content')

    <div class="card-body">
        <!-- Tombol Back dan Title Login -->
        <button type="button" class="btn-close" aria-label="Close" onclick="window.location.href='{{ route('landing_page') }}'"></button>
        
        <div class="justify-content-between align-items-center mb-4">
            <h2 class="card-title text-center mb-0 fade-in" style="color: black;">Register</h2>
        </div>

        <!-- Tampilkan pesan error jika ada -->
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Tampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group form-group-default mb-3">
                <label for="name" style="color: black;">Nama Lengkap</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control"
                    placeholder="masukkan nama lengkap"
                    value="{{ old('name') }}"
                    required
                />
            </div>

            <div class="form-group form-group-default mb-3">
                <label for="nip" style="color: black;">NIP/NIK</label>
                <input
                    type="text"
                    name="nip"
                    id="nip"
                    class="form-control"
                    placeholder="masukkan NIP/NIK"
                    value="{{ old('nip') }}"
                    required
                />
            </div>

            <div class="form-group form-group-default mb-3">
                <label for="password" style="color: black;">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="masukkan password"
                    required
                />
            </div>

            <div class="form-group form-group-default mb-3">
                <label for="password_confirmation" style="color: black;">Konfirmasi Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="form-control"
                    placeholder="konfirmasi password"
                    required
                />
            </div>

           <!-- Hidden input field for group_id with value 8 -->
            <input type="hidden" name="group_id" value="8">


            <div class="form-group form-group-default mb-3">
                <label for="photo" style="color: black;">Foto Profil (Opsional)</label>
                <input
                    type="file"
                    name="photo"
                    id="photo"
                    accept="image/*"
                    class="form-control"
                />
                <small class="form-text text-muted">Unggah file dengan format jpeg,png,jpg,gif|max:2 MB</small>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-50">Register</button>
            </div>
        </form>

        <div class="mt-3 text-center">
            <p style="color: black;">
                Sudah punya akun? 
                <a href="{{ route('login') }}" style="text-decoration: underline;">Login disini</a> .
            </p>
        </div>
    </div>

@endsection
