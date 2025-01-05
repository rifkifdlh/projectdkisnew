@extends('layouts.dashboard')

@section('title', 'Create Pelatihan dan Bimbingan')

@section('content')
<div class="container">
    <div class="card">
        <!-- Header Card -->
        <div class="card-header">
            <h3 class="card-title">Tambah Pelatihan dan Bimbingan</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body">
            <form action="{{ route('pelatihandanbimbingan.store') }}" method="POST">
                @csrf
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
                                value="{{ 'Pltdkis - ' . time() }}"
                                readonly
                            />
                        </div>

                        <div class="form-group form-group-default">
                            <label for="nama_pelatihan">Nama Pelatihan</label>
                            <input
                                type="text"
                                id="nama_pelatihan"
                                name="nama_pelatihan"
                                class="form-control"
                                placeholder="Isi nama pelatihan"
                                required
                            />
                        </div>

                        <div class="form-group form-group-default">
                            <label for="tanggal">Tanggal</label>
                            <input
                                type="date"
                                id="tanggal"
                                name="tanggal"
                                class="form-control"
                                onchange="updateStatus()"
                                required
                            />
                        </div>

                        <div class="form-group form-group-default">
                            <label for="waktu_mulai">Waktu Mulai</label>
                            <input
                                type="time"
                                id="waktu_mulai"
                                name="waktu_mulai"
                                class="form-control"
                                required
                            />
                        </div>

                        <div class="form-group form-group-default">
                            <label for="waktu_selesai">Waktu Selesai</label>
                            <input
                                type="time"
                                id="waktu_selesai"
                                name="waktu_selesai"
                                class="form-control"
                                required
                            />
                        </div>

                        <div class="form-group form-group-default">
                            <label for="kuota">Kuota Peserta</label>
                            <input
                                type="number"
                                id="kuota"
                                name="kuota"
                                class="form-control"
                                placeholder="Isi jumlah kuota peserta"
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
                            value="akanhadir"
                            readonly
                        />
                    </div>
                        
                    <div class="form-group form-group-default">
                        <label for="user_id">Mentor/Pelatih</label>
                        <select name="user_id" id="user_id" class="form-select">
                            <option value="" disabled selected>Pilih Mentor/Pelatih</option> <!-- Placeholder -->
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>


                        <div class="form-group form-group-default">
                            <label for="group_id">Group</label>
                            <select name="group_id" id="group_id" class="form-select">
                            <option value="" disabled selected>Pilih Group</option> <!-- Placeholder -->
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-group-default">
                            <label for="tempat_id">Tempat</label>
                            <select name="tempat_id" id="tempat_id" class="form-select">
                            <option value="" disabled selected>Pilih Tempat</option> <!-- Placeholder -->
                                @foreach ($tempats as $tempat)
                                    <option value="{{ $tempat->id }}">{{ $tempat->name }}</option>
                                @endforeach
                            </select>
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

<!-- 
<script>
    function updateStatus() {
        const selectedDate = new Date(document.getElementById('tanggal').value);
        const today = new Date();
        const statusInput = document.getElementById('status');

        // Set the time of the comparison dates to noon to avoid time zone differences
        selectedDate.setHours(12, 0, 0, 0);
        today.setHours(12, 0, 0, 0);

        // Compare selected date with today's date
        if (selectedDate < today) {
            statusInput.value = "berlangsung";  // The event has already started
        } else {
            statusInput.value = "akanhadir";   // The event is in the future
        }
    }
</script> -->
