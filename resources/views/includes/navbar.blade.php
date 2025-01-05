<!-- Navbar Header -->
            <div class="container-fluid">
            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-search pe-1">
                            <i class="fa fa-search search-icon"></i>
                        </button>
                    </div>
                    <input
                        type="text"
                        placeholder="Search menu..."
                        class="form-control"/>
                </div>
            </nav>


              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li
                  class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                  <a
                    class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-expanded="false"
                    aria-haspopup="true">
                    <i class="fa fa-search"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form class="navbar-left navbar-form nav-search">
                      <div class="input-group">
                        <input
                          type="text"
                          placeholder="Search ..."
                          class="form-control"/>
                      </div>
                    </form>
                  </ul>
                </li>


                
                <li class="nav-item topbar-icon dropdown hidden-caret">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="messageDropdown"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fa fa-map"></i>
                  </a>
                  <ul
                    class="dropdown-menu messages-notif-box animated fadeIn"
                    aria-labelledby="messageDropdown">
                    <li>
                      <div
                        class="dropdown-title d-flex justify-content-between align-items-center">
                        Lokasi
                        <a href="#" class="small">Lokasi DKIS</a>
                      </div>
                    </li>

                    <!-- Maps section -->
                    <li>
                      <!-- Map 1 (Top) -->
                      <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253602.21677430745!2d108.3183145819255!3d-6.704406952211668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ee209bd53f649%3A0x8b85bec5b459e4f3!2sDinas%20Komunikasi%20Informasi%20Dan%20Statistik%20Kota%20Cirebon!5e0!3m2!1sen!2sid!4v1732320238439!5m2!1sen!2sid" 
                                width="100%" height="200" style="border:0;" allowfullscreen=""></iframe>
                      </div>

                      <!-- Map 2 (Bottom) -->
                      <div class="map-container mt-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253602.21677430745!2d108.3183145819255!3d-6.704406952211668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1d89f269093f%3A0xe9281bd67b6f3c25!2sDinas%20Komunikasi%2C%20Informatika%20dan%20Statistik%20Kota%20Cirebon!5e0!3m2!1sen!2sid!4v1732320426530!5m2!1sen!2sid" 
                                width="100%" height="200" style="border:0;" allowfullscreen=""></iframe>
                      </div>
                    </li>

                    <li>
                      <a class="see-all" href="https://maps.app.goo.gl/wZEQNTkkxVB9dV2t6">
                        See full maps<i class="fa fa-angle-right"></i>
                      </a>
                    </li>
                  </ul>
                </li>
                
                <li class="nav-item topbar-icon dropdown hidden-caret">
  <a class="nav-link dropdown-toggle" href="#" id="clockDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-clock"></i>
  </a>
  <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="clockDropdown">
    <li>
      <div class="dropdown-title d-flex justify-content-between align-items-center">
        Jam Digital
      </div>
    </li>
    <li>
      <div id="digitalClock" class="text-center" style="font-size: 18px; font-weight: bold;">
        <!-- Jam digital akan ditampilkan di sini -->
      </div>
    </li>
  
  </ul>
</li>

@push('scripts')
<script>
  // Jam Digital
  function updateClock() {
    const now = new Date();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    document.getElementById('digitalClock').innerText = `${hours}:${minutes}:${seconds}`;
  }

  setInterval(updateClock, 1000); // Update every second


