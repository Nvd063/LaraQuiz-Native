<?php

namespace App\Livewire\Teacher;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\Subject;

class QuizManager extends Component
{
    public $title, $subject_id, $total_questions = 20, $duration_minutes = 30, $is_active = 1;

    public function saveQuiz()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'total_questions' => 'required|integer|min:1',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        // Yahan galti thi ($this->duration_questions likha gaya tha)
        Quiz::create([
            'title' => $this->title,
            'subject_id' => $this->subject_id,
            'total_questions' => $this->total_questions,
            'duration_minutes' => $this->duration_minutes,
            'is_active' => $this->is_active,
        ]);

        session()->flash('message', 'Quiz Configuration Saved! 🎯');

        // Sirf title aur subject reset karein, numbers wese hi rehne dein
        $this->reset(['title', 'subject_id']);
    }

    public function deleteQuiz($id)
    {
        Quiz::find($id)->delete();
        session()->flash('message', 'Quiz Removed! ❌');
    }

    public function toggleStatus($id)
    {
        $quiz = Quiz::find($id);
        $quiz->update(['is_active' => !$quiz->is_active]);
    }

    public function render()
    {
        return view('livewire.teacher.quiz-manager', [
            'subjects' => Subject::all(),
            'quizzes' => Quiz::with('subject')->latest()->get()
        ])->layout('layouts.app');
    }
}