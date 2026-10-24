@extends('layouts.app')

@section('title', 'Interview Completed - NextHire AI')
@section('page_title', 'Interview Complete')

@section('content')
    <div class="completion-page">
        <span class="completion-icon">
            <x-icon name="check-circle-2" :size="34" />
        </span>
        <span class="badge badge-green">Practice completed</span>
        <h1>Great work, Maya.</h1>
        <p>You completed {{ $session->total_questions }} questions in this session. Your sample assessment report has been generated and is ready to review.</p>

        <div class="completion-stats">
            <div>
                <strong>{{ $session->average_score ? round($session->average_score) : 82 }}</strong>
                <span>Overall score</span>
            </div>
            <div>
                <strong>86%</strong>
                <span>Answer relevance</span>
            </div>
            <div>
                <strong>4:12</strong>
                <span>Avg. response</span>
            </div>
        </div>

        <div class="flex-actions">
            <a href="{{ route('interview') }}" class="btn btn-primary">
                <span>Practice again</span>
            </a>
            <a href="{{ route('assessment') }}" class="btn btn-secondary">
                <span>View assessment</span>
                <x-icon name="arrow-right" :size="16" />
            </a>
        </div>
    </div>
@endsection
