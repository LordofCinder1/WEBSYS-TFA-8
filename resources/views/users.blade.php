<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Accounts - POS</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8fafc; color: #334155; margin: 0; padding: 2rem; }
        nav { background-color: #1e293b; padding: 1rem 2rem; border-radius: 8px; margin-bottom: 2rem; }
        nav a { color: #e2e8f0; text-decoration: none; margin-right: 1.5rem; font-weight: 600; }
        nav a:hover { color: #38bdf8; }
        .header-row { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem; }
        h1 { color: #0f172a; margin: 0; }
        .btn { display: inline-block; padding: 8px 14px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.875rem; border: none; cursor: pointer; }
        .btn-primary { background-color: #0284c7; color: #ffffff; }
        .btn-primary:hover { background-color: #0369a1; }
        .btn-edit { background-color: #e2e8f0; color: #1e293b; margin-right: 6px; }
        .btn-delete { background-color: #fee2e2; color: #b91c1c; }
        .alert-success { background-color: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 6px; margin-top: 1rem; }
        table { width: 100%; border-collapse: collapse; background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); border-radius: 8px; overflow: hidden; margin-top: 1rem; }
        th, td { padding: 12px 16px; text-align: left; vertical-align: middle; }
        th { background-color: #f1f5f9; color: #475569; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; }
        tr:not(:last-child) td { border-bottom: 1px solid #f1f5f9; }
        .avatar-img { width: 44px; height: 44px; border-radius: 50%; object-fit: cover; display: block; }
        .avatar-fallback { width: 44px; height: 44px; border-radius: 50%; background-color: #cbd5e1; color: #1e293b; font-weight: 700; display: flex; align-items: center; justify-content: center; }
    </style>
</head>
<body>
    @include('partials.nav')

    <div class="header-row">
        <h1>User Accounts</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">+ Add User</a>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert-success" style="background-color:#fee2e2; color:#b91c1c;">{{ session('error') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Avatar</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->full_name }}" class="avatar-img">
                        @else
                            <div class="avatar-fallback">{{ strtoupper(substr($user->full_name ?? $user->username, 0, 1)) }}</div>
                        @endif
                    </td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.show', $user) }}" class="btn btn-edit">View</a>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>