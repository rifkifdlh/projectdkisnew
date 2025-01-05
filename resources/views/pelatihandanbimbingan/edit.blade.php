@extends('layouts.dashboard')

@section('title', 'Edit Pelatihan dan Bimbingan')

@section('content')
<div class="container">
    <div class="card">
        <!-- Header Card -->
        <div class="card-header">
            <h3 class="card-title">Edit Pelatihan dan Bimbingan</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body">
            <form action="{{ route('pelatihandanbimbingan.update', $pelatihan->id_pelatihan) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label for="no_pelatihan">No Pelatihan</label>
                            <input
                                type="text"
                                id="no_pelatihan"
                                name="no_pelatihan"
                                class="form-control"
                                value="{{ old('no_pelatihan', $pelatihan->no_pelatihan) }}"
                                readonly
                            />
                            @error('no_pelatihan')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group form-group-default">
                            <label for="nama_pelatihan">Nama Pelatihan</label>
                            <input
                                type="text"
                                id="nama_pelatihan"
                                name="nama_pelatihan"
                                class="form-control"
                                value="{{ old('nama_pelatihan', $pelatihan->nama_pelatihan) }}"
                                placeholder="Masukkan nama pelatihan"
                                required
                            />
                            @error('nama_pelatihan')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group form-group-default">
                            <label for="tanggal">Tanggal</label>
                            <input
                                type="date"
                                id="tanggal"
                                name="tanggal"
                                class="form-control"
                                value="{{ old('tanggal', $pelatihan->tanggal) }}"
                                required
                            />
                            @error('tanggal')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group form-group-default">
                            <label for="waktu_mulai">Waktu Mulai</label>
                            <input
                                type="time"
                                id="waktu_mulai"
                                name="waktu_mulai"
                                class="form-control"
                                value="{{ old('waktu_mulai', $pelatihan->waktu_mulai) }}"
                            />
                            @error('waktu_mulai')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group form-group-default">
                            <label for="waktu_selesai">Waktu Selesai</label>
                            <input
                                type="time"
                                id="waktu_selesai"
                                name="waktu_selesai"
                                class="form-control"
                                value="{{ old('waktu_selesai', $pelatihan->waktu_selesai) }}"
                            />
                            @error('waktu_selesai')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group form-group-default">
                            <label for="kuota">Kuota Peserta</label>
                            <input
                                type="number"
                                id="kuota"
                                name="kuota"
                                class="form-control"
                                value="{{ old('kuota', $pelatihan->kuota) }}"
                                min="1"
                                required
                            />
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label for="status">Status</label>
                            <input
                                type="text"
                                id="status"
                                name="status"
                                class="form-control"
                                value="{{ old('status', $pelatihan->status) }}"
                                readonly
                            />
                        </div>

                        <div class="form-group form-group-default">
                            <label for="user_id">Mentor/Pelatih</label>
                            <select
                                name="user_id"
                                id="user_id"
                                class="form-select"
                                required
                            >
                            <option value="" disabled selected>Pilih Mentor/Pelatih</option> <!-- Placeholder -->
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == old('user_id', $pelatihan->user_id) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group form-group-default">
                            <label for="group_id">Group</label>
                            <select
                                name="group_id"
                                id="group_id"
                                class="form-select"
                                required
                            >
                            <option value="" disabled selected>Pilih Group</option> <!-- Placeholder -->
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}" {{ $group->id == old('group_id', $pelatihan->group_id) ? 'selected' : '' }}>
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('group_id')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group form-group-default">
                            <label for="tempat_id">Tempat</label>
                            <select
                                name="tempat_id"
                                id="tempat_id"
                                class="form-select"
                                required
                            >
                            <option value="" disabled selected>Pilih Tempat</option> <!-- Placeholder -->
                                @foreach ($tempats as $tempat)
                                    <option value="{{ $tempat->id }}" {{ $tempat->id == old('tempat_id', $pelatihan->tempat_id) ? 'selected' : '' }}>
                                        {{ $tempat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tempat_id')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer text-start">
                    <button type="submit" class="btn btn-success">Ubah</button>
                    <a href="{{ route('pelatihandanbimbingan.index') }}" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
