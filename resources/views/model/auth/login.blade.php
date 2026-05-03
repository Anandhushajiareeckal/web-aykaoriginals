<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Model Login — AYKA Originals</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css'])
  <style>
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:'Inter',sans-serif;min-height:100vh;background:#0B132B;display:flex;align-items:stretch}
    .auth-left{flex:1;background:linear-gradient(160deg,#0B132B 0%,#1C2951 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;padding:3rem;position:relative;overflow:hidden}
    .auth-left::before{content:'';position:absolute;top:-20%;left:-20%;width:60%;height:60%;background:radial-gradient(circle,rgba(201,169,110,.08) 0%,transparent 70%);border-radius:50%}
    .auth-left::after{content:'';position:absolute;bottom:-20%;right:-20%;width:80%;height:80%;background:radial-gradient(circle,rgba(108,99,255,.06) 0%,transparent 70%);border-radius:50%}
    .auth-left-content{position:relative;z-index:1;max-width:400px;text-align:center}
    .auth-logo{font-family:'Cormorant Garamond',serif;font-size:3rem;font-weight:300;letter-spacing:.4em;color:#fff;display:block;line-height:1}
    .auth-logo-sub{font-size:.5rem;letter-spacing:.6em;color:rgba(255,255,255,.3);text-transform:uppercase;margin-top:.5rem;display:block}
    .auth-tagline{font-size:.85rem;color:rgba(255,255,255,.45);line-height:1.8;margin-top:2rem;max-width:300px}
    .auth-features{margin-top:2.5rem;display:flex;flex-direction:column;gap:1rem;text-align:left}
    .auth-feature{display:flex;align-items:center;gap:.875rem}
    .auth-feature-dot{width:6px;height:6px;border-radius:50%;background:linear-gradient(135deg,#C9A96E,#e8c07a);flex-shrink:0}
    .auth-feature span{font-size:.78rem;color:rgba(255,255,255,.5)}
    .auth-right{width:480px;background:#F4F5FA;display:flex;align-items:center;justify-content:center;padding:3rem 2.5rem}
    .auth-card{width:100%;max-width:400px}
    .auth-card h1{font-family:'Cormorant Garamond',serif;font-size:2rem;font-weight:400;color:#0B132B;margin-bottom:.5rem}
    .auth-card p{font-size:.82rem;color:#5E6472;margin-bottom:2rem}
    .form-group{margin-bottom:1.25rem}
    .form-label{display:block;font-size:.68rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.5rem}
    .form-control{width:100%;padding:.7rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.875rem;color:#0B132B;background:#fff;transition:border-color .2s,box-shadow .2s;font-family:'Inter',sans-serif}
    .form-control:focus{outline:none;border-color:#6C63FF;box-shadow:0 0 0 3px rgba(108,99,255,.12)}
    .form-control::placeholder{color:#8B90A0}
    .btn-submit{width:100%;padding:.8rem;border:none;border-radius:8px;background:linear-gradient(135deg,#6C63FF,#8B80FF);color:#fff;font-size:.85rem;font-weight:600;cursor:pointer;transition:all .2s;font-family:'Inter',sans-serif;box-shadow:0 4px 15px rgba(108,99,255,.3)}
    .btn-submit:hover{box-shadow:0 6px 20px rgba(108,99,255,.5);transform:translateY(-1px)}
    .auth-link{font-size:.8rem;color:#5E6472;margin-top:1.25rem;text-align:center}
    .auth-link a{color:#6C63FF;font-weight:500}
    .auth-link a:hover{text-decoration:underline}
    .field-error{font-size:.72rem;color:#EF4444;margin-top:.35rem;display:flex;align-items:center;gap:.35rem}
    .remember-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem}
    .remember-label{display:flex;align-items:center;gap:.5rem;font-size:.78rem;color:#5E6472;cursor:pointer}
    .divider-or{display:flex;align-items:center;gap:.75rem;margin:1.25rem 0;color:#8B90A0;font-size:.72rem}
    .divider-or::before,.divider-or::after{content:'';flex:1;height:1px;background:#E4E6F0}
    @media(max-width:900px){.auth-left{display:none}.auth-right{width:100%}}
    @media(max-width:480px){.auth-right{padding:2rem 1.5rem}}
  </style>
</head>
<body>
<div class="auth-left">
  <div class="auth-left-content">
    <span class="auth-logo">AYKA</span>
    <span class="auth-logo-sub">Originals — Model Portal</span>
    <p class="auth-tagline">Your professional presence, beautifully managed. Upload, showcase, and get discovered.</p>
    <div class="auth-features">
      <div class="auth-feature"><div class="auth-feature-dot"></div><span>Build your digital comp card</span></div>
      <div class="auth-feature"><div class="auth-feature-dot"></div><span>Manage your portfolio with ease</span></div>
      <div class="auth-feature"><div class="auth-feature-dot"></div><span>Get featured on the agency's public roster</span></div>
      <div class="auth-feature"><div class="auth-feature-dot"></div><span>Share your shareable profile link</span></div>
    </div>
  </div>
</div>

<div class="auth-right">
  <div class="auth-card">
    <h1>Welcome back</h1>
    <p>Sign in to your model portal to manage your profile.</p>

    @if(session('error'))
    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:.875rem;font-size:.8rem;color:#dc2626;margin-bottom:1.25rem">
      {{ session('error') }}
    </div>
    @endif

    <form method="POST" action="{{ route('model.login.post') }}">
      @csrf
      <div class="form-group">
        <label class="form-label" for="email">Email Address</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="form-control" placeholder="your@email.com">
        @error('email')<div class="field-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input type="password" id="password" name="password" required autocomplete="current-password" class="form-control" placeholder="••••••••">
        @error('password')<div class="field-error">{{ $message }}</div>@enderror
      </div>
      <div class="remember-row">
        <label class="remember-label">
          <input type="checkbox" name="remember" style="accent-color:#6C63FF"> Remember me
        </label>
      </div>
      <button type="submit" class="btn-submit">Sign In to Portal</button>
    </form>

    <div class="divider-or">or</div>

    <p class="auth-link">
      Don't have an account? <a href="{{ route('model.register') }}">Register as a model</a>
    </p>
    <p class="auth-link" style="margin-top:.75rem">
      Are you an admin? <a href="{{ route('admin.login') }}">Admin login →</a>
    </p>
  </div>
</div>
</body>
</html>
