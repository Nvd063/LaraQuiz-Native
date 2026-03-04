<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['title', 'subject_id', 'total_questions', 'duration_minutes', 'is_active'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);


    }

    public function results()
    {
        // Aik quiz ke kaafi saare results ho saktay hain (alag alag students ke)
        return $this->hasMany(QuizResult::class);
    }
}