<?php

namespace App\Livewire\Teacher;

use Livewire\Component;
// use App\Models\Question;
// use App\Models\Subject;

class Dashboard extends Component
{
    public function render()
{
    return view('livewire.teacher.dashboard')->layout('layouts.app');
}
}