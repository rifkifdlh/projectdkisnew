@extends('layouts.dashboard')

@section('title', 'Create Group')

@section('content')
<div class="container">
    <div class="card">
        <!-- Header Card -->
        <div class="card-header">
            <h3 class="card-title">Tambah Group</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body">
            <form action="{{ route('groups.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label for="name">Nama Group</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                placeholder="isi nama group"
                                required
                            />
                        </div>

                        <div class="form-group form-group-default">
                            <label for="tugas">Tugas</label>
                            <input
                                type="text"
                                id="tugas"
                                name="tugas"
                                class="form-control"
                                placeholder="isi tugas group (opsional)"
                            />
                        </div>
                    </div>

                    <div class="card-footer text-first">
                        <button type="submit" class="btn btn-success">Create Group</button>
                        <a href="{{ route('groups.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
