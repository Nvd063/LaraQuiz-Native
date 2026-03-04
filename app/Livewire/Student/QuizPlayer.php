<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuizResult;


class QuizPlayer extends Component
{
    public $quiz;
    public $questions;
    public $currentStep = 0;
    public $answers = []; // User ke selected answers
    public $timeLeft;
    public $showResult = false; // Result screen dikhane ke liye
    public $score = 0;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;

        // Ab filter lage ga: Sirf wahi questions ayenge jin ki subject_id quiz se match karegi
        $this->questions = Question::where('subject_id', $quiz->subject_id)
            ->inRandomOrder()
            ->limit($quiz->total_questions)
            ->get();

        // Agar us subject ka koi sawal nahi mila
        if ($this->questions->isEmpty()) {
            session()->flash('error', 'No questions found for this subject!');
            return redirect()->to('/');
        }

        $this->timeLeft = $quiz->duration_minutes * 60;
    }

    public function selectOption($questionId, $option)
    {
        $this->answers[$questionId] = $option;

        // Agar aakhri sawal nahi hai to agle par jao
        if ($this->currentStep < count($this->questions) - 1) {
            $this->currentStep++;
        }
    }

    public function submitQuiz()
    {
        $this->score = 0;
        foreach ($this->questions as $question) {
            if (isset($this->answers[$question->id]) && $this->answers[$question->id] == $question->correct_option) {
                $this->score++;
            }
        }

        // YAHAN SAVE HOGA:
        QuizResult::create([
            'user_id' => auth()->id(), // Current logged in student
            'quiz_id' => $this->quiz->id,
            'score' => $this->score,
            'total_questions' => count($this->questions),
        ]);

        $this->showResult = true;
    }

    public function decrementTimer()
    {
        if ($this->timeLeft > 0) {
            $this->timeLeft--;
        } else {
            // Agar time khatam ho jaye to khud submit kar do
            $this->submitQuiz();
        }
    }

    public function render()
    {
        return view('livewire.student.quiz-player')->layout('layouts.app');
    }
}