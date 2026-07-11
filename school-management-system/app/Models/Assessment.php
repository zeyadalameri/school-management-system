<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'grade_level_id',
        'section_id',
        'subject_id',
        'teacher_id',
        'title',
        'type',
        'total_marks',
        'assessment_date',
        'status',
    ];

    protected $casts = [
        'assessment_date' => 'date',
        'total_marks' => 'decimal:2',
    ];

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function gradeLevel(): BelongsTo
    {
        return $this->belongsTo(GradeLevel::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function marks(): HasMany
    {
        return $this->hasMany(Mark::class);
    }
}
