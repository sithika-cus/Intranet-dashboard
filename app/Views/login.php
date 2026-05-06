<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Sri Lanka Customs — Login</title>
  <link rel="stylesheet" href="<?= base_url('dist/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #152433 0%, #1e3a52 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Source Sans Pro', sans-serif;
    }
    .login-box { width: 380px; }
    .login-logo { text-align: center; margin-bottom: 24px; }
    .login-logo h1 { color: #fff; font-size: 1.5rem; font-weight: 700; margin: 0; }
    .login-logo p  { color: #8ba3b8; font-size: 0.85rem; margin-top: 6px; }
    .login-card {
      background: #fff; border-radius: 10px;
      padding: 32px; box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }
    .login-card h4 { font-weight: 700; color: #222; margin-bottom: 20px; font-size: 1.1rem; }
    .form-group label { font-weight: 600; font-size: 0.85rem; color: #444; }
    .input-group-addon {
      background: #f4f4f4; border: 1px solid #ddd;
      border-right: none; padding: 0 12px;
      display: flex; align-items: center; color: #888;
      border-radius: 6px 0 0 6px;
    }
    .form-control {
      border-radius: 0 6px 6px 0 !important;
      height: 42px; border: 1px solid #ddd;
      font-size: 0.9rem;
    }
    .form-control:focus { border-color: #3c8dbc; box-shadow: none; outline: none; }
    .btn-login {
      background: linear-gradient(135deg, #152433, #3c8dbc);
      color: #fff; border: none; border-radius: 6px;
      height: 42px; font-size: 0.95rem; font-weight: 600;
      width: 100%; cursor: pointer; margin-top: 8px;
      transition: opacity 0.2s;
    }
    .btn-login:hover { opacity: 0.9; }
    .alert-danger { border-radius: 6px; font-size: 0.85rem; margin-bottom: 16px; }
    .login-footer { text-align: center; margin-top: 20px; color: #8ba3b8; font-size: 0.78rem; }
  </style>
</head>
<body>
  <div class="login-box">
    <div class="login-logo">
      <h1><i class="fa fa-shield"></i> Sri Lanka Customs</h1>
      <p>Intranet Portal — Please sign in to continue</p>
    </div>

    <div class="login-card">
      <h4>Sign In</h4>

      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
          <i class="fa fa-exclamation-circle"></i>
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <form action="<?= base_url('login') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="form-group">
          <label>Username</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" name="username" class="form-control"
                   placeholder="Enter your username" required autofocus
                   value="<?= old('username') ?>">
          </div>
        </div>

        <div class="form-group">
          <label>Password</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input type="password" name="password" class="form-control"
                   placeholder="Enter your password" required>
          </div>
        </div>

        <button type="submit" class="btn-login">
          <i class="fa fa-sign-in"></i> Sign In
        </button>
      </form>
    </div>

    <div class="login-footer">
      &copy; <?= date('Y') ?> Sri Lanka Customs. All rights reserved.
    </div>
  </div>
</body>
</html>