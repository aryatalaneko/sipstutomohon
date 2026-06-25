<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SIPSTU</title>
  
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --blue-950: #0a1628;
      --blue-600: #2563a8;
      --blue-500: #3b82d4;
      --blue-400: #60a5f0;
      --surface: #f8fafc;
      --text-primary: #0f172a;
      --text-secondary: #475569;
      --text-muted: #94a3b8;
      --border: #e2e8f0;
    }
    
    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--surface);
      color: var(--text-primary);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
    }

    /* Abstract background shapes matching SIPSTU theme */
    body::before {
      content: '';
      position: absolute;
      top: -100px; left: -100px;
      width: 400px; height: 400px;
      background: radial-gradient(circle, rgba(59,130,212,0.1) 0%, transparent 70%);
      border-radius: 50%;
      z-index: -1;
    }
    body::after {
      content: '';
      position: absolute;
      bottom: -150px; right: -50px;
      width: 500px; height: 500px;
      background: radial-gradient(circle, rgba(16,185,129,0.08) 0%, transparent 70%);
      border-radius: 50%;
      z-index: -1;
    }

    .login-card {
      background: white;
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(10, 22, 40, 0.08);
      padding: 48px 40px;
      width: 100%;
      max-width: 420px;
      border: 1px solid var(--border);
      position: relative;
    }

    .logo-badge {
      display: flex;
      justify-content: center;
      margin-bottom: 24px;
    }
    .logo-icon {
      width: 56px;
      height: 56px;
      background: var(--blue-500);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 22px;
      color: white;
      box-shadow: 0 10px 20px rgba(59, 130, 212, 0.2);
    }

    .login-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 24px;
      text-align: center;
      margin-bottom: 6px;
      color: var(--blue-950);
    }

    .login-sub {
      font-size: 14px;
      color: var(--text-secondary);
      text-align: center;
      margin-bottom: 32px;
    }

    .form-label {
      font-size: 13px;
      font-weight: 600;
      color: var(--text-primary);
      margin-bottom: 6px;
    }

    .form-control {
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 14px;
      border: 1px solid var(--border);
      background: var(--surface);
      color: var(--text-primary);
      transition: all 0.2s;
    }

    .form-control:focus {
      background: white;
      box-shadow: 0 0 0 4px rgba(59,130,212,0.15);
      border-color: var(--blue-400);
    }

    .btn-login {
      background: var(--blue-600);
      color: white;
      border-radius: 10px;
      padding: 12px;
      font-weight: 600;
      font-size: 15px;
      width: 100%;
      margin-top: 24px;
      transition: all 0.2s;
      border: none;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .btn-login:hover {
      background: var(--blue-700);
      transform: translateY(-2px);
      box-shadow: 0 8px 16px rgba(37, 99, 168, 0.2);
    }

    .alert {
      font-size: 13px;
      border-radius: 10px;
      padding: 12px 16px;
      margin-bottom: 24px;
      border: none;
    }
  </style>
</head>
<body>

<div class="login-card">
  <div class="logo-badge">
    <div class="logo-icon">ST</div>
  </div>
  
  <h1 class="login-title">Masuk ke SIPSTU</h1>
  <p class="login-sub">Sistem Informasi Pemantauan Stunting</p>

  <?php if($this->session->flashdata('error')): ?>
    <div class="alert alert-danger" style="background:#fef2f2; color:#b91c1c;">
        <div class="d-flex align-items-center gap-2">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <?= $this->session->flashdata('error') ?>
        </div>
    </div>
  <?php endif; ?>

  <form action="<?= base_url('auth/process') ?>" method="POST">
    <div class="mb-4">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
    </div>
    
    <div class="mb-2">
      <div class="d-flex justify-content-between">
        <label class="form-label">Password</label>
      </div>
      <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
    </div>
    
    <button type="submit" class="btn btn-login">Login Sekarang</button>
  </form>
</div>

</body>
</html>
