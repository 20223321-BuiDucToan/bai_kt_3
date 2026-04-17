<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use App\Repositories\Contracts\StudentRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function __construct(
        private readonly StudentRepositoryInterface $students
    ) {
    }

    public function index(): View
    {
        $classrooms = Classroom::query()
            ->withCount('students')
            ->orderBy('class_name')
            ->get();

        $subjects = Subject::query()
            ->withCount('students')
            ->orderBy('subject_name')
            ->get();

        $activeStudents = Student::query()
            ->with(['classroom', 'subjects'])
            ->active()
            ->get();

        $cntt1Students = Student::query()
            ->with('classroom')
            ->whereHas('classroom', fn ($query) => $query->where('class_name', 'CNTT1'))
            ->get();

        $studentFive = Student::query()
            ->with(['classroom', 'subjects'])
            ->find(5);

        $subjectsOfStudentFive = $studentFive?->subjects ?? collect();

        $classroomStats = Classroom::query()
            ->withCount('students')
            ->orderBy('class_name')
            ->get();

        $studentSubjectCounts = DB::table('students')
            ->leftJoin('classrooms', 'students.class_id', '=', 'classrooms.id')
            ->leftJoin('student_subject', 'students.id', '=', 'student_subject.student_id')
            ->select(
                'students.id',
                'students.student_name',
                'classrooms.class_name',
                DB::raw('COUNT(student_subject.subject_id) AS subjects_count')
            )
            ->groupBy('students.id', 'students.student_name', 'classrooms.class_name')
            ->orderBy('students.student_name')
            ->get();

        return view('students.index', [
            'activeStudents' => $activeStudents,
            'classrooms' => $classrooms,
            'subjects' => $subjects,
            'cntt1Students' => $cntt1Students,
            'studentFive' => $studentFive,
            'subjectsOfStudentFive' => $subjectsOfStudentFive,
            'classroomStats' => $classroomStats,
            'studentSubjectCounts' => $studentSubjectCounts,
            'repositoryStudents' => $this->students->all(),
        ]);
    }

    public function show(int $id): View
    {
        return view('students.show', [
            'student' => $this->students->find($id),
        ]);
    }

    public function studentsByClass(Classroom $classroom): View
    {
        return view('students.by-class', [
            'classroom' => $classroom,
            'students' => $this->students->studentsByClass($classroom->id),
        ]);
    }

    public function registerSubject(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
            'score' => ['nullable', 'numeric', 'between:0,10'],
        ]);

        $student = $this->students->registerSubject(
            $validated['student_id'],
            $validated['subject_id'],
            isset($validated['score']) ? (float) $validated['score'] : null,
        );

        return redirect()
            ->route('students.show', $student->id)
            ->with('status', 'Dang ky mon hoc thanh cong.');
    }
}
