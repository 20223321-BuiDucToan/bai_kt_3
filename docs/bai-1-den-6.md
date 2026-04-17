# Bai 1 den Bai 6 - Ban Nop Gon

## Bai 1

- File ERD da xuat san:
  - `docs/erd.svg`
  - `docs/erd.mmd`
- Quan he:
  - `Classroom (1) - (n) Student`
  - `Student (n) - (n) Subject` qua `student_subject`

## Bai 2

- Migration:
  - `create_classrooms_table`
  - `create_students_table`
  - `create_subjects_table`
  - `create_student_subject_table`
- FK da dung `cascadeOnDelete()`

## Bai 3

- `Classroom` co `hasMany(Student::class, 'class_id')`
- `Student` co `belongsTo(Classroom::class, 'class_id')`
- `Student` va `Subject` co quan he many-to-many qua `student_subject`

## Bai 4

Da lam trong `StudentController@index`:

1. Sinh vien thuoc lop `CNTT1`
2. Mon hoc sinh vien `id = 5` da dang ky
3. Dem so sinh vien theo tung lop
4. Danh sach sinh vien kem so mon dang ky bang `LEFT JOIN + groupBy`

## Bai 5

- Local Scope: `scopeActive()`
- Global Scope: sap xep theo `student_name`

## Bai 6

- Interface: `StudentRepositoryInterface`
- Implement: `StudentRepository`
- Method:
  - `all()`
  - `find($id)`
  - `studentsByClass($classId)`
  - `registerSubject($studentId, $subjectId)`
- Da bind trong `AppServiceProvider`
