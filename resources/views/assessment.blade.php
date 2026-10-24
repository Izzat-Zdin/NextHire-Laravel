@extends('layouts.app')

@section('title', 'Career Readiness Assessment')
@section('page_title', 'Career Readiness Assessment')

@section('content')
    <div class="page-intro">
        <div>
            <p class="eyebrow">Module 4 · Reflect</p>
            <h1>Understand every response</h1>
            <p>Review your sample interview assessment and turn feedback into focused next steps.</p>
        </div>
        <button type="button" class="btn btn-secondary" onclick="window.print()">
            <x-icon name="file-text" :size="16" />
            <span>Export sample report</span>
        </button>
    </div>

    <div class="guidance-note">
        <x-icon name="lightbulb" :size="18" />
        <span><strong>Use scores as guidance.</strong> AI-style feedback in this prototype is for practice and is not a definitive hiring decision.</span>
    </div>

    <!-- Assessment Hero -->
    <div class="assessment-hero">
        <div class="score-ring score-violet" style="--score: {{ 82 * 3.6 }}deg">
            <div>
                <strong>82</strong>
                <span>Overall</span>
            </div>
        </div>
        <div class="assessment-copy">
            <span class="badge badge-green">Strong performance</span>
            <h2>You communicated clearly and connected your examples to business outcomes.</h2>
            <p>Focus next on concise technical explanations and stronger closing statements.</p>
        </div>
        <div class="assessment-meta">
            <span>Behavioural</span>
            <strong>Product Analyst</strong>
            <small>Completed today · 12 min</small>
        </div>
    </div>

    <!-- Tabs -->
    <div class="tab-list">
        <a href="{{ route('assessment', ['tab' => 'Overview']) }}" class="{{ $tab === 'Overview' ? 'active' : '' }}">Overview</a>
        <a href="{{ route('assessment', ['tab' => 'Question feedback']) }}" class="{{ $tab === 'Question feedback' ? 'active' : '' }}">Question feedback</a>
        <a href="{{ route('assessment', ['tab' => 'Full report']) }}" class="{{ $tab === 'Full report' ? 'active' : '' }}">Full report</a>
    </div>

    @if($tab === 'Overview')
        <div class="stats-grid three">
            <div class="card stat-card">
                <div class="icon-box icon-blue">
                    <x-icon name="message-square-text" :size="19" />
                </div>
                <div>
                    <p>Communication</p>
                    <strong>84/100</strong>
                    <small>Clear and structured</small>
                </div>
            </div>

            <div class="card stat-card">
                <div class="icon-box icon-green">
                    <x-icon name="target" :size="19" />
                </div>
                <div>
                    <p>Answer relevance</p>
                    <strong>86/100</strong>
                    <small>Strong examples</small>
                </div>
            </div>

            <div class="card stat-card">
                <div class="icon-box icon-violet">
                    <x-icon name="activity" :size="19" />
                </div>
                <div>
                    <p>Technical response</p>
                    <strong>74/100</strong>
                    <small>Needs more depth</small>
                </div>
            </div>
        </div>

        <div class="content-grid">
            <section class="card">
                <div class="mb-5 flex items-center justify-between gap-3">
                    <h2 class="section-title">Performance by question</h2>
                </div>

                <div class="trend-chart">
                    <div class="chart-grid">
                        @php
                            $scores = [
                                ['label' => 'Q1', 'value' => 78],
                                ['label' => 'Q2', 'value' => 85],
                                ['label' => 'Q3', 'value' => 74],
                                ['label' => 'Q4', 'value' => 88],
                                ['label' => 'Q5', 'value' => 84],
                            ];
                        @endphp
                        @foreach($scores as $col)
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
                    <h2 class="section-title">What stood out</h2>
                </div>

                <div class="insight-list positive">
                    <div>
                        <x-icon name="check-circle-2" :size="16" />
                        <span>
                            <strong>Strong STAR structure</strong>
                            <small>Your challenge and impact were easy to follow.</small>
                        </span>
                    </div>
                    <div>
                        <x-icon name="check-circle-2" :size="16" />
                        <span>
                            <strong>Business awareness</strong>
                            <small>You linked metrics to customer outcomes.</small>
                        </span>
                    </div>
                </div>

                <div class="insight-list negative">
                    <div>
                        <x-icon name="zap" :size="16" />
                        <span>
                            <strong>Technical precision</strong>
                            <small>Define metrics before explaining the analysis.</small>
                        </span>
                    </div>
                </div>
            </section>
        </div>
    @elseif($tab === 'Question feedback')
        <div class="question-feedback-list">
            @foreach($questions as $index => $q)
                @php
                    $isWeak = ($index === 2);
                    $scoreVal = $isWeak ? 74 : (78 + $index * 2);
                @endphp
                <section class="card">
                    <div class="feedback-head">
                        <span>Q{{ $index + 1 }}</span>
                        <div>
                            <h3>{{ $q }}</h3>
                            <p>{{ $isWeak ? 'Add more detail about the analysis method and how you validated the result.' : 'Relevant example, clear structure, and a specific outcome.' }}</p>
                        </div>
                        <span class="badge {{ $isWeak ? 'badge-amber' : 'badge-green' }}">
                            {{ $scoreVal }}/100
                        </span>
                    </div>
                </section>
            @endforeach
        </div>
    @elseif($tab === 'Full report')
        <section class="card report-view">
            <div class="report-header">
                <div class="logo-mark small">N</div>
                <div>
                    <h2>NextHire AI Interview Report</h2>
                    <p>Maya Chen · Associate Product Analyst</p>
                </div>
                <span class="badge badge-slate">Demo report</span>
            </div>

            <div class="report-grid">
                <div>
                    <span>Overall score</span>
                    <strong>82/100</strong>
                </div>
                <div>
                    <span>Top strength</span>
                    <strong>Answer relevance</strong>
                </div>
                <div>
                    <span>Priority focus</span>
                    <strong>Technical depth</strong>
                </div>
            </div>

            <h3>Coach summary</h3>
            <p>Maya demonstrates strong early-career interview readiness. Her responses are well structured, personable, and grounded in practical experience. Continued SQL study and repeated practice explaining analytical methods will increase confidence for product analyst interviews.</p>
        </section>
    @endif
@endsection
