<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Register as a Model — AYKA Originals</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css'])
  <style>
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:'Inter',sans-serif;min-height:100vh;background:#0B132B;display:flex;align-items:stretch}
    .auth-left{flex:1;background:linear-gradient(160deg,#0B132B 0%,#1C2951 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;padding:3rem;position:relative;overflow:hidden}
    .auth-left::before{content:'';position:absolute;top:-20%;left:-20%;width:60%;height:60%;background:radial-gradient(circle,rgba(201,169,110,.08) 0%,transparent 70%);border-radius:50%}
    .auth-logo{font-family:'Cormorant Garamond',serif;font-size:3rem;font-weight:300;letter-spacing:.4em;color:#fff;display:block;line-height:1;position:relative;z-index:1}
    .auth-logo-sub{font-size:.5rem;letter-spacing:.6em;color:rgba(255,255,255,.3);text-transform:uppercase;margin-top:.5rem;display:block;position:relative;z-index:1}
    .auth-tagline{font-size:.85rem;color:rgba(255,255,255,.45);line-height:1.8;margin-top:2rem;max-width:300px;position:relative;z-index:1}
    .auth-right{width:520px;background:#F4F5FA;display:flex;align-items:center;justify-content:center;padding:3rem 2.5rem;overflow-y:auto}
    .auth-card{width:100%;max-width:440px}
    .auth-card h1{font-family:'Cormorant Garamond',serif;font-size:2rem;font-weight:400;color:#0B132B;margin-bottom:.5rem}
    .auth-card p{font-size:.82rem;color:#5E6472;margin-bottom:2rem}
    .form-group{margin-bottom:1.125rem}
    .form-label{display:block;font-size:.68rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.5rem}
    .form-control{width:100%;padding:.7rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.875rem;color:#0B132B;background:#fff;transition:border-color .2s,box-shadow .2s;font-family:'Inter',sans-serif}
    .form-control:focus{outline:none;border-color:#6C63FF;box-shadow:0 0 0 3px rgba(108,99,255,.12)}
    .form-control::placeholder{color:#8B90A0}
    .btn-submit{width:100%;padding:.8rem;border:none;border-radius:8px;background:linear-gradient(135deg,#6C63FF,#8B80FF);color:#fff;font-size:.85rem;font-weight:600;cursor:pointer;transition:all .2s;font-family:'Inter',sans-serif;box-shadow:0 4px 15px rgba(108,99,255,.3)}
    .btn-submit:hover{box-shadow:0 6px 20px rgba(108,99,255,.5);transform:translateY(-1px)}
    .auth-link{font-size:.8rem;color:#5E6472;margin-top:1.25rem;text-align:center}
    .auth-link a{color:#6C63FF;font-weight:500}
    .field-error{font-size:.72rem;color:#EF4444;margin-top:.35rem}
    .note{font-size:.73rem;color:#8B90A0;background:#fff;border:1px solid #E4E6F0;border-radius:8px;padding:.75rem 1rem;margin-bottom:1.25rem;line-height:1.6}
    @media(max-width:900px){.auth-left{display:none}.auth-right{width:100%}}
    @media(max-width:480px){.auth-right{padding:2rem 1.5rem}}
  </style>
</head>
<body>
<div class="auth-left">
  <div style="position:relative;z-index:1;max-width:400px;text-align:center">
    <span class="auth-logo">AYKA</span>
    <span class="auth-logo-sub">Originals — Model Portal</span>
    <p class="auth-tagline">Join our roster. Create your professional profile, build your comp card, and let the world discover your talent.</p>
  </div>
</div>

<div class="auth-right">
  <div class="auth-card">
    <h1>Create your account</h1>
    <p>Register to manage your model profile on AYKA Originals.</p>

    <div class="note">
      ℹ️ Your profile will be reviewed by our team before appearing publicly on the agency roster.
    </div>

    <form method="POST" action="{{ route('model.register.post') }}">
      @csrf
      <div class="form-group">
        <label class="form-label" for="name">Full Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" class="form-control" placeholder="Your professional name">
        @error('name')<div class="field-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label" for="email">Email Address</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="form-control" placeholder="your@email.com">
        @error('email')<div class="field-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input type="password" id="password" name="password" required autocomplete="new-password" class="form-control" placeholder="At least 8 characters">
        @error('password')<div class="field-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label" for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" class="form-control" placeholder="Repeat your password">
      </div>
      <button type="submit" class="btn-submit" style="margin-top:.5rem">Create Account</button>
    </form>

    <p class="auth-link" style="margin-top:1.25rem">
      Already have an account? <a href="{{ route('model.login') }}">Sign in →</a>
    </p>
  </div>
</div>
</body>
</html>
