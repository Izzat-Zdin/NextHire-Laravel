@extends('layouts.app')

@section('title', 'AI Resume Analyzer')
@section('page_title', 'AI Resume Analyzer')

@section('content')
    <div class="page-intro">
        <div>
            <p class="eyebrow">Module 2 · Discover</p>
            <h1>Turn your resume into a stronger story</h1>
            <p>Upload a PDF or DOCX to preview a sample analysis based on your target Product Analyst role.</p>
        </div>
    </div>

    <div class="prototype-note">
        <x-icon name="shield-check" :size="17" />
        <span><strong>Prototype mode:</strong> no real AI parsing or file storage is connected. Results below use fictional demo data.</span>
    </div>

    <div class="content-grid wide-left">
        <!-- Upload Card -->
        <section class="card">
            <div class="mb-5 flex items-center justify-between gap-3">
                <h2 class="section-title">Resume upload</h2>
            </div>

            <form id="resumeUploadForm" method="POST" action="{{ route('resume.analyze') }}" enctype="multipart/form-data">
                @csrf
                <label class="upload-zone" for="resumeInput">
                    <input type="file" id="resumeInput" name="resume" accept=".pdf,.docx" onchange="handleFileSelected(this)">
                    <span class="upload-icon">
                        <x-icon name="upload-cloud" :size="27" />
                    </span>
                    <strong>Drop your resume here or browse</strong>
                    <p>PDF or DOCX · Maximum 5 MB</p>
                </label>

                <div id="fileRowContainer" class="file-row" style="{{ $fileName ? '' : 'display: none;' }}">
                    <span><x-icon name="file-text" :size="20" /></span>
                    <div>
                        <strong id="displayFileName">{{ $fileName ?? 'Selected_Resume.pdf' }}</strong>
                        <small>Uploaded for this session</small>
                    </div>
                    <span class="badge badge-green">
                        <x-icon name="check" :size="12" /> Ready
                    </span>
                    <button type="button" class="btn btn-icon btn-ghost" onclick="clearSelectedFile()">
                        <x-icon name="x" :size="16" />
                    </button>
                </div>

                <div id="uploadAlert" class="alert alert-error" style="display: none;">
                    Select a PDF or DOCX before starting the demo analysis.
                </div>

                <button type="submit" id="analyzeBtn" class="btn btn-primary mt-4 w-full">
                    <x-icon name="sparkles" :size="16" />
                    <span id="analyzeBtnText">Analyze resume</span>
                </button>
            </form>
        </section>

        <!-- Score Card -->
        <section class="card resume-score-card">
            <div class="score-ring score-blue" style="--score: {{ 76 * 3.6 }}deg">
                <div>
                    <strong>76</strong>
                    <span>Resume score</span>
                </div>
            </div>
            <h3>Strong foundation</h3>
            <p>Your experience is relevant, but clearer impact metrics and stronger SQL evidence would make your resume more competitive.</p>
            <div class="score-breakdown">
                <div><span>Role alignment</span><strong>82</strong></div>
                <div><span>Impact & evidence</span><strong>68</strong></div>
                <div><span>Clarity</span><strong>79</strong></div>
            </div>
        </section>
    </div>

    <!-- Results Section -->
    @if($hasAnalyzed)
        <div class="results-header">
            <div>
                <span class="badge badge-green">
                    <x-icon name="check-circle-2" :size="13" /> Analysis complete
                </span>
                <h2>Your sample resume insights</h2>
            </div>
            <small>Demo analysis · Updated just now</small>
        </div>

        <div class="content-grid">
            <section class="card">
                <div class="mb-5 flex items-center justify-between gap-3">
                    <h2 class="section-title">Extracted profile</h2>
                </div>

                <p class="summary-text">Early-career product professional with internship experience in product operations, KPI reporting, user research, and cross-functional delivery.</p>

                <div class="extracted-block">
                    <span>Education</span>
                    <strong>BSc Management & IT, Northbridge University</strong>
                </div>

                <div class="extracted-block">
                    <span>Experience</span>
                    <strong>1 internship · 3 academic projects</strong>
                </div>

                <div class="tag-row mt-4">
                    @foreach(["Excel", "User research", "Agile", "React", "Figma", "Data storytelling"] as $tag)
                        <span class="badge badge-slate">{{ $tag }}</span>
                    @endforeach
                </div>
            </section>

            <section class="card">
                <div class="mb-5 flex items-center justify-between gap-3">
                    <h2 class="section-title">Strengths & weaknesses</h2>
                </div>

                <div class="insight-list positive">
                    <div>
                        <x-icon name="check-circle-2" :size="16" />
                        <span>
                            <strong>Clear product focus</strong>
                            <small>Projects consistently align with target role.</small>
                        </span>
                    </div>
                    <div>
                        <x-icon name="check-circle-2" :size="16" />
                        <span>
                            <strong>Evidence of ownership</strong>
                            <small>Leadership and initiative are easy to identify.</small>
                        </span>
                    </div>
                </div>

                <div class="insight-list negative">
                    <div>
                        <x-icon name="zap" :size="16" />
                        <span>
                            <strong>Limited measurable impact</strong>
                            <small>Only 2 of 7 bullets include outcomes.</small>
                        </span>
                    </div>
                    <div>
                        <x-icon name="zap" :size="16" />
                        <span>
                            <strong>SQL evidence is missing</strong>
                            <small>Add a relevant project or course.</small>
                        </span>
                    </div>
                </div>
            </section>
        </div>

        <section class="card">
            <div class="mb-5 flex items-center justify-between gap-3">
                <h2 class="section-title">Priority improvements</h2>
            </div>

            <div class="suggestion-grid">
                <div class="suggestion">
                    <span>01</span>
                    <div>
                        <span class="badge badge-amber">High priority</span>
                        <h3>Quantify your impact</h3>
                        <p>Replace task-led bullets with outcome-led evidence.</p>
                    </div>
                </div>

                <div class="suggestion">
                    <span>02</span>
                    <div>
                        <span class="badge badge-amber">High priority</span>
                        <h3>Show applied SQL</h3>
                        <p>Add your retail cohort analysis project and key finding.</p>
                    </div>
                </div>

                <div class="suggestion">
                    <span>03</span>
                    <div>
                        <span class="badge badge-blue">Medium priority</span>
                        <h3>Sharpen the summary</h3>
                        <p>Name your target role and strongest differentiator.</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @push('scripts')
    <script>
        function handleFileSelected(input) {
            if (input.files && input.files[0]) {
                document.getElementById('displayFileName').textContent = input.files[0].name;
                document.getElementById('fileRowContainer').style.display = 'flex';
                document.getElementById('uploadAlert').style.display = 'none';
            }
        }

        function clearSelectedFile() {
            document.getElementById('resumeInput').value = '';
            document.getElementById('fileRowContainer').style.display = 'none';
        }

        document.getElementById('resumeUploadForm').addEventListener('submit', function(e) {
            const fileRowVisible = document.getElementById('fileRowContainer').style.display !== 'none';
            if (!fileRowVisible) {
                e.preventDefault();
                document.getElementById('uploadAlert').style.display = 'flex';
                return;
            }
            const btn = document.getElementById('analyzeBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner"></span> <span>Analysing demo resume…</span>';
        });
    </script>
    @endpush
@endsection