</script>
@endpush






                <li class="nav-item topbar-icon dropdown hidden-caret">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="notifDropdown"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="true"
                  >
                    <i class="fa fa-bell"></i>
                    <span class="notification text-dark">{{ session('notifications') ? count(session('notifications')) : 0 }}</span>
                  </a>
                  <ul
                    class="dropdown-menu notif-box animated fadeIn"
                    aria-labelledby="notifDropdown"
                  >
                    <li>
                      <div class="dropdown-title">
                        Kamu Punya Notifikasi Baru!
                      </div>
                    </li>
                    <li>
                      <div class="notif-scroll scrollbar-outer">
                        <div class="notif-center" id="notifMessages">
                          @if(session('notifications'))
                            @foreach(session('notifications') as $index => $notif)
                              @if (is_array($notif))
                                <p class="notif-message" data-timestamp="{{ \Carbon\Carbon::parse($notif['timestamp'])->toIso8601String() }}">
                                  {{ $notif['message'] }}
                                  <span class="notif-time" data-time="{{ $notif['timestamp'] }}">
                                    ({{ \Carbon\Carbon::parse($notif['timestamp'])->diffForHumans() }})
                                  </span>
                                </p>
                                
                                @if ($index < count(session('notifications')) - 1)
                                  <!-- Add a separator line -->
                                  <hr class="notification-separator"></hr>
                                @endif
                              @endif
                            @endforeach
                          @else
                            <p class="text-center text-muted">No new notifications</p>
                          @endif
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>



                @push('scripts')
                <script>
                  document.addEventListener('DOMContentLoaded', function() {
                    const notificationsContainer = document.querySelector('.notif-center'); // Select container holding the notifications
                    const notificationCountElement = document.querySelector('.notification'); // Select the notification count element
                    const dropdownTitleNotificationCount = document.querySelector('.dropdown-title .notification'); // Select the notification count in the dropdown title

                    // Function to update the notification count in both the dropdown and notification icon
                    function updateNotificationCount() {
                      const remainingNotifications = document.querySelectorAll('.notif-message').length;
                      notificationCountElement.textContent = remainingNotifications; // Update the count of visible notifications in the icon
                    }

                    // Select all the notifications
                    const notifications = document.querySelectorAll('.notif-message');

                    notifications.forEach(function(notification) {
                      const timestamp = notification.getAttribute('data-timestamp'); // Get the timestamp
                      const notifTimeElement = notification.querySelector('.notif-time'); // Select the time element

                      if (timestamp) {
                        const timeDifference = getTimeDifference(new Date(timestamp)); // Get the time difference
                        notifTimeElement.textContent = `(${timeDifference})`; // Update the time display with parentheses

                        // If the notification is older than 10 minutes, remove it
                        if (getTimeDifferenceInMinutes(new Date(timestamp)) > 60) {
                          console.log("Removing notification:", notification); // Debug log
                          notification.remove(); // Remove the notification if it's older than 10 minutes
                        }
                      }
                    });

                    // Function to calculate the time difference in a human-readable format
                    function getTimeDifference(date) {
                      const now = new Date();
                      const diffInSeconds = Math.floor((now - date) / 1000); // Time difference in seconds
                      const diffInMinutes = Math.floor(diffInSeconds / 60); // Convert seconds to minutes
                      const diffInHours = Math.floor(diffInMinutes / 60); // Convert minutes to hours
                      const diffInDays = Math.floor(diffInHours / 24); // Convert hours to days

                      if (diffInSeconds < 60) {
                        return 'Just now'; // Less than a minute ago
                      } else if (diffInMinutes < 60) {
                        return `${diffInMinutes} minute${diffInMinutes > 1 ? 's' : ''} ago`; // Minutes ago
                      } else if (diffInHours < 24) {
                        return `${diffInHours} hour${diffInHours > 1 ? 's' : ''} ago`; // Hours ago
                      } else {
                        return `${diffInDays} day${diffInDays > 1 ? 's' : ''} ago`; // Days ago
                      }
                    }

                    // Helper function to calculate the time difference in minutes
                    function getTimeDifferenceInMinutes(date) {
                      const now = new Date();
                      const diffInMilliseconds = now - date; // Time difference in milliseconds
                      return diffInMilliseconds / (1000 * 60); // Convert milliseconds to minutes
                    }

                    // Initial update of notification count on page load
                    updateNotificationCount(); // Call this function to update the count of notifications displayed

                  });

                  $(document).ready(function () {
                      if ($('.notification').text() > 0) {
                          let shakeIcon = $('#notifDropdown i');
                          let shakeCount = 0;
                          let interval = setInterval(function () {
                              shakeIcon.addClass('shake');
                              setTimeout(() => {
                                  shakeIcon.removeClass('shake');
                              }, 500); // Animasi berlangsung selama 0.5 detik
                              
                              shakeCount += 1;
                              if (shakeCount >= 5) { // Total durasi: 10 detik (5 kali interval 2 detik)
                                  clearInterval(interval);
                              }
                          }, 2000); // Ulangi setiap 2 detik
                      }
                  });

                </script>
                @endpush



                

                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                  <div class="avatar-sm">
                      <!-- Cek apakah pengguna online berdasarkan sesi -->
                      @if (Session::get('user-is-online-' . Auth::user()->id, false))
                          <div class="avatar avatar-online">
                              <img src="{{ Auth::user()->photo ? asset('assets/img/profil/' . Auth::user()->photo) : asset('assets/img/profil/default.png') }}" 
                                  alt="Profile Photo"
                                  class="avatar-img rounded-circle" />
                          </div>
                      @else
                          <div class="avatar avatar-offline">
                              <img src="{{ Auth::user()->photo ? asset('assets/img/profil/' . Auth::user()->photo) : asset('assets/img/profil/default.png') }}" 
                                  alt="Profile Photo"
                                  class="avatar-img rounded-circle" />
                          </div>
                      @endif
                  </div>



                    <span class="profile-username">
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold">{{ Auth::user()->name }}</span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                          <img src="{{ Auth::user()->photo ? asset('assets/img/profil/' . Auth::user()->photo) : asset('assets/img/profil/default.png') }}" 
                              alt="Profile Photo"
                              class="avatar-img rounded-circle" />
                          </div>
                          <div class="u-text">
                            <h4>{{ Auth::user()->name }}</h4>
                            @if(Auth::check() && Auth::user()->group)
                                <p class="text-muted">{{ Auth::user()->group->name }}</p>
                            @else
                                <p class="text-muted">Bidang tidak ditemukan</p>
                            @endif
                            <a href="{{ route('profile.show', Auth::user()->nip) }}" class="btn btn-xs btn-secondary btn-sm">
                            View Profile
                            </a>
                          </div>
                        </div>
                      </li>
                      <li>
                        <!-- Dropdown Menu -->
                            <div class="dropdown-divider"></div>
                            
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('profile.edit', Auth::user()->nip) }}">Pengaturan Akun</a>
                            <div class="dropdown-divider"></div>

                            <!-- Logout Link -->
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">Logout</a>

                            <!-- Logout Form (hidden) -->
                            <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          <!-- End Navbar -->