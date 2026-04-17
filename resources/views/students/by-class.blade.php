@extends('layouts.app')

@section('content')
    <section class="box">
        <p><a href="{{ route('students.index') }}">Ve trang chinh</a></p>

        <h2>Sinh vien theo lop {{ $classroom->class_name }}</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sinh vien</th>
                    <th>Trang thai</th>
                    <th>So mon</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td><a href="{{ route('students.show', $student->id) }}">{{ $student->student_name }}</a></td>
                        <td>{{ $student->is_active ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $student->subjects->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
