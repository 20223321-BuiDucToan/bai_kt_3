# Bai Tap Chuong 4 - Quan Ly Sinh Vien

Project nay da duoc trien khai day du cac yeu cau tu Bai 1 den Bai 6 trong de:

- Bai 1: ERD va mo ta PK/FK tai `docs/bai-1-den-6.md`
- Bai 2: Migration + model cho `classrooms`, `students`, `subjects`, `student_subject`
- Bai 3: Quan he Eloquent 1-n va n-n
- Bai 4: Query Builder + Eloquent nang cao tren trang chinh
- Bai 5: Local scope `active()` va global scope sap xep theo `student_name`
- Bai 6: Repository Pattern cho `Student`

## Cach chay

```bash
php artisan migrate:fresh --seed
php artisan serve
```

Sau do mo:

- `/` de xem dashboard tong hop Bai 1-6
- `/students/5` de xem chi tiet sinh vien qua repository
- `/classrooms/1/students` de xem danh sach sinh vien theo lop

## Ghi chu

- Database mac dinh dang dung `sqlite`
- De Bai 5 can trang thai active, vi vay bang `students` duoc bo sung cot `is_active`
- Du lieu mau da duoc seed san de truy van trong Bai 4 co ket qua ngay
