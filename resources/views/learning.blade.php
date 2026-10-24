@extends('layouts.app')

@section('title', 'Learning Recommendation')
@section('page_title', 'Learning Recommendation')

@section('content')
    <div class="page-intro">
        <div>
            <p class="eyebrow">Module 5 · Grow</p>
            <h1>A learning plan shaped around your gaps</h1>
            <p>Prioritized courses, credentials, tutorials, and practice activities based on your fictional profile insights.</p>
        </div>
    </div>

    <!-- Summary Statistics -->
    <div class="learning-summary">
        <div>
            <span class="summary-icon">
                <x-icon name="target" :size="21" />
            </span>
            <div>
                <strong>3 priority skill gaps</strong>
                <p>SQL, product analytics, stakeholder communication</p>
            </div>
        </div>

        <div>
            <span class="summary-icon violet">
                <x-icon name="clock-3" :size="21" />
            </span>
            <div>
                <strong>9 hours this month</strong>
                <p>Suggested learning commitment</p>
            </div>
        </div>

        <div>
            <span class="summary-icon green">
                <x-icon name="trending-up" :size="21" />
            </span>
            <div>
                <strong>+7 readiness points</strong>
                <p>Estimated demo impact</p>
            </div>
        </div>
    </div>

    <!-- Search & Filter Controls -->
    <div class="filters">
        <form method="GET" action="{{ route('learning') }}" class="search-box">
            <input type="hidden" name="type" value="{{ $type }}">
            <x-icon name="search" :size="17" />
            <input type="text" name="search" value="{{ $search }}" placeholder="Search recommendations" onchange="this.form.submit()">
        </form>

        <div class="filter-pills">
            @foreach(['All', 'Course', 'Certification', 'Tutorial', 'Practice', 'Project'] as $pill)
                <a href="{{ route('learning', ['type' => $pill, 'search' => $search]) }}" class="{{ $type === $pill ? 'active' : '' }}">
                    {{ $pill }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Items Grid -->
    @if($items->count() > 0)
        <div class="learning-grid">
            @foreach($items as $index => $item)
                @php
                    $artClass = 'art-' . (($index % 3) + 1);
                    $badgeTone = $item->priority === 'High' ? 'amber' : ($item->priority === 'Medium' ? 'blue' : 'slate');
                @endphp
                <div class="card learning-card">
                    <div class="learning-art {{ $artClass }}">
                        <x-icon name="book-open" :size="28" />
                        <span class="badge badge-{{ $badgeTone }}">{{ $item->priority }} priority</span>
                    </div>

                    <div class="learning-body">
                        <div class="row-between">
                            <span class="badge badge-violet">{{ $item->type }}</span>
                            <form method="POST" action="{{ route('learning.toggle-save', $item->id) }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-icon btn-ghost" title="{{ $item->is_saved ? 'Remove bookmark' : 'Save to plan' }}">
                                    <x-icon name="save" :size="16" class="{{ $item->is_saved ? 'text-success' : '' }}" />
                                </button>
                            </form>
                        </div>

                        <h3>{{ $item->title }}</h3>
                        <p><strong>Builds:</strong> {{ $item->skill }}</p>

                        <div class="course-meta">
                            <span>
                                <x-icon name="gauge" :size="14" /> {{ $item->level }}
                            </span>
                            <span>
                                <x-icon name="clock-3" :size="14" /> {{ $item->duration }}
                            </span>
                        </div>

                        <form method="POST" action="{{ route('learning.toggle-complete', $item->id) }}">
                            @csrf
                            <button type="submit" class="btn w-full {{ $item->is_completed ? 'btn-secondary' : 'btn-primary' }}">
                                @if($item->is_completed)
                                    <x-icon name="check" :size="15" />
                                    <span>Completed</span>
                                @else
                                    <x-icon name="play" :size="15" />
                                    <span>Start learning</span>
                                @endif
                            </button>
                        </form>

                        @if($item->is_saved)
                            <small class="saved-text">
                                <x-icon name="check" :size="12" /> Saved to your plan
                            </small>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <section class="card">
            <div class="empty-state">
                <x-icon name="search" :size="26" />
                <h3>No matching recommendations</h3>
                <p>Try a different search or reset the filter.</p>
                <a href="{{ route('learning') }}" class="btn btn-secondary">
                    <span>Reset filters</span>
                </a>
            </div>
        </section>
    @endif
@endsection
