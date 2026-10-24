<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InterviewSession;
use App\Models\InterviewQuestion;
use App\Models\InterviewAnswer;

class InterviewController extends Controller
{
    protected array $defaultQuestions = [
        "Tell me about a project where you used data to improve a product or process.",
        "How would you prioritize features when stakeholders have competing requirements?",
        "Describe a time you received difficult feedback. How did you respond?",
        "How would you investigate a sudden drop in a product's weekly active users?",
        "Why are you interested in this Associate Product Analyst role?",
    ];

    public function index()
    {
        return view('interview.setup');
    }

    public function start(Request $request)
    {
        $role = $request->input('role', 'Associate Product Analyst');
        $type = strtolower($request->input('type', 'behavioral'));
        if (!in_array($type, ['hr', 'behavioral', 'technical'])) {
            $type = 'behavioral';
        }
        $difficulty = $request->input('difficulty', 'Intermediate');
        $count = (int) $request->input('count', 5);
        if ($count <= 0) $count = 5;

        $session = InterviewSession::create([
            'role' => $role,
            'interview_type' => $type,
            'difficulty' => $difficulty,
            'total_questions' => min($count, count($this->defaultQuestions)),
            'current_question_no' => 1,
            'status' => 'active',
        ]);

        $selectedQuestions = array_slice($this->defaultQuestions, 0, $session->total_questions);
        foreach ($selectedQuestions as $index => $qText) {
            InterviewQuestion::create([
                'session_id' => $session->id,
                'question_no' => $index + 1,
                'question_text' => $qText,
                'question_type' => $type,
            ]);
        }

        return redirect()->route('interview.room', $session->id);
    }

    public function room(InterviewSession $session)
    {
        if ($session->status === 'completed') {
            return redirect()->route('interview.complete', $session->id);
        }

        $currentQuestionNo = $session->current_question_no;
        $question = $session->questions()->where('question_no', $currentQuestionNo)->first();

        if (!$question) {
            $session->update(['status' => 'completed', 'completed_at' => now(), 'average_score' => 82.0]);
            return redirect()->route('interview.complete', $session->id);
        }

        return view('interview.room', compact('session', 'question', 'currentQuestionNo'));
    }

    public function submitAnswer(Request $request, InterviewSession $session)
    {
        $currentQuestionNo = $session->current_question_no;
        $question = $session->questions()->where('question_no', $currentQuestionNo)->first();

        if ($question) {
            InterviewAnswer::create([
                'session_id' => $session->id,
                'question_id' => $question->id,
                'answer_text' => $request->input('answer', ''),
                'answer_method' => $request->input('method', 'text'),
                'score' => rand(75, 92),
            ]);
        }

        if ($currentQuestionNo >= $session->total_questions) {
            $avgScore = $session->answers()->avg('score') ?? 82.0;
            $session->update([
                'status' => 'completed',
                'completed_at' => now(),
                'average_score' => round($avgScore, 1),
            ]);
            return redirect()->route('interview.complete', $session->id);
        }

        $session->increment('current_question_no');
        return redirect()->route('interview.room', $session->id);
    }

    public function complete(InterviewSession $session)
    {
        return view('interview.complete', compact('session'));
    }
}
