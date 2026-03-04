<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Quiz;

class Home extends Component
{
    public function mount()
{
    $teacherEmails = ['teacher@quiz.com', 'admin@quiz.com'];

    if (auth()->check() && in_array(auth()->user()->email, $teacherEmails)) {
        return redirect()->route('teacher.questions');
    }
}
    public function render()
{
    // Quizzes uthao aur sath check karo ke kya current user ka result maujood hai
    $quizzes = Quiz::with(['results' => function($q) {
        $q->where('user_id', auth()->id());
    }])->where('is_active', 1)->get();

    return view('livewire.student.home', compact('quizzes'));
}
}