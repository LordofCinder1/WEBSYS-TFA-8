<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - POS Application</title>
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
            <h1>Point of Sale System</h1>
            @auth
                <p>Welcome, {{ auth()->user()->full_name }}. Choose what you want to manage.</p>
            @else
                <p>Log in to manage customer and user accounts.</p>
            @endauth

            <div class="grid">
                <div class="feature-box">
                    <h3><a href="{{ route('customers.index') }}">Customer Accounts</a></h3>
                    <p>Add, view, edit and delete customer records.</p>
                </div>
                <div class="feature-box">
                    <h3><a href="{{ route('users.index') }}">User Accounts</a></h3>
                    <p>Manage the accounts that can log in to the system.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
