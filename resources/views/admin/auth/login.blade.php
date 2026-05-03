<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — AYKA Originals</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css'])
</head>
<body style="font-family:'Montserrat',sans-serif;background:#0B132B;min-height:100vh;display:flex;align-items:center;justify-content:center">
  <div style="width:100%;max-width:400px;padding:2rem">
    <div style="background:#fff;padding:3rem 2.5rem">
      <div style="text-align:center;margin-bottom:2.5rem">
        <div style="font-family:'Cormorant Garamond',serif;font-size:2rem;letter-spacing:0.3em;color:#0B132B;font-weight:600">AYKA</div>
        <div style="font-size:0.55rem;letter-spacing:0.5em;color:#5E6472;margin-top:-4px">ORIGINALS</div>
        <p style="font-size:0.7rem;letter-spacing:0.2em;text-transform:uppercase;color:#5E6472;margin-top:1rem">Admin Access</p>
      </div>

      @if($errors->any())
      <div style="background:#fee2e2;border-left:3px solid #dc2626;padding:0.75rem 1rem;margin-bottom:1.5rem;font-size:0.8rem;color:#dc2626">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div style="margin-bottom:1.5rem">
          <label style="display:block;font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:#5E6472;margin-bottom:0.5rem">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" required class="admin-input" placeholder="admin@aykaoriginals.com">
        </div>
        <div style="margin-bottom:2rem">
          <label style="display:block;font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:#5E6472;margin-bottom:0.5rem">Password</label>
          <input type="password" name="password" required class="admin-input" placeholder="••••••••">
        </div>
        <button type="submit" class="admin-btn" style="width:100%;justify-content:center">Sign In</button>
      </form>

      <p style="text-align:center;margin-top:1.5rem;font-size:0.7rem;color:#8B90A0">Default: admin@aykaoriginals.com / Admin@2024!</p>
    </div>
  </div>
</body>
</html>
