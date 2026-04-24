<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WashDepot</title>
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
            justify-content: space-between;
            align-items: center;
            padding: 60px 40px;
            min-height: calc(100vh - 80px);
        }

        .left-side {
            color: white;
            max-width: 380px;
            font-size: 14px;
            line-height: 1.8;
            align-self: flex-end;
            padding-bottom: 40px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            padding: 40px;
            border-radius: 12px;
            width: 340px;
            color: white;
        }

        .login-card h1 {
            font-size: 34px;
            font-weight: bold;
            margin-bottom: 24px;
            color: white;
        }

        .alert {
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 13px;
            display: none;
        }

        .alert.error {
            background: rgba(254,226,226,0.9);
            color: #dc2626;
            display: block;
        }

        .alert.success {
            background: rgba(220,252,231,0.9);
            color: #059669;
            display: block;
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
            transition: background 0.2s;
        }

        .form-group input:focus {
            background: rgba(255,255,255,1);
            box-shadow: 0 0 0 2px rgba(37,99,235,0.3);
        }

        .form-group input:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Password wrapper */
        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 40px;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            transition: color 0.2s;
        }

        .toggle-password:hover { color: #222; }

        .toggle-password:focus {
            outline: 2px solid #2563eb;
            border-radius: 4px;
        }

        .toggle-password svg {
            width: 18px;
            height: 18px;
            pointer-events: none;
        }

        .forgot {
            text-align: center;
            margin: 14px 0;
        }

        .forgot a {
            color: white;
            font-size: 13px;
            text-decoration: none;
        }

        .forgot a:hover { text-decoration: underline; }

        .btn-login {
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

        .btn-login:hover:not(:disabled) { 
            background-color: #1d4ed8; 
        }

        .btn-login:active:not(:disabled) {
            background-color: #1e40af;
        }

        .btn-login:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .loading-spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .btn-login.loading {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-login.loading .loading-spinner {
            display: inline-block;
        }
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

        <div class="left-side">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Donec rutrum posuere ornare. Proin enim turpis, pellentesque
            quis mattis eu, aliquam ac augue. Integer elit libero, dapibus
            in aliquet at, posuere vel justo.</p>
        </div>

        <div class="login-card">
            <h1>Login</h1>

            <div id="alertBox" class="alert"></div>

            <div id="loginForm">
                <div class="form-group">
                    <label for="email">Username:</label>
                    <input 
                        type="text" 
                        id="email" 
                        placeholder="Enter your username"
                        required
                        autocomplete="username"
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <div class="password-wrapper">
                        <input 
                            type="password" 
                            id="password"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                        >
                        <button 
                            type="button" 
                            class="toggle-password" 
                            id="togglePassword"
                            aria-label="Show password"
                            tabindex="0"
                        >
                            <!-- Eye icon (shown by default) -->
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <!-- Eye-off icon (hidden by default) -->
                            <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="forgot">
                    <a href="/forgot-pass">Forgot Password?</a>
                </div>

                <button type="button" class="btn-login" id="loginBtn">
                    <span class="loading-spinner"></span>
                    <span class="btn-text">Login</span>
                </button>
            </div>
        </div>

    </div>

    <script>
        // ==========================================
        // Password Visibility Toggle
        // ==========================================
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        togglePassword.addEventListener('click', function (e) {
            e.preventDefault();
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';
            eyeIcon.style.display = isHidden ? 'none' : 'block';
            eyeOffIcon.style.display = isHidden ? 'block' : 'none';
            togglePassword.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
            passwordInput.focus();
        });

        // ==========================================
        // Alert Message Handler
        // ==========================================
        function showAlert(message, type = 'error') {
            const alertBox = document.getElementById('alertBox');
            alertBox.textContent = message;
            alertBox.className = `alert ${type}`;
            alertBox.setAttribute('role', 'alert');
            window.scrollTo(0, 0);
        }

        function hideAlert() {
            const alertBox = document.getElementById('alertBox');
            alertBox.className = 'alert';
            alertBox.removeAttribute('role');
        }

        // ==========================================
        // Form Validation
        // ==========================================
        function validateForm() {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            if (!email) {
                showAlert('Please enter your username');
                return false;
            }

            if (!password) {
                showAlert('Please enter your password');
                return false;
            }

            if (password.length < 4) {
                showAlert('Password must be at least 4 characters');
                return false;
            }

            return true;
        }

        // ==========================================
        // Login Handler
        // ==========================================
        const loginBtn = document.getElementById('loginBtn');

        loginBtn.addEventListener('click', function () {
            if (!validateForm()) {
                return;
            }

            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            // Disable button and show loading state
            loginBtn.disabled = true;
            loginBtn.classList.add('loading');

            // Simulate network delay
            setTimeout(() => {
                // User database (hardcoded for demo - replace with API call)
                const users = [
                    { email: "Admin@washdepot.com", password: "Pass1234", role: "admin" },
                    { email: "Staff@washdepot.com", password: "Pass1234", role: "staff" }
                ];

                const validUser = users.find(user =>
                    user.email === email && user.password === password
                );

                if (validUser) {
                    showAlert(`Login successful as ${validUser.role}!`, 'success');
                    
                    // Redirect after 1 second
                    setTimeout(() => {
                        if (validUser.role === "admin") {
                            window.location.href = "/admin/shop-management";
                        } else {
                            window.location.href = "/staff/new-laundry";
                        }
                    }, 1000);
                } else {
                    showAlert('Invalid email or password');
                    loginBtn.disabled = false;
                    loginBtn.classList.remove('loading');
                }
            }, 500);
        });

        // ==========================================
        // Clear Alert on Input
        // ==========================================
        document.getElementById('email').addEventListener('focus', hideAlert);
        document.getElementById('password').addEventListener('focus', hideAlert);

        // ==========================================
        // Enter Key Support
        // ==========================================
        document.getElementById('password').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                loginBtn.click();
            }
        });
    </script>
</body>
</html>