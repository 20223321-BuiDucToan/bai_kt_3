<?php

namespace Tests\Unit;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentScopeTest extends TestCase
{
    use RefreshDatabase;

    public function test_active_scope_filters_students_and_global_scope_orders_names(): void
    {
        $classroom = Classroom::factory()->create(['class_name' => 'TEST01']);

        Student::factory()->create([
            'student_name' => 'Minh',
            'class_id' => $classroom->id,
            'is_active' => true,
        ]);

        Student::factory()->create([
            'student_name' => 'An',
            'class_id' => $classroom->id,
            'is_active' => true,
        ]);

        Student::factory()->create([
            'student_name' => 'Bao',
            'class_id' => $classroom->id,
            'is_active' => false,
        ]);

        $this->assertSame(['An', 'Bao', 'Minh'], Student::query()->pluck('student_name')->all());
        $this->assertSame(['An', 'Minh'], Student::query()->active()->pluck('student_name')->all());
    }
}
