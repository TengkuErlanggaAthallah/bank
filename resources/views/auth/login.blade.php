<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/erlass.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/lte/dist/css/adminlte.css">
</head>
<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{ route('login') }}" class="link-dark text-center">
                    <h1 class="mb-0"><b>Login</b></h1>
                </a>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('login-proses') }}" method="post">
                    @csrf
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="loginEmail" name="email" type="email" class="form-control" placeholder="" required>
                            <label for="loginEmail">Email</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="loginPassword" name="password" type="password" class="form-control" placeholder="" required>
                            <label for="loginPassword">Password</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword" onclick="togglePasswordVisibility()">
                            <span id="toggleIcon" class="bi bi-eye-fill"></span>
                        </button>
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    
                    <div class="row">
                        <div class="col-8 d-inline-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </div>
                    </div>
                </form>
                
                <!-- Link to Registration Page -->
                <div class="mt-3 text-center">
                    <p>Don't have an account? <a href="{{ route('register') }}" class="text-primary">Register here</a></p>
                </div>
            </div>
        </div>
    </div>

    @error('login')
    <small class="text-danger">{{ $message }}</small>
    @enderror

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="/lte/dist/js/adminlte.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('loginPassword');
            const toggleIcon = document.getElementById('toggleIcon');
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
            }
        }
        
        @if(session('failed'))
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "{{ session('failed') }}",
    });
    @endif

    @if(session('success'))
    Swal.fire({
        icon: "success",
        title: "Success!",
        text: "{{ session('success') }}",
    });
    @endif

    @if($errors->any())
        @foreach ($errors->all() as $error)
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ $error }}",
            });
        @endforeach
    @endif
    </script>
</body>
</html>