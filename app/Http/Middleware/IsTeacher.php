<?php

namespace App\Http\Middleware;

use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;

class IsTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, $next)
    {
        $teacherEmails = ['teacher@quiz.com', 'admin@quiz.com'];

        if (auth()->check() && in_array(auth()->user()->email, $teacherEmails)) {
            return $next($request);
        }

        // Agar teacher nahi hai to wapas home par phenk do
        return redirect('/')->with('error', 'Access Denied!');
    }
}
