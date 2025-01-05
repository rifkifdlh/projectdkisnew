@extends('layouts.dashboard')

@section('title', 'Edit Group')

@section('content')
<div class="container">
    <div class="card">
        <!-- Header Card -->
        <div class="card-header">
            <h3 class="card-title">Edit Group</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body">
            <form action="{{ route('groups.update', $group->id) }}" method="POST">
                @csrf
                @method('PUT')
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
                                value="{{ $group->name }}"
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
                                value="{{ $group->tugas }}"
                            />
                        </div>
                    </div>

                </div>
                <!-- Footer Card -->
               <div class="card-footer text-first">
                   <button type="submit" class="btn btn-success">Update Group</button>
                   <a href="{{ route('groups.index') }}" class="btn btn-danger">Cancel</a>
               </div>
            </form>
        </div>
    </div>
</div>
@endsection
