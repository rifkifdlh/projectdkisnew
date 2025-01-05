@extends('layouts.dashboard')

@section('title', 'Create User Group')

@section('content')
<div class="container">
    <div class="card">
        <!-- Header Card -->
        <div class="card-header">
            <h3 class="card-title">Tambah User Group</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body">
            <form action="{{ route('usergroups.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label for="user_id">User (Optional)</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="">Select User (Optional)</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-group-default">
                            <label for="group_id">Group</label>
                            <select name="group_id" id="group_id" class="form-control" required>
                                <option value="">Select Group</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
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
                            ></textarea>
                        </div>
                    </div>
                    <div class="card-footer text-first">
                        <button type="submit" class="btn btn-success">Create User Group</button>
                        <a href="{{ route('usergroups.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
