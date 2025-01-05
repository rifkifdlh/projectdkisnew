<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ErrorController;
use App\Models\User;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TempatController;
use App\Http\Controllers\PelatihanDanBimbinganController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AspirasiEventController;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing_page'); 
})->name('landing_page');



// route buat login,register,logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('redirect.if.session.exists')->get('/', function () {
    return view('landing_page');
})->name('landing_page');


Route::middleware(['check.auth.login'])->group(function () {
    // Dashboard dengan pelacakan user aktif dan auto refresh pada route tertentu
    Route::middleware(['track.active', 'autorefresh'])->group(function () {
        
        // Dashboard SuperAdmin
        Route::get('/dashboard_superadmin', [DashboardController::class, 'superadmin'])
            ->middleware('check_user_group:SuperAdmin')
            ->name('dashboard.superadmin');

        // Dashboard Umum
        Route::get('/dashboard_umum', [DashboardController::class, 'umum'])
            ->middleware('check_user_group:Umum')
            ->name('dashboard.umum');

        // Dashboard Bidang
        Route::get('/dashboard_bidang', [DashboardController::class, 'bidang'])
            ->middleware('check_user_group:E-Government,ITIK,Persandian,PIKP,Statistik,Sekretariat')
            ->name('dashboard.bidang');

            Route::get('groups', [GroupController::class, 'index'])->name('groups.index');
            Route::get('users', [UserController::class, 'index'])->name('users.index');
            Route::get('usergroups', [UserGroupController::class, 'index'])->name('usergroups.index');
            Route::get('tempat', [TempatController::class, 'index'])->name('tempat.index');
            Route::get('pelatihandanbimbingan', [PelatihanDanBimbinganController::class, 'index'])->name('pelatihandanbimbingan.index');
            Route::get('events', [EventController::class, 'index'])->name('events.index');
            Route::get('aspirasievent', [AspirasiEventController::class, 'index'])->name('aspirasievent.index');
            Route::get('/pelatihandanbimbingan/{id}', [PelatihanDanBimbinganController::class, 'show'])->name('pelatihandanbimbingan.show');
            Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
    });


    // Routes untuk aksi lain tanpa AutoRefresh
    Route::resource('groups', GroupController::class)->except(['index']);
    Route::resource('users', UserController::class)->except(['index']);
    Route::resource('usergroups', UserGroupController::class)->except(['index']);
    Route::resource('tempat', TempatController::class)->except(['index']);
    Route::resource('pelatihandanbimbingan', PelatihanDanBimbinganController::class)->except(['index']);
    Route::resource('events', EventController::class)->except(['index']);
    Route::resource('aspirasievent', AspirasiEventController::class)->except(['index']);

    // Detail pelatihan
    Route::post('/pelatihandanbimbingan/{id}/tambah-peserta', [PelatihanDanBimbinganController::class, 'tambahPeserta'])->name('pelatihandanbimbingan.tambahPeserta');
    Route::patch('/pelatihandanbimbingan/{id}/akhiri', [PelatihanDanBimbinganController::class, 'akhiriPelatihan'])->name('pelatihandanbimbingan.akhiriPelatihan');

    // Detail event
    Route::put('/pelatihandanbimbingan/{id}/akhiri', [EventController::class, 'akhiriEvent'])->name('event.akhiri');

    Route::get('aspirasievent/download/{filename}', [AspirasiEventController::class, 'download'])->name('aspirasievent.download');

    // Profil Pengguna
    Route::get('/profile/show/{nip}', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit/{nip}', [ProfileController::class, 'showEditProfile'])->name('profile.edit');
    Route::match(['PUT', 'POST'], '/profile/update/{nip}', [ProfileController::class, 'updateProfile'])->name('profile.update');
});



// Fungsi Modal Landing Page Login
Route::get('/get-groups', function (Request $request) {
    // Menggunakan $request untuk mengakses query parameter
    $nip = $request->query('nip');
        
    // Ambil grup yang terkait dengan NIP yang dimasukkan
    $userGroups = User::where('nip', $nip)->with('group')->get();
        
    // Ambil grup yang unik
    $groups = $userGroups->pluck('group')->unique(); 

    return response()->json(['groups' => $groups]);
});



// Footer menu
Route::get('/about', function () {
    return view('about');
});

Route::get('/licenses', function () {
    return view('licenses');
})->name('licenses');

Route::get('/help', function () {
    return view('help'); // This assumes the blade file is named 'help.blade.php'
})->name('help');





Route::get('/online-users', [AuthController::class, 'countOnlineUsers'])->name('online.users');

Route::view('/', 'landing_page')->name('landing_page');
