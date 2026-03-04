<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model {
    protected $fillable = ['user_id', 'quiz_id', 'started_at', 'completed_at', 'score'];

    public function attemptQuestions() {
        return $this->hasMany(QuizAttemptQuestion::class);
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}