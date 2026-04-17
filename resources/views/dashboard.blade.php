<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard | Quan ly sinh vien</title>
        <style>
            :root {
                --bg: #f6eee5;
                --panel: #fffaf3;
                --text: #24160d;
                --muted: #6f584a;
                --primary: #b85c2d;
                --border: rgba(120, 89, 64, 0.18);
                --success-bg: #eefaf2;
                --success-text: #22613b;
                --shadow: 0 24px 50px rgba(51, 28, 14, 0.12);
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
                    linear-gradient(145deg, #f3e1cf, var(--bg));
            }

            .page {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 24px;
            }

            .card {
                width: min(100%, 760px);
                padding: 36px;
                border-radius: 28px;
                background: rgba(255, 250, 243, 0.94);
                border: 1px solid var(--border);
                box-shadow: var(--shadow);
            }

            .eyebrow {
                margin: 0 0 10px;
                font-size: 13px;
                font-weight: 700;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: var(--muted);
            }

            h1 {
                margin: 0 0 12px;
                font-size: clamp(32px, 4vw, 42px);
            }

            p {
                margin: 0;
                line-height: 1.7;
                color: var(--muted);
            }

            .status {
                margin-top: 22px;
                padding: 14px 16px;
                border-radius: 14px;
                background: var(--success-bg);
                color: var(--success-text);
            }

            .grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 16px;
                margin-top: 26px;
            }

            .info {
                padding: 18px;
                border-radius: 18px;
                background: var(--panel);
                border: 1px solid rgba(120, 89, 64, 0.12);
            }

            .info strong,
            .info span {
                display: block;
            }

            .info strong {
                margin-bottom: 6px;
                font-size: 13px;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: var(--muted);
            }

            .info span {
                color: var(--text);
                font-weight: 700;
                word-break: break-word;
            }

            .actions {
                display: flex;
                gap: 12px;
                flex-wrap: wrap;
                margin-top: 30px;
            }

            .button,
            .link {
                padding: 13px 18px;
                border-radius: 14px;
                font-size: 14px;
                font-weight: 700;
                text-decoration: none;
            }

            .button {
                border: 0;
                color: #fff;
                background: linear-gradient(135deg, var(--primary), #d07a45);
                cursor: pointer;
            }

            .link {
                color: var(--text);
                border: 1px solid rgba(120, 89, 64, 0.2);
            }
        </style>
    </head>
    <body>
        <div class="page">
            <div class="card">
                <p class="eyebrow">Dashboard</p>
                <h1>Dang nhap thanh cong</h1>

                @if (session('status'))
                    <div class="status">{{ session('status') }}</div>
                @endif

                <div class="grid">
                    <div class="info">
                        <strong>Ho ten</strong>
                        <span>{{ auth()->user()->name }}</span>
                    </div>
                    <div class="info">
                        <strong>Email</strong>
                        <span>{{ auth()->user()->email }}</span>
                    </div>
                    <div class="info">
                        <strong>Trang thai</strong>
                        <span>Da dang nhap</span>
                    </div>
                </div>

                <div class="actions">
                    <a class="link" href="{{ route('home') }}">Ve trang chu</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="button">Dang xuat</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
