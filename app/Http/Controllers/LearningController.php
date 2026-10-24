<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningItem;

class LearningController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input('type', 'All');
        $search = $request->input('search', '');

        $query = LearningItem::query();

        if ($type && $type !== 'All') {
            $query->where('type', $type);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('skill', 'like', "%{$search}%");
            });
        }

        $items = $query->get();

        return view('learning', compact('items', 'type', 'search'));
    }

    public function toggleComplete(LearningItem $item)
    {
        $item->is_completed = !$item->is_completed;
        $item->save();

        return back()->with('success', $item->is_completed ? 'Marked as completed!' : 'Marked as in progress.');
    }

    public function toggleSave(LearningItem $item)
    {
        $item->is_saved = !$item->is_saved;
        $item->save();

        return back()->with('success', $item->is_saved ? 'Saved to your learning plan!' : 'Removed from saved items.');
    }
}
