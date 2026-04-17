<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') | Quan ly sinh vien</title>
        <style>
            :root {
                --bg: #f7efe6;
                --panel: rgba(255, 252, 247, 0.94);
                --panel-strong: #fffaf3;
                --text: #27180e;
                --muted: #70594a;
                --primary: #b85c2d;
                --primary-dark: #8e4019;
                --border: rgba(120, 89, 64, 0.18);
                --danger-bg: #fff1ec;
                --danger-text: #8c2f14;
                --success-bg: #eefaf2;
                --success-text: #22613b;
                --shadow: 0 30px 70px rgba(51, 28, 14, 0.18);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                color: var(--text);
                background:
                    radial-gradient(circle at top left, rgba(255, 209, 148, 0.6), transparent 35%),
                    radial-gradient(circle at bottom right, rgba(232, 141, 89, 0.45), transparent 30%),
                    linear-gradient(135deg, #f2e0cf, var(--bg));
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            .shell {
                min-height: 100vh;
                display: grid;
                grid-template-columns: minmax(280px, 1.1fr) minmax(320px, 0.9fr);
            }

            .brand-panel,
            .form-panel {
                padding: 48px 24px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .brand-card,
            .form-card {
                width: min(100%, 520px);
                border-radius: 28px;
                border: 1px solid var(--border);
                box-shadow: var(--shadow);
                backdrop-filter: blur(14px);
            }

            .brand-card {
                padding: 40px;
                color: #fff6ef;
                background:
                    linear-gradient(160deg, rgba(82, 35, 17, 0.92), rgba(143, 67, 30, 0.9)),
                    #5f2a12;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .form-card {
                padding: 36px;
                background: var(--panel);
            }

            .eyebrow {
                margin: 0 0 12px;
                font-size: 13px;
                font-weight: 700;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                opacity: 0.8;
            }

            h1 {
                margin: 0 0 14px;
                font-size: clamp(32px, 4vw, 48px);
                line-height: 1.05;
            }

            .brand-card p,
            .lead {
                line-height: 1.7;
                color: var(--muted);
            }

            .brand-card p {
                color: rgba(255, 246, 239, 0.84);
            }

            .title {
                margin: 0 0 10px;
                font-size: 34px;
                line-height: 1.15;
            }

            .stack {
                display: grid;
                gap: 18px;
            }

            .field {
                display: grid;
                gap: 8px;
            }

            label {
                font-size: 14px;
                font-weight: 700;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"] {
                width: 100%;
                padding: 14px 16px;
                border-radius: 14px;
                border: 1px solid rgba(120, 89, 64, 0.25);
                background: var(--panel-strong);
                color: var(--text);
                font-size: 15px;
                outline: none;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            input:focus {
                border-color: rgba(184, 92, 45, 0.8);
                box-shadow: 0 0 0 4px rgba(184, 92, 45, 0.12);
            }

            .inline {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                flex-wrap: wrap;
            }

            .checkbox {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                font-size: 14px;
                color: var(--muted);
            }

            .checkbox input {
                accent-color: var(--primary);
            }

            .button {
                width: 100%;
                padding: 14px 18px;
                border: 0;
                border-radius: 14px;
                background: linear-gradient(135deg, var(--primary), #d07a45);
                color: #fff;
                font-size: 15px;
                font-weight: 700;
                cursor: pointer;
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            }

            .button:hover {
                transform: translateY(-1px);
                box-shadow: 0 14px 28px rgba(184, 92, 45, 0.24);
                background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            }

            .flash,
            .error-box {
                padding: 14px 16px;
                border-radius: 14px;
                margin-bottom: 20px;
                font-size: 14px;
                line-height: 1.6;
            }

            .flash {
                background: var(--success-bg);
                color: var(--success-text);
                border: 1px solid rgba(34, 97, 59, 0.14);
            }

            .error-box {
                background: var(--danger-bg);
                color: var(--danger-text);
                border: 1px solid rgba(140, 47, 20, 0.14);
            }

            .error-box ul {
                margin: 0;
                padding-left: 18px;
            }

            .field-error {
                color: #a33c1b;
                font-size: 13px;
            }

            .switch {
                margin-top: 22px;
                font-size: 14px;
                color: var(--muted);
            }

            .switch a {
                color: var(--primary-dark);
                font-weight: 700;
            }

            @media (max-width: 900px) {
                .shell {
                    grid-template-columns: 1fr;
                }

                .brand-panel {
                    padding-bottom: 8px;
                }

                .form-panel {
                    padding-top: 8px;
                }

                .brand-card,
                .form-card {
                    width: min(100%, 640px);
                }
            }
        </style>
    </head>
    <body>
        <div class="shell">
            <section class="brand-panel">
                <div class="brand-card">
                    <p class="eyebrow">He thong quan ly sinh vien</p>
                    <h1>Dang nhap va dang ky tai khoan bang Laravel</h1>
                    <p>Quan ly tai khoan.</p>
                </div>
            </section>

            <main class="form-panel">
                <div class="form-card">
                    <p class="eyebrow">Tai khoan nguoi dung</p>
                    <h2 class="title">@yield('heading')</h2>
                    <p class="lead">@yield('description')</p>

                    @if (session('status'))
                        <div class="flash">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="error-box">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')

                    <p class="switch">@yield('switch')</p>
                </div>
            </main>
        </div>
    </body>
</html>
