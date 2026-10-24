@extends('layouts.app')

@section('title', 'AI Mock Interview Engine')
@section('page_title', 'AI Mock Interview Engine')

@section('content')
    <div class="page-intro">
        <div>
            <p class="eyebrow">Module 3 · Practise</p>
            <h1>Practise with purpose</h1>
            <p>Configure a realistic interview session and build confidence one answer at a time.</p>
        </div>
    </div>

    <div class="prototype-note">
        <x-icon name="shield-check" :size="17" />
        <span>Sesi temuduga dan jawapan teks disimpan terus ke pangkalan data SQLite Laravel secara automatik.</span>
    </div>

    <div class="content-grid wide-left">
        <!-- Setup Card -->
        <section class="card">
            <div class="mb-5 flex items-center justify-between gap-3">
                <h2 class="section-title">Set up your interview</h2>
            </div>

            <form method="POST" action="{{ route('interview.start') }}">
                @csrf
                <div class="interview-type-grid">
                    <label class="type-card active" id="card-behavioral" onclick="selectType('behavioral')">
                        <input type="radio" name="type" value="behavioral" checked style="display: none;">
                        <x-icon name="message-square-text" :size="20" />
                        <strong>Behavioural</strong>
                        <span>Experiences and soft skills</span>
                        <x-icon name="check-circle-2" :size="17" />
                    </label>

                    <label class="type-card" id="card-hr" onclick="selectType('hr')">
                        <input type="radio" name="type" value="hr" style="display: none;">
                        <x-icon name="user-round" :size="20" />
                        <strong>HR</strong>
                        <span>Motivation and role fit</span>
                    </label>

                    <label class="type-card" id="card-technical" onclick="selectType('technical')">
                        <input type="radio" name="type" value="technical" style="display: none;">
                        <x-icon name="activity" :size="20" />
                        <strong>Technical</strong>
                        <span>Role-specific knowledge</span>
                    </label>
                </div>

                <div class="form-grid mt-6">
                    <label class="field">
                        <span>Target job role</span>
                        <select name="role" id="roleSelect" onchange="updatePreview()">
                            <option value="Associate Product Analyst" selected>Associate Product Analyst</option>
                            <option value="Business Analyst Intern">Business Analyst Intern</option>
                            <option value="Product Operations Associate">Product Operations Associate</option>
                        </select>
                    </label>

                    <label class="field">
                        <span>Difficulty</span>
                        <select name="difficulty" id="diffSelect" onchange="updatePreview()">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate" selected>Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                    </label>

                    <label class="field">
                        <span>Number of questions</span>
                        <select name="count" id="countSelect" onchange="updatePreview()">
                            <option value="3">3 questions</option>
                            <option value="5" selected>5 questions</option>
                        </select>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary mt-6">
                    <x-icon name="play" :size="16" />
                    <span>Enter interview room</span>
                </button>
            </form>
        </section>

        <!-- Preview Stack -->
        <div class="stack">
            <section class="card session-preview">
                <span class="badge badge-violet">Session preview</span>
                <div class="preview-icon">
                    <x-icon name="message-square-text" :size="30" />
                </div>
                <h3 id="previewTitle">Behavioural interview</h3>
                <p id="previewRole">Associate Product Analyst</p>
                <div class="preview-facts">
                    <span>
                        <x-icon name="gauge" :size="15" />
                        <span id="previewDiff">Intermediate</span>
                    </span>
                    <span>
                        <x-icon name="clock-3" :size="15" />
                        <span>About 15 min</span>
                    </span>
                    <span>
                        <x-icon name="file-text" :size="15" />
                        <span id="previewCount">5 questions</span>
                    </span>
                </div>
            </section>

            <section class="card">
                <div class="mb-5 flex items-center justify-between gap-3">
                    <h2 class="section-title">Tips before you start</h2>
                </div>
                <ul class="tips-list">
                    <li>Find a quiet, well-lit space.</li>
                    <li>Use specific examples and measurable outcomes.</li>
                    <li>Keep most answers between 60–120 seconds.</li>
                </ul>
            </section>
        </div>
    </div>

    @push('scripts')
    <script>
        function selectType(val) {
            ['behavioral', 'hr', 'technical'].forEach(t => {
                const card = document.getElementById('card-' + t);
                const input = card.querySelector('input');
                if (t === val) {
                    card.classList.add('active');
                    input.checked = true;
                    document.getElementById('previewTitle').textContent = (t.charAt(0).toUpperCase() + t.slice(1)) + ' interview';
                } else {
                    card.classList.remove('active');
                    input.checked = false;
                }
            });
        }

        function updatePreview() {
            document.getElementById('previewRole').textContent = document.getElementById('roleSelect').value;
            document.getElementById('previewDiff').textContent = document.getElementById('diffSelect').value;
            document.getElementById('previewCount').textContent = document.getElementById('countSelect').value + ' questions';
        }
    </script>
    @endpush
@endsection
