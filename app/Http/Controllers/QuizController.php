<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptQuestion;
// use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function startQuiz($quizId)
    {
        // 1. Fetch Quiz with its related Subject
        $quiz = Quiz::with('subject')->findOrFail($quizId);
        $user = auth()->user();

        // 2. Double-check if student already has an active or finished attempt
        $existingAttempt = QuizAttempt::where('user_id', $user->id)
                                      ->where('quiz_id', $quizId)
                                      ->first();
        
        if ($existingAttempt) {
            return response()->json(['error' => 'You have already attempted this quiz.'], 403);
        }

        // 3. Smart Shuffling Logic:
        // Pick $quiz->total_questions from the 100+ available for that subject
        $randomQuestions = Question::where('subject_id', $quiz->subject_id)
                                     ->inRandomOrder()
                                     ->limit($quiz->total_questions)
                                     ->get();

        // 4. Create the Attempt Header
        $attempt = QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'started_at' => now(),
        ]);

        // 5. Freeze the questions for this specific attempt
        foreach ($randomQuestions as $index => $q) {
            QuizAttemptQuestion::create([
                'quiz_attempt_id' => $attempt->id,
                'question_id' => $q->id,
                'order_number' => $index + 1, // Store the shuffle order
            ]);
        }

        return response()->json([
            'message' => 'Quiz started!',
            'attempt_id' => $attempt->id,
            'duration' => $quiz->duration_minutes,
            'questions' => $randomQuestions // Ye mobile app receive karegi
        ]);
    }
}