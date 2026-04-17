<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Quan ly sinh vien' }}</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f5f5;
            color: #222;
        }

        a {
            color: #0b57d0;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .container {
            width: min(1100px, calc(100% - 32px));
            margin: 0 auto;
            padding: 24px 0 40px;
        }

        .header,
        .box {
            background: #fff;
            border: 1px solid #ddd;
            padding: 16px;
            margin-bottom: 16px;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 28px;
        }

        h2 {
            margin: 0 0 12px;
            font-size: 20px;
        }

        p {
            margin: 8px 0;
            line-height: 1.5;
        }

        .nav {
            margin-top: 12px;
        }

        .nav a {
            display: inline-block;
            margin-right: 12px;
        }

        button:hover {
            cursor: pointer;
        }

        .grid {
            display: grid;
            gap: 16px;
        }

        .grid-2 {
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        }

        .grid-4 {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }

        .box strong.value {
            display: block;
            font-size: 24px;
            margin-top: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 8px 10px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        th {
            background: #f0f0f0;
        }

        pre {
            margin: 0;
            padding: 12px;
            background: #f7f7f7;
            border: 1px solid #ddd;
            overflow-x: auto;
        }

        form {
            display: grid;
            gap: 12px;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #bbb;
            font: inherit;
        }

        button {
            background: #0b57d0;
            color: #fff;
            border: 0;
        }

        .success {
            color: green;
            margin-bottom: 16px;
        }

        ul {
            margin: 8px 0;
        }

        code {
            background: #f0f0f0;
            padding: 2px 5px;
        }

        @media (max-width: 680px) {
            .container {
                width: min(100% - 16px, 100%);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Quan ly sinh vien bang Laravel</h1>
            <div class="nav">
                <a href="{{ route('students.index') }}">Trang chinh</a>
                <a href="{{ route('students.show', 5) }}">Sinh vien #5</a>
                <a href="/docs/erd.svg">ERD SVG</a>
            </div>
        </div>

        @if (session('status'))
            <div class="success">{{ session('status') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
