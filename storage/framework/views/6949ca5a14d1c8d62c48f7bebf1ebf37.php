<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>BestEx Travel Login</title>
  <style>
    :root{
      --accent:#e21b1b; /* red used for login button */
      --muted:#6b7280;
      --card-bg: rgba(255,255,255,0.95);
      --glass: linear-gradient(180deg, rgba(255,255,255,0.9), rgba(255,255,255,0.85));
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }
    html,body{height:100%;margin:0;background: linear-gradient(180deg,#e7f2ff 0%, #f6f0fb 100%);}
    .wrap{
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:32px;
      box-sizing:border-box;
    }

    /* big rounded container */
    .card {
      width:100%;
      max-width:1100px;
      background:var(--card-bg);
      border-radius:18px;
      box-shadow: 0 10px 30px rgba(20,30,60,0.08);
      display:flex;
      overflow:hidden;
      align-items:stretch;
      gap:0;
    }

    /* left panel with illustration */
    .left {
      flex:1.05;
      min-width:320px;
      padding:42px 36px;
      background:
        url('left-illustration.png') right center / contain no-repeat,
        linear-gradient(180deg, rgba(255,255,255,0.6), rgba(255,255,255,0.55));
      display:flex;
      flex-direction:column;
      justify-content:center;
      gap:20px;
    }
    .left .welcome {
      font-weight:700;
      color:#0b6a96;
      font-size:22px;
      letter-spacing:0.2px;
    }
    .left .biglogo {
      width:84px;
      height:84px;
      border-radius:50%;
      background:white;
      display:flex;
      align-items:center;
      justify-content:center;
      box-shadow:0 6px 18px rgba(11,106,150,0.08);
    }
    .left p {
      margin:0;
      color:var(--muted);
      font-size:14px;
    }

    /* right panel the login form */
    .right {
      width:420px;
      padding:36px 40px;
      display:flex;
      flex-direction:column;
      gap:14px;
      align-items:stretch;
      background:transparent;
    }
    .brand {
      display:flex;
      align-items:center;
      gap:12px;
      margin-bottom:6px;
    }
    .brand img { height:100px; display:block; }
    .input {
      border:0;
      border-bottom:1px solid #e6e7eb;
      padding:12px 10px;
      font-size:15px;
      outline:none;
      background:transparent;
      width:100%;
    }
    .field {
      display:flex;
      border-radius:6px;
      background:transparent;
      align-items:center;
      position:relative;
    }
    .field label { display:block; font-size:13px; color:var(--muted); margin-bottom:6px; }
    .form-row { margin-bottom:12px; }
    .show-pass {
      position:absolute;
      right:8px;
      top:50%;
      transform:translateY(-50%);
      border:0;
      background:transparent;
      cursor:pointer;
      padding:6px;
      font-size:13px;
      color:var(--muted);
    }

    .links {
      display:flex;
      justify-content:space-between;
      align-items:center;
      font-size:13px;
      margin-top:4px;
      color:var(--muted);
    }

    .btn {
      margin-top:8px;
      padding:12px 18px;
      background:var(--accent);
      color:white;
      border:0;
      width:100%;
      border-radius:6px;
      font-weight:600;
      cursor:pointer;
      box-shadow:0 6px 18px rgba(226,27,27,0.12);
    }

    .small-muted {
      color:var(--muted);
      font-size:13px;
      text-align:center;
      margin-top:10px;
    }

    /* bottom download bar */
    .download-bar {
      margin:18px;
      margin-top:26px;
      border-radius:12px;
      background:linear-gradient(180deg,#ffffff,#faf9ff);
      padding:12px 16px;
      display:flex;
      gap:12px;
      align-items:center;
      justify-content:space-between;
      box-shadow: 0 6px 18px rgba(10,20,50,0.04);
    }
    .download-left {
      display:flex;
      gap:10px;
      align-items:center;
    }
    .download-left .phone {
      display:flex;
      gap:6px;
      align-items:center;
      border:1px solid #e6e8ee;
      padding:6px 8px;
      border-radius:6px;
      background:white;
    }
    .download-left input[type="text"]{
      border:0; outline:none; padding:6px; width:170px;
    }
    .get-link {
      padding:8px 10px;
      border-radius:6px;
      background:transparent;
      border:1px solid #e6e8ee;
      font-weight:600;
      cursor:pointer;
    }
    .download-right { display:flex; gap:10px; align-items:center; }
    .google-badge{ height:36px; display:block; }

    /* responsive */
    @media (max-width:880px){
      .card { flex-direction:column; max-width:760px; }
      .left { padding:24px; order:1; min-height:180px; background-size:cover; }
      .right { width:100%; order:2; padding:20px; }
      .download-bar { flex-direction:column; align-items:stretch; gap:10px; }
      .download-right { justify-content:flex-end; }
    }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card" role="main" aria-labelledby="login-title">

      <!-- LEFT: Illustration -->
      <div class="left" aria-hidden="false">
        <div style="display:flex;align-items:center;justify-content:space-between;">
          <div>
            <div class="welcome">WELCOME TO BESTEX TRAVELS</div>
            <p>Book Airline, Train, Bus & Hotels — all in one place.</p>
          </div>
          <div class="biglogo">
            <!-- small round logo -->
            <img src="<?php echo e(asset('assets/img/login.png')); ?>" alt="logo" style="width:64px;height:64px;object-fit:contain;">
          </div>
        </div>

       <img src="<?php echo e(asset('assets/img/img-login.jpg')); ?>" />
        <div style="margin-top:auto;color:var(--muted);font-size:13px;">
          Secure login • Fast bookings • 24/7 support
        </div>
      </div>

      <!-- RIGHT: Form -->
      <div class="right">
        <div class="brand">
          <img src="<?php echo e(asset('assets/img/logo.webp')); ?>" alt="bestex logo">
        </div>

                    <form method="POST" action="<?php echo e(route('login.post')); ?>">
                        <?php echo csrf_field(); ?>
        <div>
          <label for="user" style="font-size:13px;color:var(--muted)">Enter Mobile Number/ Email ID</label>
          <div class="field form-row">
            <input id="user" name="email" class="input" placeholder="mobile number or email" type="text" />
          </div>
        </div>

        <div>
          <label for="password" style="font-size:13px;color:var(--muted)">Password</label>
          <div class="field form-row">
            <input id="password" name="password" class="input" placeholder="Password" type="password" />
            <button class="show-pass" id="togglePass" aria-label="toggle password">Show</button>
          </div>
        </div>

        <div class="links">
          <a href="#" id="signup" style="text-decoration:none;color:var(--muted)">Signup</a>
          <a href="#" id="forgot" style="text-decoration:none;color:var(--muted)">Forgot Password</a>
        </div>

        <button class="btn" id="loginBtn">LOGIN</button>

        <div class="small-muted">About Us | Privacy Policy | Terms and Conditions</div>

        <!-- Download bar -->

      </form>

      </div>
    </div>
  </div>

 <script>
  // Show / hide password (fixed: no page refresh)
  const pass = document.getElementById('password');
  const toggle = document.getElementById('togglePass');
  toggle.addEventListener('click', (e) => {
    e.preventDefault(); // ✅ prevents page reload

    if (pass.type === 'password') {
      pass.type = 'text';
      toggle.textContent = 'Hide';
    } else {
      pass.type = 'password';
      toggle.textContent = 'Show';
    }
  });

  // Simple login click demo

</script>

</body>
</html>

<?php /**PATH C:\wamp64\www\BestexTravel\agentbestex\resources\views/auth/login.blade.php ENDPATH**/ ?>