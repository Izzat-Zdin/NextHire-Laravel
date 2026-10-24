@extends('layouts.app')

@section('title', 'Career Dashboard')
@section('page_title', 'Career Dashboard')

@section('content')
    <!-- Hero Section -->
    <div class="hero">
        <div>
            <span class="badge badge-violet">
                <x-icon name="sparkles" :size="13" />
                <span>Your weekly career brief</span>
            </span>
            <h1>Good morning, Maya.</h1>
            <p>You’re making strong progress. Complete one focused activity today to keep your momentum going.</p>
            <div class="hero-actions">
                <a href="{{ route('interview') }}" class="btn btn-primary">
                    <x-icon name="play" :size="16" />
                    <span>Start mock interview</span>
                </a>
                <a href="{{ route('learning') }}" class="btn btn-secondary">
                    <span>View learning plan</span>
                </a>
            </div>
        </div>

        <div class="hero-score">
            <div class="score-ring score-violet" style="--score: {{ 78 * 3.6 }}deg">
                <div>
                    <strong>78</strong>
                    <span>Ready</span>
                </div>
            </div>
            <div>
                <strong>Career readiness</strong>
                <span>+6 points this month</span>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="card stat-card">
            <div class="icon-box icon-blue">
                <x-icon name="circle-user-round" :size="19" />
            </div>
            <div>
                <p>Profile completion</p>
                <strong>85%</strong>
                <small>Add one certification</small>
            </div>
        </div>

        <div class="card stat-card">
            <div class="icon-box icon-violet">
                <x-icon name="file-text" :size="19" />
            </div>
            <div>
                <p>Latest resume score</p>
                <strong>76/100</strong>
                <small>+8 after last update</small>
            </div>
        </div>

        <div class="card stat-card">
            <div class="icon-box icon-green">
                <x-icon name="mic" :size="19" />
            </div>
            <div>
                <p>Recent interview</p>
                <strong>82/100</strong>
                <small>Strong answer relevance</small>
            </div>
        </div>

        <div class="card stat-card">
            <div class="icon-box icon-amber">
                <x-icon name="target" :size="19" />
            </div>
            <div>
                <p>Skill gaps</p>
                <strong>3 skills</strong>
                <small>SQL is highest priority</small>
            </div>
        </div>
    </div>

    <!-- Content Grid: Trend & Priority Skills -->
    <div class="content-grid wide-left">
        <section class="card">
            <div class="mb-5 flex items-center justify-between gap-3">
                <h2 class="section-title">Interview score trend</h2>
                <a href="{{ route('progress') }}" class="text-action">
                    <span>View progress</span>
                    <x-icon name="arrow-right" :size="14" />
                </a>
            </div>

            <div class="chart-heading">
                <div>
                    <strong>82</strong>
                    <span>Latest score</span>
                </div>
                <span class="badge badge-green">
                    <x-icon name="trending-up" :size="13" />
                    <span>24% improvement</span>
                </span>
            </div>

            <div class="trend-chart">
                <div class="chart-grid">
                    @php
                        $trend = [
                            ['label' => 'Jan', 'value' => 58],
                            ['label' => 'Feb', 'value' => 64],
                            ['label' => 'Mar', 'value' => 71],
                            ['label' => 'Apr', 'value' => 76],
                            ['label' => 'May', 'value' => 82],
                        ];
                    @endphp
                    @foreach($trend as $col)
                        <div class="chart-column">
                            <span class="chart-value">{{ $col['value'] }}</span>
                            <div class="chart-bar" style="height: {{ max(24, $col['value']) }}%"></div>
                            <span class="chart-label">{{ $col['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="card">
            <div class="mb-5 flex items-center justify-between gap-3">
                <h2 class="section-title">Priority skill gaps</h2>
            </div>

            <div class="skill-list">
                <div>
                    <div class="row-between">
                        <span>SQL & data queries</span>
                        <span class="badge badge-amber">High</span>
                    </div>
                    <div class="progress-track" aria-label="42% complete">
                        <div class="progress-fill progress-blue" style="width: 42%"></div>
                    </div>
                </div>

                <div>
                    <div class="row-between">
                        <span>Product analytics</span>
                        <span class="badge badge-amber">High</span>
                    </div>
                    <div class="progress-track" aria-label="58% complete">
                        <div class="progress-fill progress-blue" style="width: 58%"></div>
                    </div>
                </div>

                <div>
                    <div class="row-between">
                        <span>Stakeholder communication</span>
                        <span class="badge badge-blue">Medium</span>
                    </div>
                    <div class="progress-track" aria-label="71% complete">
                        <div class="progress-fill progress-violet" style="width: 71%"></div>
                    </div>
                </div>
            </div>

            <a href="{{ route('learning') }}" class="btn btn-secondary mt-5 w-full">
                <span>Explore recommendations</span>
            </a>
        </section>
    </div>

    <!-- Career Workflow -->
    <section class="card workflow-card">
        <div class="mb-5 flex items-center justify-between gap-3">
            <h2 class="section-title">Your career workflow</h2>
        </div>

        <div class="workflow">
            @foreach($modules as $index => $mod)
                <a href="{{ route($mod['id']) }}" class="workflow-step">
                    <span class="step-number">{{ $index + 1 }}</span>
                    <span class="step-icon">
                        <x-icon :name="$mod['icon']" :size="20" />
                    </span>
                    <span>
                        <strong>{{ $mod['short'] }}</strong>
                        <small>{{ $mod['status'] }}</small>
                    </span>
                    <x-icon name="arrow-right" :size="16" />
                </a>
            @endforeach
        </div>
    </section>

    <!-- Bottom Features: Recommendation & Activity -->
    <div class="content-grid">
        <section class="card">
            <div class="mb-5 flex items-center justify-between gap-3">
                <h2 class="section-title">Recommended for you</h2>
            </div>

            <div class="recommendation-feature">
                <div class="course-art">
                    <x-icon name="bar-chart-3" :size="34" />
                </div>
                <div>
                    <span class="badge badge-violet">Top priority</span>
                    <h3>SQL for Product Analytics</h3>
                    <p>Build query confidence with a practical, project-led course.</p>
                    <div class="course-meta">
                        <span>
                            <x-icon name="clock-3" :size="14" /> 4 hours
                        </span>
                        <span>
                            <x-icon name="gauge" :size="14" /> Beginner
                        </span>
                    </div>
                    <a href="{{ route('learning') }}" class="btn btn-sm btn-primary">
                        <span>Start learning</span>
                        <x-icon name="arrow-right" :size="14" />
                    </a>
                </div>
            </div>
        </section>

        <section class="card">
            <div class="mb-5 flex items-center justify-between gap-3">
                <h2 class="section-title">Recent activity</h2>
            </div>

            <div class="timeline">
                <div class="timeline-item">
                    <span><x-icon name="mic" :size="16" /></span>
                    <div>
                        <strong>Mock interview completed</strong>
                        <p>Scored 82 in Product Analyst practice</p>
                    </div>
                    <small>2 hours ago</small>
                </div>

                <div class="timeline-item">
                    <span><x-icon name="file-text" :size="16" /></span>
                    <div>
                        <strong>Resume improved</strong>
                        <p>Added measurable project outcomes</p>
                    </div>
                    <small>Yesterday</small>
                </div>

                <div class="timeline-item">
                    <span><x-icon name="award" :size="16" /></span>
                    <div>
                        <strong>Course milestone reached</strong>
                        <p>SQL fundamentals: 3 of 6 lessons</p>
                    </div>
                    <small>2 days ago</small>
                </div>
            </div>
        </section>
    </div>
@endsection
