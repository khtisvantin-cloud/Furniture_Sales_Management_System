<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in &mdash; Furniture Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --walnut: #2e211a;
            --walnut-deep: #201712;
            --oak: #c08a56;
            --oak-light: #e3b888;
            --linen: #f6f0e7;
            --charcoal: #2b2621;
            --sage: #74806a;
            --border: #dcd0be;
            --gold: #b08344;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            background: var(--linen);
            color: var(--charcoal);
            font-family: Inter, sans-serif;
        }

        .wrap {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            min-height: 100vh;
        }

        .brand {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            padding: 56px;
            color: var(--linen);
            background: radial-gradient(circle at 15% 20%, rgba(224, 182, 130, .1), transparent 45%), linear-gradient(180deg, var(--walnut), var(--walnut-deep));
        }

        .grain {
            position: absolute;
            inset: 0;
            pointer-events: none;
            background-image: repeating-linear-gradient(100deg, rgba(255, 255, 255, .018) 0 1px, transparent 1px 7px);
        }

        .brand>*:not(.grain) {
            position: relative;
            z-index: 1;
        }

        .wordmark,
        .hero h1,
        .form-box h1,
        .stat-num {
            font-family: Fraunces, serif;
            font-weight: 500;
        }

        .wordmark {
            font-size: 26px;
        }

        .wordmark span,
        .hero h1 em,
        .stat-num {
            color: var(--oak-light);
        }

        .tagline,
        .form-eyebrow {
            margin-top: 6px;
            color: rgba(246, 240, 231, .55);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .hero {
            margin: auto 0;
            padding-top: 60px;
        }

        .hero h1 {
            max-width: 420px;
            font-size: 40px;
            line-height: 1.18;
        }

        .hero p {
            max-width: 360px;
            margin-top: 18px;
            color: rgba(246, 240, 231, .62);
            font-size: 15px;
            line-height: 1.6;
        }

        .furniture-art {
            margin-top: 40px;
            opacity: .9;
        }

        .stats {
            display: flex;
            gap: 36px;
            padding-top: 32px;
            border-top: 1px solid rgba(246, 240, 231, .12);
        }

        .stat-num {
            font-size: 22px;
        }

        .stat-label {
            margin-top: 2px;
            color: rgba(246, 240, 231, .5);
            font-size: 12px;
        }

        .panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .form-box {
            width: 100%;
            max-width: 380px;
        }

        .form-eyebrow {
            margin: 0 0 10px;
            color: var(--sage);
        }

        .form-box h1 {
            color: var(--walnut);
            font-size: 28px;
        }

        .sub {
            margin: 8px 0 32px;
            color: #6b5f52;
            font-size: 14.5px;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: var(--charcoal);
            font-size: 13px;
            font-weight: 600;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 13px 14px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            outline: 0;
            background: #fff;
            color: var(--charcoal);
            font: 14.5px Inter, sans-serif;
            transition: border-color .15s, box-shadow .15s;
        }

        input::placeholder {
            color: #b3a695;
        }

        input:focus {
            border-color: var(--oak);
            box-shadow: 0 0 0 3px rgba(192, 138, 86, .18);
        }

        .error {
            margin-top: 7px;
            color: #b42318;
            font-size: 12px;
        }

        .status {
            margin: 0 0 20px;
            padding: 10px 12px;
            border-radius: 8px;
            background: #e7f3e4;
            color: #355d2e;
            font-size: 13px;
        }

        .row-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 26px;
            font-size: 13.5px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            color: #5c5145;
            font-weight: 400;
        }

        .remember input {
            width: 15px;
            height: 15px;
            accent-color: var(--oak);
        }

        a {
            color: var(--gold);
            font-weight: 600;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .submit {
            width: 100%;
            padding: 14px;
            border: 0;
            border-radius: 8px;
            background: var(--walnut);
            color: var(--linen);
            cursor: pointer;
            font: 600 14.5px Inter, sans-serif;
            transition: background .15s, transform .1s;
        }

        .submit:hover {
            background: #3a2a20;
        }

        .submit:active {
            transform: scale(.995);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 26px 0;
            color: #b3a695;
            font-size: 12px;
            letter-spacing: .03em;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .footnote {
            color: #7a6e60;
            font-size: 13.5px;
            text-align: center;
        }

        .footnote a {
            color: var(--walnut);
        }

        @media (max-width:860px) {
            .wrap {
                grid-template-columns: 1fr;
            }

            .brand {
                display: none;
            }

            .panel {
                padding: 32px 20px;
            }
        }
    </style>
</head>

<body>
    <main class="wrap">
        <section class="brand" aria-label="Furniture Management System">
            <div class="grain"></div>
            <div>
                <div class="wordmark">Ledger <span>&amp; Oak</span></div>
                <div class="tagline">Furniture sales &amp; inventory desk</div>
            </div>
            <div class="hero">
                <h1>Every piece, <em>tracked</em> from showroom floor to doorstep.</h1>
                <p>Sign in to manage stock, quotes, and orders across your furniture showrooms in one ledger.</p>
                <svg class="furniture-art" width="320" height="120" viewBox="0 0 320 120" fill="none"
                    aria-hidden="true">
                    <path
                        d="M10 78h70v18a6 6 0 0 1-6 6H16a6 6 0 0 1-6-6Z M14 78V58a8 8 0 0 1 8-8h48a8 8 0 0 1 8 8v20 M14 62h64"
                        stroke="#C08A56" stroke-width="1.4" opacity=".75" />
                    <path
                        d="M170 100V66 M158 34h24l-6 22h-12Z M158 100h24 M240 44v40 M282 44v40 M240 44h42 M236 84l8 18 M286 84l-8 18 M240 60h42"
                        stroke="#C08A56" stroke-width="1.4" opacity=".7" />
                </svg>
            </div>
            <div class="stats">
                <div>
                    <div class="stat-num">4,120</div>
                    <div class="stat-label">SKUs tracked</div>
                </div>
                <div>
                    <div class="stat-num">18</div>
                    <div class="stat-label">Showrooms</div>
                </div>
                <div>
                    <div class="stat-num">99.2%</div>
                    <div class="stat-label">Order accuracy</div>
                </div>
            </div>
        </section>

        <section class="panel">
            <div class="form-box">
                <div class="form-eyebrow">Staff access</div>
                <h1>Sign in to your desk</h1>
                <p class="sub">Enter your credentials to open the sales &amp; inventory dashboard.</p>
                @if (session('status'))
                    <p class="status">{{ session('status') }}</p>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="field">
                        <label for="email">Email address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            placeholder="e.g. sok.dara@ledgerandoak.com" autocomplete="username" required autofocus>
                        @error('email')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" placeholder="Enter your password"
                            autocomplete="current-password" required>
                        @error('password')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row-between">
                        <label class="remember" for="remember"><input id="remember" type="checkbox" name="remember"
                                @checked(old('remember'))> Keep me signed in</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        @endif
                    </div>
                    <button class="submit" type="submit">Sign in</button>
                </form>
                <div class="divider">NEED HELP</div>
                @if (Route::has('register'))
                    <p class="footnote">New to the system? <a href="{{ route('register') }}">Create an account</a></p>
                @else
                    <p class="footnote">Trouble signing in? Contact your store admin.</p>
                @endif
            </div>
        </section>
    </main>
</body>

</html>
