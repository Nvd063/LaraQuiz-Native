<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Question extends Model {
    protected $fillable = ['subject_id', 'question_text', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_option'];

    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}