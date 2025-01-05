@extends('layouts.dashboard')

@section('title', 'User Groups List')

@section('content')
<div class="container-fluid">
    <div class="col-md-12">
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
                                        <td>{{ $loop->parent->iteration . '.' . $loop->iteration }}</td> <!-- Indeks -->
                                        <td>{{ $user['group_name'] }}</td> <!-- Nama grup -->
                                        <td>{{ $user['user_name'] }}</td> <!-- Nama user -->
                                        <td>{{ $groupId }}</td> <!-- ID grup -->
                                        <td>{{ $user['created_by'] }}</td> <!-- Dibuat oleh -->
                                        <td>{{ $user['updated_by'] }}</td> <!-- Diperbarui oleh -->
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#user-group-table').DataTable({
            "responsive": true,
            "paging": true,
            "searching": true,
            "ordering": true,
        });
    });
</script>
@endpush
