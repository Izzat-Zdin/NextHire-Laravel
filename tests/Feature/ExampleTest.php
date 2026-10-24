<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\InterviewSession;
use App\Models\LearningItem;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_renders_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Career Dashboard');
        $response->assertSee('Good morning, Maya');
    }

    public function test_profile_page_renders_and_updates(): void
    {
        $response = $this->get('/profile');
        $response->assertStatus(200);
        $response->assertSee('Build a profile that works for you');

        $update = $this->post('/profile', [
            'name' => 'Maya Chen Updated',
            'email' => 'maya.new@university.edu',
            'phone' => '+1 647 555 9999',
            'location' => 'Vancouver, Canada',
        ]);
        $update->assertRedirect('/profile');
        $update->assertSessionHas('success');
    }

    public function test_resume_analyzer_page(): void
    {
        $response = $this->get('/resume');
        $response->assertStatus(200);
        $response->assertSee('Turn your resume into a stronger story');
    }

    public function test_interview_flow(): void
    {
        $response = $this->get('/interview');
        $response->assertStatus(200);
        $response->assertSee('Practise with purpose');

        $start = $this->post('/interview/start', [
            'role' => 'Associate Product Analyst',
            'type' => 'behavioral',
            'difficulty' => 'Intermediate',
            'count' => 3,
        ]);

        $session = InterviewSession::first();
        $this->assertNotNull($session);
        $start->assertRedirect('/interview/room/' . $session->id);

        $room = $this->get('/interview/room/' . $session->id);
        $room->assertStatus(200);
        $room->assertSee('Question 1 of 3');

        $answer = $this->post('/interview/answer/' . $session->id, [
            'answer' => 'This is my STAR formatted answer to question 1.',
        ]);
        $answer->assertRedirect('/interview/room/' . $session->id);

        // Next answer
        $this->post('/interview/answer/' . $session->id, [
            'answer' => 'Answer to question 2.',
        ]);

        // Final answer
        $final = $this->post('/interview/answer/' . $session->id, [
            'answer' => 'Answer to question 3.',
        ]);
        $final->assertRedirect('/interview/complete/' . $session->id);

        $complete = $this->get('/interview/complete/' . $session->id);
        $complete->assertStatus(200);
        $complete->assertSee('Practice completed');
    }

    public function test_assessment_page(): void
    {
        $response = $this->get('/assessment');
        $response->assertStatus(200);
        $response->assertSee('Understand every response');
    }

    public function test_learning_recommendations_page(): void
    {
        LearningItem::create([
            'title' => 'Test SQL Course',
            'skill' => 'SQL',
            'type' => 'Course',
            'level' => 'Beginner',
            'duration' => '2 hours',
            'priority' => 'High',
        ]);

        $response = $this->get('/learning');
        $response->assertStatus(200);
        $response->assertSee('A learning plan shaped around your gaps');
        $response->assertSee('Test SQL Course');
    }

    public function test_progress_page(): void
    {
        $response = $this->get('/progress');
        $response->assertStatus(200);
        $response->assertSee('See how far you’ve come');
    }
}
