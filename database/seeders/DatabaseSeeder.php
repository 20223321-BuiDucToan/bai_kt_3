<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
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
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $classrooms = collect([
            ['class_name' => 'CNTT1'],
            ['class_name' => 'CNTT2'],
            ['class_name' => 'KTPM1'],
        ])->mapWithKeys(fn (array $classroom) => [
            $classroom['class_name'] => Classroom::query()->create($classroom),
        ]);

        $subjects = collect([
            ['subject_name' => 'Lap trinh Laravel'],
            ['subject_name' => 'PHP nang cao'],
            ['subject_name' => 'Co so du lieu'],
            ['subject_name' => 'Mang may tinh'],
        ])->mapWithKeys(fn (array $subject) => [
            $subject['subject_name'] => Subject::query()->create($subject),
        ]);

        $students = collect([
            ['student_name' => 'An Nguyen', 'class' => 'CNTT1', 'is_active' => true],
            ['student_name' => 'Binh Tran', 'class' => 'CNTT1', 'is_active' => true],
            ['student_name' => 'Cuong Le', 'class' => 'CNTT2', 'is_active' => false],
            ['student_name' => 'Dung Pham', 'class' => 'CNTT2', 'is_active' => true],
            ['student_name' => 'Giang Vo', 'class' => 'KTPM1', 'is_active' => true],
            ['student_name' => 'Huy Do', 'class' => 'CNTT1', 'is_active' => true],
        ])->map(function (array $student) use ($classrooms) {
            return Student::query()->create([
                'student_name' => $student['student_name'],
                'class_id' => $classrooms[$student['class']]->id,
                'is_active' => $student['is_active'],
            ]);
        });

        $students[0]->subjects()->attach([
            $subjects['Lap trinh Laravel']->id => ['score' => 8.8, 'registered_at' => now()->subDays(14)],
            $subjects['Co so du lieu']->id => ['score' => 8.2, 'registered_at' => now()->subDays(12)],
        ]);

        $students[1]->subjects()->attach([
            $subjects['Lap trinh Laravel']->id => ['score' => 7.9, 'registered_at' => now()->subDays(10)],
            $subjects['PHP nang cao']->id => ['score' => null, 'registered_at' => now()->subDays(9)],
            $subjects['Mang may tinh']->id => ['score' => null, 'registered_at' => now()->subDays(7)],
        ]);

        $students[2]->subjects()->attach([
            $subjects['Co so du lieu']->id => ['score' => 6.5, 'registered_at' => now()->subDays(11)],
        ]);

        $students[4]->subjects()->attach([
            $subjects['Lap trinh Laravel']->id => ['score' => 9.1, 'registered_at' => now()->subDays(5)],
            $subjects['PHP nang cao']->id => ['score' => 8.7, 'registered_at' => now()->subDays(4)],
        ]);

        $students[5]->subjects()->attach([
            $subjects['Mang may tinh']->id => ['score' => 8.0, 'registered_at' => now()->subDays(3)],
        ]);
    }
}
