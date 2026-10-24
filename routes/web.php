<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\ProgressController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index']);

// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Resume
Route::get('/resume', [ResumeController::class, 'index'])->name('resume');
Route::post('/resume/analyze', [ResumeController::class, 'analyze'])->name('resume.analyze');
Route::post('/resume/reset', [ResumeController::class, 'reset'])->name('resume.reset');

// Interview
Route::get('/interview', [InterviewController::class, 'index'])->name('interview');
Route::post('/interview/start', [InterviewController::class, 'start'])->name('interview.start');
Route::get('/interview/room/{session}', [InterviewController::class, 'room'])->name('interview.room');
Route::post('/interview/answer/{session}', [InterviewController::class, 'submitAnswer'])->name('interview.answer');
Route::get('/interview/complete/{session}', [InterviewController::class, 'complete'])->name('interview.complete');

// Assessment
Route::get('/assessment', [AssessmentController::class, 'index'])->name('assessment');

// Learning
Route::get('/learning', [LearningController::class, 'index'])->name('learning');
Route::post('/learning/{item}/toggle-complete', [LearningController::class, 'toggleComplete'])->name('learning.toggle-complete');
Route::post('/learning/{item}/toggle-save', [LearningController::class, 'toggleSave'])->name('learning.toggle-save');

// Progress
Route::get('/progress', [ProgressController::class, 'index'])->name('progress');

