<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Student\Home;
use App\Livewire\Student\QuizPlayer;
use App\Livewire\Teacher\QuestionManager;
use App\Livewire\Teacher\Dashboard as TeacherDashboard;
use App\Livewire\Teacher\QuizManager;
use Illuminate\Support\Facades\Route;

// 1. Welcome & Auth Routes
Route::get('/welcome', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

// 2. Protected Routes (Sab Logged-in Users ke liye)
Route::middleware(['auth'])->group(function () {

    // DASHBOARD REDIRECT LOGIC: Faisla karega ke Teacher Dashboard dikhana hai ya Student Home
    Route::get('/dashboard', function () {
        $teacherEmails = ['teacher@quiz.com', 'admin@quiz.com'];

        if (in_array(auth()->user()->email, $teacherEmails)) {
            return redirect()->route('teacher.dashboard');
        }

        return redirect()->route('home');
    })->name('dashboard');

    // --- STUDENT ROUTES ---
    Route::get('/', Home::class)->name('home');
    Route::get('/quiz/{quiz}', QuizPlayer::class)->name('quiz.play');

    // --- PROFILE ROUTES ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- TEACHER ROUTES (Sirf Special Emails ke liye) ---
    Route::middleware(['teacher'])->group(function () {
        Route::get('/teacher/dashboard', TeacherDashboard::class)->name('teacher.dashboard');
        Route::get('/teacher/questions', QuestionManager::class)->name('teacher.questions');
        Route::get('/teacher/quizzes', QuizManager::class)->name('teacher.quizzes');
    });
});