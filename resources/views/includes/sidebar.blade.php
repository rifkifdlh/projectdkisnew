@php
    $groupName = Auth::check() ? Auth::user()->group->name : null;
    $redirectUrl = '#'; // Default URL jika user tidak login atau group tidak dikenali

    if ($groupName) {
        if ($groupName === 'SuperAdmin') { // SuperAdmin
            $redirectUrl = route('dashboard.superadmin');
        } elseif ($groupName === 'Umum') { // Umum
            $redirectUrl = route('dashboard.umum');
        } else { // Semua group selain SuperAdmin dan Umum
            $redirectUrl = route('dashboard.bidang');
        }
    }
   
@endphp

<div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
        <a href="{{ $redirectUrl }}" class="logo">
            <img
                src="{{ asset('assets/img/kaiadmin/logo_light.png') }}"
                alt="navbar brand"
                class="navbar-brand"
                height="20"
            />
        </a>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
            </button>
        </div>
        <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
        </button>
    </div>
    <!-- End Logo Header -->
</div>

<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <ul class="nav nav-secondary">
            <li class="nav-item active">
                <a href="{{ $redirectUrl }}">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
            </li>

            @php
                $user = Auth::user(); // Get the authenticated user
                $group_name = $user->group->name; // Get the group name of the authenticated user
            @endphp

            {{-- For SuperAdmin --}}
            @if($group_name === 'SuperAdmin')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base">
                    <i class="fas fa-address-card"></i>
                    <p>Manajemen Akses</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="base">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="users">
                                <span class="sub-item">Data User</span>
                            </a>
                        </li>
                        <li>
                            <a href="groups">
                                <span class="sub-item">Data Groups</span>
                            </a>
                        </li>
                        <li>
                            <a href="usergroups">
                                <span class="sub-item">Data User Group</span>
                            </a>
                        </li>
                        <li>
                            <a href="tempat">
                                <span class="sub-item">Data Tempat</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif

            {{-- For SuperAdmin, Umum, and all Bidang groups --}}
            @if(in_array($group_name, ['SuperAdmin', 'Umum', 'E-Government', 'ITIK', 'Persandian', 'PIKP', 'Statistik', 'Sekretariat']))
            <li class="nav-item">
                <a href="pelatihandanbimbingan">
                    <i class="fas fa-child"></i>
                    <p>Pelatihan & Bimbingan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="events">
                    <i class="fas fa-calendar-week"></i>
                    <p>Events</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="aspirasievent">
                    <i class="fas fa-bullhorn"></i>
                    <p>Aspirasi Events</p>
                </a>
            </li>
            @endif


        </ul>
    </div>
</div>



@push('scripts')
<script>
   document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('.navbar .form-control'); // Input pencarian
    const menuItems = document.querySelectorAll('.sidebar-wrapper .nav-item'); // Semua menu
    const sections = document.querySelectorAll('.sidebar-wrapper .nav-section'); // Section judul

    searchInput.addEventListener('input', function () {
        const query = searchInput.value.toLowerCase(); // Ambil input pencarian
        let anyVisible = false; // Flag untuk menandai jika ada yang cocok

        // Iterasi menu
        menuItems.forEach(item => {
            const menuText = item.innerText.toLowerCase(); // Ambil teks dari item
            const isMatch = menuText.includes(query); // Cocokkan query

            if (isMatch) {
                item.style.display = ''; // Tampilkan menu
                anyVisible = true; // Tandai ada menu yang cocok
            } else {
                item.style.display = 'none'; // Sembunyikan menu
            }
        });

        // Iterasi sections (untuk menyembunyikan jika semua menu di dalamnya hilang)
        sections.forEach(section => {
            const visibleChildren = section.nextElementSibling.querySelectorAll('.nav-item:not([style*="display: none"])');
            if (visibleChildren.length > 0) {
                section.style.display = ''; // Tampilkan section jika ada menu yang terlihat
            } else {
                section.style.display = 'none'; // Sembunyikan section jika tidak ada menu
            }
        });

        // Jika tidak ada menu yang cocok, tampilkan placeholder atau reset
        if (!anyVisible) {
            // Misalnya, tambahkan logika untuk menampilkan pesan "Tidak ditemukan"
        }
    });
    });

</script>
@endpush
