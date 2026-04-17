<?php

namespace Tests\Unit;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use App\Repositories\Contracts\StudentRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class StudentRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_repository_can_load_all_students_find_one_and_filter_by_class(): void
    {
        $this->seed();

        $repository = app(StudentRepositoryInterface::class);
        $cntt1 = Classroom::query()->where('class_name', 'CNTT1')->firstOrFail();

        $allStudents = $repository->all();
        $student = $repository->find(5);
        $studentsByClass = $repository->studentsByClass($cntt1->id);

        $this->assertCount(6, $allStudents);
        $this->assertSame('An Nguyen', $allStudents->first()->student_name);
        $this->assertSame('Giang Vo', $student->student_name);
        $this->assertCount(3, $studentsByClass);
    }

    public function test_repository_register_subject_creates_only_one_pivot_pair(): void
    {
        $this->seed();

        $repository = app(StudentRepositoryInterface::class);
        $student = Student::query()->findOrFail(2);
        $subject = Subject::query()->where('subject_name', 'Co so du lieu')->firstOrFail();

        $repository->registerSubject($student->id, $subject->id, 9.0);
        $repository->registerSubject($student->id, $subject->id, 9.0);

        $this->assertSame(1, DB::table('student_subject')
            ->where('student_id', $student->id)
            ->where('subject_id', $subject->id)
            ->count());

        $this->assertNotNull(DB::table('student_subject')
            ->where('student_id', $student->id)
            ->where('subject_id', $subject->id)
            ->value('registered_at'));
    }
}
