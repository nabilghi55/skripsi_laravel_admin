<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\MenteeRegistrationController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\MentorRegistrationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('admin/berita', BeritaController::class, ['as' => 'admin'])->parameters([
        'berita' => 'berita:slug'
    ]);
    Route::resource('admin/lowongan', LowonganController::class, ['as' => 'admin']);
    Route::resource('admin/event', EventController::class, ['as'=> 'admin']);
    Route::get('events/{event}/registrations', [EventController::class, 'registrations'])
    ->name('admin.event.registrations');
    Route::resource('admin/mentorship', MentorController::class);
    Route::get('admin/mentor/registrations', [MentorRegistrationController::class, 'index'])->name('admin.mentor.registrations.index');
    Route::post('admin/mentor/registrations/{id}/approve', [MentorRegistrationController::class, 'approve'])->name('admin.mentor.approve');
    Route::delete('admin/mentor/registrations/{id}', [MentorRegistrationController::class, 'destroy'])->name('admin.mentor.destroy');
    // web.php
    Route::get('admin/mentee/registrations', [MenteeRegistrationController::class, 'index'])->name('admin.mentee.registrations.index');
    Route::post('admin/mentee/registrations/{id}/approve', [MenteeRegistrationController::class, 'approve'])->name('admin.mentee.approve');
    Route::delete('admin/mentee/registrations/{id}', [MenteeRegistrationController::class, 'destroy'])->name('admin.mentee.destroy');
    Route::get('admin/mentor/{id}', [MentorController::class, 'show'])->name('admin.mentor.show');

    
});

require __DIR__.'/auth.php';
