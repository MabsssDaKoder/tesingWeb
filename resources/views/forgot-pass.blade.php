<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - WashDepot</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            background-image: url('https://images.unsplash.com/photo-1545173168-9f1947eebb7f?w=1600');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.55);
            z-index: 0;
        }

        .navbar {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
            color: white;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 30px;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .nav-links a:hover { text-decoration: underline; }

        .main {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
            min-height: calc(100vh - 80px);
        }

        .card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            padding: 40px;
            border-radius: 12px;
            width: 360px;
            color: white;
        }

        /* Back arrow */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: white;
            text-decoration: none;
            font-size: 13px;
            margin-bottom: 20px;
            opacity: 0.85;
            transition: opacity 0.2s;
        }
        .back-link:hover { opacity: 1; text-decoration: underline; }
        .back-link svg { width: 15px; height: 15px; }

        .card h1 {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 10px;
            color: white;
        }

        .card p.subtitle {
            font-size: 13px;
            line-height: 1.6;
            color: rgba(255,255,255,0.8);
            margin-bottom: 24px;
        }

        .form-group { margin-bottom: 16px; }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 6px;
            color: white;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            background: rgba(255,255,255,0.9);
            outline: none;
        }

        .form-group input:focus {
            background: white;
            box-shadow: 0 0 0 2px #2563eb;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
            transition: background-color 0.2s;
        }

        .btn-submit:hover { background-color: #1d4ed8; }

        /* Success state */
        .success-box {
            display: none;
            background: rgba(209, 250, 229, 0.9);
            color: #065f46;
            padding: 14px;
            border-radius: 8px;
            font-size: 13px;
            line-height: 1.6;
            margin-top: 16px;
            text-align: center;
        }

        .success-box svg {
            width: 32px;
            height: 32px;
            margin: 0 auto 8px;
            display: block;
            color: #059669;
        }

        .success-box p { font-weight: bold; font-size: 14px; margin-bottom: 4px; }
        .success-box span { font-weight: normal; color: #047857; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">WashDepot</div>
        <div class="nav-links">
            <a href="/queue-status">QUEUE STATUS</a>
        </div>
    </nav>

    <div class="main">
        <div class="card">

            <a href="/login" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Back to Login
            </a>

            <h1>Forgot Password</h1>
            <p class="subtitle">Enter your registered email address and we'll send you a link to reset your password.</p>

            <div id="formArea">
                <div class="form-group">
                    <label>Email Address:</label>
                    <input type="email" id="resetEmail" placeholder="e.g. you@washdepot.com">
                </div>

                <button class="btn-submit" id="submitBtn" onclick="handleReset()">Send Reset Link</button>
            </div>

            <div class="success-box" id="successBox">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                <p>Reset link sent!</p>
                <span id="sentTo"></span>
                <br><br>
                <span>Please check your inbox and follow the instructions to reset your password.</span>
            </div>

        </div>
    </div>

    <script>
        function handleReset() {
            const emailInput = document.getElementById('resetEmail');
            const email = emailInput.value.trim();

            if (!email) {
                alert("Please enter your email address.");
                emailInput.focus();
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address.");
                emailInput.focus();
                return;
            }

            // Show success message
            document.getElementById('formArea').style.display = 'none';
            const successBox = document.getElementById('successBox');
            successBox.style.display = 'block';
            document.getElementById('sentTo').textContent = 'We sent a link to: ' + email;
        }

        // Allow pressing Enter to submit
        document.getElementById('resetEmail').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') handleReset();
        });
    </script>

</body>
</html>