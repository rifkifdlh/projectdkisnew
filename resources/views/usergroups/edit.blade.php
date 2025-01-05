@extends('layouts.dashboard')

@section('title', 'Edit User Group')

@section('content')
<div class="container">
    <div class="card">
        <!-- Header Card -->
        <div class="card-header">
            <h3 class="card-title">Edit User Group</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body">
            <!-- Menampilkan daftar nama pengguna yang tergabung dalam grup -->
            <div class="mb-3">
                <label for="group_users" class="form-label">Users in this Group</label>
                <div class="p-2 border rounded bg-light">
                    @if ($usersInGroup->isNotEmpty())
                        @foreach ($usersInGroup->unique('user_id') as $userInGroup)
                            @if ($userInGroup->user)
                                <span>{{ $userInGroup->user->name }}</span>@if (!$loop->last), @endif
                            @endif
                        @endforeach
                    @else
                        <span>No User</span>
                    @endif
                </div>
            </div>

            <!-- Form untuk edit -->
            <form action="{{ route('usergroups.update', $usergroup) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label for="user_id">User (Only Users in Group)</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="">Select User</option>
                                @foreach ($usersInGroup->unique('user_id') as $userInGroup)
                                    @if ($userInGroup->user)
                                        <option value="{{ $userInGroup->user->id }}" 
                                            {{ $userInGroup->user->id == $usergroup->user_id ? 'selected' : '' }}>
                                            {{ $userInGroup->user->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-group-default">
                            <label for="group_id">Group</label>
                            <select name="group_id" id="group_id" class="form-control" required>
                                <option value="">Select Group</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}" 
                                        {{ $group->id == $usergroup->group_id ? 'selected' : '' }}>
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label for="deskripsi_tugas">Description</label>
                            <textarea
                                name="deskripsi_tugas"
                                id="deskripsi_tugas"
                                class="form-control"
                                placeholder="Enter task description (optional)"
                            >{{ $usergroup->deskripsi_tugas }}</textarea>
                        </div>

                    </div>
                    <div class="card-footer text-first">
                        <button type="submit" class="btn btn-success">Update User Group</button>
                        <a href="{{ route('usergroups.index') }}" class="btn btn-danger">Cancel</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
