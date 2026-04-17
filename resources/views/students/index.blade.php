@extends('layouts.app')

@section('content')
    <section class="grid grid-4">
        <div class="box">
            Tong so lop
            <strong class="value">{{ $classrooms->count() }}</strong>
        </div>
        <div class="box">
            Tong so sinh vien
            <strong class="value">{{ $repositoryStudents->count() }}</strong>
        </div>
        <div class="box">
            Sinh vien active
            <strong class="value">{{ $activeStudents->count() }}</strong>
        </div>
        <div class="box">
            Tong so mon hoc
            <strong class="value">{{ $subjects->count() }}</strong>
        </div>
    </section>

    <section class="grid grid-2" style="margin-top: 1rem;">
        <div class="box">
            <h2>Bai 1 - ERD</h2>
            <ul>
                <li><a href="/docs/erd.svg">docs/erd.svg</a></li>
                <li><a href="/docs/erd.mmd">docs/erd.mmd</a></li>
            </ul>
            <pre>Classroom (id PK, class_name)
    1 ----- n
Student (id PK, student_name, class_id FK, is_active)
    n ----- n
Subject (id PK, subject_name)

student_subject (
    student_id PK, FK -> students.id,
    subject_id PK, FK -> subjects.id,
    score,
    registered_at
)</pre>
        </div>

        <div class="box">
            <h2>Bai 2 & Bai 3 - Migration + Eloquent</h2>
            <ul>
                <li>Classroom - hasMany Student</li>
                <li>Student - belongsTo Classroom</li>
                <li>Student - belongsToMany Subject</li>
                <li>Subject - belongsToMany Student</li>
            </ul>
        </div>
    </section>

    <section class="grid grid-2" style="margin-top: 1rem;">
        <div class="box">
            <h2>Bai 4.1 - Sinh vien thuoc lop CNTT1</h2>
            @if ($cntt1Students->isEmpty())
                <p>Khong co du lieu.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sinh vien</th>
                            <th>Lop</th>
                            <th>Trang thai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cntt1Students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->student_name }}</td>
                                <td>{{ $student->classroom->class_name }}</td>
                                <td>{{ $student->is_active ? 'Active' : 'Inactive' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="box">
            <h2>Bai 4.2 - Mon hoc cua sinh vien ID = 5</h2>
            @if ($subjectsOfStudentFive->isEmpty())
                <p>Sinh vien nay chua dang ky mon hoc nao.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Mon hoc</th>
                            <th>Diem</th>
                            <th>Ngay dang ky</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjectsOfStudentFive as $subject)
                            <tr>
                                <td>{{ $subject->subject_name }}</td>
                                <td>{{ $subject->pivot->score ?? 'Chua co' }}</td>
                                <td>{{ optional($subject->pivot->registered_at)->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>

    <section class="grid grid-2" style="margin-top: 1rem;">
        <div class="box">
            <h2>Bai 4.3 - Dem so sinh vien theo tung lop</h2>
            <table>
                <thead>
                    <tr>
                        <th>Lop</th>
                        <th>So sinh vien</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classroomStats as $classroom)
                        <tr>
                            <td>
                                <a href="{{ route('students.by-class', $classroom) }}">{{ $classroom->class_name }}</a>
                            </td>
                            <td>{{ $classroom->students_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="box">
            <h2>Bai 4.4 - LEFT JOIN + groupBy</h2>
            <table>
                <thead>
                    <tr>
                        <th>Sinh vien</th>
                        <th>Lop</th>
                        <th>So mon da dang ky</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($studentSubjectCounts as $row)
                        <tr>
                            <td><a href="{{ route('students.show', $row->id) }}">{{ $row->student_name }}</a></td>
                            <td>{{ $row->class_name }}</td>
                            <td>{{ $row->subjects_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <section class="box" style="margin-top: 1rem;">
        <h2>Bai 5 - Local Scope & Global Scope</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ten sinh vien</th>
                    <th>Lop</th>
                    <th>So mon dang ky</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activeStudents as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->student_name }}</td>
                        <td>{{ $student->classroom->class_name }}</td>
                        <td>{{ $student->subjects->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section class="box" style="margin-top: 1rem;">
        <h2>Bai 6 - Repository Pattern</h2>
        <ul>
            <li><code>all()</code></li>
            <li><code>find(5)</code> -> <a href="{{ route('students.show', 5) }}">Xem sinh vien #5</a></li>
            <li><code>studentsByClass(1)</code> -> <a href="{{ route('students.by-class', $classrooms->first()) }}">Xem lop dau tien</a></li>
            <li><code>registerSubject($studentId, $subjectId)</code></li>
        </ul>

        <form method="POST" action="{{ route('students.register-subject') }}">
            @csrf
            <div>
                <strong>Sinh vien</strong>
                <select name="student_id" required>
                    @foreach ($repositoryStudents as $student)
                        <option value="{{ $student->id }}">{{ $student->student_name }} - {{ $student->classroom->class_name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <strong>Mon hoc</strong>
                <select name="subject_id" required>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <strong>Diem</strong>
                <input type="number" name="score" min="0" max="10" step="0.1" placeholder="VD: 8.5">
            </div>

            <div>
                <strong>Dang ky</strong>
                <button type="submit">Dang ky mon hoc</button>
            </div>
        </form>
    </section>
@endsection
