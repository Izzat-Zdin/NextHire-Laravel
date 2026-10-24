<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InterviewSession;
use App\Models\LearningItem;

class DashboardController extends Controller
{
    public function index()
    {
        $recentSessions = InterviewSession::latest()->take(3)->get();
        $recommendedCourse = LearningItem::where('priority', 'High')->first();

        $modules = [
            ['id' => 'profile', 'label' => 'User Profile Management', 'short' => 'Profile', 'icon' => 'user-round', 'status' => 'Completed'],
            ['id' => 'resume', 'label' => 'AI Resume Analyzer', 'short' => 'Resume Analyzer', 'icon' => 'file-search', 'status' => 'Completed'],
            ['id' => 'interview', 'label' => 'AI Mock Interview Engine', 'short' => 'Mock Interview', 'icon' => 'message-square-text', 'status' => 'Completed'],
            ['id' => 'assessment', 'label' => 'Interview & Career Readiness Assessment', 'short' => 'Assessment', 'icon' => 'gauge', 'status' => 'Review now'],
            ['id' => 'learning', 'label' => 'Learning Recommendation', 'short' => 'Learning', 'icon' => 'book-open', 'status' => 'Next step'],
            ['id' => 'progress', 'label' => 'Recommendation & Progress Tracking', 'short' => 'Progress', 'icon' => 'trending-up', 'status' => 'Next step'],
        ];

        return view('dashboard', compact('modules', 'recentSessions', 'recommendedCourse'));
    }
}
