<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE | Register Page</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/lte/dist/css/adminlte.css">
    <link rel="shortcut icon" href="/images/erlass.png">
</head>

<body class="register-page bg-body-secondary">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new admin account</p>

                <form action="{{ route('register-proses') }}" method="POST">
                    @csrf
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="registerFullName" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full Name" required>
                            <label for="registerFullName">Full Name</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-person"></span>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="registerEmail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required>
                            <label for="registerEmail">Email</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-envelope"></span>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="registerPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                            <label for="registerPassword">Password</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="registerPasswordConfirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password" required>
                            <label for="registerPasswordConfirmation">Confirm Password</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>                  
                    
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>

                <a href="{{ route('login') }}" class="text-center">I already have an account</a>
            </div>
        </div>
    </div>

 <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="/lte/dist/js/adminlte.js"></script>
</body>

</html>