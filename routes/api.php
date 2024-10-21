<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\MenteeRegistrationController;
use App\Http\Controllers\MenteeRequestController;
use App\Http\Controllers\MentorRegistrationController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::post('/alumni/login', [LoginController::class, 'login']);
Route::post('/alumni/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/berita', [BeritaController::class, 'getAll']);
    Route::get('/berita/{slug}', [BeritaController::class, 'getSingleBySlug']);
    
    Route::get('/lowongan', [LowonganController::class, 'getAllLowongan']);
    Route::get('/lowongan/{id}', [LowonganController::class, 'getLowonganById']);
    
    Route::get('/events', [EventController::class, 'getAllEvents']);
    Route::get('/events/{id}', [EventController::class, 'getEventById']);
    Route::post('/events/{eventId}/register', [EventController::class, 'apiRegister']);
    
    Route::post('/mentor/register', [MentorRegistrationController::class, 'store']);
    Route::post('/mentee/register', [MenteeRegistrationController::class, 'store']);
});
Route::middleware(['auth:sanctum', 'role:mentor'])->group(function () {
    Route::get('/mentee-requests', [MentorRegistrationController::class, 'listAllMenteeRequests'])->name('mentee.requests');
    Route::get('/schedules', [ScheduleController::class, 'index']);
    Route::post('/schedules/{id}/book', [ScheduleController::class, 'book']);
    Route::get('/mentee/listrequests', [MentorRegistrationController::class, 'listAllMenteeRequests']);
    Route::get('/mentors/{mentorId}/mentee-requests', [MentorRegistrationController::class, 'listMenteeRequests']);
    Route::post('/mentee/requests/{id}/approve', [MentorRegistrationController::class, 'approveMentee']);
});
Route::middleware(['auth:sanctum', 'role:mentee'])->group(function () {
    Route::get('/mentors', [MentorRegistrationController::class, 'listMentors']); // List all mentors
    Route::get('/mentors/{id}', [MentorRegistrationController::class, 'showMentor']); // Get mentor by ID
    Route::post('/mentee/requests', [MenteeRequestController::class, 'store']);
    Route::get('/mentee-requests', [MenteeRequestController::class, 'listAllMenteeRequests'])->name('mentee.requests');

});



