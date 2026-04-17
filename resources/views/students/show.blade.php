@extends('layouts.app')

@section('content')
    <section class="box">
        <p>
            <a href="{{ route('students.index') }}">Ve trang chinh</a> |
            <a href="{{ route('students.by-class', $student->classroom) }}">Xem cung lop</a>
        </p>

        <h2>Chi tiet sinh vien #{{ $student->id }}</h2>
        <ul>
            <li>Ten sinh vien: <strong>{{ $student->student_name }}</strong></li>
            <li>Lop hoc: <strong>{{ $student->classroom->class_name }}</strong></li>
            <li>Trang thai: <strong>{{ $student->is_active ? 'Active' : 'Inactive' }}</strong></li>
            <li>So mon da dang ky: <strong>{{ $student->subjects->count() }}</strong></li>
        </ul>
    </section>

    <section class="box" style="margin-top: 1rem;">
        <h2>Danh sach mon hoc da dang ky</h2>
        @if ($student->subjects->isEmpty())
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
                    @foreach ($student->subjects as $subject)
                        <tr>
                            <td>{{ $subject->subject_name }}</td>
                            <td>{{ $subject->pivot->score ?? 'Chua co' }}</td>
                            <td>{{ optional($subject->pivot->registered_at)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>
@endsection
