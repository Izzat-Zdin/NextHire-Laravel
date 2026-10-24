<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('interview_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('role')->default('Associate Product Analyst');
            $table->enum('interview_type', ['hr', 'behavioral', 'technical'])->default('behavioral');
            $table->string('difficulty')->default('Intermediate');
            $table->unsignedInteger('total_questions')->default(5);
            $table->unsignedInteger('current_question_no')->default(1);
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
            $table->decimal('average_score', 5, 2)->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('interview_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('interview_sessions')->cascadeOnDelete();
            $table->unsignedInteger('question_no');
            $table->text('question_text');
            $table->string('question_type')->default('behavioral');
            $table->timestamps();
        });

        Schema::create('interview_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('interview_sessions')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('interview_questions')->cascadeOnDelete();
            $table->text('answer_text')->nullable();
            $table->string('answer_method')->default('text');
            $table->decimal('score', 5, 2)->nullable();
            $table->decimal('duration_seconds', 8, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('learning_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('skill');
            $table->string('type');
            $table->string('level');
            $table->string('duration');
            $table->string('priority');
            $table->boolean('is_completed')->default(false);
            $table->boolean('is_saved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_items');
        Schema::dropIfExists('interview_answers');
        Schema::dropIfExists('interview_questions');
        Schema::dropIfExists('interview_sessions');
    }
};
