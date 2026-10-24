<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Career Dashboard') - NextHire AI</title>
    <link rel="stylesheet" href="{{ asset('css/nexthire.css') }}">
    @stack('styles')
</head>
<body>
    <div class="app-shell">
        <div id="mobileOverlay" class="mobile-overlay" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside id="appSidebar" class="sidebar">
            <a href="{{ route('dashboard') }}" class="brand">
                <div class="logo-mark">N</div>
                <div>
                    <strong>NextHire <i>AI</i></strong>
                    <span>Smart Interview & Career</span>
                </div>
            </a>

            <nav>
                <p>OVERVIEW</p>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <x-icon name="layout-dashboard" :size="19" />
                    <span>Dashboard</span>
                </a>

                <p>CAREER WORKSPACE</p>
                <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile*') ? 'active' : '' }}">
                    <span class="nav-index">1</span>
                    <x-icon name="user-round" :size="18" />
                    <span>User Profile Management</span>
                </a>

                <a href="{{ route('resume') }}" class="{{ request()->routeIs('resume*') ? 'active' : '' }}">
                    <span class="nav-index">2</span>
                    <x-icon name="file-search" :size="18" />
                    <span>AI Resume Analyzer</span>
                </a>

                <a href="{{ route('interview') }}" class="{{ request()->routeIs('interview*') ? 'active' : '' }}">
                    <span class="nav-index">3</span>
                    <x-icon name="message-square-text" :size="18" />
                    <span>AI Mock Interview Engine</span>
                </a>

                <a href="{{ route('assessment') }}" class="{{ request()->routeIs('assessment*') ? 'active' : '' }}">
                    <span class="nav-index">4</span>
                    <x-icon name="gauge" :size="18" />
                    <span>Career Readiness Assessment</span>
                </a>

                <a href="{{ route('learning') }}" class="{{ request()->routeIs('learning*') ? 'active' : '' }}">
                    <span class="nav-index">5</span>
                    <x-icon name="book-open" :size="18" />
                    <span>Learning Recommendation</span>
                </a>

                <a href="{{ route('progress') }}" class="{{ request()->routeIs('progress*') ? 'active' : '' }}">
                    <span class="nav-index">6</span>
                    <x-icon name="trending-up" :size="18" />
                    <span>Recommendation & Progress</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="mini-progress">
                    <div class="row-between">
                        <span>Career readiness</span>
                        <strong>78%</strong>
                    </div>
                    <div class="progress-track" aria-label="78% complete">
                        <div class="progress-fill progress-violet" style="width: 78%"></div>
                    </div>
                </div>

                <div class="sidebar-profile">
                    <div class="avatar">MC</div>
                    <div>
                        <strong>Maya Chen</strong>
                        <span>Student plan</span>
                    </div>
                    <x-icon name="more-horizontal" :size="17" />
                </div>
            </div>
        </aside>

        <!-- Main Workspace -->
        <main class="main-shell">
            <header class="topbar">
                <div class="topbar-title">
                    <button type="button" class="btn btn-ghost btn-icon menu-trigger" onclick="toggleSidebar()" aria-label="Toggle navigation">
                        <x-icon name="menu" :size="20" />
                    </button>
                    <div>
                        <span>NextHire workspace</span>
                        <strong>@yield('page_title', 'Career Dashboard')</strong>
                    </div>
                </div>

                <div class="topbar-actions">
                    <button class="notification-button" type="button" aria-label="Notifications" onclick="alert('Tiada notifikasi baharu buat masa ini.')">
                        <x-icon name="bell" :size="19" />
                        <i></i>
                    </button>

                    <div class="profile-menu-wrap">
                        <button class="profile-trigger" type="button" onclick="toggleProfileMenu()">
                            <div class="avatar">MC</div>
                            <div>
                                <strong>Maya Chen</strong>
                                <span>Product Analyst track</span>
                            </div>
                            <x-icon name="chevron-down" :size="15" />
                        </button>

                        <div id="profilePopover" class="profile-popover" style="display: none;">
                            <strong>Maya Chen</strong>
                            <span>maya.chen@university.edu</span>
                            <a href="{{ route('profile') }}">
                                <x-icon name="user-round" :size="15" />
                                <span>View profile</span>
                            </a>
                            <button type="button" onclick="alert('Notifikasi diaktifkan.')">
                                <x-icon name="bell" :size="15" />
                                <span>Notification settings</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <div class="page-content">
                @if(session('success'))
                    <div class="alert alert-success">
                        <x-icon name="check-circle-2" :size="18" />
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        <x-icon name="zap" :size="18" />
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('appSidebar');
            const overlay = document.getElementById('mobileOverlay');
            sidebar.classList.toggle('open');
            overlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
        }

        function toggleProfileMenu() {
            const popover = document.getElementById('profilePopover');
            popover.style.display = popover.style.display === 'none' ? 'flex' : 'none';
        }

        document.addEventListener('click', function(e) {
            const popover = document.getElementById('profilePopover');
            const trigger = document.querySelector('.profile-trigger');
            if (popover && trigger && !trigger.contains(e.target) && !popover.contains(e.target)) {
                popover.style.display = 'none';
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
