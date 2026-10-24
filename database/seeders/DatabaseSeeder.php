<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::firstOrCreate(
            ['email' => 'maya.chen@university.edu'],
            [
                'name' => 'Maya Chen',
                'password' => bcrypt('password123'),
            ]
        );

        $items = [
            [
                'title' => 'SQL for Product Analytics',
                'skill' => 'SQL & data queries',
                'type' => 'Course',
                'level' => 'Beginner',
                'duration' => '4 hours',
                'priority' => 'High',
            ],
            [
                'title' => 'Build a Product Metrics Dashboard',
                'skill' => 'Product analytics',
                'type' => 'Project',
                'level' => 'Intermediate',
                'duration' => '6 hours',
                'priority' => 'High',
            ],
            [
                'title' => 'Google Data Analytics Certificate',
                'skill' => 'Data analysis',
                'type' => 'Certification',
                'level' => 'Beginner',
                'duration' => '3 months',
                'priority' => 'Medium',
            ],
            [
                'title' => 'Stakeholder Stories That Persuade',
                'skill' => 'Communication',
                'type' => 'Tutorial',
                'level' => 'Intermediate',
                'duration' => '45 min',
                'priority' => 'Medium',
            ],
            [
                'title' => 'Ten Product Interview Drills',
                'skill' => 'Interview confidence',
                'type' => 'Practice',
                'level' => 'Intermediate',
                'duration' => '2 hours',
                'priority' => 'Low',
            ],
            [
                'title' => 'A/B Testing Fundamentals',
                'skill' => 'Experimentation',
                'type' => 'Course',
                'level' => 'Intermediate',
                'duration' => '3 hours',
                'priority' => 'Medium',
            ],
        ];

        foreach ($items as $item) {
            \App\Models\LearningItem::firstOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
