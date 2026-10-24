@extends('layouts.app')

@section('title', 'Interview Room - NextHire AI')
@section('page_title', 'AI Mock Interview Engine')

@section('content')
    <div class="interview-top">
        <div>
            <span class="badge badge-violet">{{ ucfirst($session->interview_type) }} interview</span>
            <h1>{{ $session->role }}</h1>
        </div>
        <div class="timer-pill">
            <x-icon name="timer" :size="17" />
            <strong id="sessionTimer">14:52</strong>
        </div>
    </div>

    <section class="card interview-room">
        @php
            $percentage = round(($currentQuestionNo / $session->total_questions) * 100);
        @endphp

        <div class="question-progress">
            <span>Question {{ $currentQuestionNo }} of {{ $session->total_questions }}</span>
            <span>{{ $percentage }}%</span>
        </div>

        <div class="progress-track" aria-label="{{ $percentage }}% complete">
            <div class="progress-fill progress-violet" style="width: {{ $percentage }}%"></div>
        </div>

        <div class="question-area">
            <span class="question-number">0{{ $currentQuestionNo }}</span>
            <div>
                <p>INTERVIEW QUESTION</p>
                <h2>{{ $question->question_text }}</h2>
                <small>Take a moment to structure your answer. Try using the STAR framework (Situation, Task, Action, Result).</small>
            </div>
        </div>

        <form method="POST" action="{{ route('interview.answer', $session->id) }}">
            @csrf
            <label class="answer-field">
                <span>Your answer</span>
                <textarea name="answer" id="answerInput" placeholder="Type your response here, or use the microphone to practise speaking…" oninput="updateCharCount(this)"></textarea>
                <small><span id="charCount">0</span> characters</small>
            </label>

            <div class="record-panel">
                <button type="button" id="micBtn" class="mic-button" onclick="toggleMicRecording()">
                    <x-icon name="mic" :size="22" id="micIcon" />
                </button>
                <div>
                    <strong id="micTitle">Practise your spoken answer</strong>
                    <span id="micDesc">Microphone UI is simulated in this prototype.</span>
                </div>
                <span id="recordTimer" class="record-time" style="display: none;">00:00</span>
            </div>

            <div class="interview-controls">
                <a href="{{ route('interview') }}" class="btn btn-danger" onclick="return confirm('Adakah anda pasti ingin menamatkan sesi temuduga ini?')">
                    <span>End interview</span>
                </a>

                <button type="submit" class="btn btn-primary">
                    <span>{{ $currentQuestionNo >= $session->total_questions ? 'Submit interview' : 'Submit & next' }}</span>
                    <x-icon name="arrow-right" :size="16" />
                </button>
            </div>
        </form>
    </section>

    @push('scripts')
    <script>
        function updateCharCount(el) {
            document.getElementById('charCount').textContent = el.value.length;
        }

        let recording = false;
        let recSeconds = 0;
        let recInterval = null;

        function toggleMicRecording() {
            recording = !recording;
            const micBtn = document.getElementById('micBtn');
            const title = document.getElementById('micTitle');
            const desc = document.getElementById('micDesc');
            const timer = document.getElementById('recordTimer');

            if (recording) {
                micBtn.classList.add('recording');
                title.textContent = 'Recording demo active';
                desc.textContent = 'Audio is simulated. Speak clearly to practise pacing.';
                timer.style.display = 'inline-block';
                recSeconds = 0;
                recInterval = setInterval(() => {
                    recSeconds++;
                    const m = String(Math.floor(recSeconds / 60)).padStart(2, '0');
                    const s = String(recSeconds % 60).padStart(2, '0');
                    timer.textContent = `${m}:${s}`;
                }, 1000);
            } else {
                micBtn.classList.remove('recording');
                title.textContent = 'Practise your spoken answer';
                desc.textContent = 'Microphone UI is simulated in this prototype.';
                timer.style.display = 'none';
                clearInterval(recInterval);
            }
        }

        // Room countdown timer
        let totalSeconds = 14 * 60 + 52;
        setInterval(() => {
            if (totalSeconds > 0) {
                totalSeconds--;
                const mins = String(Math.floor(totalSeconds / 60)).padStart(2, '0');
                const secs = String(totalSeconds % 60).padStart(2, '0');
                document.getElementById('sessionTimer').textContent = `${mins}:${secs}`;
            }
        }, 1000);
    </script>
    @endpush
@endsection
