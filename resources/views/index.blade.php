<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Warehouse Key</title>
  <link rel="icon" href="{{ asset('img/CH_ICON1.ico') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
    rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <style>
    body {
      background: #f0f2f5;
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-card {
      background: #e2e2e2;
      border: none;
      border-radius: 16px;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
      padding: 2.5rem;
      width: 100%;
      max-width: 420px;
    }

    .login-logo {
      width: 48px;
      height: 48px;
      background: #0d6efd;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.4rem;
      margin: 0 auto 1.25rem;
    }

    .login-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: #1a1a2e;
      text-align: center;
      margin-bottom: 0.3rem;
    }

    .login-subtitle {
      font-size: 0.875rem;
      color: #6c757d;
      text-align: center;
      margin-bottom: 2rem;
    }

    .form-label {
      font-size: 0.85rem;
      font-weight: 500;
      color: #374151;
      margin-bottom: 0.4rem;
    }

    .input-wrapper {
      position: relative;
      margin-bottom: 1.1rem;
    }

    .input-icon {
      position: absolute;
      left: 13px;
      top: 50%;
      transform: translateY(-50%);
      color: #adb5bd;
      font-size: 1rem;
      pointer-events: none;
    }

    .form-control {
      padding: 0.7rem 1rem 0.7rem 2.6rem;
      border: 1.5px solid #e5e7eb;
      border-radius: 10px;
      font-size: 0.9rem;
      color: #1a1a2e;
      background: #fafafa;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
      background: #fff;
      outline: none;
    }

    .form-control::placeholder {
      color: #c4c9d4;
    }

    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .form-check-label {
      font-size: 0.85rem;
      color: #6c757d;
    }

    .form-check-input:checked {
      background-color: #0d6efd;
      border-color: #0d6efd;
    }

    .forgot-link {
      font-size: 0.85rem;
      color: #0d6efd;
      text-decoration: none;
      font-weight: 500;
    }

    .forgot-link:hover {
      text-decoration: underline;
    }

    .btn-login {
      width: 100%;
      padding: 0.75rem;
      background: #d12f24;
      border: none;
      border-radius: 10px;
      color: white;
      font-size: 0.95rem;
      font-weight: 500;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
      transition: background 0.2s, transform 0.15s;
      margin-bottom: 1.25rem;
    }

    .btn-login:hover {
      background: #ff8b83;
      transform: translateY(-1px);
    }

    .register-text {
      text-align: center;
      font-size: 0.85rem;
      color: #6c757d;
    }

    .register-text a {
      color: #0d6efd;
      text-decoration: none;
      font-weight: 500;
    }

    .register-text a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body style="padding: 20px;">

  <div class="login-card">

    <!-- Logo -->
    <!-- <div class="login-logo">
      <i class="bi bi-shield-check"></i>
    </div> -->

    <!-- Title -->
    <center><img src="{{ asset('img/ch_logo1.PNG') }}" alt="" style="border-radius: 10px; width:200px;"></center>
    <!-- <h1 class="login-title">Warehouse Key</h1> -->
    <p class="login-subtitle">Enter your credentials to continue</p>

    <!-- Form -->
    <form action="{{ route('login') }}" method="POST">
      @csrf
      <!-- Email -->
      <label class="form-label" for="email">Username</label>
      <div class="input-wrapper">
        <input type="text" class="form-control" id="email" name="username" placeholder="Enter your username" required />
      </div>

      <!-- Password -->
      <label class="form-label" for="password">Password</label>
      <div class="input-wrapper">
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password"
          required />
      </div>

      <!-- Options -->
      <!-- Submit -->
      <button type="submit" class="btn-login">Sign In</button>
      @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif
    </form>

    <!-- <p class="register-text">
        Don't have an account? <a href="#">Register</a>
        </p> -->
  </div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  $(document).ready(function () {
    history.pushState(null, null, location.href);

    window.onpopstate = function () {
      history.go(1);
    };
  });
</script>