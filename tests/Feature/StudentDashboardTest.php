<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_renders_the_assignment_sections(): void
    {
        $this->seed();

        $this->get(route('students.index'))
            ->assertOk()
            ->assertSee('Quan ly sinh vien bang Laravel')
            ->assertSee('Bai 4.1 - Sinh vien thuoc lop CNTT1')
            ->assertSee('Bai 6 - Repository Pattern')
            ->assertSee('Giang Vo');
    }

    public function test_register_subject_route_attaches_a_subject_to_a_student(): void
    {
        $this->seed();

        $student = Student::query()->findOrFail(4);
        $subject = Subject::query()->where('subject_name', 'Mang may tinh')->firstOrFail();

        $this->post(route('students.register-subject'), [
            'student_id' => $student->id,
            'subject_id' => $subject->id,
            'score' => 8.5,
        ])->assertRedirect(route('students.show', $student->id));

        $this->assertDatabaseHas('student_subject', [
            'student_id' => $student->id,
            'subject_id' => $subject->id,
            'score' => 8.5,
        ]);
    }
}
