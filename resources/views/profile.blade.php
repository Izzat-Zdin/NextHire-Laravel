@extends('layouts.app')

@section('title', 'User Profile Management')
@section('page_title', 'User Profile Management')

@section('content')
    <div class="page-intro">
        <div>
            <p class="eyebrow">Module 1 · Foundation</p>
            <h1>Build a profile that works for you</h1>
            <p>Keep your background, strengths, and career goals current for more relevant demo recommendations.</p>
        </div>
        <button type="button" class="btn btn-secondary" onclick="toggleEditMode()">
            <x-icon name="plus" :size="16" />
            <span id="editBtnText">Edit profile</span>
        </button>
    </div>

    <!-- Profile Overview Card -->
    <section class="card profile-overview">
        <div class="avatar-large">MC</div>
        <div class="profile-copy">
            <h2>{{ $profile['name'] }}</h2>
            <p>{{ $profile['role_title'] }} · {{ $profile['location'] }}</p>
            <div class="tag-row">
                <span class="badge badge-blue">Open to internships</span>
                <span class="badge badge-violet">Available May 2026</span>
            </div>
        </div>
        <div class="completion">
            <div class="row-between">
                <strong>Profile completion</strong>
                <b>{{ $profile['completion'] }}%</b>
            </div>
            <div class="progress-track" aria-label="{{ $profile['completion'] }}% complete">
                <div class="progress-fill progress-violet" style="width: {{ $profile['completion'] }}%"></div>
            </div>
            <small>Add a certification to complete your profile.</small>
        </div>
    </section>

    <!-- Main Profile Grid -->
    <div class="content-grid wide-left profile-grid">
        <div class="stack">
            <!-- Personal Information Form -->
            <section class="card">
                <div class="mb-5 flex items-center justify-between gap-3">
                    <h2 class="section-title">Personal information</h2>
                </div>

                <form id="profileForm" method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    <div class="form-grid">
                        <label class="field">
                            <span>Full name <b class="text-danger">*</b></span>
                            <input type="text" name="name" id="fieldName" value="{{ old('name', $profile['name']) }}" disabled required>
                        </label>

                        <label class="field">
                            <span>Email address <b class="text-danger">*</b></span>
                            <input type="email" name="email" id="fieldEmail" value="{{ old('email', $profile['email']) }}" disabled required>
                        </label>

                        <label class="field">
                            <span>Phone</span>
                            <input type="text" name="phone" id="fieldPhone" value="{{ old('phone', $profile['phone']) }}" disabled>
                        </label>

                        <label class="field">
                            <span>Location</span>
                            <input type="text" name="location" id="fieldLocation" value="{{ old('location', $profile['location']) }}" disabled>
                        </label>
                    </div>

                    <div id="saveActions" style="display: none;" class="mt-4 flex justify-between items-center">
                        <p class="validation-text" id="valWarning" style="display: none;">Enter a valid name and email before saving.</p>
                        <button type="submit" class="btn btn-primary">
                            <x-icon name="save" :size="16" />
                            <span>Save changes</span>
                        </button>
                    </div>
                </form>
            </section>

            <!-- Education & Qualifications -->
            <section class="card">
                <div class="mb-5 flex items-center justify-between gap-3">
                    <h2 class="section-title">Education & qualifications</h2>
                    <button type="button" class="btn btn-sm btn-ghost" onclick="alert('Borang penambahan sijil/pendidikan dipaparkan.')">
                        <x-icon name="plus" :size="14" />
                        <span>Add</span>
                    </button>
                </div>

                <div class="detail-item">
                    <span class="detail-icon">
                        <x-icon name="graduation-cap" :size="19" />
                    </span>
                    <div>
                        <strong>BSc, Management & Information Technology</strong>
                        <p>Northbridge University · Expected June 2026</p>
                        <small>GPA 3.7 / 4.0 · Dean’s List 2024</small>
                    </div>
                    <x-icon name="more-horizontal" :size="18" />
                </div>
            </section>

            <!-- Experience & Projects -->
            <section class="card">
                <div class="mb-5 flex items-center justify-between gap-3">
                    <h2 class="section-title">Experience & projects</h2>
                    <button type="button" class="btn btn-sm btn-ghost" onclick="alert('Borang penambahan pengalaman dipaparkan.')">
                        <x-icon name="plus" :size="14" />
                        <span>Add</span>
                    </button>
                </div>

                <div class="detail-item">
                    <span class="detail-icon violet">
                        <x-icon name="briefcase-business" :size="19" />
                    </span>
                    <div>
                        <strong>Product Operations Intern</strong>
                        <p>BrightLabs · May–August 2025</p>
                        <small>Built weekly KPI reporting and improved onboarding completion by 12%.</small>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="detail-item">
                    <span class="detail-icon">
                        <x-icon name="rocket" :size="19" />
                    </span>
                    <div>
                        <strong>Campus Events Discovery App</strong>
                        <p>Capstone project · Team lead</p>
                        <small>Led user research and product analytics for a React prototype.</small>
                    </div>
                </div>
            </section>
        </div>

        <div class="stack">
            <!-- Skills & Proficiency -->
            <section class="card">
                <div class="mb-5 flex items-center justify-between gap-3">
                    <h2 class="section-title">Skills & proficiency</h2>
                </div>

                <div class="skill-list">
                    @foreach($skills as $skill)
                        <div>
                            <div class="row-between">
                                <span>{{ $skill['name'] }}</span>
                                <small>{{ $skill['level'] }}%</small>
                            </div>
                            <div class="progress-track" aria-label="{{ $skill['level'] }}%">
                                <div class="progress-fill {{ $skill['level'] > 75 ? 'progress-green' : 'progress-blue' }}" style="width: {{ $skill['level'] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Career Interests -->
            <section class="card">
                <div class="mb-5 flex items-center justify-between gap-3">
                    <h2 class="section-title">Career interests</h2>
                </div>

                <p class="muted-label">Target roles</p>
                <div class="tag-row">
                    <span class="badge badge-blue">Product Analyst</span>
                    <span class="badge badge-blue">Business Analyst</span>
                    <span class="badge badge-violet">Product Operations</span>
                </div>

                <p class="muted-label mt-5">Interested industries</p>
                <div class="tag-row">
                    <span class="badge badge-slate">SaaS</span>
                    <span class="badge badge-slate">FinTech</span>
                    <span class="badge badge-slate">Education</span>
                </div>
            </section>

            <!-- Certifications -->
            <section class="card">
                <div class="mb-5 flex items-center justify-between gap-3">
                    <h2 class="section-title">Certifications</h2>
                </div>

                <div class="empty-mini">
                    <x-icon name="award" :size="25" />
                    <strong>No certifications added yet</strong>
                    <p>Add one to improve profile completeness.</p>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="alert('Sila pilih sijil yang ingin dimuat naik.')">
                        <x-icon name="plus" :size="14" />
                        <span>Add certification</span>
                    </button>
                </div>
            </section>
        </div>
    </div>

    @push('scripts')
    <script>
        let isEditing = false;
        function toggleEditMode() {
            isEditing = !isEditing;
            const inputs = ['fieldName', 'fieldEmail', 'fieldPhone', 'fieldLocation'];
            inputs.forEach(id => {
                document.getElementById(id).disabled = !isEditing;
            });
            document.getElementById('saveActions').style.display = isEditing ? 'flex' : 'none';
            document.getElementById('editBtnText').textContent = isEditing ? 'Cancel editing' : 'Edit profile';
            if (isEditing) {
                document.getElementById('fieldName').focus();
            }
        }
    </script>
    @endpush
@endsection
