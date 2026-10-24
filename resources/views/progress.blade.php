@extends('layouts.app')

@section('title', 'Recommendation & Progress Tracking')
@section('page_title', 'Recommendation & Progress Tracking')

@section('content')
    <div class="page-intro">
        <div>
            <p class="eyebrow">Module 6 · Improve</p>
            <h1>See how far you’ve come</h1>
            <p>Connect practice, learning, and readiness into one clear view of your development.</p>
        </div>
        <form method="GET" action="{{ route('progress') }}">
            <label class="field">
                <span>View period</span>
                <select name="period" onchange="this.form.submit()">
                    <option value="3 months" {{ $period === '3 months' ? 'selected' : '' }}>3 months</option>
                    <option value="6 months" {{ $period === '6 months' ? 'selected' : '' }}>6 months</option>
                    <option value="12 months" {{ $period === '12 months' ? 'selected' : '' }}>12 months</option>
                </select>
            </label>
        </form>
    </div>

    <!-- Progress Hero -->
    <div class="progress-hero">
        <div>
            <span class="badge badge-violet">
                <x-icon name="sparkles" :size="13" />
                <span>Monthly progress report</span>
            </span>
            <h2>Your readiness score is up 18 points.</h2>
            <p>Consistent interview practice and stronger resume evidence are making the biggest difference.</p>
        </div>
        <div class="progress-score">
            <strong>78</strong>
            <span>from 60</span>
            <span class="badge badge-green">
                <x-icon name="trending-up" :size="12" /> +30%
            </span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="card stat-card">
            <div class="icon-box icon-blue">
                <x-icon name="mic" :size="19" />
            </div>
            <div>
                <p>Interviews practised</p>
                <strong>8</strong>
                <small>3 this month</small>
            </div>
        </div>

        <div class="card stat-card">
            <div class="icon-box icon-violet">
                <x-icon name="book-open" :size="19" />
            </div>
            <div>
                <p>Activities completed</p>
                <strong>12</strong>
                <small>4 in progress</small>
            </div>
        </div>

        <div class="card stat-card">
            <div class="icon-box icon-green">
                <x-icon name="award" :size="19" />
            </div>
            <div>
                <p>Skills improved</p>
                <strong>5</strong>
                <small>2 reached proficiency</small>
            </div>
        </div>

        <div class="card stat-card">
            <div class="icon-box icon-amber">
                <x-icon name="target" :size="19" />
            </div>
            <div>
                <p>Remaining gaps</p>
                <strong>3</strong>
                <small>Down from 7</small>
            </div>
        </div>
    </div>

    <!-- Trend & Readiness Grid -->
    <div class="content-grid wide-left">
        <section class="card">
            <div class="mb-5 flex items-center justify-between gap-3">
                <h2 class="section-title">Interview score trend</h2>
                <span class="badge badge-green">+24 points</span>
            </div>

            <div class="trend-chart">
                <div class="chart-grid">
                    @foreach($currentChart['values'] as $i => $val)
                        <div class="chart-column">
                            <span class="chart-value">{{ $val }}</span>
                            <div class="chart-bar" style="height: {{ max(24, $val) }}%"></div>
                            <span class="chart-label">{{ $currentChart['labels'][$i] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="card">
            <div class="mb-5 flex items-center justify-between gap-3">
                <h2 class="section-title">Career readiness</h2>
            </div>

            <div class="readiness-list">
                @php
                    $readiness = [
                        ['label' => 'Profile strength', 'val' => 85],
                        ['label' => 'Resume quality', 'val' => 76],
                        ['label' => 'Interview readiness', 'val' => 82],
                        ['label' => 'Skill alignment', 'val' => 69],
                    ];
                @endphp
                @foreach($readiness as $r)
                    <div>
                        <div class="row-between">
                            <span>{{ $r['label'] }}</span>
                            <strong>{{ $r['val'] }}%</strong>
                        </div>
                        <div class="progress-track" aria-label="{{ $r['val'] }}%">
                            <div class="progress-fill {{ $r['val'] > 80 ? 'progress-green' : 'progress-violet' }}" style="width: {{ $r['val'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <!-- Skills Development & Learning Status -->
    <div class="content-grid">
        <section class="card">
            <div class="mb-5 flex items-center justify-between gap-3">
                <h2 class="section-title">Skills development</h2>
            </div>

            <div class="skills-table">
                @php
                    $skillsDev = [
                        ['Data storytelling', '58', '78', '+20'],
                        ['Interview structure', '61', '84', '+23'],
                        ['SQL', '24', '42', '+18'],
                        ['Product metrics', '43', '58', '+15'],
                    ];
                @endphp
                @foreach($skillsDev as $row)
                    <div>
                        <strong>{{ $row[0] }}</strong>
                        <span>{{ $row[1] }}% → {{ $row[2] }}%</span>
                        <span class="badge badge-green">{{ $row[3] }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="card">
            <div class="mb-5 flex items-center justify-between gap-3">
                <h2 class="section-title">Learning status</h2>
            </div>

            <div class="status-donut-wrap">
                <div class="status-donut">
                    <div>
                        <strong>18</strong>
                        <span>Activities</span>
                    </div>
                </div>
                <div class="donut-legend">
                    <span><i class="green"></i> 8 completed</span>
                    <span><i class="violet"></i> 4 in progress</span>
                    <span><i></i> 6 pending</span>
                </div>
            </div>
        </section>
    </div>

    <!-- Development Roadmap -->
    <section class="card">
        <div class="mb-5 flex items-center justify-between gap-3">
            <h2 class="section-title">Development roadmap</h2>
        </div>

        <div class="roadmap">
            @php
                $roadmap = [
                    ['title' => 'Complete SQL foundations', 'date' => 'May 18', 'status' => 'Completed', 'tone' => 'green'],
                    ['title' => 'Build product metrics project', 'date' => 'May 31', 'status' => 'In progress', 'tone' => 'violet'],
                    ['title' => 'Reach 85+ interview score', 'date' => 'June 15', 'status' => 'Next milestone', 'tone' => 'blue'],
                    ['title' => 'Apply to 5 target internships', 'date' => 'June 30', 'status' => 'Upcoming', 'tone' => 'slate'],
                ];
            @endphp
            @foreach($roadmap as $index => $item)
                <div class="roadmap-item">
                    <span class="roadmap-dot {{ $item['tone'] }}">
                        @if($index === 0)
                            <x-icon name="check" :size="14" />
                        @else
                            {{ $index + 1 }}
                        @endif
                    </span>
                    <div>
                        <strong>{{ $item['title'] }}</strong>
                        <p>Target · {{ $item['date'] }}</p>
                    </div>
                    <span class="badge badge-{{ $item['tone'] }}">{{ $item['status'] }}</span>
                </div>
            @endforeach
        </div>
    </section>
@endsection
