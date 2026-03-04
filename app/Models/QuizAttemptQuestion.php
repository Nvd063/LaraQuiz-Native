<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class QuizAttemptQuestion extends Model {
    // Note: table name agar migration mein 'quiz_attempt_questions' hai to fillable ye honge
    protected $fillable = ['quiz_attempt_id', 'question_id', 'user_answer', 'order_number'];

    public function question() {
        return $this->belongsTo(Question::class);
    }
}