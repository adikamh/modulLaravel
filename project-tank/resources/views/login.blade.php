@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light login-page">
    <button id="btn-theme" class="btn btn-outline-light position-fixed top-0 end-0 m-3" style="z-index: 1050;">Mode Gelap</button>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 login-card">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4 text-primary">Login</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label fw-bold">Username</label>
                                <input type="text" id="username" name="username" class="form-control form-control-lg" value="{{ request()->cookie('username') ?? '' }}" required placeholder="Masukkan username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input type="password" id="password" name="password" class="form-control form-control-lg" required placeholder="Masukkan password">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" id="remember" name="remember" class="form-check-input">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                            <button type="submit" class="btn btn-warning btn-lg w-100 mb-3">Login</button>
                            <div class="text-center">
                                <a href="{{ route('home') }}" class="text-decoration-none">Kembali ke beranda</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>


