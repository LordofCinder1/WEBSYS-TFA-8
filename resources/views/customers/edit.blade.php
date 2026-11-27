<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Customer - POS</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8fafc; color: #334155; margin: 0; padding: 2rem; }
        nav { background-color: #1e293b; padding: 1rem 2rem; border-radius: 8px; margin-bottom: 2rem; }
        nav a { color: #e2e8f0; text-decoration: none; margin-right: 1.5rem; font-weight: 600; }
        .card { max-width: 520px; background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 1.25rem; }
        label { display: block; font-weight: 600; margin-bottom: 0.4rem; }
        input[type="text"], input[type="email"], input[type="file"] { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; }
        .error { color: #dc2626; font-size: 0.85rem; margin-top: 0.3rem; }
        .btn { padding: 10px 18px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer; text-decoration: none; }
        .btn-primary { background-color: #0284c7; color: #fff; }
        .btn-secondary { background-color: #e2e8f0; color: #1e293b; margin-left: 8px; }
        .preview-img { width: 72px; height: 72px; border-radius: 50%; object-fit: cover; margin-bottom: 0.5rem; display: block; }
    </style>
</head>
<body>
    @include('partials.nav')

    <div class="card">
        <h1>Edit Customer</h1>
        <form action="{{ route('customers.update', $customer) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $customer->full_name) }}" required>
                @error('full_name') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}" required>
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}">
                @error('phone') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="avatar">Avatar (Leave blank to keep current)</label>
                @if($customer->avatar)
                    <img src="{{ asset('storage/' . $customer->avatar) }}" alt="{{ $customer->full_name }}" class="preview-img">
                @endif
                <input type="file" id="avatar" name="avatar" accept="image/*">
                @error('avatar') <div class="error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Customer</button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>