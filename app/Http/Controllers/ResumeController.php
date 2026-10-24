<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index()
    {
        $fileName = session('resume_file', 'Maya_Chen_Resume_2026.pdf');
        $hasAnalyzed = session('resume_analyzed', true);

        return view('resume', compact('fileName', 'hasAnalyzed'));
    }

    public function analyze(Request $request)
    {
        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $fileName = $file->getClientOriginalName();
            session(['resume_file' => $fileName]);
        }

        session(['resume_analyzed' => true]);

        return redirect()->route('resume')->with('success', 'Resume analyzed successfully with demo insights.');
    }

    public function reset()
    {
        session()->forget(['resume_file', 'resume_analyzed']);
        return redirect()->route('resume');
    }
}
