<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'Overview');
        $questions = [
            "Tell me about a project where you used data to improve a product or process.",
            "How would you prioritize features when stakeholders have competing requirements?",
            "Describe a time you received difficult feedback. How did you respond?",
            "How would you investigate a sudden drop in a product's weekly active users?",
            "Why are you interested in this Associate Product Analyst role?",
        ];

        return view('assessment', compact('tab', 'questions'));
    }
}
