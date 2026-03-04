<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // --- YEH LOGIC LAAZMI HAI ---
        $teacherEmails = ['teacher@quiz.com', 'admin@quiz.com'];

        if (in_array($request->user()->email, $teacherEmails)) {
            return redirect()->route('teacher.dashboard'); // Teacher ko dashboard bhejo
        }

        return redirect()->intended(route('home', absolute: false)); // Student ko home
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->isTeacher()) {
            return redirect()->intended('/teacher/questions');
        }

        return redirect()->intended('/');
    }
}
