<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Quan ly sinh vien</title>
        <style>
            :root {
                --bg: #f7efe6;
                --card: rgba(255, 250, 243, 0.92);
                --text: #24160d;
                --muted: #70594a;
                --primary: #b85c2d;
                --border: rgba(120, 89, 64, 0.18);
                --shadow: 0 30px 70px rgba(51, 28, 14, 0.16);
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

            .page {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 24px;
            }

            .card {
                width: min(100%, 980px);
                display: grid;
                grid-template-columns: minmax(300px, 1.1fr) minmax(280px, 0.9fr);
                gap: 24px;
                padding: 30px;
                border-radius: 30px;
                background: var(--card);
                border: 1px solid var(--border);
                box-shadow: var(--shadow);
                backdrop-filter: blur(14px);
            }

            .eyebrow {
                margin: 0 0 12px;
                font-size: 13px;
                font-weight: 700;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: var(--muted);
            }

            h1 {
                margin: 0 0 16px;
                font-size: clamp(36px, 5vw, 58px);
                line-height: 1.04;
            }

            p {
                margin: 0;
                line-height: 1.75;
                color: var(--muted);
            }

            .cta-panel {
                display: grid;
                align-content: center;
                gap: 16px;
                padding: 26px;
                border-radius: 24px;
                background: linear-gradient(165deg, rgba(82, 35, 17, 0.96), rgba(143, 67, 30, 0.88));
                color: #fff6ef;
            }

            .hero {
                display: grid;
                align-content: center;
            }

            .cta-panel p {
                color: rgba(255, 246, 239, 0.82);
            }

            .button,
            .button-secondary {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 14px 18px;
                border-radius: 14px;
                font-size: 15px;
                font-weight: 700;
                text-decoration: none;
            }

            .button {
                background: linear-gradient(135deg, #f1a25d, #ffcf90);
                color: #4a1e08;
            }

            .button-secondary {
                border: 1px solid rgba(255, 246, 239, 0.24);
                color: #fff6ef;
            }

            .button-row {
                display: grid;
                gap: 12px;
                margin-top: 8px;
            }

            @media (max-width: 860px) {
                .card {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body>
        <div class="page">
            <div class="card">
                <section class="hero">
                    <p class="eyebrow">Bai kiem tra 1 giua ky</p>
                    <h1>Xay dung chuc nang dang nhap va dang ky nguoi dung</h1>
                    <p>Chon thao tac ben phai.</p>
                </section>

                <aside class="cta-panel">
                    <p class="eyebrow">Bat dau</p>
                    <h2>Tai khoan</h2>

                    <div class="button-row">
                        @auth
                            <a class="button" href="{{ route('dashboard') }}">Mo dashboard</a>
                        @else
                            <a class="button" href="{{ route('login') }}">Dang nhap</a>
                            <a class="button-secondary" href="{{ route('register') }}">Dang ky tai khoan</a>
                        @endauth
                    </div>
                </aside>
            </div>
        </div>
    </body>
</html>
