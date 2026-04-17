@extends('layouts.auth')

@section('title', 'Dang ky')
@section('heading', 'Dang ky tai khoan')
@section('description', 'Tao nguoi dung moi trong database bang Eloquent ORM.')

@section('content')
    <form method="POST" action="{{ route('register.store') }}" class="stack">
        @csrf

        <div class="field">
            <label for="name">Ho va ten</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                placeholder="Nhap ho ten"
                required
                autofocus
            >
            @error('name')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Nhap dia chi email"
                required
            >
            @error('email')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="password">Mat khau</label>
            <input
                id="password"
                type="password"
                name="password"
                placeholder="It nhat 8 ky tu"
                required
            >
            @error('password')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="password_confirmation">Xac nhan mat khau</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                placeholder="Nhap lai mat khau"
                required
            >
        </div>

        <button type="submit" class="button">Dang ky tai khoan</button>
    </form>
@endsection

@section('switch')
    Da co tai khoan?
    <a href="{{ route('login') }}">Dang nhap tai day</a>
@endsection
