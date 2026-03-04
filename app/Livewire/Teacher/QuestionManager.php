<?php

namespace App\Livewire\Teacher;

use Livewire\Component;
use App\Models\Question;
use App\Models\Subject;

class QuestionManager extends Component
{
    // Saari properties ko top par rakhein
    public $subject_id, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_option;
    public $editing_id = null; 

    public function saveQuestion()
    {
        $data = $this->validate([
            'subject_id' => 'required|exists:subjects,id',
            'question_text' => 'required|string',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_option' => 'required|in:a,b,c,d',
        ]);

        if ($this->editing_id) {
            Question::find($this->editing_id)->update($data);
            session()->flash('message', 'Question Updated Successfully! ✨');
        } else {
            Question::create($data);
            session()->flash('message', 'Question Added Successfully! 🎉');
        }

        // Reset fields
        $this->reset(['editing_id', 'question_text', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_option']);
    }

    public function editQuestion($id)
    {
        $q = Question::findOrFail($id);
        $this->editing_id = $q->id;
        $this->subject_id = $q->subject_id;
        $this->question_text = $q->question_text;
        $this->option_a = $q->option_a;
        $this->option_b = $q->option_b;
        $this->option_c = $q->option_c;
        $this->option_d = $q->option_d;
        $this->correct_option = $q->correct_option;
    }

    public function cancelEdit()
    {
        $this->reset(['editing_id', 'subject_id', 'question_text', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_option']);
    }

    public function deleteQuestion($id)
    {
        Question::find($id)->delete();
        session()->flash('message', 'Question Deleted Successfully! 🗑️');
    }

    public function render()
    {
        return view('livewire.teacher.question-manager', [
            'subjects' => Subject::all(),
            'questions' => Question::with('subject')->latest()->get()
        ])->layout('layouts.app');
    }
}