@extends('layouts.dashboard')

@section('content')

    <div class="card card-profile">
        <div
            class="card-header"
            style="background-image: url('/assets/img/blogpost.jpg')"
        >
            <div class="profile-picture">
                <div class="avatar avatar-xxl">
                    <img
                        src="{{ $user->photo ? asset('assets/img/profil/' . $user->photo) : asset('assets/img/profil/default.png') }}"
                        alt="Profile Photo"
                        class="avatar-img rounded"
                    />
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="user-profile text-center">
                <div class="name">{{ $user->name }}</div>
                <div class="job">{{ $user->nip }}</div>
                <div class="desc">{{ $user->group->name }}</div>
                
                <!-- <div class="view-profile">
                <a href="{{ route('profile.edit', $user->nip) }}" class="btn btn-secondary w-40">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </a>
                </div> -->
            </div>
        </div>
        <div class="card-footer">
            <div class="row user-stats text-center">
                <div class="col">
                    <div class="title">Created At</div>
                    <div class="number">{{ $user->created_at->format('d-m-Y') }}</div>
                </div>
                <div class="col">
                    <div class="title">Updated At</div>
                    <div class="number">{{ $user->updated_at->format('d-m-Y') }}</div>
                </div>
                <div class="col">
                    <div class="title">Groups</div>
                <div class="number">
                    {{ $groups->isEmpty() ? 'No Groups Assigned' : $groups->pluck('name')->join(', ') }}
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection
