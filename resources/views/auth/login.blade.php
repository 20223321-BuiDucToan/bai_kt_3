@extends('layouts.auth')

@section('title', 'Dang nhap')
@section('heading', 'Dang nhap tai khoan')
@section('description', 'Nhap email va mat khau de truy cap khu vuc quan ly sinh vien.')

@section('content')
    <form method="POST" action="{{ route('login.store') }}" class="stack">
        @csrf

        <div class="field">
            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="vd: sinhvien@example.com"
                required
                autofocus
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
                placeholder="Nhap mat khau"
                required
            >
            @error('password')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="inline">
            <label class="checkbox" for="remember">
                <input id="remember" type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                Ghi nho dang nhap
            </label>

            <a href="{{ route('register') }}">Tao tai khoan moi</a>
        </div>

        <button type="submit" class="button">Dang nhap</button>
    </form>
@endsection

@section('switch')
    Chua co tai khoan?
    <a href="{{ route('register') }}">Dang ky ngay</a>
@endsection
