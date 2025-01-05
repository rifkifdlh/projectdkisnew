@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <div class="card-body">
        <!-- Tombol Back dan Title Login -->
        <button type="button" class="btn-close" aria-label="Close" onclick="window.location.href='{{ route('landing_page') }}'"></button>
        
        <div class="justify-content-between align-items-center mb-4">
            <h2 class="card-title text-center mb-0 fade-in" style="color: black;">Login</h2>
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

        <form action="{{ route('login') }}" method="POST">
            @csrf
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
                <label for="group_id" style="color: black;">Pilih Grup</label>
                <select name="group_id" id="group_id" class="form-select" required>
                    @if($groups->isNotEmpty()) <!-- Cek apakah grup ada -->
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    @else
                        <option value="" disabled selected>Masukkan NIP terlebih dahulu</option>
                    @endif
                </select>
            </div>

            <!-- Center the Login button -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-50">Login</button>
            </div>
        </form>

        <div class="mt-3 text-center">
            <p style="color: black;">
                Belum punya akun? 
                <a href="{{ route('register') }}" style="text-decoration: underline;">Daftar disini</a>.
            </p>
        </div>
    </div>

    <!-- JavaScript untuk mengambil grup berdasarkan NIP -->
    <script>
        document.getElementById('nip').addEventListener('blur', function () {
            const nip = this.value;
            if (nip) {
                fetch(`/get-groups?nip=${nip}`)
                    .then(response => response.json())
                    .then(data => {
                        const groupSelect = document.getElementById('group_id');
                        groupSelect.innerHTML = ''; // Kosongkan dropdown

                        if (data.groups && data.groups.length) {
                            data.groups.forEach(group => {
                                const option = document.createElement('option');
                                option.value = group.id;
                                option.textContent = group.name;
                                groupSelect.appendChild(option);
                            });
                        } else {
                            groupSelect.innerHTML = '<option disabled selected>Grup tidak ditemukan</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching groups:', error);
                    });
            }
        });
    </script>
@endsection
