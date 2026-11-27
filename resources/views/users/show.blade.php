<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Details - POS</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8fafc; color: #334155; margin: 0; padding: 2rem; }
        nav { background-color: #1e293b; padding: 1rem 2rem; border-radius: 8px; margin-bottom: 2rem; }
        nav a { color: #e2e8f0; text-decoration: none; margin-right: 1.5rem; font-weight: 600; }
        .card { max-width: 520px; background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 1.25rem; }
        label { display: block; font-weight: 600; margin-bottom: 0.4rem; }
        input[type="text"], input[type="email"], input[type="password"], input[type="file"] { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; }
        .error { color: #dc2626; font-size: 0.85rem; margin-top: 0.3rem; }
        .btn { padding: 10px 18px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer; text-decoration: none; }
        .btn-primary { background-color: #0284c7; color: #fff; }
        .btn-secondary { background-color: #e2e8f0; color: #1e293b; margin-left: 8px; }
        .preview-img { width: 72px; height: 72px; border-radius: 50%; object-fit: cover; margin-bottom: 0.5rem; display: block; }
        dt { font-weight: 600; margin-top: 1rem; }
        dd { margin: 0.2rem 0 0 0; }
        .actions { margin-top: 1.5rem; }
    </style>
</head>
<body>
    @include('partials.nav')

    <div class="card">
        <h1>User Details</h1>
        @if($user->avatar)
            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->full_name }}" class="preview-img">
        @endif

        <dl>
            <dt>Username</dt>
            <dd>{{ $user->username ?? '—' }}</dd>
            <dt>Full Name</dt>
            <dd>{{ $user->full_name ?? '—' }}</dd>
            <dt>Email</dt>
            <dd>{{ $user->email ?? '—' }}</dd>
            <dt>Date Added</dt>
            <dd>{{ $user->created_at?->format('M d, Y h:i A') ?? '—' }}</dd>
        </dl>

        <div class="actions">
            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to list</a>
        </div>
    </div>
</body>
</html>
