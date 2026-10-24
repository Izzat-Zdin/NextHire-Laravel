<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $profile = session('user_profile', [
            'name' => 'Maya Chen',
            'email' => 'maya.chen@university.edu',
            'phone' => '+1 647 555 0143',
            'location' => 'Toronto, Canada',
            'role_title' => 'Aspiring Product Analyst',
            'completion' => 85,
        ]);

        $skills = [
            ['name' => 'Excel & reporting', 'level' => 88],
            ['name' => 'User research', 'level' => 78],
            ['name' => 'Data storytelling', 'level' => 72],
            ['name' => 'SQL', 'level' => 42],
        ];

        return view('profile', compact('profile', 'skills'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:100',
        ]);

        $profile = array_merge(session('user_profile', [
            'role_title' => 'Aspiring Product Analyst',
            'completion' => 85,
        ]), $validated);

        session(['user_profile' => $profile]);

        return redirect()->route('profile')->with('success', 'Profile saved for this session.');
    }
}
