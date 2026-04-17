<?php

namespace App\Repositories\Contracts;

use App\Models\Student;
use Illuminate\Support\Collection;

interface StudentRepositoryInterface
{
    public function all(): Collection;

    public function find(int $id): Student;

    public function studentsByClass(int $classId): Collection;

    public function registerSubject(int $studentId, int $subjectId, ?float $score = null): Student;
}
