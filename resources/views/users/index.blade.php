@extends('layouts.dashboard')

@section('title', 'User List')

@section('content')
<!-- Bar Loading Overlay -->
<div id="loadingBar" class="loading-bar d-none position-fixed top-0 start-0 w-0 bg-primary" style="height: 5px;"></div>

<div class="container-fluid">
    <!-- Card for User Count -->
    <div class="row">
        <!-- Users Card -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round hover-effect">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Users</p>
                                <h4 class="card-title">{{ $userCount }}</h4> <!-- Total User Count -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Super Admin Card -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round hover-effect">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Super Admin</p>
                                <h4 class="card-title">{{ $superadminCount }}</h4> <!-- Count of users in SuperAdmin -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bidang Card (Users excluding SuperAdmin and Umum groups) -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round hover-effect">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                <i class="fas fa-user-cog"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Bidang</p>
                                <h4 class="card-title">{{ $bidangCount }}</h4> <!-- Count of users in Bidang -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Umum Card (Users in the Umum group) -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round hover-effect">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="fas fa-user-shield"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Umum</p>
                                <h4 class="card-title">{{ $umumCount }}</h4> <!-- Count of users in Umum -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card for User List -->
    <!-- Row for Two Tables -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card"> 
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Daftar User</h4>
                        <a href="{{ route('users.create') }}" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i> Tambah User Baru
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover w-100" style="min-width: 100%;"> <!-- Tambahkan min-width -->
                            <thead>
                                <tr>
                                    <th>ID</th>  <!-- Menambahkan kolom ID -->
                                    <th>Name</th>
                                    <th>NIP/NIK</th>
                                    <th>Group</th>
                                    <th>Photo</th>
                                    <th style="width: 15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>  <!-- Menampilkan ID -->
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->nip }}</td>
                                        <td>{{ $user->group->name }}</td>
                                        <td>
                                            @if($user->is_online) <!-- Pastikan Anda memiliki field atau metode untuk mengecek status online -->
                                                <div class="avatar avatar-online">
                                                    <img src="{{ asset('assets/img/profil/' . ($user->photo ?: 'default.png')) }}" alt="User Photo" class="avatar-img rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                                </div>
                                            @else
                                                <div class="avatar avatar-offline">
                                                    <img src="{{ asset('assets/img/profil/' . ($user->photo ?: 'default.png')) }}" alt="User Photo" class="avatar-img rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                                </div>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-start">
                                            <a href="{{ route('profile.show', $user->nip) }}" class="btn btn-info btn-sm me-2">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm me-2">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $user->id }}">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteModal-{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog text-dark">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel-{{ $user->id }}">Konfirmasi Penghapusan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    Apa kamu yakin mau ngehapus ini "{{ $user->name }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel User Groups -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar User Groups</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="user-group-table" class="display table table-striped table-hover w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Group</th>
                                    <th>Users</th>
                                    <th>Group ID</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupedUsers as $groupId => $users)
                                    <tr>
                                        <td colspan="6" class="bg-primary">
                                            <strong>Group: {{ $users->first()['group_name'] }}</strong> 
                                            (ID: {{ $groupId }})
                                        </td>
                                    </tr>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->parent->iteration . '.' . $loop->iteration }}</td>
                                            <td>{{ $user['group_name'] }}</td>
                                            <td>{{ $user['user_name'] }}</td>
                                            <td>{{ $groupId }}</td>
                                            <td>{{ $user['created_by'] }}</td>
                                            <td>{{ $user['updated_by'] }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#add-row').DataTable({
                "responsive": true,  // Ensures the table is responsive
                "paging": true,      // Enables pagination
                "searching": true,   // Enables the search box
                "ordering": true,    // Enables sorting
            });
        });
    </script>
@endpush

