<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id')->constrained()->cascadeOnDelete();
            $table->foreignId('grade_level_id')->constrained()->cascadeOnDelete();
            $table->foreignId('section_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('teacher_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('type')->default('exam')->index();
            $table->decimal('total_marks', 6, 2);
            $table->date('assessment_date')->nullable();
            $table->string('status')->default('draft')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
