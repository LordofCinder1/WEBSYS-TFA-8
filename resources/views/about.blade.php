<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About - POS Application</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #334155;
            margin: 0;
            padding: 2rem;
            line-height: 1.6;
        }
        nav {
            background-color: #1e293b;
            padding: 1rem 2rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        nav a {
            color: #e2e8f0;
            text-decoration: none;
            margin-right: 1.5rem;
            font-weight: 600;
        }
        nav a:hover {
            color: #38bdf8;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        .card {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }
        h1 {
            color: #0f172a;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 0.5rem;
            margin-top: 0;
        }
        h2 {
            color: #1e293b;
            font-size: 1.2rem;
            margin-top: 0;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.25rem;
            margin-top: 1rem;
        }
        .feature-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 1.25rem;
        }
        .feature-box h3 {
            margin: 0 0 0.5rem 0;
            color: #0284c7;
            font-size: 1rem;
        }
        .feature-box p {
            margin: 0;
            font-size: 0.925rem;
        }
        ul {
            padding-left: 1.25rem;
            margin: 0.5rem 0 0 0;
        }
        li {
            margin-bottom: 0.4rem;
        }
        .badge {
            display: inline-block;
            background-color: #e0f2fe;
            color: #0369a1;
            font-weight: 600;
            font-size: 0.8rem;
            padding: 4px 10px;
            border-radius: 999px;
            margin-right: 6px;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    @include('partials.nav')

    <div class="container">
        <div class="card">
            <h1>About My POS System</h1>
            <p>
                This is a database-backed Point of Sale (POS) web application built with Laravel.
                In this activity, account management was refactored into
                <strong>resource controllers</strong> and locked behind <strong>authentication</strong>.
            </p>
            <div>
                <span class="badge">Laravel 12</span>
                <span class="badge">PHP 8.2+</span>
                <span class="badge">SQLite / MySQL</span>
                <span class="badge">Laravel Breeze</span>
                <span class="badge">Intervention Image v3</span>
            </div>
        </div>

        <div class="card">
            <h2>What Was Built in This Activity</h2>
            <div class="grid">
                <div class="feature-box">
                    <h3>1. Resource Routes &amp; Controllers</h3>
                    <p>Customer and user account routes are each registered with a single <code>Route::resource()</code> line, backed by controllers using the seven conventional methods.</p>
                </div>
                <div class="feature-box">
                    <h3>2. Laravel Breeze Authentication</h3>
                    <p>Login, registration and password pages are scaffolded with Laravel Breeze, adapted to the <code>username</code> and <code>full_name</code> account fields.</p>
                </div>
                <div class="feature-box">
                    <h3>3. Protected Pages</h3>
                    <p>The <code>auth</code> middleware guards every customer and user page. Visitors who are logged out are redirected to the login page.</p>
                </div>
                <div class="feature-box">
                    <h3>4. Secure Accounts</h3>
                    <p>Passwords are stored hashed, forms use CSRF protection, and you cannot delete the account you are logged in with.</p>
                </div>
            </div>
        </div>

        <div class="card">
            <h2>System Modules</h2>
            <ul>
                <li><strong>Customers (<a href="/customers">/customers</a>):</strong> Manage customer profiles including full name, email address, phone number, and profile avatar.</li>
                <li><strong>Users (<a href="/users">/users</a>):</strong> Manage POS operator accounts with unique usernames, full names, hashed passwords, and avatars.</li>
            </ul>
        </div>
    </div>
</body>
</html>