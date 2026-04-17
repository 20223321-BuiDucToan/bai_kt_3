<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\Subject;
use App\Repositories\Contracts\StudentRepositoryInterface;
use Illuminate\Support\Collection;

class StudentRepository implements StudentRepositoryInterface
{
    public function all(): Collection
    {
        return Student::query()
            ->with(['classroom', 'subjects'])
            ->get();
    }

    public function find(int $id): Student
    {
        return Student::query()
            ->with(['classroom', 'subjects'])
            ->findOrFail($id);
    }

    public function studentsByClass(int $classId): Collection
    {
        return Student::query()
            ->with(['classroom', 'subjects'])
            ->where('class_id', $classId)
            ->get();
    }

    public function registerSubject(int $studentId, int $subjectId, ?float $score = null): Student
    {
        $student = Student::query()->findOrFail($studentId);
        Subject::query()->findOrFail($subjectId);

        $student->subjects()->syncWithoutDetaching([
            $subjectId => [
                'score' => $score,
                'registered_at' => now(),
            ],
        ]);

        return $student->load(['classroom', 'subjects']);
    }
}
